<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 02.04.2016
 * Time: 17:58
 */

namespace Ant\Model;


use Ant\Application\Application;
use PDO;
use SebastianBergmann\Exporter\Exception;

class Model
{
    /**
     * Table name
     *
     * @var string
     */
    public static $table = false;

    /**
     * Connection to DB
     *
     * @var \PDO
     */
    protected static $connector = null;

    public $attributes = [];

    public static function findAll()
    {
        return self::runStatement("SELECT * FROM " . static::$table)->fetchAll();
    }

    /**
     * @param            $query
     * @param array|null $params
     *
     * @return \PDOStatement
     */
    protected static function runStatement($query, array $params = null)
    {
        try {
            self::getConnector()->beginTransaction();

            $sth = self::getConnector()->prepare($query);
            $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);

            $sth->execute($params);

            self::getConnector()->commit();
        } catch (Exception $e) {
            self::getConnector()->rollBack();
        }

        return $sth;
    }

    /**
     * @return \PDO
     */
    protected static function getConnector()
    {
        if (!self::$connector) {
            self::$connector = ConnectorFactory::getConnector(Application::getInstance()->getConfig()['DB'])->connect();
        }

        return self::$connector;
    }

    public static function findByID($id)
    {
        return self::runStatement("SELECT * FROM " . static::$table . " WHERE `id` = :id", array(':id' => $id))
            ->fetch();
    }

    /**
     * @param $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->attributes[$property];
    }

    /**
     * @param $property
     * @param $value
     */
    public function __set($property, $value)
    {
        $this->attributes[$property] = $value;
    }

    public function __isset($property)
    {
        return isset($this->attributes[$property]);
    }

    /**
     * @param $attribute
     *
     * @return mixed
     */
    public function getAttributes($attribute)
    {
        return $this->attributes[$attribute];
    }

    /**
     * @param $attribute
     * @param $val
     *
     * @internal param array $attributes
     */
    public function setAttributes($attribute, $val)
    {
        $this->attributes[$attribute] = $val;
    }

    public function save()
    {
        if (empty($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }

        return $this;
    }

    private function insert()
    {
        $table = static::$table;
        return self::runStatement("INSERT INTO {$table} (" . implode(',', array_keys($this->attributes))
            . ") VALUES (" . implode(',', array_fill(0, count($this->attributes), '?')) . ")",
            array_values($this->attributes));
    }

    private function update()
    {
        $table = static::$table;

        $set    = '';
        $values = [];

        foreach ($this->attributes as $field => $value) {
            if ($field === 'id') {
                continue;
            }

            $set .= "`$field` = ?,";
            $values[] = $value;
        }

        $set      = rtrim($set, ',');
        $values[] = $this->id;

        return self::runStatement("UPDATE {$table} SET $set WHERE `id` = ?", $values);
    }

    public function delete()
    {
        return self::runStatement("DELETE FROM " . static::$table . " WHERE `id` = :id", array(':id' => $this->id));
    }
}