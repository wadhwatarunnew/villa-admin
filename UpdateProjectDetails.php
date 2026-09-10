<?php
	error_reporting(1);
	include "db.php";
	// include_once('common/header.php');
	// $PageTitle = "Villatent: Projects";
	
	$id = $_GET['id'];
	$CurrentDateTime = Date("Y-m-d H:i:s");
	$query3 = mysqli_query($con, "SELECT * FROM project_types");
	if(mysqli_num_rows($query3))
	{
		while($b = mysqli_fetch_assoc($query3))
		{
			$ProjectID = $b['id'];
			$CheckIfExists = mysqli_query($con, "SELECT * FROM project_details WHERE project_id='$ProjectID'");
			if(mysqli_num_rows($CheckIfExists) > 0)
			{
				echo "Matched === ".$b['title']."<br>";
			}
			else
			{
				echo "Not Matched === ".$b['title']."<br>";
				mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, created_at) VALUES ('$ProjectID', 'Project Info', 'Client', '', 'business', '$CurrentDateTime')");
				mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, created_at) VALUES ('$ProjectID', 'Project Info', 'Location', '', 'location_on', '$CurrentDateTime')");
				mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, created_at) VALUES ('$ProjectID', 'Project Info', 'Year of Completion', '', 'calendar_month', '$CurrentDateTime')");
				mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, created_at) VALUES ('$ProjectID', 'Project Info', 'Tent Category', '', 'holiday_village', '$CurrentDateTime')");
				mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, created_at) VALUES ('$ProjectID', 'Project Info', 'Tent Design', '', 'architecture', '$CurrentDateTime')");
				mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, created_at) VALUES ('$ProjectID', 'Project Info', 'Scope of Work', '', 'construction', '$CurrentDateTime')");
			}
		}

	}
?>