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
        }

        $matchedRoute = [];
        if (!empty($routes[$uri])) {
            $matchedRoute['variables'] = null;
            $matchedRoute['callback']  = $routes[$uri];

            return $matchedRoute;
        }

        foreach ($routes as $route => $callback) {
            if (strpos($route, '/:') !== false) {
                $matchedRoute = [];
                $routeArr     = explode('/', $route);
                $uriArr       = explode('/', $uri);

                $dif = array_diff_assoc($routeArr, $uriArr);
                foreach ($dif as $index => $key) {
                    if ($key[0] !== ':' || empty($uriArr[$index])) {
                        continue 2;
                    }
                    $matchedRoute['variables'][substr($key, 1)] = $uriArr[$index];
                }
                $matchedRoute['callback'] = $routes[$route];
                break;
            }
        }

        return $matchedRoute;
    }

}