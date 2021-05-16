@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-3 mx-auto">
            <h4><a href="{{ route('seance', [$schedule->id]) }}">{{ $schedule->film->title }}</a></h4>
            <div class="d-flex justify-content-between">
                <img class="d-block mr-2" src="{{ asset(  'storage/' .  $schedule->film->wallpaper) }}" alt=""
                     width="150">
                <div>{{ $schedule->film->description }}</div>
            </div>
            <p>Starting at -> {{ $schedule->start_time }} <br>
                Ending at -> {{ $schedule->end_time }}</p>
        </div>
    </div>
    <div class="col-10 mx-auto" style="width: 80%; overflow-x: auto">
        @foreach($seats as $seatRow)
            <div class="d-flex mt-2 align-items-center justify-content-between">
                @foreach($seatRow as $seat)
                    @if($orderedSeats->contains($seat->id))
                        <button class="btn btn-danger mr-1 d-block" disabled> {{ $seat->code }}</button>
                    @else
                        <a href="{{ route('order', [$schedule->id, $seat->id]) }}"
                           class="btn mr-1 btn-success d-block" {{ $orderedSeats->contains($seat->id) ? 'disabled': '' }} >{{ $seat->code }}</a>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
