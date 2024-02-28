<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;


class EventController extends Controller
{
    public function index($event_Id){
        $event = Event::where('event_Id', $event_Id)->first();
        $tickets=0;
        if($event){
            // dump($event);
            return view('viewEvent', ['event' => $event]);

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



        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->save($location);

            $data['image'] = $filename;
        }

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

    public function show(){
        return view('viewAllEvents');
    }
}
