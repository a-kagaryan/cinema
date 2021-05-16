@extends('home')

@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <h1>Halls</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Verical lines</th>
                        <th>Horizontal lines</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($halls as $hall)
                        <tr>
                            <td>{{ $hall->id }}</td>
                            <td>{{ $hall->name }}</td>
                            <td>{{ $hall->vertical_lines }}</td>
                            <td>{{ $hall->horizontal_lines }}</td>
                            <td>
                                <a href="{{route('halls.show', [$hall->id])}}"><i class="">view</i></a>
                                <a href="{{route('halls.edit', [$hall->id])}}"><i class="">edit</i></a>
                                <a href="{{route('halls.destroy', [$hall->id])}}" onclick="event.preventDefault();
                                                     document.getElementById('view-form').submit();" >
                                    <i class="fa fa-trash">delete</i>
                                </a>
                                <form id="view-form" action="{{ route('halls.destroy', [$hall->id]) }}" method="post" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" value="{{ $hall->id }}">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $halls->links() }}
        </div>
    </div>
@endsection
