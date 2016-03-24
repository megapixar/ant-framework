<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 24.03.2016
 * Time: 19:57
 */

namespace Ant\Router;

class Routes
{
    protected static $posts = [];

    protected static $gets = [];

    public static function post($url, $function)
    {
        self::$posts[$url] = $function;
    }

    public static function get($url, $function)
    {
        self::$gets[$url] = $function;
    }

}