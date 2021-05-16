@extends('home')

@section('content')
    <div class="row">
        <div class="col-6 mx-auto">
            <h1>Edit Schedule</h1>
            {{ view('schedule._form', [
                'schedule' => $schedule,
                'method' => 'PUT',
                'action' => 'update',
                'halls' => $halls,
                'films' => $films,
              ])
            }}
        </div>
    </div>
@endsection
