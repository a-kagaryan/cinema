<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Hall;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $halls = Hall::all();
        return view('app.index', ['halls' => $halls]);
    }

    public function hall(Request $request, Hall $hall)
    {
        $date = $request->input('date') ?? (new Carbon())->toDateString();
        $schedules = $hall->schedules()
            ->where('date', $date)
            ->get();

        return view('app.hall', compact('hall', 'schedules', 'date'));
    }

    public function seance(Schedule $schedule)
    {
        $seats = $schedule->hall()->first()->seats()->orderBy('x')->get();
        $seats = $seats->groupBy('x');
        $orderedSeats =
        return view('app.seance', compact('schedule', 'seats'));
    }

}
