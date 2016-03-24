<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 24.03.2016
 * Time: 19:52
 */

namespace Ant\Controller;

class FrontController implements IFrontController
{
    public function __construct()
    {

    }

    public function run()
    {
        echo "Hello!";
    }
}