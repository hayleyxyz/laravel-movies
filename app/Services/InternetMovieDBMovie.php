<?php
/**
 * Created by PhpStorm.
 * User: yui
 * Date: 30/01/18
 * Time: 18:51
 */

namespace App\Services;


class InternetMovieDBMovie implements Movie {

    protected $descriptor;

    protected $genereList;

    public function __construct($descriptor, $genreList) {
        $this->descriptor = $descriptor;
        $this->genereList = $genreList;
    }

    function getTitle(): string {
        return $this->descriptor->title;
    }

    function getImageUrl() : string {
        return 'http://image.tmdb.org/t/p/w185' . $this->descriptor->poster_path;
    }

    function getDescription() : string {
        return $this->descriptor->overview;
    }

    function getGenres() {
        return collect($this->descriptor->genre_ids)->map(function($genreId) {
            return $this->genereList->get($genreId);
        });
    }
}