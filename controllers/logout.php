<?php
    //finalitzar la sessió
    session_destroy();

    //finalitzar les coockies
    setcookie('rememberUser', $uname, time()-100);
    setcookie('rememberPassword', $uname, time()-100);
    
    //render vista

    require APP.'/src/render.php';
    //si està definida la sessió
    $uname=$_SESSION['uname'] ?? '';
    header("location:?url=home");