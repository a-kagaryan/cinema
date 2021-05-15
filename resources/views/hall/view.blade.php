@extends('home')

@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <p>Hall id -> {{ $hall->id }}</p>
            <p>Hall name -> {{ $hall->name }}</p>
            <p>Vertical lines ->  {{ $hall->vertical_lines }}</p>
            <p>Harizontal lines -> {{ $hall->horizontal_lines }}</p>
        </div>
    </div>
@endsection
