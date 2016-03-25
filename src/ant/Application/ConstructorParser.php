<?php
/**
 * Created by PhpStorm.
 * User: mac-188
 * Date: 3/25/16
 * Time: 1:46 PM
 */

namespace Ant\Application;


use ReflectionClass;
use ReflectionParameter;

class ConstructorParser
{

    public static function getParams($className)
    {
        /** @var $params ReflectionParameter[]*/
        $constructor = (new ReflectionClass($className))->getConstructor();

        if(!$constructor) {
            return false;
        }

        $params = $constructor->getParameters();

        if (!count($params)) {
           return false;
        }

        $paramClasses = [];

        foreach ($params as $param) {

            $class = $param->getClass();
            if (!($class || $param->isOptional())) {
                return false;
            }

            $paramClasses[] = $class ? $class->getName() : null;
        }

        return $paramClasses;
    }

}