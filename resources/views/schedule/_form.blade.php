
{!! Form::model($schedule, ['route' => ["schedules.$action", $schedule->id], 'method' => $method]); !!}
@if ($errors->any())
    <div class="alert alert-danger">
        <ol>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
@endif
<div class="form-group">
    {{ Form::label('hall_id', 'Hall') }}
    {{ Form::select('hall_id', $halls, null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('film_id', 'Film') }}
    {{ Form::select('film_id', $films, null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('date', 'Date') }}
    {{ Form::date('date', $schedule->date, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('date', 'Start Time') }}
    {{ Form::time('start_time', $schedule->start_time, ['class' => 'form-control', 'format' => 'h:i:s']) }}
</div>
{{ Form::submit('Save') }}

{!! Form::close() !!}

