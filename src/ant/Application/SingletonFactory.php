<?php
/**
 * Created by PhpStorm.
 * User: mac-188
 * Date: 3/25/16
 * Time: 5:10 PM
 */

namespace Ant\Application;


class SingletonFactory extends Factory
{
    protected static $instances = [];

    public static function get($abstract, $implementation, $params = null)
    {
        if (empty(static::$instances[$abstract])) {
            static::$instances[$abstract] = static::instantiate($abstract, $implementation, $params);
        }

        return static::$instances[$abstract];
    }

}