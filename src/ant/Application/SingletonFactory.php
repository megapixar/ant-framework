<?php
/**
 * Created by PhpStorm.
 * User: mac-188
 * Date: 3/25/16
 * Time: 5:10 PM
 */

namespace Ant\Application;


use ReflectionClass;

class SingletonFactory
{
    protected static $instances = [];

    public static function get($abstract, $implementation, $params = null)
    {
        if (empty(self::$instances[$abstract])) {
            self::$instances[$abstract] = self::instantiate($abstract, $implementation);
        }

        return self::$instances[$abstract];
    }

    public static function instantiate($abstract, $implementation = null)
    {

        $ref = new ReflectionClass($implementation);

        if (!$ref->getConstructor()) {
            return self::$instances[$abstract] = $ref->newInstanceWithoutConstructor();
        }

        if (empty($params) && ($reflectionParams = ConstructorParser::getParams($implementation))) {

            $params = array_map(function ($className) {

                return Application::getInstance()->get($className);

            }, $reflectionParams);
        }

        return $ref->newInstance($params);
    }
}