<?php

error_reporting(0);

$id = $_GET['id'];

$page = "update";

include "db.php";


$quer= mysqli_query($con,"delete from project_category where id=$id");
include "alert-delete.php"; 
//header("location:project-category-listing.php");
header( "refresh:1; url=project-category-listing.php" );
?>