<?php
session_start();

if (isset($_SESSION['u']))
{
	echo $_SESSION['u'];
}
else
{
	echo "session variable was not set";
}


?>