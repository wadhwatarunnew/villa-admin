<?php
error_reporting(0);
$id = isset($_GET['id']) ? $_GET['id'] : 0;
include "db.php";
include "alert-delete.php";
header("refresh:1; url=founders-list-page.php");
?>
