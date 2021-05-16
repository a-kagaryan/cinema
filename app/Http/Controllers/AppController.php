<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Hall;
use App\Models\Order;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

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
        //TODO check if seance already started or has been finished and don't allow to order
        $seats = $schedule->hall()->first()->seats()->orderBy('x')->get();
        $seats = $seats->groupBy('x');
        $orderedSeats = $schedule->orders()->get()->pluck('seat_id');

        return view('app.seance', compact('schedule', 'seats', 'orderedSeats'));
    }

    public function order(int $scheduleId, int $seatId)
    {
        $exists = Order::where('schedule_id', $scheduleId)
            ->where('seat_id', $seatId)
            ->exists();

        $ip = \request()->getClientIp();

        if ($exists) {
            Log::critical("User with ip $ip tries to order already ordered seat", \request()->all());
            abort(500, 'This seat already has been ordered');
        }

        Order::create([
           'seat_id' => $seatId,
           'schedule_id' => $scheduleId,
           'user_ip' => $ip
        ]);

        return back()
            ->with('success', 'Seat has been ordered');
    }
}
