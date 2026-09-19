<?php
	error_reporting(1);
	include "db.php";
	// include_once('common/header.php');
	// $PageTitle = "Villatent: Projects";
	
	$id = $_GET['id'];
	$CurrentDateTime = Date("Y-m-d H:i:s");
	$query3 = mysqli_query($con, "SELECT * FROM resort_types");
	if(mysqli_num_rows($query3))
	{
		while($b = mysqli_fetch_assoc($query3))
		{
			$ProjectID = $b['id'];
			$CheckIfExists = mysqli_query($con, "SELECT * FROM tent_details WHERE tent_id='$ProjectID' AND category='Quick Info'");
			if(mysqli_num_rows($CheckIfExists) > 0)
			{
				echo "Matched === ".$b['title']."<br>";
			}
			else
			{
				echo "Not Matched === ".$b['title']."<br>";
				mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, icon, created_at) VALUES ('$ProjectID', 'Quick Info', 'Size', 'square_foot', '$CurrentDateTime')");
				mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, icon, created_at) VALUES ('$ProjectID', 'Quick Info', 'Capacity', 'group', '$CurrentDateTime')");
				mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, icon, created_at) VALUES ('$ProjectID', 'Quick Info', 'Bedroom', 'bed', '$CurrentDateTime')");
				mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, icon, created_at) VALUES ('$ProjectID', 'Quick Info', 'Bathroom', 'bathtub', '$CurrentDateTime')");
			}
		}

	}
?>