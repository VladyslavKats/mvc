<?php

    


    spl_autoload_register(function($class){
        $root = dirname(__DIR__);
        $file = $root . '/' . str_replace('\\' , '/' , $class) . '.php';
        if(is_readable($file)){
            require $root . '/' . str_replace('\\' , '/' , $class) . '.php';
        }
    });

    require_once dirname(__DIR__) . '/vendor/autoload.php';


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