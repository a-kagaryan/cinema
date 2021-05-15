@extends('home')

@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <h1>Edit Hall</h1>
            {{ view('hall._form', ['hall' => $hall, 'method' => 'PUT', 'action' => 'update']) }}
        </div>
    </div>
@endsection
