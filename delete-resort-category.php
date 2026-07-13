<?php

error_reporting(0);

$id = $_GET['id'];

$page = "update";

include "db.php";


$quer= mysqli_query($con,"delete from resort_category where id=$id");
include "alert-delete.php"; 
//header("location:resort-category-listing.php");
header( "refresh:1; url=resort-category-listing.php" );
?>