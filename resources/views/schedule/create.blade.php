@extends('home')

@section('content')
    <div class="row">
        <div class="col-6 mx-auto">
            <h1>Create Film</h1>
            {{ view('film._form', ['film' => $film, 'method' => 'POST', 'action' => 'store']) }}
        </div>
    </div>
@endsection
