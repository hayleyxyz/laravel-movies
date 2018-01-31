<?php
/**
 * Created by PhpStorm.
 * User: yui
 * Date: 30/01/18
 * Time: 18:51
 */

namespace App\Services;


interface Movie {

    function getTitle() : string;

    function getImageUrl() : string;

    function getDescription() : string;

}