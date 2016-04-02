<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: mac-188
 * Date: 3/25/16
 * Time: 5:10 PM
 */

namespace Ant\Application;


class InvokableFactory extends Factory
{
    protected static $instances = [];

    public static function get($abstract, $implementation, $params = null)
    {
        return static::instantiate($abstract, $implementation, $params);
    }
}