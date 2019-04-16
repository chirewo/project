<?php 
session_start();
if(! isset($_SESSION['username'])){
    header('Location:../../index.php');
}else{
include '../../controller/user.php';
include '../../controller/project.php';
include '../../controller/schedule.php';

// ownership
$p_array = mysqli_fetch_array($p_result);
$p_id = $p_array['id'];
$p_name = $p_array['p_name'];
$p_category = $p_array['p_category'];
$p_status = $p_array['p_status'];
$p_required = $p_array['p_required'];
$p_owner =$p_array['p_owner'];
include '../../controller/investor.php';
// investorshin
$i_array = mysqli_fetch_array($i_result);
$i_id = $i_array['id'];
$i_name = $i_array['project'];
$i_amount = $i_array['amount'];
$i_investor = $i_array['investor'];
// tasks ongoing
$task = "SELECT * FROM tasks WHERE t_user='$username' and t_project = '$p_name' and t_status = 'open'";
$t_result =mysqli_query($db,$task);
//comleted tasks
$ctask = "SELECT * FROM tasks WHERE t_user='$username' and t_project = '$p_name' and t_status ='completed' ";
$ct_result =mysqli_query($db,$ctask);
// its calling from the complete button
if (isset($_POST['complete'])){
$tt_id = $_POST['t_id'];
$tt_status = $_POST['t_status'];
{
$check = "SELECT * FROM tasks WHERE id='$tt_id' and t_status = 'open'";
$tt_result =mysqli_query($db,$check);
if (mysqli_num_rows($tt_result) > 0){

$data="UPDATE tasks SET t_status='completed' WHERE id='$tt_id'";
$update_task = mysqli_query($db, $data);
if ($update_task){                                        
echo" <script> alert('Status update completed');
</script>";
     header("Refresh:0; url=index.php");                                            
}else{
?>
<script> alert("Failed to update Error t_001");</script>
<?php

}
}else{
?>
<script> alert("The task status is already complete");</script>
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
                            <li class="breadcrumb-item active"><?php echo $p_name;?></li>
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
                   
                    <div class="col-lg-8 col-md-12" id="yourschesule">
                        <div class="card card-body mailbox">
                            <h5 class="card-title">Pending Tasks</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                               
                                <?php while ($task_loop = mysqli_fetch_array($t_result)){?>
                                <!-- <a href="#yourschesule"> -->
                                    <form action="index.php" method="post">
                                         <div class="btn btn-success btn-circle"><i class="fa fa-calendar-check-o"></i></div>
                                    <div class="mail-contnet">
                                          
                                
                                <table class="table">
                                                                
                                
                                <tr>
                                    <td>
                                       <v class="card-title">Description</v> 
                                    </td>
                                    <td>
                                        <v class="card-title">Due date</v>
                                    </td>
                                    <td>
                                      <v class="card-title">Instructed by</v>  
                                    </td>
                                    <td>
                                      <v class="card-title">Status</v>  
                                    </td>
                                    
                                </tr>
                                 <tr>
                                    <td style="width: 50%;">
                                       <v class="card-title"><h5><?php echo $task_loop['t_description'];?></h5> <span class="mail-desc"><?php// echo $task_loop['t_description'];?></span></v> 
                                       <input type="hidden" name="t_id" value=<?php echo $task_loop['id'];?>>

                                       <input type="hidden" name="t_description" value=<?php echo $task_loop['t_description'];?>>
                                    </td>
                                    <td>
                                        <v class="card-subtitle"><span class="time"><?php echo $task_loop['t_end'];?></span> </v>
                                        <input type="hidden" name="t_end" value=<?php echo $task_loop['t_end'];?>>
                                    </td>
                                    <td>
                                      <v class="card-subtitle"><span class="time"><?php echo $task_loop['t_origin'];?></span></v> 
                                      <input type="hidden" name="t_origin" value=<?php echo $task_loop['t_origin'];?>> 
                                    </td>
                                    <td>
                                      <v class="card-subtitle"><span class="time"><?php echo $task_loop['t_status'];?></span></v>
                                      <input type="hidden" name="t_status" value=<?php echo $task_loop['t_status'];?>>  
                                    </td>
                                    <td>
                                     <v class="card-subtitle"><span class="time"><button class="btn btn-heart btn-success" type="submit" name ="complete">complete</button></span></v>  
                                    </td>
                                </tr>
                            </table>

                        </div>
                                    </form>
                                   
                      <!--   </a> -->
                                 <?php 

                                }$task_loop ++;
                                
                                ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12" id="yourschesule">
                        <div class="card card-body mailbox">
                            <h5 class="card-title">Recent Tasks</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                               
                                <?php while ($ctask_loop = mysqli_fetch_array($ct_result)){?>
                                <!-- <a href="#yourschesule"> -->
                                    <form action="index.php" method="post">
                                         <div class="btn btn-success btn-circle"><i class="fa fa-calendar-check-o"></i></div>
                                    <div class="mail-contnet">
                                          
                                
                                <table class="table">
                                                                
                                
                                <tr>
                                    <td>
                                       <v class="card-title">Description</v> 
                                    </td>
                                    <td>
                                        <v class="card-title">Due date</v>
                                    </td>
                                    
                                    
                                    
                                </tr>
                                 <tr>
                                    <td style="width: 50%;">
                                       <v class="card-title"><h5><?php echo $ctask_loop['t_description'];?></h5> <span class="mail-desc"><?php// echo $task_loop['t_description'];?></span></v> 
                                       <input type="hidden" name="t_id" value=<?php echo $ctask_loop['id'];?>>

                                       <input type="hidden" name="t_description" value=<?php echo $ctask_loop['t_description'];?>>
                                    </td>
                                    <td>
                                        <v class="card-subtitle"><span class="time"><?php echo $ctask_loop['t_end'];?></span> </v>
                                        <input type="hidden" name="t_end" value=<?php echo $ctask_loop['t_end'];?>>
                                    </td>
                                    
                                  </tr>
                                                         
                            </table>

                        </div>
                                    </form>
                                   
                      <!--   </a> -->
                                 <?php 

                                }$task_loop ++;
                                
                                ?>
                                
                            </div>
                        </div>
                    </div>
                    

                </div>
                <div class="row">
                   <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $p_name;?></h4>
                               <!--  <h6 class="card-subtitle">Add class <code>.table</code></h6> -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Budget</th>
                                                <th>Investor</th>
                                                <th>Funds</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $p_category;?></td>
                                                <td><?php echo $p_status;?></td>
                                                <td><?php echo $p_required;?></td>
                                                <td><?php echo $i_investor?></td>
                                                 <td><?php echo $i_amount?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    
                </div>
                <div class="row">
                   
                    <div class="col-lg-6 col-md-12" id="yourschesule">
                        <div class="card card-body mailbox">
                            <h5 class="card-title">Your Schedule</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                               
                                <?php while ($notification_loop = mysqli_fetch_array($s_result)){?>
                                <a href="#yourschesule">
                                    <div class="btn btn-success btn-circle"><i class="fa fa-calendar-check-o"></i></div>
                                    <div class="mail-contnet">
                                          
                                
                                <table class="table">
                                                                
                                
                                <tr>
                                    <td>
                                       <v class="card-title">Description</v> 
                                    </td>
                                    <td>
                                        <v class="card-subtitle">Starting</v>
                                    </td>
                                    <td>
                                      <v class="card-subtitle">Ending</v>  
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                       <v class="card-title"><h5><?php echo $notification_loop['s_name'];?></h5> <span class="mail-desc"><?php echo $notification_loop['s_description'];?></span></v> 
                                    </td>
                                    <td>
                                        <v class="card-subtitle"><span class="time"><?php echo $notification_loop['s_start'];?></span> </v>
                                    </td>
                                    <td>
                                      <v class="card-subtitle"><span class="time"><?php echo $notification_loop['s_end'];?></span></v>  
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </a>
                                 <?php 
                                }$notification_loop ++;
                                ?>
                                
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-12" id="createschedule">
                        <div class="card card-body mailbox">
                            <h5 class="card-title"><div class="btn btn-primary btn-circle"><i class="fa fa-calendar-check-o"></i></div> Create Schedule</h5>
                            <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                                <a href="#reateschedule">
                                    <form class="form-horizontal form-material " action="scheduler.php" method="post" >
                                        <table>
                                            <tr>
                                                <td>
                                                    <label class="col-md-12">Start date</label> 
                                                        </td>
                                                             <td>
                                                                 <label class="col-md-12">End date</label> 
                                                            </td>
                                                        <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <input type="date" placeholder="" class="form-control form-control-line" id="startdate" name="startdate" required="">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">   
                                                            <div class="col-md-12">
                                                                <input type="date" placeholder="" class="form-control form-control-line" id="enddate" name="enddate" required="">
                                                            </div>
                                                        </div> 
                                                    </td>
                                                </tr>
                                             </tr>
                                        </table>
                                        <div class="form-group">
                                            <label class="col-md-12">Schedule Name</label>
                                                <div class="col-md-12">
                                                    <textarea rows="1" class="form-control form-control-line" name="s_name" required=""></textarea>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Message</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5" class="form-control form-control-line" name="description" required=""></textarea>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-primary" type="submit" name="schedule">Create</button>
                                            </div>
                                    </div>             
                                    </form>
                                      
                                </a>
                            </div>
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
     
                <!-- ============================================================== -->
                <!-- End Projects of the Month -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Notification And Feeds -->
                <!-- ============================================================== -->
                
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
    </script>
</body>

</html>
<?php }?>