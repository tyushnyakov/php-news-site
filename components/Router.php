<?php

class Router
{
    private $routes;
    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath); 
    }

    //return request string
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        } 
    } 

    public function run()
    {
        //получить строку запроса
        $uri = $this->getURI();
        
        //проверить наличие такого запроса в router.php
        foreach ($this->routes as $uriPattern => $path) {
           
            //сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {

                //Получаем внутренний путь из внешнего, согласно правилу
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                //определить какой контроллер и акшн обрабатывают этот запрос
                $segments = explode('/', $internalRoute);
                array_shift($segments);
                $controllerName = array_shift($segments)."Controller";
                $controllerName = ucfirst($controllerName);
                
                $actionName = "action" . ucfirst(array_shift($segments));

                $parameters = $segments;
                
                //Подключить файл класса-контролера
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                //Создать объект, вызвать метод, т.е. action
                  $controllerObject = new $controllerName;
                  $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                  if ($result != null) {
                    break;
                }
            }    
        }
    }
}