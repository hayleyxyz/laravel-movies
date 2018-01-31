<?php
/**
 * Created by PhpStorm.
 * User: yui
 * Date: 29/01/18
 * Time: 21:35
 */

namespace App\Services;


use Illuminate\Support\Collection;

interface MovieService {

    /**
     * Get movies from given year, sorted by popularity descending
     *
     * @param int $year The year to return movies for
     * @return Collection Collection of \App\Services\Movie objects
     */
    public function getPopularMoviesForYear(int $year) : Collection;

}