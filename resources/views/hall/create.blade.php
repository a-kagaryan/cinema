@extends('home')

@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <h1>Create Hall</h1>
            {{ view('hall._form', ['hall' => $hall, 'method' => 'POST']) }}
        </div>
    </div>
@endsection
