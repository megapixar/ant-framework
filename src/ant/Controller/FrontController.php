<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 24.03.2016
 * Time: 19:52
 */

namespace Ant\Controller;

use Ant\Http\IRequest;

class FrontController implements IFrontController
{
    public function __construct(IRequest $request)
    {
        
    }

    public function run()
    {
        echo "Hello!";
    }
}