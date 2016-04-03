<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 02.04.2016
 * Time: 18:02
 */

namespace Ant\Model;

use Ant\Model\Connector\IConnector;
use Ant\Model\Connector\MySQLConnector;

class ConnectorFactory
{


    /**
     * @param $dbConfig
     *
     * @return IConnector
     */
    public static function getConnector($dbConfig)
    {
        $connector = false;
        switch ($dbConfig['default']) {
            case 'mysql':
                $connector = new MySQLConnector($dbConfig['connections']['mysql']);
                break;

        }

        return $connector;
    }
}