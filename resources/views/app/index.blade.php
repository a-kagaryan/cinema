@extends('layouts.app')

@section('content')
<div class="col-10">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Hall name</th>
                <th>Live Seance</th>
            </tr>
        </thead>
        <tbody>
        @foreach($halls as $hall)
            <tr>
                <td><a href="{{route('hall', [$hall->id])}}">{{ $hall->name }}</a></td>
                <td>
                    @if($hall->liveSeance())
                        {{ $hall->liveSeance()->film->title }}
                        <p>
                            Started at {{ $hall->liveSeance()->start_time }}<br>
                            Ends at  {{ $hall->liveSeance()->end_time }}
                        </p>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
