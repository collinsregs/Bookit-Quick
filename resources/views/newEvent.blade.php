@extends('layout')

@section('content')
<div class="content_form">
    <form action="/createEvent" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form">
            <div class="nice-form-group">
                <label for="event_Name">Enter the Name of the Event</label>
                <input type="text" id="event_Name" name="event_Name" placeholder="Event name" required>
            </div>
            <div class="nice-form-group">
                <label for="event_Date">Select the Date and Time of the Event</label>
                <br>
                <input type="date" id="event_Date" name="event_Date" required>
                <input type="time" value="00:00" >
            </div>
            <div class="nice-form-group">
                <label for="event_Location">Enter the Location of the Event</label>
                <input type="text" id="event_Location" name="event_Location" placeholder="Event location" required>
            </div>
            <div class="nice-form-group">
                <label for="description">Provide a Description of the Event</label>
                <textarea id="description" name="description" rows="3" placeholder="Describe your event" required></textarea>
            </div>
            <div class="nice-form-group">
                <label for="event_category">Select the Category of the Event</label>
                <select id="event_category" name="event_category" required>
                    <option value="">Please select category</option>
                    <option value="Conference">Conference</option>
                    <option value="Workshop">Workshop</option>
                    <option value="Seminar">Seminar</option>
                    <option value="Networking">Networking</option>
                    <option value="Trade Show">Trade Show</option>
                    <option value="Music">Music</option>
                    <option value="Food & Drink">Food & Drink</option>
                    <option value="Performance & Visual Arts">Performance & Visual Arts</option>
                    <option value="Sports & Fitness">Sports & Fitness</option>
                    <option value="Charity & Causes">Charity & Causes</option>
                </select>
            </div>


            <hr class="divider">
            <div class="nice-form-group">
                <label for="max_Attendees">Enter the Maximum Number of Attendees</label>
                <br>
                <input type="number" id="max_Attendees" name="max_Attendees" min="0" required>
            </div>
            <div class="nice-form-group">
                <label for="Regular_ticket_price">Enter the Price for Regular Tickets</label>
                <br>
                <input type="number" id="Regular_ticket_price" name="Regular_ticket_price" min="0" required>
            </div>
            <div class="nice-form-group">
                <label for="max_VIP_Attendees">Enter the Number of Available VIP Tickets</label>
                <br>
                <input type="number" id="max_VIP_Attendees" name="max_VIP_Attendees" min="0" >
            </div>
            <div class="nice-form-group">
                <label for="VIP_ticket_price">Enter the Price for VIP Tickets</label>
                <br>
                <input type="number" id="VIP_ticket_price" name="VIP_ticket_price" min="0" >
            </div>

            <hr class="divider">
            <div class="nice-form-group">
                <label for="image">Upload an Image to Represent the Event</label>

                <input type="file" id="image" name="image">
            </div>
            <div class="nice-form-group">
                <input type="submit" value="Submit">
            </div>
        </div>
    </form>
</div>
@endsection
