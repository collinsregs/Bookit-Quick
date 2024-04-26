<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Models\ticket;
use Illuminate\Http\Request;
use App\Mail\Tickets_mail;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;




class TicketController extends Controller
{
    public function index($event_Id){
        $user_Id=auth()->user()->id;
        $event=event::where('event_Id',$event_Id)->first();
        $tickets=ticket::where('event_id',$event_Id)->where('User_Id',$user_Id)->get();
        $ticket_stub=[];
        foreach ($tickets as $item ) {
            $ticket_stub[]=[
               'event_Id'=>$event->event_Id,
               'event_Name'=>$event->event_Name,
               'event_Location'=>$event->event_Location,
               'event_Date'=>$event->event_Date,
               'ticket_Id'=>$item->id,
               'ticket_type'=>$item->ticket_type,
               'user_Id'=>$user_Id,
            ];
        }
// dd($event,$tickets,$ticket_stub);
        return view('viewTicket',['tickets'=>$ticket_stub]);
    }

    public function ticketDetails($event_Id){
        $event = Event::where('event_ID',$event_Id)->first();
        $tickets=Ticket::where('event_ID',$event_Id)->get();
        $VIP_ticket_total=$event['max_VIP_Attendees']||0;
        $regular_ticket_total=$event['max_Attendees'];
        $VIP_count=0;
        $Regular_count=0;
        foreach($tickets as $ticket){
            if($ticket['VIP']){
                $VIP_count++;
            }
            if($ticket['Regular']){
                $Regular_count++;
            }
        }
        if($VIP_ticket_total==0){
            $remaining_VIP_tickets=0;
        }else{
            $remaining_VIP_tickets=$VIP_ticket_total-$VIP_count;
        }
        $remaining_Regular_tickets=$regular_ticket_total-$Regular_count;
            // dump($event_Id,$event,$tickets);

            return view('newTicket',['event'=>$event,'remaining_regular_tickets'=>$remaining_Regular_tickets,
        'remaining_VIP_tickets'=>$remaining_VIP_tickets, 'message'=>null]);


    }
    public function create(Request $request,$event_Id){
        $mailing_tickets=[];
        $event = Event::where('event_ID',$event_Id)->first();
        $tickets=Ticket::where('event_ID',$event_Id)->get();
        $VIP_ticket_total=$event['max_VIP_Attendees']||0;
        $regular_ticket_total=$event['max_Attendees'];
        $VIP_count=0;
        $Regular_count=0;
        foreach($tickets as $ticket){
            if($ticket['VIP']){
                $VIP_count++;
            }
            if($ticket['Regular']){
                $Regular_count++;
            }
        }
        if($VIP_ticket_total==0){
            $remaining_VIP_tickets=0;
        }else{
            $remaining_VIP_tickets=$VIP_ticket_total-$VIP_count;
        }
        $remaining_Regular_tickets=$regular_ticket_total-$Regular_count;
        $data = $request->validate([
            'vip_tickets' => 'integer',
            'regular_tickets' => 'integer',
        ]);
        $user_Id=auth()->user()->id;

        $vip_tickets = $request->input('vip_tickets');
        $regular_tickets = $request->input('regular_tickets');
        $total_tickets=$vip_tickets+$regular_tickets;

        $total_bought_tickets=Ticket::where('event_ID',$event_Id)->where('User_id',$user_Id)->count();
        $message='The quantity of tickets you’re attempting to purchase exceeds the limit. Each user is permitted to buy up to 5 tickets';

        if ($total_tickets > 5) {

            return view('newTicket',['event'=>$event,'remaining_regular_tickets'=>$remaining_Regular_tickets,
            'remaining_VIP_tickets'=>$remaining_VIP_tickets,'message'=> $message])
            ;}
            if ($total_tickets ==0) {

                return view('newTicket',['event'=>$event,'remaining_regular_tickets'=>$remaining_Regular_tickets,
                'remaining_VIP_tickets'=>$remaining_VIP_tickets,'message'=> 'you must buy at least one ticket to proceed'])
                ;}


            if ($total_tickets+$total_bought_tickets > 5) {

                return view('newTicket',['event'=>$event,'remaining_regular_tickets'=>$remaining_Regular_tickets,
                'remaining_VIP_tickets'=>$remaining_VIP_tickets,'message'=> $message])
                ;}



        // dd($request,$event_Id,$user_Id,$data);
        // Create VIP tickets
        if($data['vip_tickets']!=0){
            for ($i = 0; $i < $data['vip_tickets']; $i++) {

                $ticket_new=Ticket::create(['ticket_type' => 'VIP','event_id'=>$event_Id,'User_id'=>$user_Id]);
                $mailing_tickets[] = [
                    'ticket_Id' => $ticket_new->id,
                    'event_Id' => $event_Id,
                    'event_Name' => $event->event_Name,
                    'user_Id' => $user_Id,
                    'event_Location' => $event->event_Location,
                    'event_Date' => $event->event_Date,
                    'ticket_type' => 'VIP'
                ];
            }
        }


        // Create regular tickets
        if($data['regular_tickets']!=0){
        for ($i = 0; $i < $data['regular_tickets']; $i++) {

            $ticket_new=Ticket::create(['ticket_type' => 'Regular','event_id'=>$event_Id,'User_id'=>$user_Id]);
            $mailing_tickets[] = [
                'ticket_Id' => $ticket_new->id,
                'event_Id' => $event_Id,
                'event_Name' => $event->event_Name,
                'user_Id' => $user_Id,
                'event_Location' => $event->event_Location,
                'event_Date' => $event->event_Date,
                'ticket_type' => 'VIP'
            ];
        }}

        // dd($mailing_tickets);
        \Mail::to(auth()->user()->email)->send(new Tickets_mail($mailing_tickets));

        return redirect()->route('viewAllTickets');
    }


    public function show(){
        $user_Id = auth()->user()->id;
        $tickets = Ticket::select('event_id', DB::raw('count(*) as total'))
                         ->where('User_id', $user_Id)
                         ->groupBy('event_id')
                         ->get();
        $events = [];
        foreach($tickets as $item){
            $event = Event::find($item->event_id);

            $events[] = [
                'event_Id'=>$event->event_Id,
                'event_Name' => $event->event_Name,
                'event_Date' => $event->event_Date,
                'image'=>$event->image,
                'event_category'=>$event->event_category,
                'ticket_count' => $item->total,
            ];
        }
            // Get current page form url e.x. &page=1
    $currentPage = LengthAwarePaginator::resolveCurrentPage();

    // Create a new Laravel collection from the array data
    $itemCollection = collect($events);

    // Define how many items we want to be visible in each page
    $perPage = 10;

    // Slice the collection to get the items to display in current page
    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

    // Create our paginator and pass it to the view
    $paginatedEvents= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

    // set url path for generated links
    $paginatedEvents->setPath(request()->url());
// dd($paginatedEvents);
    return view('viewAllTickets' ,['events' => $paginatedEvents]);
        // return view('viewAllTickets' ,['events'=>$events]);
    }
    public function mailing(){

    }

}
