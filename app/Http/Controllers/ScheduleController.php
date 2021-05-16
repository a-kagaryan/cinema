<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Hall;
use App\Models\Schedule;
use App\Rules\ScheduleAvailable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('schedule.index', ['schedules' => Schedule::paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('schedule.create', [
            'schedule' => new Schedule(),
            'halls' => Hall::all()->pluck('name', 'id')->toArray(),
            'films' => Film::all()->pluck('title', 'id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $startTime = (new Carbon($request->start_time));
        $filmDuration = Film::where('id', $request->film_id)->first()->duration;
        $endTime = $startTime->addMinutes($filmDuration);
        $request->start_time = $startTime->toTimeString();

        //validate that this range time range  not in use for particular hall
        //TODO validate other fields for correct date /time format
        $request->validate([
            'start_time' => [
                new ScheduleAvailable($request->hall_id, new Carbon($request->date), $endTime)
            ],
        ]);
        $fields = $request->except('_token');
        $fields['end_time'] = $endTime->toTimeString();

        try {
            $schedule = Schedule::create($fields);
        } catch (\PDOException $e) {
            Log::error($e->getMessage(), $fields);

            return back()
                ->with('error', 'Schedule creation has been failed');
        }

        return redirect()
            ->route('schedules.create')
            ->with('success', 'Schedule creation successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        return view('schedule.view', ['schedule' => $schedule]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //TODO maybe don't allow delete schedule if it's start_time < now()
        Schedule::where('id', $schedule->id)->delete();

        return back()
            ->with('success', 'Schedule has been deleted');
    }
}
