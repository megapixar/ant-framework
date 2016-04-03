<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 02.04.2016
 * Time: 18:08
 */

namespace Ant\Model\Connector;


interface IConnector
{
    /**
     * @return \PDO
     */
    public function connect();
}