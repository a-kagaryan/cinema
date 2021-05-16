@extends('home')

@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <p>Schedule id -> {{ $schedule->id }}</p>
            <p>Hall name -> {{ $schedule->hall->name }}</p>
            <p>Film name -> {{ $schedule->film->title }}</p>
            <p>Date -> {{ $schedule->date }}</p>
            <p>Start Time ->  {{ $schedule->start_time }}</p>
            <p>End Time -> {{ $schedule->end_time }}</p>
        </div>
    </div>
@endsection
