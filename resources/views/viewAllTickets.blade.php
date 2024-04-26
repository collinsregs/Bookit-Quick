@extends('layout')
@section('content')
<div class="list_wrap">
    <h2>All your tickets</h2>
    <div class="event_wrapper">


        @foreach ($events as $item)
        <a class="card-link" href="/ticket/{{$item['event_Id']}}">
        <div class="event_listing" style="    background-image: url('{{$item['image']}}');">
            <div class='event_content'>

                <span class="event_text">{{$item['event_Name']}}</span>
                <br>
                <div class="event_subtext">
                     <span >{{$item['event_category']}}</span>
                    <span>{{ \Carbon\Carbon::createFromTimestamp($item['event_Date'])->format('d-m-Y') }}</span>
                    <span >{{$item['ticket_count']}} Tickets</span>

                    </div>

            </div></div>

    </a>
</div>
    @endforeach

    </div>
    {{ $events->links('default') }}
    </div>
@endsection

