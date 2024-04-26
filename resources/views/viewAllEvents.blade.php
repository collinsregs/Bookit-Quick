

@extends('layout')
@section('content')


<div class="list_wrap">



<div class="event_wrapper">
    @if ( $message!=null)
    <h2 class="event-h2">{{$message}}</h2>
    @else
    <h2 class="event-h2">View all events</h2>
    @endif

    @if ($events->count() == 0)
<h2 class="event-h2">
    No items matching your search
</h2>
    @endif

    @foreach ($events as $item)
    <a class="card-link" href="/event/{{$item['event_Id']}}">
    <div class="event_listing" style="    background-image: url('{{$item['image']}}');">
        <div class='event_content'><div>
            <span class="event_text">{{$item['event_Name']}}</span>
            <br>
            <div class="event_subtext"> <span >{{$item['event_category']}}</span>
                <span>{{ \Carbon\Carbon::createFromTimestamp($item['event_Date'])->format('d-m-Y') }}</span>

                </div>

        </div></div>
    </div>
</a>
@endforeach

</div>
{{ $events->links('default') }}
</div>
@endsection
