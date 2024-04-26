@extends('layout')
{{-- @dump($message) --}}
@section('content')
<h1></h1>
<div class="content_form">
<form action="/createTicket/{{ $event['event_Id'] }}" method="POST">
    @csrf
    <div class="form_card">
        <div class="form_card_title">
            tickets for the <b> {{ $event['event_Name']}} </b> event:
        </div>
    <div class="nice-form-group">
        <label for="max_Attendees">How many VIP tickets</label>
        <br>
        @if ($remaining_VIP_tickets==0)
        <input type="number" id="vip_tickets" name="vip_tickets" value="0" placeholder=" " disabled>
        <input type="hidden" name="vip_tickets" value="0">
    @else
        <input type="number" id="vip_tickets" name="vip_tickets" value="0" placeholder=" " max="{{
            min($remaining_regular_tickets,5)
        }}">
    @endif

    </div>

    <div class="nice-form-group">
        <label for="max_Attendees">How many Regular tickets</label>
        <br>
        <input type="number" id="regular_tickets" name="regular_tickets" min="0"  max="{{
            min($remaining_regular_tickets,5)
        }}" required>
    </div>
    @if($message)
        <div class="error_message">
            {{$message}}
        </div>
    @endif
    <hr class="divider">
    <div class="nice-form-group">
        <input type="submit" value="Check Out" class="hero-button">
    </div>
</div>
</form>
</div>
@endsection
