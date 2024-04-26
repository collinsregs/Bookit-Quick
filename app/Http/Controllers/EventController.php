<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Models\ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class EventController extends Controller
{
    public function index($event_Id){
        $event = Event::where('event_Id', $event_Id)->first();
        $event_tickets= $event['max_Attendees']+$event['max_VIP_Attendees'];

        $tickets= DB::table('tickets')->where('event_id',$event_Id)->count();
        $remaining_tickets=$event_tickets-$tickets;
        // dump($event_Id,$tickets,$event_tickets,$remaining_tickets);
        if($event){
            // dump($event);
            return view('viewEvent', ['event' => $event, 'remaining_tickets'=>$remaining_tickets]);

        }else{
            return redirect()->route('event')->with('error', 'Event not found');
        }
        // return redirect()->route('event',['id'=>$event_Id]);
    }
    public function create(Request $request){
        // dd($request);
        $data = $request->validate([
            'event_Name' => 'required',
            'event_Date' => 'required|date',
            'event_Location' => 'required',
            'description' => 'required',
            'event_category' => 'required',
            'max_Attendees' => 'required|integer',
            'Regular_ticket_price' => 'required|integer',
            'max_VIP_Attendees' => 'integer',
            'VIP_ticket_price' => 'nullable|integer',
            'image' => 'nullable|image',
        ]);





            $eventName = $data['event_Name'];
            $eventDate= $data['event_Date'];
            $randomNumber = rand(1000, 9999);

            $eventName = preg_replace('/[^A-Za-z0-9]/', '', $eventName);
            $eventDate = str_replace('-', '', $eventDate);

            $numericEventName = hexdec(substr(md5($eventName), 0, 8));
            $numericEventDate = hexdec(substr(md5($eventDate), 0, 8));

            $eventId = ($numericEventName + $numericEventDate + $randomNumber) % PHP_INT_MAX;
            $data = array_merge(['event_Id'=>$eventId],$data);
// dd($eventId,$numericEventDate,$numericEventName,$randomNumber);
            $newEvent = Event::create($data);

            // echo '$listing';
            // dump($newEvent);



            return redirect()->route('event', ['event_Id' => $eventId]);

    }
    public function update(Request $request, $eventId){
        // dd($request);
        // dd($request->all());
        // Validate the request data
        $data = $request->validate([
            'event_Name' => 'required',
            'event_Date' => 'required|date',
            'event_Location' => 'required',
            'description' => 'required',
            'event_category' => 'required',
            'max_Attendees' => 'required|integer',
            'Regular_ticket_price' => 'required|integer',
            'max_VIP_Attendees' => 'integer',
            'VIP_ticket_price' => 'nullable|integer',
            'image' => 'nullable',
        ]);

        // Find the event by its ID
        $event = Event::find($eventId);

        // Check if the event exists
        if ($event) {
            // Update the event with the new data
            $event->event_Name = $data['event_Name'];
            $event->event_Date = $data['event_Date'];
            $event->event_Location = $data['event_Location'];
            $event->description = $data['description'];
            $event->event_category = $data['event_category'];
            $event->max_Attendees = $data['max_Attendees'];
            $event->Regular_ticket_price = $data['Regular_ticket_price'];
            $event->max_VIP_Attendees = $data['max_VIP_Attendees'];
            $event->VIP_ticket_price = $data['VIP_ticket_price'];
            $event->image = $data['image'];

            // Save the updated event
            $event->update();
        }

        // Redirect back to the event page
        return response()->json(['redirect_url' => "/event/{$eventId}"]);

    }


    public function show(){
        $events = Event::paginate(10);
        $message = null;// Display 10 items per page
        return view('viewAllEvents', ['events' => $events, 'message'=>$message]);

    }
    public function popularEvents(){
        $popularEventIds = DB::table('tickets')
        ->select('event_id', DB::raw('count(*) as ticket_count'))
        ->groupBy('event_id')
        ->orderBy('ticket_count', 'desc')
        ->take(20)
        ->pluck('event_id');

    // Get the event details for each event
    $popularEvents = \App\Models\Event::whereIn('event_Id', $popularEventIds)->get();


        return view('home_event',['events'=>$popularEvents]);
    }

    public function updateView($event_Id){
        $event = Event::where('event_Id', $event_Id)->first();
        return view('eventUpdate',['event'=>$event]);

    }
    public function search(Request $request)
{
    $search = $request->input('search');
    // dd($search,$request);
    $events = Event::where('event_Name', 'LIKE', "%{$search}%")->paginate(10);;
    $message='Search results for '.$search;

    return view('viewAllEvents', ['events' => $events,'message'=>$message]);
}
}
