<?php
/**
 * Created by PhpStorm.
 * User: yui
 * Date: 29/01/18
 * Time: 21:35
 */

namespace App\Services;


use App\Exceptions\MovieServiceException;

class InternetMovieDBService implements MovieService {

    protected $apiKey;

    const baseUrl = 'https://api.themoviedb.org/3/';

    public function __construct() {
        $this->apiKey = config('imdb.api_key');

        if(!$this->apiKey) {
            throw new MovieServiceException("Service requires API key!");
        }
    }

    public function getPopularMoviesForYear($year) {
        $params = [
            'primary_release_year'  => $year,
            'sort_by'               => 'popularity.desc',
        ];

        $url = $this->buildUrl('discover/movie', $params);


    }

    protected function buildUrl($path, $params) {
        $allParams = array_merge($params, [
            'api_key' => $this->apiKey,
        ]);

        return self::baseUrl . $path . $allParams . '?';
    }

}