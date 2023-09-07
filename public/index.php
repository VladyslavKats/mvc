<?php
    require_once '../vendor/autoload.php';


    $router = new Core\Router();

    //Add the routes
    $router->add('' , ['controller' => 'Home' , 'action' => 'index'] );
    $router->add('{controller}/{action}');
    $router->add('{controller}/{id:\d+}/{action}');
    $router->add('admin/{controller}/{action}' , ['namespace' => 'Admin']);
    $url = $_SERVER['QUERY_STRING'];
    $router->match($url);
    $router->dispatch($url);
    
?>