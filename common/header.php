<?php
   include "db.php";
   session_start();
   if(!isset($_SESSION['loggedin']))
   {
        session_destroy(); 
	    mysqli_close($con); 
        header("location:login.php");
    }
    
    $PageTitle = isset($PageTitle) ? $PageTitle : 'Villatent: Dashboard';
?>

<!DOCTYPE html>
<html lang="en">
   <head>
        <title><?php echo $PageTitle; ?></title>
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="uploads/logo/6076favicon.png"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/feather.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        <script src="js/jquery.min.js"></script>
        <script src="js/common.js"></script>
        <script src="ckeditor/ckeditor.js?ver=1"></script>
    </head>

    <body>
       
        <nav class="navbar header-navbar pcoded-header iscollapsed">
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a href="index.php">
                        <img class="img-fluid" src="images/thevillatent-logo.png" alt="image" width="50">     The Villa Tent
                    </a>
                </div>
                 
                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li>
                            <?php 
                                $MainHeading = preg_replace([
                                                                '/^Villatent:\s*/',   // remove "Villatent:" from start
                                                                '/\s*Page$/'          // remove "Page" from end
                                                            ], '', trim($PageTitle));
                                echo trim($MainHeading); 
                            ?>
                        </li>
                    </ul>
                    <ul class="nav-right ms-auto">
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <span>Ajay Garg</span>
                                    <i class="feather icon-chevron-down"></i> 
                                </div>

                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <a href="profile.php">
                                            <i class="feather icon-settings"></i> Edit Profile
                                        </a>
                                    </li>
                                   
                                    <li>
                                        <a href="logout.php">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php include_once('common/sidebar.php'); ?>