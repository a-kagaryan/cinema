@extends('home')

@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <h1>Schedules</h1>
            <a class="btn btn-success" href="{{route('schedules.create')}}">Create</a>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Hall</th>
                    <th>Date</th>
                    <th>Film</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->id }}</td>
                        <td>{{ $schedule->hall->name }}</td>
                        <td>{{ $schedule->date }}</td>
                        <td>{{ $schedule->film->title }}</td>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td>
                            <a href="{{route('schedules.show', [$schedule->id])}}"><i class="">view</i></a>
                            <a href="{{route('schedules.destroy', [$schedule->id])}}" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();" >
                                <i class="fa fa-trash">delete</i>
                            </a>
                            <form id="delete-form" action="{{ route('schedules.destroy', [$schedule->id]) }}" method="post" class="d-none">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" value="{{ $schedule->id }}">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $schedules->links() }}
        </div>
    </div>
@endsection
