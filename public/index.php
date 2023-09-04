<?php

    require '../core/Router.php';
    require '../app/controllers/Posts.php';
    $router = new Router();

    //Add the routes
    $router->add('' , ['controller' => 'Home' , 'action' => 'index']);
    $router->add('posts' , ['controller' => 'Posts' , 'action' => 'index']);
    $router->add('{controller}/{action}');
    $router->add('{controller}/{id:\d+}/{action}');
    $url = $_SERVER['QUERY_STRING'];
    $router->match($url);
    // echo  'URL : ' .$url;
    // echo '<br>';
    // print_r($router->getParams());
    // echo '<br>';
    // echo '<br>';
    // echo '<br>';
    // print_r($router->getRoutes());

    $router->dispatch($url);
?>