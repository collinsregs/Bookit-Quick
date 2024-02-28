<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Models\ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        return view('viewTicket');
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
            if($VIP_ticket_total=0){
                $remaining_VIP_tickets=0;
            }else{
                $remaining_VIP_tickets=$VIP_ticket_total-$VIP_count;
            }
            $remaining_Regular_tickets=$regular_ticket_total-$Regular_count;
            return view('newTicket',['event'=>$event,'remaining_regular_tickets'=>$remaining_Regular_tickets,
        'remaining_VIP_tickets'=>$remaining_VIP_tickets]);

    }
    public function create(Request $request,$event_Id){
        $data = $request->validate([
            'vip_tickets' => 'integer',
            'regular_tickets' => 'integer',
        ]);
        $user_Id=0;
        // dd($request,$event_Id,$user_Id,$data);
        // Create VIP tickets
        if($data['vip_tickets']!=0){
            for ($i = 0; $i < $data['vip_tickets']; $i++) {
                Ticket::create(['ticket_type' => 'VIP','event_id'=>$event_Id,'User_id'=>$user_Id]);
            }
        }


        // Create regular tickets
        if($data['regular_tickets']!=0){
        for ($i = 0; $i < $data['regular_tickets']; $i++) {
            Ticket::create(['ticket_type' => 'Regular','event_id'=>$event_Id,'User_id'=>$user_Id]);
        }}
        // dd($request,$event_Id);
        return view('viewAllTickets');
    }

    public function show(){
        return view('viewAllTickets');
    }
}
