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
use ReflectionMethod;

class FrontController implements IFrontController
{
    const LAYOUT = 'layout';

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
        $route = Routes::getCallbackByURI($this->request->getCurrentURI(), $this->request->getMethod());

        if (empty($route['callback'])) {
            header("HTTP/1.0 404 Not Found");
            die('Page Not found');
        }

        if (($callBack = $route['callback']) instanceof Closure) {
            echo $callBack();
            return;
        }

        list($params, $layout) = $this->getRenderParams($route['callback'], $route['variables']);

        $this->render($params, $layout);
    }

    protected function getRenderParams($callBack, $variables)
    {
        list($className, $method) = explode('::', $callBack);
        $class = Application::getInstance()->get('App\\Http\\Controller\\' . $className);

        $refMethod = new ReflectionMethod($class, $method);
        $params    = [];

        foreach ($refMethod->getParameters() as $i => $parameter) {

            if ($parameter->getClass()) {
                $params[$i] = Application::getInstance()->get($parameter->getClass()->getName());
            } else {
                $params[$i] = $variables[$parameter->getName()];
            }
        }

        $layout = property_exists($class, self::LAYOUT) ? $class->{self::LAYOUT} : null;
        $params = $refMethod->invokeArgs($class, $params);

        return [$params, $layout];
    }

    protected function render($params, $layout)
    {
        if (is_array($params)) {
            $template = function ($res) use ($layout) {
                $content = '';
                if (isset($res['view'])) {

                    extract($res['data']);
                    ob_start("ob_gzhandler");
                    require_once __DIR__ . "/../../../resources/view/{$res['view']}.html.php";
                    $content = ob_get_clean();
                }

                if ($layout) {
                    ob_start("ob_gzhandler");
                    require_once __DIR__ . "/../../../resources/view/layouts/{$layout}.html.php";
                }

            };
            $template($params);
        } else {
            echo $params;
        }
    }

}