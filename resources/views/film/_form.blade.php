
{!! Form::model($film, ['route' => ["films.$action", $film->id], 'method' => $method, 'enctype' => 'multipart/form-data']); !!}
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
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', $film->title, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', $film->description, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    @if ($film->wallpaper)
        <img src="{{ asset(  'storage/' . $film->wallpaper) }}" alt="" width="100">
    @endif
    {{ Form::label('file', 'WallPaper') }}
    {{ Form::file('file') }}
</div>

<div class="form-group">
    {{ Form::label('duration', 'Duration (minutes)') }}
    {{ Form::number('duration', $film->duration, ['class' => 'form-control']) }}
</div>

{{ Form::submit('Save') }}

{!! Form::close() !!}

