<?php
    include "db.php";
    session_start();
    session_destroy();
	mysqli_close($con);
    header("location:login.php");
?>