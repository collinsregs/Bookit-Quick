{{-- @dump($events) --}}
@extends('layout')
@section('content')
@include('partials._hero')
<main >
    <div class="main_text">
        <div class="event_title">Featured Events</div>
        <br>
        <span class="event_text">Have a look at our featured events</span>
    </div>
    <div class="event_masonry">
    <div class="masonry_wrapper" >

        @foreach ($events as $event)

            <a class="card-link" href="/event/{{$event['event_Id']}}">
                <div class="card"><img class="card__background" src="{{$event['image']}}" alt="">
                    <div class=" card-text
                    {{-- card__content | flow --}}
                    ">
                        <div class="
                        {{-- card__content--container | flow --}}
                        ">
                          <span class="card-title
                          {{-- card__title --}}
                          ">{{$event['event_Name']}}</span>
                          <p class="card-category
                          {{-- card__description --}}
                          ">
                {{$event['event_category']}}
                          </p>
                        </div>
                      </div>
                    </div>
            </a>
        @endforeach
    </div>
</div>
</main>
@endsection


