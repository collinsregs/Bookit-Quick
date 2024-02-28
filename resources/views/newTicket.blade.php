@extends('layout')
@section('content')
<h1>tickets for the event {{$event['event_Name']}} {{$event['event_Id']}}</h1>
<form action="/createTicket/{{ $event['event_Id'] }}" method="POST">
    @csrf
    <div class="nice-form-group">
        <label for="max_Attendees">How many VIP tickets</label>
        <br>
        @if ($remaining_VIP_tickets==0)
        <input type="number" id="vip_tickets" name="vip_tickets" value="0" disabled>
        <input type="hidden" name="vip_tickets" value="0">
    @else
        <input type="number" id="vip_tickets" name="vip_tickets" value="0">
    @endif

    </div>

    <div class="nice-form-group">
        <label for="max_Attendees">How many Regular tickets</label>
        <br>
        <input type="number" id="regular_tickets" name="regular_tickets" min="0" required>
    </div>
    <div class="nice-form-group">
        <input type="submit" value="Submit">
    </div>
</form>
@endsection
