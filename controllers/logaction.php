<?php

include 'config.php';
require APP.'/src/db.php';

//Parameters
$db = connectMysql($dsn, $dbuser, $dbpass);
$remember = filter_input(INPUT_POST, 'remember');
$uname = filter_input(INPUT_POST, 'uname');
$pass = filter_input(INPUT_POST, 'pass');

//Call function
$auth = auth($db, $uname, $pass);

//if user is auth
if($auth){
    //if the user press checkbox remember me, set session remember.
    if($remember){

        //remember user
        setcookie('rememberUser', $uname, time()+3600);
        setcookie('rememberPassword', $pass, time()+3600);

        //go to home
        header("location:?url=home");
    }
    //go to home
    header("location:?url=home");
}else{
    //else go to login
    header("location:?url=login");
}