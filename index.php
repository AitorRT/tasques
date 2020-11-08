<?php
    die("hola");
    //activació d'errors
    ini_set('display_errors', 'On');
    //configuració entorn
    session_start();
    define('APP',__DIR__);
    require APP.'/src/route.php';
    //enrutamiento
    $controller=getRoute();
    //redirigir a ruta capturada
    require APP.'/controllers/'.$controller.'.php';