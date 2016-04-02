<?php
/**
 * Created by PhpStorm.
 * User: Ant
 * Date: 24.03.2016
 * Time: 19:52
 */

namespace Ant\Controller;

use Ant\Application\Application;
use Ant\Http\IRequest;
use Ant\Http\Request;
use Ant\Router\Routes;
use Closure;

class FrontController implements IFrontController
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(IRequest $request, $opt = null)
    {
        $this->request = $request;
    }

    public function run()
    {
        $callBack = Routes::getCallbackByURI($this->request->getCurrentURI(), $this->request->getRequestMethod());

        if ($callBack instanceof Closure) {
            echo $callBack();
            return;
        }

        list($className, $method) = explode('::', $callBack);
        $class = Application::getInstance()->get('App\\Http\\Controller\\' . $className);
        ob_start();
        $res = call_user_func(array($class, $method));
        if (is_array($res)) {
            $template = function ($res) use ($class) {
                $content = '';
                if (isset($res['view'])) {

                    extract($res['data']);
                    ob_start("ob_gzhandler");
                    require_once __DIR__ . "/../../../resources/view/{$res['view']}.html.php";
                    $content = ob_get_clean();
                }

                if (property_exists($class, 'layout')) {
                    ob_start("ob_gzhandler");
                    require_once __DIR__ . "/../../../resources/view/layouts/{$class->layout}.html.php";
                }

            };
            $template($res);
        } else {
            echo $res;
        }


    }

}