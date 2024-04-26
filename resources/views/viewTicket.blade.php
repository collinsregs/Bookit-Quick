@extends('layout')
@section('content')
<div class="tickets_flex">
@foreach ($tickets as $ticket)
<div class="ticketContainer">
    <div class="ticket">
      <div class="ticketTitle">{{$ticket['event_Name']}}</div>
      <hr class="ticket_hr">
      <div class="ticketDetail">
        <div>Type:&ensp; {{$ticket['ticket_type']}}</div>
        <div>Location:&nbsp; {{$ticket['event_Location']}}</div>
        <div>Date:&emsp; {{\Carbon\Carbon::createFromTimestamp($ticket['event_Date'])->format('d-m-Y')}}</div>
      </div>
      <div class="ticketRip">
        <div class="circleLeft"></div>
        <div class="ripLine"></div>
        <div class="circleRight"></div>
      </div>
      <div class="ticketSubDetail">
        <div class="code">{{$ticket['event_Id'].$ticket['ticket_Id'].$ticket['user_Id']}}</div>
        {{-- <div class="date"> Jan 14<sup>th</sup> 2023</div> --}}
      </div>
    </div>
    <div class="ticketShadow"></div>
  </div>
@endforeach


</div>

@endsection
