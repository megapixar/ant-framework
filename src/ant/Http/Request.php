<?php
/**
 * Created by PhpStorm.
 * User: mac-188
 * Date: 3/25/16
 * Time: 1:23 PM
 */

namespace Ant\Http;


class Request implements IRequest
{
    protected $get = [];

    protected $post = [];

    protected $server = [];

    public function capture()
    {
        $this->get = $_GET;

        $this->post = $_POST;

        $this->server = $_SERVER;
    }

    /**
     * @return mixed
     */
    public function getCurrentURI()
    {
        return $this->server['REQUEST_URI'];
    }

    /**
     * @param $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->getInput()[$property];
    }

    /**
     * @param $property
     * @param $value
     */
    public function __set($property, $value)
    {
        $this->getInput()[$property] = $value;
    }

    protected function getInput()
    {
        return $this->getMethod() == 'POST' ? $this->post : $this->get;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }
}