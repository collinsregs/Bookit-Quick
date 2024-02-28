@extends('layout')
@section('content')


<div>
    <div>
        {{-- this should hold the event name location and date --}}
        <h1>{{ $event->event_Name }}</h1>
        <span>
            <span>{{$event->event_Date}}</span>
            <span>{{$event->event_Location}}</span>
        </span>
    </div>
    <hr class="divider">
    <div>
        {{-- this should hold the event description and details --}}
        <span>{{$event->event_category}}</span>
        <span><p>{{ $event->description }}</p></span>
    </div>
    <hr class="divider">
    <div>
        {{-- this should hold event ticket prices --}}
        @if ($event->VIP_ticket_price != 0 && $event->VIP_ticket_price != null)
        <div>get your VIP tickets at: <span>{{$event->VIP_ticket_price}}</span> /=</div>
        <br>
        <div>and regular tickets at: <span>{{$event->Regular_ticket_price}}</span> /=</div>
        @else
        <div>get your tickets at: <span>{{$event->Regular_ticket_price}}</span> /=</div>
        @endif

    </div>
    <hr class="divider">
    <div>
        {{-- this should hold a call to action saying the number of tiskets available and the book tickets button --}}
@if (true)
<div>Only <span>{{$event->VIP_ticket_price}}</span> tickets remaining. Get yours now</div>
<div> <a href="/ticket/new/{{$event->event_Id}}"> get tickets now</a></div>
@else
    <div>Sorry all sold out</div>
@endif
</div>
</div>
@endsection

