<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 02.04.2016
 * Time: 13:00
 */

namespace App\Http\Controller;


class Blog
{
    public $layout = 'layout';

    public function index()
    {
        return [
            'view' => 'index',
            'data' => [
                'text' => 'Hello World'
            ]
        ];
    }
}