<?php
namespace Migration;

require __DIR__ . '/../vendor/autoload.php';

use Ant\Model\ConnectorFactory;
use PDO;

class Migrations
{

    public static function up()
    {

        $config['DB'] = require_once __DIR__ . '/../config/database.php';
        /** @var $dbh PDO */
        $dbh = ConnectorFactory::getConnector($config['DB'])->connect();

        try {
            $dbh->beginTransaction();

            $sth = $dbh->prepare("CREATE TABLE IF NOT EXISTS Post (
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(50) NOT NULL,
                        description VARCHAR(255) NOT NULL,
                        updated TIMESTAMP
                    )");

            $sth->execute();
            echo 'Migrations has been applied';
        } catch (\Exception $e) {
            $dbh->rollBack();
        }
    }
}



