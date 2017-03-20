<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Returns request string
     */

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     *
     */
    public function run()
    {
        // Получить строку запроса
        $uri = $this->getURI();

        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {

            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {

                // Получаем внутренний путь из внешнего согласно правилу
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Определить контроллер, action, параметры
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller'; // извлекаем первый элемент массива
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));


                echo '<br> controller name: ' . $controllerName;
                echo '<br> action name: ' . $actionName;

                $parameters = $segments;
                echo '<pre>';
                print_r($parameters);
                die;

                // Подключить файл класса контроллера

                    $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';
                    if (file_exists($controllerFile)) {
                        include_once($controllerFile);
                    }

                // Создать объект, вызвать метод(т.е action)
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();

                if ($result != null) {
                    break;
                }
            }
        }

    }
}