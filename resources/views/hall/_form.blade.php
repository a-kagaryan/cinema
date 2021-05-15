<?php

?>

{!! Form::model($hall, ['route' => 'halls.store', $hall->id, 'method' => $method]) !!}
@if ($errors->any())
    <div class="alert alert-danger">
        <ol>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
@endif
{{ Form::label('title', 'Name') }}
{{ Form::text('title') }}

{{ Form::label('vertical_lines', 'Vertical lines Count') }}
{{ Form::number('vertical_lines') }}

{{ Form::label('horizontal_lines', 'Horizontal lines Count') }}
{{ Form::number('horizontal_lines') }}

{{ Form::submit('Save') }}

{!! Form::close() !!}
