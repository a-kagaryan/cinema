<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('hall.index', ['halls' => Hall::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('hall.create', ['hall' => new Hall()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate(Hall::$rules);

        try {
            $hall = Hall::create($request->except('_token'));
            $hall->createSeats();

            DB::commit();
        } catch(\PDOException $e) {
            DB::rollBack();
            Log::critical($e->getMessage(), ['hall' => $hall]);

            return redirect()
                ->route('halls.create', ['hall' => $hall] )
                ->with('message','Something went wrong');
        }

        return redirect()
            ->route('halls.show', ['hall' => $hall] )
            ->with('message','Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hall $hall
     */
    public function show(Hall $hall)
    {
        return view('hall.view', ['hall' => $hall]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     */
    public function edit(Hall $hall)
    {
        return view('hall.edit', ['hall' => $hall]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hall  $hall
     */
    public function update(Request $request, Hall $hall)
    {
        $rules = Hall::$rules;
        $rules['name'] .= ',id,' . $hall->id;
        $request->validate($rules);

        DB::beginTransaction();

        try {
            $hall->update($request->except('_token'));
            //check if has been changed vertical, horizontal lines counts then update seats
            //TODO check if seats are ordered and maybe don't remove them ?
            if (
                $hall->getOriginal('vertical_lines') !== $hall->vertical_lines
                || $hall->getOriginal('horizontal_lines') !== $hall->horizontal_lines
            ) {
                Seat::where('hall_id', $hall->id)->delete();
                $hall->createSeats();
            }

            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            Log::critical($e->getMessage(), ['hall' => $hall]);

            return redirect()
                ->route('halls.edit', ['hall' => $hall])
                ->with('error', 'Could not update Hall');
        }

        return redirect()
            ->route('halls.show', ['hall' => $hall])
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hall  $hall
     */
    public function destroy(Hall $hall)
    {
        Hall::where('id', $hall->id)->delete();

        return redirect()
            ->route('halls.index')
            ->with('success', 'Hall has been deleted');
    }
}
