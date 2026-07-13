<?php

error_reporting(0);

$id = $_GET['id'];

$page = "update";

include "db.php";


$quer= mysqli_query($con,"delete from youtube_video where id=$id");
include "alert-delete.php"; 
//header("location:youtube-list-page.php");
header( "refresh:1; url=youtube-list-page.php" );
?>