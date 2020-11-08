<?php
//insert user
include 'config.php';
require APP.'/src/db.php';

$db = connectMysql($dsn, $dbuser, $dbpass);

//Parameters
$uname = filter_input(INPUT_POST, 'uname');
$pass1 = filter_input(INPUT_POST, 'pass');
$pass = password_hash($pass1, PASSWORD_BCRYPT, ["cost" => 4]);

$email = filter_input(INPUT_POST, 'email');
$data = ['email' => $email,'uname' => $uname,'passw' => $pass];
$table = "users";

//if parameters are setted
if (isset($data)){
    //call function insert and go to login
    insert($db, $table, $data);
    
    header("location:?url=login");
} else{
    //else show error and go to register
    header("location:?url=register");
}