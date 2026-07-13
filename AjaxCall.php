<?php
   ini_set('display_errors', '1');
   ini_set('display_startup_errors', '1');
   error_reporting(E_ALL);

   include "db.php";
   session_start();  

   if (isset($_GET['Action']) && $_GET['Action'] == "GetDashboardInfo")   
   {
      $TotalProjects = $BlogsCount = $YoutubeVideosCount = 0;
      $FinalResponse = array();
      
      $ResortTentsResult = mysqli_query($con, "SELECT category, COUNT(*) AS TotalCount FROM `resort_types` GROUP BY category");
      if(mysqli_num_rows($ResortTentsResult) > 0)
      {
         $i = 0;
         while($ResortTentsRow = mysqli_fetch_object($ResortTentsResult))
         {
            $Category = str_replace(" ", "_", $ResortTentsRow->category);
            $FinalResponse['Resorts'][$Category] = $ResortTentsRow->TotalCount;
            $i++;
         }
      }

      $ProjectsResult = mysqli_query($con, "SELECT category, COUNT(*) AS TotalCount FROM `project_types` GROUP BY category");
      if(mysqli_num_rows($ProjectsResult) > 0)
      {
         $i = 0;
         while($ProjectRow = mysqli_fetch_object($ProjectsResult))
         {
            $Category = str_replace(" ", "_", $ProjectRow->category);
            $FinalResponse['Projects'][$Category] = $ProjectRow->TotalCount;
            $TotalProjects += $ProjectRow->TotalCount;
            $i++;
         }
      }
      $FinalResponse['Projects']['Total'] = $TotalProjects;

      $BlogsResult = mysqli_query($con, "SELECT COUNT(*) AS TotalCount FROM blog_inner_content");
      $BlogsCount = mysqli_fetch_object($BlogsResult)->TotalCount;

      $YoutubeResult = mysqli_query($con, "SELECT COUNT(*) AS TotalCount FROM youtube_video");
      $YoutubeVideosCount = mysqli_fetch_object($YoutubeResult)->TotalCount;

      $FinalResponse['BlogsCount'] = $BlogsCount;
      $FinalResponse['YoutubeVideosCount'] = $YoutubeVideosCount;
        
      //echo "<pre>"; print_r($FinalResponse);
      echo json_encode($FinalResponse);
	  exit;
   }
?>