<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 24.03.2016
 * Time: 20:27
 */

namespace Ant\Application;

use ReflectionClass;

class Application
{
    protected $singleton = [];

    protected $typeContainer = [];

    protected $instances = [];

    protected static $instance;

    const TYPE_SINGLETON = 'singleton';

    public function __construct()
    {
        static::setInstance($this);
    }

    public static function setInstance(Application $app)
    {
        self::$instance = $app;
    }

    /**
     * @return Application
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    public function singleton($abstract, $implementation)
    {
        $this->bind(self::TYPE_SINGLETON, $abstract, $implementation);
    }

    protected function bind($type, $abstract, $implementation)
    {
        $this->typeContainer[$abstract] = $type;

        $this->{$type}[$abstract] = $implementation;
    }

    public function get($abstract, $params = null)
    {
        $type = $this->typeContainer[$abstract];
        $instance = null;

        switch ($type) {
            case self::TYPE_SINGLETON:
                $instance = SingletonFactory::get($abstract, $this->{$type}[$abstract], $params);
                break;
        }

        return $instance;
    }

}