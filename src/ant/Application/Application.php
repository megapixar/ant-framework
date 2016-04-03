<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 24.03.2016
 * Time: 20:27
 */

namespace Ant\Application;

class Application
{
    const TYPE_SINGLETON = 'singleton';
    protected static $instance;
    protected $singleton = [];
    protected $typeContainer = [];
    protected $instances = [];
    protected $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
        static::setInstance($this);
    }

    /**
     * @return Application
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    public static function setInstance(Application $app)
    {
        self::$instance = $app;
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
        $type     = isset($this->typeContainer[$abstract]) ? $this->typeContainer[$abstract] : false;
        $instance = null;

        switch ($type) {
            case self::TYPE_SINGLETON:
                $instance = SingletonFactory::get($abstract, $this->{$type}[$abstract], $params);
                break;
            default:
                $instance = InvokableFactory::get($abstract, $abstract, $params);
        }

        return $instance;
    }

    public function isInstantiable($abstract)
    {
        return $abstract && (!empty($this->typeContainer[$abstract]) || class_exists($abstract));
    }

    public function getConfig()
    {
        return $this->config;
    }

}