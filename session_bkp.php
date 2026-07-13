<?php


$e=$_REQUEST['user'];
$p=$_REQUEST['pass'];


if(!empty($_POST["remember"])) {
	setcookie ("username",$e,time()+ 3600);
	setcookie ("password",$p,time()+ 3600);
	//echo "Cookies Set Successfuly";
} else {
	setcookie("username","");
	setcookie("password","");
	//echo "Cookies Not Set";
}


include "db.php";

if($y=mysqli_fetch_assoc(mysqli_query($con,"select * from login where user='$e' and password='$p'"))){
	
session_start();
$_SESSION['u']= $e ;

//$GLOBALS['id'] = $y['id'];
//echo $GLOBALS['id'];
//echo $_SESSION['user'];
header("location:index.php");

}else{?>
<script>


alert("Please enter right username and password");
window.location="login.php";
</script>



<?php

}


?>