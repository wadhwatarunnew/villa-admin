<?php

error_reporting(0);

$id = $_GET['id'];

$page = "update";

include "db.php";


$quer= mysqli_query($con,"delete from resort_types where id=$id");
include "alert-delete.php"; 
//header("location:project-listing.php");
header( "refresh:1; url=project-listing.php" );
?>