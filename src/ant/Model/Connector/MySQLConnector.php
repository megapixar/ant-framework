<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 02.04.2016
 * Time: 18:06
 */

namespace Ant\Model\Connector;


use PDO;

class MySQLConnector implements IConnector
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function connect()
    {
        return new PDO("mysql:host={$this->config['host']};dbname={$this->config['database']}",
            $this->config['username'], $this->config['password']);
    }
}