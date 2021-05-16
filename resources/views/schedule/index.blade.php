@extends('home')

@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <h1>Films</h1>
            <a class="btn btn-success" href="{{route('films.create')}}">Create</a>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Wallpaper</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($films as $film)
                    <tr>
                        <td>{{ $film->id }}</td>
                        <td>{{ $film->title }}</td>
                        <td><pre>{{ $film->description }}</pre></td>
                        <td><img src="{{ asset(  'storage/' . $film->wallpaper) }}" alt="" width="150"></td>
                        <td>
                            <a href="{{route('films.show', [$film->id])}}"><i class="">view</i></a>
                            <a href="{{route('films.edit', [$film->id])}}"><i class="">edit</i></a>
                            <a href="{{route('films.destroy', [$film->id])}}" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();" >
                                <i class="fa fa-trash">delete</i>
                            </a>
                            <form id="delete-form" action="{{ route('films.destroy', [$film->id]) }}" method="post" class="d-none">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" value="{{ $film->id }}">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $films->links() }}
        </div>
    </div>
@endsection
