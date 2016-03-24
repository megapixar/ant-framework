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

    protected $singleton = [];

    protected $typeContainer = [];

    protected $instances = [];

    public function singleton($abstract, $implementation)
    {
        $this->bind('singleton', $abstract, $implementation);
    }

    protected function bind($type, $abstract, $implementation)
    {
        $this->typeContainer[$abstract] = $type;

        $this->{$type}[$abstract] = $implementation;
    }

    public function get($abstract, $params = null)
    {
        $type = $this->typeContainer[$abstract];

        return $this->{'generate' . $type}($type, $abstract, $params);
    }

    protected function generateSingleton($type, $abstract, $params)
    {
        $implementation = $this->{$type}[$abstract];
        if (empty($this->instances[$abstract])) {
            $this->instances[$abstract] = new $implementation;
        }

        return $this->instances[$abstract];
    }
}