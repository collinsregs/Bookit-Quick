@extends('layout')
@section('content')
    <h1>events</h1>
    <form action="/create" method="post">
        @csrf
        <label for="event_Name">Event Name:</label><br>
        <input type="text" id="event_Name" name="event_Name"><br>
        <label for="event_Date">Event Date:</label><br>
        <input type="date" id="event_Date" name="event_Date"><br>
        <label for="max_Attendees">Max Attendees:</label><br>
        <input type="number" id="max_Attendees" name="max_Attendees"><br>
        <label for="VIP_ticket_price">VIP Ticket Price:</label><br>
        <input type="number" id="VIP_ticket_price" name="VIP_ticket_price" step="0.01" min="0"><br>
        <label for="Regular_ticket_price">Regular Ticket Price:</label><br>
        <input type="number" id="Regular_ticket_price" name="Regular_ticket_price" min="0"><br>
        <input type="submit" value="Submit">
    </form>

@endsection
