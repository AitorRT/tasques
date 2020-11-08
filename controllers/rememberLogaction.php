<?php

//render vista
require APP.'/src/render.php';
//si està definida la sessió
$uname=$_SESSION['uname'] ?? '';
echo render('rememberLogin',['title'=>'Todo '.$uname]);

$rememberedUser = filter_input(INPUT_POST, 'rememberedUser');
$anotherUser = filter_input(INPUT_POST, 'anotherUser');


if(isset($rememberedUser)){
    header("location:?url=home");
}

if(isset($anotherUser)){
    header("location:?url=logout");
}