<?php

    function connectMysql(string $dsn,string $userdb,string $passdb){
        try{
            $db = new PDO($dsn, $userdb, $passdb);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            die( $e->getMessage());
            
        }
        return $db;
    }

    // funció d'autenticació
    // comprova si existeix usuari i password
    // i crea variables de sessió, això podria estar fora
    function auth($db,$uname,$pass):bool
    {
        
        try{   
            
            $stmt=$db->prepare('SELECT * FROM users WHERE uname=:uname LIMIT 1');
            $stmt->execute([':uname'=>$uname]);
            $count=$stmt->rowCount();
            $row=$stmt->fetchAll(PDO::FETCH_ASSOC);  

            if($count==1){       
                $user=$row[0];
                $res=password_verify($pass,$user['passw']);

                if ($res){
                    $_SESSION['uname']=$user['uname'];

                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch(PDOException $e){
            return false;
        }
    }

        // funció d'inserció de registres en taula
        function insert($db,$table,$data):bool 
        {
           if (is_array($data)){
               
              $columns='';$bindv='';$values=null;
                foreach ($data as $column => $value) {
                    $columns.='`'.$column.'`,';
                    $bindv.='?,';
                    $values[]=$value;
                }

                $columns=substr($columns,0,-1);
                $bindv=substr($bindv,0,-1);
                  
                $sql="INSERT INTO {$table}({$columns}) VALUES ({$bindv})";
                var_dump($sql);
                die;
                    try{
                        $stmt=$db->prepare($sql);
    
                        $stmt->execute($values);
                    }catch(PDOException $e){
                        echo $e->getMessage();
                        return false;
                    }
                
                return true;
                }
                return false;
            }

      // funció de selecció de  tots els registres
      // pots indicar quins camps vols mostrar
        function selectAll($db,$table,array $fields=null):array
        {
            if (is_array($fields)){
                $columns=implode(',',$fields);
                
            }else{
                $columns="*";
            }
            
            $sql="SELECT {$columns} FROM {$table}";
           
            $stmt=$db->prepare($sql);
            $stmt->execute();
            $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

            return $rows;
        }

        // insert registers to table
        function insertRegs($db,$table,$data):bool 
        {
           if (is_array($data)){
              $columns='';$bindv='';$values=null;
                foreach ($data as $column => $value) {
                    $columns.='`'.$column.'`,';
                    $bindv.='?,';
                    $values[]=$value;
                }

                $columns=substr($columns,0,-1);
                $bindv=substr($bindv,0,-1);
                  
                $sql="INSERT INTO {$table}({$columns}) VALUES ({$bindv})";

                    try{
                        $stmt=$db->prepare($sql);
    
                        $stmt->execute($values);
                    }catch(PDOException $e){
                        echo $e->getMessage();
                        return false;
                    }
                
                return true;
                }
                return false;
            }

            // select amb només una condició
            function selectWhere($db,$table,array $fields=null,array $conditions):array
            {
                if (is_array($fields)){
                    $columns=implode(',',$fields);

                }else{
                    $columns="*";
                }

                $cond="{$conditions[0]}='{$conditions[1]}'";

                $sql="SELECT {$columns} FROM {$table} WHERE {$cond} ";


                $stmt=$db->prepare($sql);
                $stmt->execute();
                $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

                return $rows;
            }

            //esborrar registres d'una taula amb una condició
            function deleteWhere($db,$table,array $conditions):bool
            {

                $cond="{$conditions[0]}='{$conditions[1]}'";

                $sql="delete FROM {$table} WHERE {$cond} ";


                $stmt=$db->prepare($sql);
                $stmt->execute();
                

                return true;
            }