<?php
	$e=$_REQUEST['user'];
	$p=$_REQUEST['pass'];

	if(!empty($_POST["remember"]))
	{
		setcookie ("username",$e,time()+ 3600);
		setcookie ("password",$p,time()+ 3600);
		//echo "Cookies Set Successfuly";
	}
	else
	{
		setcookie("username","");
		setcookie("password","");
		//echo "Cookies Not Set";
	}

	include "db.php";
	date_default_timezone_set("Asia/Calcutta");
	
	$qu = mysqli_query($con,"SELECT * FROM login WHERE user='$e'");
	if(mysqli_num_rows($qu))
	{
		$h = mysqli_fetch_assoc($qu);
		if($h['password'] && password_verify($p, $h['password']))
	    {
			session_start();
			$_SESSION['u']= $e ;
			$_SESSION['loggedin'] = true;

			$query2= mysqli_query($con,"select * from profile_info");
			$d=mysqli_fetch_assoc($query2);

			$CurrentDate = date('Y-m-d H:i:s');
			$Datetime1 = new DateTime($d['lastlogin']);
			$Datetime2 = new DateTime($CurrentDate);
			$Difference = $Datetime1->diff($Datetime2);
			$LoginBefore = '';

			$Days = ($Difference->d > 0) ? $Difference->d.' '.(($Difference->d > 1) ? 'Days ' : 'Day ') : '';
			$Hours = ($Days != '') ? (($Difference->h > 0) ? $Difference->h.' '.(($Difference->h > 1) ? 'Hours ' : 'Hour ') : '0 Hour ') : (($Difference->h > 0) ? $Difference->h.' '.(($Difference->h > 1) ? 'Hours ' : 'Hour ') : '');
			$Minute = ($Difference->i > 0) ? $Difference->i.' '.(($Difference->i > 1) ? 'Minutes' : 'Minute') : '';

			$LoginBefore = $Days.$Hours.$Minute;

			if($Days!='' || $Hours!='' || $Minute!='')
			{
				$_SESSION['lastlogin'] = $LoginBefore.' ago ('.date('d-m-Y h:i A', strtotime($d['lastlogin'])).')';
			}
			else
			{
				$_SESSION['lastlogin'] = date('Y-m-d h:i A', strtotime($d['lastlogin']));
			}

			mysqli_query($con,"UPDATE profile_info SET lastlogin='$CurrentDate' where id=".$d['id']);

			//$GLOBALS['id'] = $y['id'];
			//echo $GLOBALS['id'];
			//echo $_SESSION['user'];
			header("location:index.php");
		}
		else
		{?>
			<script>
				alert("Please enter right username and password");
				window.location="login.php";
			</script>
		<?php }
	}
	else
	{?>
		<script>
			alert("User not found.");
			window.location="login.php";
		</script>
<?php } ?>