<?php
//render vista

require APP.'/src/render.php';
//si està definida la sessió
$uname=$_SESSION['uname'] ?? '';
echo render('login',['title'=>'Todo '.$uname]);