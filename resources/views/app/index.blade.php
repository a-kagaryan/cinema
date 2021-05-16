@extends('layouts.app')

@section('content')
<div class="col-10">
    <ul>
        @foreach($halls as $hall)
            <li><a href="{{route('hall', [$hall->id])}}">{{ $hall->name }}</a></li>
        @endforeach
    </ul>
</div>
@endsection
