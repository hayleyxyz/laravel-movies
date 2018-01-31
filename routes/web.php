<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (\Illuminate\Http\Request $request) {
    $year = (int)$request->get('year', \Carbon\Carbon::now()->year);

    /** @var \App\Services\MovieService $movieService */
    $movieService = app(\App\Services\MovieService::class);
    $movies = $movieService->getPopularMoviesForYear($year);

    $date = new \Carbon\Carbon();
    $dates = collect([ clone $date ]);

    for($i = 1; $i <= 5; $i++) {
        $date->subYears($i);
        $dates->push(clone $date);
    }

    return view('welcome')
        ->with('movies', $movies)
        ->with('dates', $dates)
        ->with('selectedYear', $year);
});
