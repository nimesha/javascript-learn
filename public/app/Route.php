<?php

namespace App;

class Route
{
    public static function rules()
    {
        return [
            '/' => 'HomeController@index',
            '/download' => 'HomeController@download',
        ];
    }
}