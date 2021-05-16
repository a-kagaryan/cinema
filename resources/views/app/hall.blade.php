
@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-3 mx-auto">
            <h1>{{ $hall->name }}</h1>
            {!! Form::open(['route' => ["hall", $hall->id], 'method' => 'GET']); !!}

            <div class="form-group">
                {{ Form::label('date', 'Date') }}
                {{ Form::date('date', $date, ['class' => 'form-control']) }}
            </div>

            {{ Form::submit('Search') }}

            {!! Form::close() !!}
        </div>
    </div>
    <div class="row p-5 mt-5">
    @foreach($schedules as $schedule)
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('seance', [$schedule->id]) }}">{{ $schedule->film->title }}</a></h4>
                    <div class="d-flex justify-content-between">
                        <img class="d-block mr-2" src="{{ asset(  'storage/' .  $schedule->film->wallpaper) }}" alt="" width="150">
                        <div>{{ $schedule->film->description }}</div>
                    </div>
                    <p>Starting at  -> {{ $schedule->start_time }} <br>
                     Ending at -> {{ $schedule->end_time }}</p>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection
