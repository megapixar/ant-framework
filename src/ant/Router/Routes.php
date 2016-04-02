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

    public static function getCallbackByURI($uri, $type = null)
    {
        $routes = null;
        switch ($type) {
            case 'POST':
                $routes = self::$posts;
                break;
            case 'GET':
                $routes = self::$gets;
                break;
            default:
//                $routes = self::$posts;
        }

        if (!empty($routes[$uri])) {
            return $routes[$uri];
        }
    }

}