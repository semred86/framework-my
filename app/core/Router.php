<?php


namespace App\core;


//use Exception;

use App\core\base\View;

class Router
{
    /**
     * List of routes
     * @var array
     */
    private static array $routes = [];

    /**
     * Add route to route list
     * @param string $pattern
     * @param array $rout
     */
    public static function add(string $pattern, array $rout = [])
    {
        self::$routes[$pattern] = $rout;
    }

    /**
     * Compare the requested URI with the route list
     * @param string $uri
     * @return bool|array
     */
    private static function matchRoute(string $uri): bool|array
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $uri, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                return $route;
            }
        }
        return false;
    }

    /**
     * Start the Router
     * @throws Exception
     */
    public static function start()
    {
        if ($route = self::matchRoute(self::getUri())) {

            $controller = self::getControllerName($route['controller']);
            unset($route['controller']);

            if (class_exists($controller)) {

                $cObj = new $controller;

                $action = self::getActionName($route['action']);
                unset($route['action']);

                if (method_exists($cObj, $action)) {
                    $cObj->$action(...$route);
                } else {
                    http_response_code(404);
                    View::render(
                        'errors/404',
                        ['title'=>'404', 'message'=>"Action: <b>$controller\\{$action}</b> not found"]
                    );
//                    throw new Exception("Action: <b>$action</b> not found");
                }
            } else {
                http_response_code(404);
                View::render(
                    'errors/404',
                    ['title'=>'404', 'message'=>"Controller: <b>$controller</b> not found"]
                );
//                throw new Exception("Controller: <b>$controller</b> not found");
            }
        }
    }

    /**
     * Get URI
     * @return string
     */
    private static function getUri(): string
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        return trim($uri, "/");
    }

    /**
     * Get a name
     * @param string $name
     * @return string
     */
    private static function getName(string $name): string
    {
        return str_replace(' ', '',
            ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * Get controller name
     * @param string $name
     * @return string
     */
    private static function getControllerName(string $name): string
    {
        $controller = self::getName($name);
        return CONTROLLER_NAMESPACE . $controller . "Controller";
    }

    /**
     * Get action name
     * @param string $name
     * @return string
     */
    private static function getActionName(string $name): string
    {
        return lcfirst(self::getName($name));
    }

//    public static function start()
//    {
//
//        $controller_name = "MainController";
//        $action = "index";
//
//        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
//        $query = explode('/', trim($uri, "/"));
//        $params = array_slice($query, 2, 3);
//
//        if (empty($params)) {
//            $params = null;
//        }
//
//        if (!empty($query[0])) {
//            $controller_name = $query[0] . "Controller";
//        }
//
//        if (!empty($query[1])) {
//            $action = $query[1];
//        }
//
//        $controller_class = CONTROLLER_NAMESPACE . $controller_name;
//
//        if (class_exists($controller_class)) {
//            $controller_object = new $controller_class;
//            if (method_exists($controller_object, $action)) {
//                $controller_object->$action($params);
//            } else {
//                View::error("404", ['no action']);
//            }
//        } else {
//            View::error("404", ['no controller']);
//        }
//    }
}