<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use MongoDB\Driver\Session;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('film.index', ['films' => Film::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('film.create', ['film' => new Film()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(array_merge(
                Film::$rules,
                ['file' => 'required|mimes:png,jpg,jpeg|max:2048']
            )
        );

        $fields = $request->except('_token');

        if (!empty($request->file('file'))) {
            $path = $request->file('file')->store('wallpapers',  ['disk' => 'public']);
            $fields['wallpaper'] = $path;
        }

        $fields['wallpaper'] = $path;

        try {
            $film = Film::create($fields);
        } catch(\PDOException $e) {
            Log::error($e->getMessage(), $request->all());

            return back()
                ->with('error','Something went wrong');
        }

        return redirect()
            ->route('films.show', ['film' => $film] )
            ->with('success','Film was created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return view('film.view', ['film' => $film]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        return view('film.edit', ['film' => $film]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        $request->validate(array_merge(
                Film::$rules,
                ['file' => 'mimes:png,jpg,jpeg|max:2048']
            )
        );

        $fields = $request->except('_token');

        if (!empty($request->file('file'))) {
            Storage::delete('public/'. $film->wallpaper );
            $path = $request->file('file')->store('wallpapers',  ['disk' => 'public']);
            $fields['wallpaper'] = $path;
        }

        try {
             $film->update($fields);
        } catch(\PDOException $e) {
            Log::error($e->getMessage(), $request->all());

            return back()
                ->with('error', 'Could not update Film');
        }

        return redirect()
            ->route('films.show', ['film' => $film] )
            ->with('success','Film was created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        Film::where('id', $film->id)->delete();

        return back()
            ->with('success', 'Film has been deleted');
    }
}
