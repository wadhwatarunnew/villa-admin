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
       <?php include_once('common/head-assets.php'); ?>
    </head>

    <body>
       
        <nav class="header-navbar pcoded-header iscollapsed">
            <div class="header-flex">
                <a class="header-brand" href="index.php">
                    <img src="images/thevillatent-logo.png" alt="The Villa Tent logo">
                    <span>The Villa Tent</span>
                </a>

                <div class="dropdown header-user">
                    <button class="btn header-user-toggle dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ajay Garg <i class="feather icon-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end show-notification profile-notification">
                        <li>
                            <a class="dropdown-item" href="profile.php">
                                <i class="feather icon-settings"></i> Edit Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="logout.php">
                                <i class="feather icon-log-out"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php include_once('common/sidebar.php'); ?>