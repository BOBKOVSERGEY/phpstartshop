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

    public function run()
    {
        // Получить строку запроса
        $uri = $this->getURI();

        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {

            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {

                // Определить какой контроллер
                // и action обрабатывают этот запрос
                $segments = explode('/', $path);

                $controllerName = array_shift($segments) . 'Controller'; // извлекаем первый элемент массива
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                echo '<br>Класс: ' .$controllerName;
                echo '<br>Метод: ' .$actionName;
            }
        }

        // Если есть совпадение,определить какой контроллер
        // и action обрабатывают запрос

        // Подключить файл класса контроллера

        // Создать объект, вызвать метод(т.е action)

    }
}