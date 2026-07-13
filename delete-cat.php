<?php

error_reporting(0);

$id = $_GET['id'];



include "db.php";


$quer= mysqli_query($con,"delete from resort_category where id=$id");

header("location:add-resort-category.php");

?>