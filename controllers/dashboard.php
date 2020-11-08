<?php
    include 'config.php';
    require APP.'/src/db.php';
    require APP.'/src/render.php';

    //si està definida la sessió
    $uname=$_SESSION['uname'] ?? '';
    
    $db = connectMysql($dsn, $dbuser, $dbpass);

    //parameters
    $user = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'descr', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $taskID = filter_input(INPUT_POST, 'taskID', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'idname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $table = 'tasks';

    //Show
    if(isset($id)){
        
        //parameters
        $fields=['id','description','user','due_date'];
        $conditions = ['user', $id];

        //Show table with specific user ID         //Call function
        $tasks = selectWhere($db,$table, $fields, $conditions);
        echo render('dashboard',['title'=>'Todo '.$uname, 'tasks' => $tasks]);
        
    }else{
        //render vista
        echo render('dashboard',['title'=>'Todo '.$uname]);
    }

    //Insert
    if(isset($user) && isset($description) && isset($date)){
        //array parameter
        $data = ['user' => $user,'description' => $description,'due_date' => $date];
        //Call function
        insertRegs($db, $table, $data);
    }

    //Delete
    if($taskID != null){
        //Parameter
        $conditions = ['id', $taskID];
        //Call function
        deleteWhere($db, $table, $conditions);
    }