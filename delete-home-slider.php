<?php

error_reporting(0);

$id = $_GET['id'];

$page = "update";

include "db.php";


mysqli_query($con,"delete from home_slider where id=$id");
include "alert-delete.php"; 
//header("location:home-slider.php");
header( "refresh:1; url=home-slider.php" );
?>