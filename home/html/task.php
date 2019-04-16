<?php
include '../../controller/db.php';
if (isset($_POST['addproject'])){
    $receipient = mysqli_real_escape_string($db, $_POST['receipient']);
    $duedate = mysqli_real_escape_string($db, $_POST['duedate']);
    $origin = mysqli_real_escape_string($db, $_POST['origin']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $status = "open";
    $currentdate = date("Y-m-d");
    if($duedate < $currentdate){
?> 

<script> alert("The date is past, please schedule current or future date");</script>
<?php
 header("Refresh:0; url=map-google.php"); 
    }else{

        $addtask = "SELECT * FROM projects WHERE p_owner='$receipient'";
        $add_result =mysqli_query($db,$addtask);
        $task_rows = mysqli_num_rows($add_result);
        if ($task_rows <1){
           ?> 

<script> alert("The receipient is not reqistered");</script>
<?php
        }else{
            $project_details =mysqli_fetch_array($add_result);
            $project_name= $project_details['p_name'];
            $taskaddquery = "INSERT INTO tasks (t_project, t_user, t_description, t_end, t_origin, t_status) 
                      VALUES('$project_name', '$receipient', '$description', '$duedate', '$origin', '$status')";
             $successtaskadd = mysqli_query($db, $taskaddquery);
             if ($successtaskadd){
               echo" <script> alert('Task added successfully added');</script>";
                header("Refresh:0; url=pages-blank.php");    
             }else{
                ?>
                <script> alert("Failed to update Error code #project_001");</script>
                <?php
                header("Refresh:0; url=pages-blank.php"); 
             }
        }
    }
}
?>