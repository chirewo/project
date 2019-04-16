<?php
//session_start();
include 'db.php';
// filter by owner
$username= ($_SESSION['username']);

$project = "SELECT * FROM projects WHERE p_owner='$username'";
$p_result =mysqli_query($db,$project);

// $p_array = mysqli_fetch_array($p_result);
// $p_id = $p_array['id'];
// $p_name = $p_array['p_name'];
// $p_category = $p_array['p_category'];
// $p_status = $p_array['p_status'];
// $p_required = $p_array['p_required'];
// $p_owner =$p_array['p_owner'];	

// filter by status
//active
$active_project = "SELECT * FROM projects WHERE p_status='active'";
$active_result =mysqli_query($db,$active_project);
$active_rows = mysqli_num_rows($active_result);
//completed
$completed_projects = "SELECT * FROM projects WHERE p_status='completed'";
$completed_results =mysqli_query($db,$completed_projects);
$completed_rows = mysqli_num_rows($completed_results);
//pending
$pending_project = "SELECT * FROM projects WHERE p_status='pending'";
$pending_result =mysqli_query($db,$pending_project);
$pending_rows = mysqli_num_rows($pending_result);
//suspended
$suspended_project = "SELECT * FROM projects WHERE p_status='suspended'";
$suspended_result =mysqli_query($db,$suspended_project);
$suspended_rows = mysqli_num_rows($suspended_result);
//cancelled
$cancelled_project = "SELECT * FROM projects WHERE p_status='cancelled'";
$cancelled_result =mysqli_query($db,$cancelled_project);
$cancelled_rows = mysqli_num_rows($cancelled_result);


// calculating project share 
$project_contribution = $active_rows+$completed_rows+$pending_rows+$suspended_rows+$cancelled_rows;
//calculating percentage per status
//active
$active_percentage = ($active_rows/$project_contribution)*100;
//completed
$completed_percentage =($completed_rows/$project_contribution)*100;
//pending
$pending_percentage =($pending_rows/$project_contribution)*100;
//suspended
$suspended_percentage =($suspended_rows/$project_contribution)*100;
//cancelled 
$cancellec_percentage =($cancelled_rows/$project_contribution)*100;
