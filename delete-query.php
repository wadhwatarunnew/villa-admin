<?php

error_reporting(0);

$id = $_GET['id'];

$page = "update";

include "db.php";


$quer= mysqli_query($con,"delete from contact_query where id=$id");
include "alert-delete.php"; 
//header("location:leads-list.php");
header( "refresh:1; url=leads-list.php" );
?>