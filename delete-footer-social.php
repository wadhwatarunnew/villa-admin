<?php

error_reporting(0);

$id = $_GET['id'];

$page = "update";

include "db.php";


$quer= mysqli_query($con,"delete from footer_follow_us where id=$id");
include "alert-delete.php"; 
//header("location:socialmedialist.php");
header( "refresh:1; url=socialmedialist.php" );
?>