<?php 
session_start();
$role = $_SESSION['role'];
if(! isset($_SESSION['username'])){

    header('Location:../index.php');
}else if($role !="admin"){
echo("<script>alert('Sorry you do not have admininstrative credentials')</script>");
 header("Refresh:0; url=pages-error-404.php"); 
}else{
    $db = mysqli_connect('localhost', 'root', '', 'project');
include '../../controller/user.php';
// include '../../controller/project.php';
// <?php
//session_start();
// include 'db.php';
// filter by owner
$username= ($_SESSION['username']);

$project = "SELECT * FROM projects ";
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

include '../../controller/schedule.php';
if (isset($_POST['addproject'])){
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $category = mysqli_real_escape_string($db, $_POST['category']);
    $budget = mysqli_real_escape_string($db, $_POST['budget']);
    $owner = mysqli_real_escape_string($db, $_POST['owner']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    {
        $find_project = "SELECT * FROM projects WHERE p_name='$name' and p_owner='$owner'";
        $find_result =mysqli_query($db,$find_project);
        $find_rows = mysqli_num_rows($find_result);
        if ($find_rows >0){
           ?>
<script> alert("The project is existing");</script>
<?php
        }else{
            $query = "INSERT INTO projects (p_name, p_category, p_status, p_required, p_owner) 
                      VALUES('$name', '$category', '$status', '$budget', '$owner')";
             $success = mysqli_query($db, $query);
             if ($success){
               echo" <script> alert('Project successfully added');</script>";
                header("Refresh:0; url=pages-blank.php");    
             }else{
                ?>
                <script> alert("Failed to update Error code #project_001");</script>
                <?php
             }
        }
    }
}
if(isset($_POST['activate'])){
    $id =$_POST['id'];
    echo $id;


{
$activate_project = "SELECT * FROM projects WHERE id='$id'";
$activate_project_result =mysqli_query($db,$activate_project);
if (mysqli_num_rows($activate_project_result) > 0){

$query_update="UPDATE projects SET p_status='active' WHERE id='$id'";
$activate_success = mysqli_query($db, $query_update);
if ($activate_success){                                        
echo" <script> alert('Project activated update completed');

</script>";
 header("Refresh:0; url=pages-blank.php");                                               
}else{
?>
<script> alert("Failed to activate Error project_001");</script>
<?php

}
}else{
?>
<script> alert("The project is already active");</script>
<?php

}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Shinga</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="../assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--c3 CSS -->
    <link href="../assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="css/pages/dashboard1.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Shinga Tech Hub</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-xs-down search-box"> <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="fa fa-times"></i></a></form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/1.jpg" alt="user" class="" /> <span class="hidden-md-down"><?php echo $username?> &nbsp;</span> </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="pages-profile.php" aria-expanded="false"><i class="fa fa-user-circle-o"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="table-basic.php" aria-expanded="false"><i class="fa fa-table"></i><span class="hide-menu">Progress</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="icon-fontawesome.php" aria-expanded="false"><i class="fa fa-smile-o"></i><span class="hide-menu">Icons</span></a>
                        </li>
                        
                        <li> <a class="waves-effect waves-dark" href="pages-blank.php" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Admin</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="pages-error-404.php" aria-expanded="false"><i class="fa fa-question-circle"></i><span class="hide-menu">404</span></a>
                        </li>
                    </ul>
                    <div class="text-center m-t-30">
                        <a href="../../logout.php" class="btn waves-effect waves-light btn-info hidden-md-down"> Logout</a>
                    </div>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Admin</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="../../logout.php" class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down"> Logout</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Sales Chart and browser state-->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <div>
                                        <h5 class="card-title m-b-0">Sales Chart</h5>
                                    </div>
                                    <div class="ml-auto">
                                        <ul class="list-inline text-center font-12">
                                            <li><i class="fa fa-circle text-success"></i> SITE A</li>
                                            <li><i class="fa fa-circle text-info"></i> SITE B</li>
                                            <li><i class="fa fa-circle text-primary"></i> SITE C</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="" id="sales-chart" style="height: 375px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex m-b-30 no-block">
                                    <h5 class="card-title m-b-0 align-self-center">Your Projects</h5>
                                    <div class="ml-auto">
                                        <select class="custom-select b-0">
                                            <option selected="">Today</option>
<!--                                             <option value="1">Tomorrow</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div id="visitor" style="height:260px; width:100%;"></div>
                                <ul class="list-inline m-t-30 text-center font-12">
                                    <li><i class="fa fa-circle " style="color:#eceff1;"></i> Active</li>
                                    <li><i class="fa fa-circle " style="color:#24d2b5;"></i> Pening</li>
                                    <li><i class="fa fa-circle " style="color:#6772e5;"></i> Completed</li>
                                    <li><i class="fa fa-circle " style="color:#20aee3;"></i> Suspended</li>
                                    <li><i class="fa fa-circle " style="color:#FF0000;"></i> Cancelled</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Sales Chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Projects of the Month -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Start Notification -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card card-body mailbox">
                            <h5 class="card-title">Notification</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                <!-- Message -->
                               <!--  <a href="#">
                                    <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                    <div class="mail-contnet">
                                        <h5><?php echo $s_name;?></h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                </a> -->
                                <!-- Message -->
                                <?php while ($notification_loop = mysqli_fetch_array($s_result)){?>
                                <a href="#">
                                    <div class="btn btn-success btn-circle"><i class="fa fa-calendar-check-o"></i></div>
                                    <div class="mail-contnet">
                                        <h5><?php echo $notification_loop['s_name'];?></h5> <span class="mail-desc"><?php echo $notification_loop['s_description'];?></span> <span class="time">kickoff <?php echo $notification_loop['s_start'];?></span> <span class="time">ending <?php echo $notification_loop['s_end'];?></span> </div>
                                </a>
                                 <?php 
                                }$notification_loop ++;
                                ?>
                                <!-- Message -->
                               <!--  <a href="#">
                                    <div class="btn btn-info btn-circle"><i class="fa fa-cog"></i></div>
                                    <div class="mail-contnet">
                                        <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                </a> -->
                                <!-- Message -->
                               <!--  <a href="#">
                                    <div class="btn btn-primary btn-circle"><i class="fa fa-user"></i></div>
                                    <div class="mail-contnet">
                                        <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                </a> -->
                            </div>
                        </div>
                    </div>
                    <!-- End Notification -->
                    <!-- Start Feeds -->
                    <div class="col-lg-6">
                       <div class="card card-body " style="height: 385px;">
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                
                                <div style="margin: 0 auto; width:100%; height:385px;">
                                <object type="text/html" data="../../notification/index.php"
                                        style="width:100%; height:100%; margin:1%;">
                                </object>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Feeds -->
                </div>
                    <div class="row">
                    <!-- Column -->
                    
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                               <h5 class="card-title">Add new project</h5>
                                <div class="table-responsive m-t-20 no-wrap">
                                    <table class="table vm no-th-brd pro-of-month">
                                       <!--  <thead>
                                            <tr>
                                                <th colspan="2">Assigned</th>
                                                <th>Name</th>
                                                <th>Budget</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead> -->
                                    
                                        <tbody><form action="pages-blank.php" method="post">
                                <tr>
                                                

                                    <td>
                                        <div class="form-group">
                                            <label class="col-md-12">Project name</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Project name" class="form-control form-control-line" required="" name ="name">
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 
                                                                                <!-- project category selection -->
                                        <?php
                                        $project_category = "SELECT * FROM categories" ;
                                        $category_result =mysqli_query($db,$project_category);
                                        // for user selection
                                        $add_users = "SELECT * FROM users";
                                        $add_users_result =mysqli_query($db,$add_users);
                                        ?>
                                        <div class="form-group">
                                            <label class="col-md-12">Project category</label>
                                            <div class="col-md-12">
                                            <select class="form-control form-control-line" name="category">
                                            <?php
                                            while ($category_loop = mysqli_fetch_array($category_result)){
                                            ?>
                                            <option value="<?php echo $category_loop['category']; ?>"  ><?php echo $category_loop['category']; ?></option>

                                            <?php
                                            }$category_loop ++;
                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" placeholder="" class="form-control form-control-line" value="active" name ="status">
                                   </td>
                                </tr>
                                <tr>
                                    <td> 
                                        <div class="form-group">
                                            <label class="col-md-12">Budget</label>
                                                <div class="col-md-12">
                                                    <input type="number" placeholder="1000" class="form-control form-control-line" required="0-9" min="500" max="10000" name="budget" step="any">
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 
                                        <div class="form-group">
                                            <label class="col-md-12">Project owner</label>
                                            <div class="col-md-12">

                                            <select class="form-control form-control-line" name ="owner">
                                            <?php
                                            while ($add_user_loop = mysqli_fetch_array($add_users_result)){
                                            ?>
                                            <option selected="" class="form-control form-control-line" value=<?php echo $add_user_loop['username']?>><?php echo $add_user_loop['username']?></option>
                                            <?php
                                            }$add_user_loop ++;
                                            ?>

                                            </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn waves-effect waves-light btn-info hidden-md-down" type="submit" name="addproject pill-right" >Add</button> 
                                    </td>
                                </tr>

                                        </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                
                   

                    <div class="col-lg-8">
                       <div class="card card-body " style="height: 650px;">
                        <h5 class="card-title">Pending Projects</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="table-responsive m-t-20 no-wrap">
                                    <table class="table vm no-th-brd pro-of-month">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Assigned</th>
                                                <th>Name</th>
                                                <th>Budget</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php while ($pending_loop = mysqli_fetch_array($pending_result)){?>
                                        <tbody><form action="pages-blank.php" method="post">
                                             <tr>
                                                <td style="width:50px;"><span class="round"><?php echo $pending_loop['p_owner']; ?></span></td>
                                                <td>
                                                <h6 name="owner"><?php echo $pending_loop['p_owner']; ?></h6><small class="text-muted"><?php echo $pending_loop['p_category']?></small></td>
                                                <td><?php echo $pending_loop['p_name']; ?></td>
                                                <td>$ <?php echo $pending_loop['p_required']; ?></td>
                                                <td><?php echo $pending_loop['p_status']; ?></td>
                                                <input type="hidden" name="id" value=<?php echo $pending_loop['id']; ?>>

                                                <td><button class="btn waves-effect waves-light btn-info hidden-md-down" type="submit" name="activate">Activate</button>   <?php //echo $project_loop['p_name']; ?> </td></td>
                                            </tr>

                                        </form>
                                                                                       <?php 
                                            }$pending_loop ++;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div></div></div>
                </div> </div>
                <!-- ============================================================== -->
                <!-- End Projects of the Month -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Notification And Feeds -->
                <!-- ============================================================== -->
                <div class="row">
                   <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                               <h5 class="card-title">Add new task</h5>
                                <div class="table-responsive m-t-20 no-wrap">
                                    <table class="table vm no-th-brd pro-of-month">
                                       <!--  <thead>
                                            <tr>
                                                <th colspan="2">Assigned</th>
                                                <th>Name</th>
                                                <th>Budget</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead> -->
                                    
                                        <tbody><form action="task.php" method="post">
                                <tr>
                                                

                                    <td>
                                        <div class="form-group">
                                            <label class="col-md-12">Task</label>
                                                <div class="col-md-12">
                                                    <textarea type="text" placeholder="Task" class="form-control form-control-line" required="" name ="description"></textarea>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                 $add_users = "SELECT * FROM users";
                                        $add_users_result =mysqli_query($db,$add_users);
                                ?>
                                
                                <tr>
                                    <td>
                                        <input type="hidden" placeholder="" class="form-control form-control-line" value=<?php echo $_SESSION['username'];?> name ="origin" >
                                   </td>
                                </tr>
                                <tr>
                                    <td> 
                                        <div class="form-group">
                                            <label class="col-md-12">Due date</label>
                                                <div class="col-md-12">
                                                    <input type="date" placeholder="1000" class="form-control form-control-line" name="duedate" required=" ">
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 
                                        <div class="form-group">
                                            <label class="col-md-12">Receipient</label>
                                            <div class="col-md-12">

                                            <select class="form-control form-control-line" name ="receipient">
                                            <?php
                                            while ($add_user_loop = mysqli_fetch_array($add_users_result)){
                                            ?>
                                            <option selected="" class="form-control form-control-line" value=<?php echo $add_user_loop['username']?>><?php echo $add_user_loop['username']?></option>
                                            <?php
                                            }$add_user_loop ++;
                                            ?>

                                            </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn waves-effect waves-light btn-info hidden-md-down pull-right" type="submit" name="addproject"  >Add</button> 
                                    </td>
                                </tr>

                                        </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                       <div class="card card-body mailbox">
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="table-responsive m-t-20 no-wrap">
                                    <table class="table vm no-th-brd pro-of-month">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Assigned</th>
                                                <th>Name</th>
                                                <th>Budget</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php while ($project_loop = mysqli_fetch_array($p_result)){?>
                                        <tbody><form action="project.php" method="post">
                                             <tr>
                                                <td style="width:50px;"><span class="round"><?php echo $project_loop['p_owner']; ?></span></td>
                                                <td>
                                                    <h6><?php echo $project_loop['p_owner']; ?></h6><small class="text-muted"><?php echo $project_loop['p_category']?></small></td>
                                                <td><?php echo $project_loop['p_name']; ?></td>
                                                <td>$ <?php echo $project_loop['p_required']; ?></td>
                                                <td><?php echo $project_loop['p_status']; ?></td>
                                                <td><button class="btn waves-effect waves-light btn-info hidden-md-down" type="submit">Open</button>   <?php //echo $project_loop['p_name']; ?> </td></td>
                                            </tr>

                                        </form>
                                                                                       <?php 
                                            }$project_loop ++;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div></div></div>
                
                <!-- ============================================================== -->
                <!-- End Notification And Feeds -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © 2019 Shinga</footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="../assets/node_modules/bootstrap/js/popper.min.js"></script>
    <script src="../assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="../assets/node_modules/raphael/raphael-min.js"></script>
    <script src="../assets/node_modules/morrisjs/morris.min.js"></script>
    <!--c3 JavaScript -->
    <script src="../assets/node_modules/d3/d3.min.js"></script>
    <script src="../assets/node_modules/c3-master/c3.min.js"></script>
    <!-- Chart JS 
    <script src="js/dashboard1.js"></script>-->
    <script type="text/javascript">
        /*
Template Name: Admin Pro Admin
Author: Wrappixel
Email: niravjoshi87@gmail.com
File: js
*/
var activeProject =<?php echo $active_rows ?>;
    var pendingProject =<?php echo $pending_rows ?>;
    var completedProject =<?php echo $completed_rows ?>;
    var suspendedProject =<?php echo $suspended_rows ?>;
    var cancelledProject =<?php echo $cancelled_rows ?>;
    var numberOfProjects =<?php echo $project_contribution?>;

$(function() {
    "use strict";
    // ============================================================== 
    // Our Visitor
    // ============================================================== 

    var chart = c3.generate({
        bindto: '#visitor',
        data: {
            columns: [
                ['Active', activeProject],
                ['Pending', pendingProject],
                ['Completed', completedProject],
                ['Suspended', suspendedProject],
                ['Cancelled', cancelledProject],
            ],

            type: 'donut',
            onclick: function(d, i) { console.log("onclick", d, i); },
            onmouseover: function(d, i) { console.log("onmouseover", d, i); },
            onmouseout: function(d, i) { console.log("onmouseout", d, i); }
        },
        donut: {
            label: {
                show: false
            },
            title: "Projects",
            width: 20,

        },

        legend: {
            hide: true
            //or hide: 'data1'
            //or hide: ['data1', 'data2']
        },
        color: {
            pattern: ['#eceff1', '#24d2b5', '#6772e5', '#20aee3','#FF0000']
        }
    });
    // ============================================================== 
    // Our Income
    // ==============================================================
    var chart = c3.generate({
        bindto: '#income',
        data: {
            columns: [
                ['Growth Income', 100, 200, 100, 300],
                ['Net Income', 130, 100, 140, 200]
            ],
            type: 'bar'
        },
        bar: {
            space: 0.2,
            // or
            width: 15 // this makes bar width 100px
        },
        axis: {
            y: {
                tick: {
                    count: 4,

                    outer: false
                }
            }
        },
        legend: {
            hide: true
            //or hide: 'data1'
            //or hide: ['data1', 'data2']
        },
        grid: {
            x: {
                show: false
            },
            y: {
                show: true
            }
        },
        size: {
            height: 290
        },
        color: {
            pattern: ['#24d2b5', '#20aee3']
        }
    });

    // ============================================================== 
    // Sales Different
    // ============================================================== 

    var chart = c3.generate({
        bindto: '#sales',
        data: {
            columns: [
                ['One+', 50],
                ['T', 60],
                ['Samsung', 20],

            ],

            type: 'donut',
            onclick: function(d, i) { console.log("onclick", d, i); },
            onmouseover: function(d, i) { console.log("onmouseover", d, i); },
            onmouseout: function(d, i) { console.log("onmouseout", d, i); }
        },
        donut: {
            label: {
                show: false
            },
            title: "",
            width: 18,

        },
        size: {
            height: 150
        },
        legend: {
            hide: true
            //or hide: 'data1'
            //or hide: ['data1', 'data2']
        },
        color: {
            pattern: ['#eceff1', '#24d2b5', '#6772e5', '#20aee3']
        }
    });
    // ============================================================== 
    // Sales Prediction
    // ============================================================== 

    var chart = c3.generate({
        bindto: '#prediction',
        data: {
            columns: [
                ['data', 91.4]
            ],
            type: 'gauge',
            onclick: function(d, i) { console.log("onclick", d, i); },
            onmouseover: function(d, i) { console.log("onmouseover", d, i); },
            onmouseout: function(d, i) { console.log("onmouseout", d, i); }
        },

        color: {
            pattern: ['#ff9041', '#20aee3', '#24d2b5', '#6772e5'], // the three color levels for the percentage values.
            threshold: {
                //            unit: 'value', // percentage is default
                //            max: 200, // 100 is default
                values: [30, 60, 90, 100]
            }
        },
        gauge: {
            width: 22,
        },
        size: {
            height: 120,
            width: 150
        }
    });
    setTimeout(function() {
        chart.load({
            columns: [
                ['data', 10]
            ]
        });
    }, 1000);

    setTimeout(function() {
        chart.load({
            columns: [
                ['data', 50]
            ]
        });
    }, 2000);

    setTimeout(function() {
        chart.load({
            columns: [
                ['data', 70]
            ]
        });
    }, 3000);

    // ============================================================== 
    // Sales chart
    // ============================================================== 
    Morris.Area({
        element: 'sales-chart',
        data: [{
                period: '2011',
                Sales: 50,
                Earning: 80,
                Marketing: 20
            }, {
                period: '2012',
                Sales: 130,
                Earning: 100,
                Marketing: 80
            }, {
                period: '2013',
                Sales: 80,
                Earning: 60,
                Marketing: 70
            }, {
                period: '2014',
                Sales: 70,
                Earning: 200,
                Marketing: 140
            }, {
                period: '2015',
                Sales: 180,
                Earning: 150,
                Marketing: 140
            }, {
                period: '2016',
                Sales: 105,
                Earning: 100,
                Marketing: 80
            },
            {
                period: '2017',
                Sales: 250,
                Earning: 150,
                Marketing: 200
            }
        ],
        xkey: 'period',
        ykeys: ['Sales', 'Earning', 'Marketing'],
        labels: ['Site A', 'Site B', 'Site C'],
        pointSize: 0,
        fillOpacity: 0,
        pointStrokeColors: ['#20aee3', '#24d2b5', '#6772e5'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        hideHover: 'auto',
        lineColors: ['#20aee3', '#24d2b5', '#6772e5'],
        resize: true

    });


});
    </script>
</body>

</html>
<?php
}
?>