<?php
/**
 * Created by PhpStorm.
 * User: yui
 * Date: 29/01/18
 * Time: 21:35
 */

namespace App\Services;


use App\Exceptions\MovieServiceException;
use Illuminate\Support\Collection;

class InternetMovieDBService implements MovieService {

    protected $apiKey;

    const baseUrl = 'https://api.themoviedb.org/3/';

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;

        if(!$this->apiKey) {
            throw new MovieServiceException("Service requires API key!");
        }
    }

    public function getGenreMapping() {
        $url = $this->buildUrl('genre/movie/list');

        $json = $this->requestJson($url);

        return collect($json->genres)->keyBy('id')
            ->map(function ($g) { return $g->name; });
    }

    /**
     * Get movies from given year, sorted by popularity descending
     *
     * @param int $year The year to return movies for
     * @return Collection Collection of \App\Services\Movie objects
     */
    public function getPopularMoviesForYear(int $year) : Collection {
        $params = [
            'primary_release_year'  => $year,
            'sort_by'               => 'popularity.desc',
        ];

        $url = $this->buildUrl('discover/movie', $params);

        $json = $this->requestJson($url);

        static $genreList = null;
        if(!$genreList) {
            $genreList = $this->getGenreMapping();
        }

        // Hydrate movie objects and return
        return collect($json->results)->map(function($entry) use($genreList) {
            return new InternetMovieDBMovie($entry, $genreList);
        });
    }

    protected function requestJson($url) {
        // Create the client, and add header to tell the server we only want json
        $http = new \GuzzleHttp\Client([
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);

        $response = $http->request('GET', $url);

        // Verify status
        if($response->getStatusCode() !== 200) {
            throw new MovieServiceException($response->getReasonPhrase());
        }

        $decoded = json_decode($response->getBody());

        return $decoded;
    }

    protected function buildUrl(string $path, array $params = null) : string {
        $defaultParams = [
            'api_key' => $this->apiKey,
        ];

        $params = $params ? array_merge($defaultParams, $params) : $defaultParams;

        return self::baseUrl . $path . '?' . http_build_query($params);
    }

}