@extends('home')

@section('content')
    <div class="row">
        <div class="col-6 mx-auto">
            <h1>Edit Film</h1>
            {{ view('film._form', ['film' => $film, 'method' => 'PUT', 'action' => 'update']) }}
        </div>
    </div>
@endsection
