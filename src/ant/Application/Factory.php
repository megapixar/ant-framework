<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 02.04.2016
 * Time: 11:38
 */

namespace Ant\Application;


use ReflectionClass;

abstract class Factory
{
    protected static $instances = [];

    protected static function instantiate($abstract, $implementation = null, $params)
    {

        $ref = new ReflectionClass($implementation);

        if (!$ref->getConstructor()) {
            return static::$instances[$abstract] = $ref->newInstanceWithoutConstructor();
        }

        if (empty($params) && ($reflectionParams = ConstructorParser::getParams($implementation))) {

            $params = array_map(function ($param) {

                return Application::getInstance()->isInstantiable($param) ? Application::getInstance()->get($param)
                    : $param;
            }, $reflectionParams);
        }

        return $ref->newInstanceArgs($params);
    }
}