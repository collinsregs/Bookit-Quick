

@extends('layout')
@section('content')


<div class="event_card_wrapper" style="background-image: url('{{$event->image}}')">
    <div class="background_gradient">
    <div class="event_card center">


    <div class="center">
        {{-- this should hold the event name location and date --}}
        <div class="edit_event">


            <h1 class="wrap-text">{{ $event->event_Name }} </h1>
            <a href="/event/update/{{$event->event_Id}}">
            @if (Auth::check())
            @if (Auth::User()->isAdmin)
            <div class="edit_png"></div>
            </a>
            @endif
@endif


        </div>

        <div class="card-details">
            <span>{{
            \Carbon\Carbon::parse($event->event_Date)->format('Y-m-d')
            }}</span>
            <span>{{$event->event_Location}}</span>
            <span>{{$event->event_category}}</span>
        </div>
    </div>
    <hr class="card-divider">
    <div class="center">
        {{-- this should hold the event description and details --}}
        <div class="card-section-heading"> <h3> Event Description </h3></div>
        <span><p>{{ $event->description }}</p></span>
    </div>
    <hr class="card-divider">
    <div class="center">
        {{-- this should hold event ticket prices --}}
        <div class="card-section-heading"> <h3> Event Pricing </h3></div>
        @if ($event->VIP_ticket_price != 0 && $event->VIP_ticket_price != null)
        <div> VIP tickets: <span>{{$event->VIP_ticket_price}}</span> /=</div>
        <br>
        <div>regular tickets: <span>{{$event->Regular_ticket_price}}</span> /=</div>
        @else
        <div>get your tickets at: <span>{{$event->Regular_ticket_price}}</span> /=</div>
        @endif

    </div>
    <hr class="card-divider">
    <div class="center">
        {{-- this should hold a call to action saying the number of tiskets available and the book tickets button --}}
@if (true)
<div>Only <strong>{{$remaining_tickets}}</strong> tickets remaining. Get yours now!</div>
<div > <a class="hero-button card-padding" href="/ticket/new/{{$event->event_Id}}"> get tickets now</a></div>
@else
    <div>Sorry all sold out</div>
@endif
</div>
</div>
    </div>
</div>
@endsection

