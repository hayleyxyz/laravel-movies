<?php
/**
 * Created by PhpStorm.
 * User: yui
 * Date: 29/01/18
 * Time: 21:35
 */

namespace App\Services;


interface MovieService {

    public function getPopularMoviesForYear($year);

}