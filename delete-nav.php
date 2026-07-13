<?php

error_reporting(0);

$id = $_GET['id'];

$link_path = $_GET['link'];

$page = "update";

include "db.php";


$quer= mysqli_query($con,"delete from add_nav where id=$id");

unlink("../$link_path");

include "alert-delete.php"; 
//header("location:contact-us-list.php");
header( "refresh:1; url=nav-listing.php" );
?>