<?php

error_reporting(0);

$id = $_GET['id'];

$page = "update";

include "db.php";


$quer= mysqli_query($con,"delete from blog_inner_content where id=$id");
include "alert-delete.php"; 
//header("location:blog-list-page.php");
header( "refresh:1; url=blog-list-page.php" );
?>