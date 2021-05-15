<?php

?>

{!! Form::model($hall, ['route' => ["halls.$action", $hall->id], 'method' => $method]); !!}
@if ($errors->any())
    <div class="alert alert-danger">
        <ol>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
@endif
{{ Form::label('name', 'Name') }}
{{ Form::text('name', $hall->name) }}

{{ Form::label('vertical_lines', 'Vertical lines Count') }}
{{ Form::number('vertical_lines', $hall->vertical_llines ?: 10) }}

{{ Form::label('horizontal_lines', 'Horizontal lines Count') }}
{{ Form::number('horizontal_lines', $hall->horizontal_llines ?: 10 ) }}

{{ Form::submit('Save') }}

{!! Form::close() !!}
