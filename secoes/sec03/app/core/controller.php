<?php 

function loadController($matchedUri, $params){

    [$controller, $method] = explode('@',array_values($matchedUri)[0]);

    $controllerWithNameSpace = CONTROLLER_PATH.$controller;

    if(!class_exists($controllerWithNameSpace)){
       throw new Exception("O controller {$controller} não existe"); 
    }

    $controllerInstance = new $controllerWithNameSpace;

    if(!method_exists($controllerInstance,$method))
    {
        throw new Exception("O método {$method} não existe no controller {$controller}"); 
    }

    $controller = $controllerInstance->$method($params);

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        die();
    }

    return $controller;
}

?>