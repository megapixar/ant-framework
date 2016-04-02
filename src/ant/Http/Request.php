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

    public function getCurrentURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}