<?php
    //if session uname is not set, go to home
    if(!isset($_SESSION['uname'])){
        header("location:?url=home");
    }
    //include header
    include 'src/templates/header.tpl.php';

    ?>
    <!-- main -->
    <main>
        <div class="container">
            <h2>Dashboard</h2>
            <!-- Select user ID-->
            <table class="table">
                <th>Select user ID</th>
            <form action="?url=dashboard" method="POST">
                <td><input type="number" name="idname" placeholder="user ID" required >
                <button type="submit"> Show</button></td>
            </form>
            </table>
            
            <?php
            //if parameters of tasks are setted
            if(isset($data['tasks'])){
                //if value of tasks is more than 0 
                if(count($data['tasks']) > 0){
                    ?>
                    <!-- print table whith specific data  -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Task ID</th>
                                <th scope="col">Task</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead> 
                    <?php
                //foreach row of the table 
                foreach($data['tasks'] as $row){
                    //add a row
                    echo "<tr>";
                    //foreach field 
                    foreach($row as $fields => $value){
                        //get value
                        echo "<td>".$value ."</td>";
                    }
                    //end of row
                    echo "</tr>";
                }
                //else, if not find data in task with this user id print table with explain
                }else{
                    ?>
                    <table class="table">
                        <th>User ID selected hasn't tasks</th>
                    </table>
                    <?php 
                }
            }
            ?>
            <!-- End select user ID -->
            
            <!--Delete task ID-->
            <table class="table">
                <th>Delete task ID</th>
            <form action="?url=dashboard" method="POST">
                <td><input type="number" name="taskID" placeholder="Task ID" required>
                <button type="submit"> Delete</button></td>
            </form>
            </table>
            <!--End delete task ID-->

            <!-- Insert -->
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Username ID</th>
                    <th scope="col">Task</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <form action="?url=dashboard" method="POST">
            <tbody>
                <tr>
                <td><input type="number" name="name" required></td>
                <td><input type="text" name="descr" required></td>
                <td><input type="date" name="date" required></td>
                <td><button type="submit"> Insert</button></td>
                </tr>
            </tbody>
            </table>
            <!-- End insert -->
        </div>
    </main>
    <!-- end main -->
<?php
    include 'src/templates/footer.tpl.php';
?>
