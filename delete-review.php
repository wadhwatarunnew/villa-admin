<?php

error_reporting(0);

$id = $_GET['id'];

$page = "update";

include "db.php";


$quer= mysqli_query($con,"delete from home_testimonials where id=$id");
include "alert-delete.php"; 
//header("location:review-list-page.php");
header( "refresh:1; url=review-list-page.php" );
?>