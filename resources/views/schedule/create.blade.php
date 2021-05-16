@extends('home')

@section('content')
    <div class="row">
        <div class="col-6 mx-auto">
            <h1>Create Schedule</h1>
            {{ view('schedule._form', [
                'schedule' => $schedule,
                'method' => 'POST',
                'action' => 'store',
                'halls' => $halls,
                'films' => $films,
              ])
            }}
        </div>
    </div>
@endsection
