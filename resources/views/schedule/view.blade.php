@extends('home')

@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <p>Film id -> {{ $film->id }}</p>
            <p>Hall name -> {{ $film->title }}</p>
            Description<pre>{{ $film->description }}</pre>
            <p>Duration ->  {{ $film->duration }}</p>
            <p>Wallpaper -> </p>
            <img src="{{ asset(  'storage/' . $film->wallpaper) }}" alt="" width="300">
        </div>
    </div>
@endsection
