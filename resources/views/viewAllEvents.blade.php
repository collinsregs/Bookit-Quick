

@extends('layout')
@section('content')


<div class="list_wrap">

    <div>
        <form onsubmit="event.preventDefault();" role="search" class="form_search">
            <label class="label_search"for="search">Search for stuff</label>
            <input id="search" type="search" placeholder="Search for events..." autofocus required class="input_search"/>
            <button class="button_search" type="submit">Search</button>
          </form>
    </div>
<div class="event_wrapper">

    @foreach ($events as $item)
    <a href="/event/{{$item['event_Id']}}">
    <div class="event_listing">
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
