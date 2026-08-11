<?php
	error_reporting(0);
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Youtube Inner Page";

	$id=$_GET['id'];
	$query3 = mysqli_query($con,"select * from youtube_video where id=$id");								
	$b = mysqli_fetch_assoc($query3);

	if (isset($_POST['update']))
	{
		$page 	 = "Update";
		$title 	 = $_POST['title'];
		$url 		 = $_POST['url'];
		$imageUrl = $_POST['image'];
		$myFile 	 = $_FILES['myFile']['name'];

		$path="uploads/pageimages/youtube/";
		$path_original="uploads/pageimages/youtube/";
		
		if(!$imageUrl)
		{
			if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
	    	{
	    	   $FileExists = true;
			   $_SESSION['BannerColor'] = "background-color:#FF0000;";
			   $_SESSION['Message'] = "Selected image already exists!";
			   echo "<script>window.location.href='edit-youtube.php?id=$id';</script>";
			   exit;
	    	}
	    	else
	    	{
	        	move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
	        	$path=$path_original.$myFile;
	        	mysqli_query($con, "UPDATE youtube_video SET title='$title', youtube_url='$url', image='', local_path='$path' WHERE id=$id");
			   $_SESSION['BannerColor'] = "background-color:#4BB543;";
			   $_SESSION['Message'] = "Updated Successfully!";
			   echo "<script>window.location.href='edit-youtube.php?id=$id';</script>";
			   exit;
	    	}
		}
		else
		{	
	    	mysqli_query($con, "UPDATE youtube_video SET title='$title', youtube_url='$url', image='$imageUrl' WHERE id=$id");
	    	$_SESSION['BannerColor'] = "background-color:#4BB543;";
		   $_SESSION['Message'] = "Updated Successfully!";
		   echo "<script>window.location.href='edit-youtube.php?id=$id';</script>";
		   exit;
		}
	}

	if (isset($_POST['update1']))
	{
		$page 	  = "Update";
		$title1 	  = $_POST['title1'];
		$url1 	  = $_POST['url1'];
		$imageUrl1 = $_POST['image1'];
		$myFile1   =$_FILES['myFile1']['name'];
		
		$path2="uploads/pageimages/youtube/";
		$path_original2="uploads/pageimages/youtube/";

		if(!$imageUrl1)
		{
	    	if($myFile1 != '' && (file_exists("uploads/pageimages/".$myFile1) || file_exists("uploads/pageimages/addgallery/".$myFile1) || file_exists("uploads/pageimages/addgallery/project/".$myFile1) || file_exists("uploads/pageimages/addgallery/resort/".$myFile1) || file_exists("uploads/pageimages/blogs/".$myFile1) || file_exists("uploads/pageimages/blogs/single/".$myFile1)  || file_exists("uploads/pageimages/contact/".$myFile1) || file_exists("uploads/pageimages/nav/".$myFile1) || file_exists("uploads/pageimages/nav/category/".$myFile1) || file_exists("uploads/pageimages/nav/types/".$myFile1) || file_exists("uploads/pageimages/project/".$myFile1) || file_exists("uploads/pageimages/project/category/".$myFile1) || file_exists("uploads/pageimages/project/types/".$myFile1) || file_exists("uploads/pageimages/resort/".$myFile1) || file_exists("uploads/pageimages/resort/category/".$myFile1) || file_exists("uploads/pageimages/resort/types/".$myFile1) || file_exists("uploads/pageimages/slider/".$myFile1) || file_exists("uploads/pageimages/youtube/".$myFile1)))
	    	{
	    	   $FileExists = true;
			   $_SESSION['BannerColor'] = "background-color:#FF0000;";
			   $_SESSION['Message'] = "Selected image already exists!";
			   echo "<script>window.location.href='edit-youtube.php?id=$id';</script>";
			   exit;
	    	}
	    	else
	    	{
	        	move_uploaded_file($_FILES['myFile1']['tmp_name'],$path2.$myFile1) ;
	        	$path1 = $path_original2.$myFile1;
	        	
	        	if(!$_FILES['myFile1']['name'])
	        	{
	        		mysqli_query($con,"UPDATE youtube_video SET title='$title1', youtube_url='$url1' WHERE id=$id");
			    	$_SESSION['BannerColor'] = "background-color:#4BB543;";
				   $_SESSION['Message'] = "Updated Successfully!";
				   echo "<script>window.location.href='edit-youtube.php?id=$id';</script>";
				   exit;
	        	}
	        	else
	        	{
	        		
	        		mysqli_query($con,"UPDATE youtube_video SET title='$title1', youtube_url='$url1', local_path='$path1' WHERE id=$id");
	        		$_SESSION['BannerColor'] = "background-color:#4BB543;";
				   $_SESSION['Message'] = "Updated Successfully!";
				   echo "<script>window.location.href='edit-youtube.php?id=$id';</script>";
				   exit;
	        	}
	    	}
		}
		else
		{	
    		mysqli_query($con,"UPDATE youtube_video SET title='$title1', youtube_url='$url1', image='$imageUrl1', local_path='' WHERE id=$id");
    		$_SESSION['BannerColor'] = "background-color:#4BB543;";
		   $_SESSION['Message'] = "Updated Successfully!";
		   echo "<script>window.location.href='edit-youtube.php?id=$id';</script>";
		   exit;
    	}
	}
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
         	<?php if (!empty($_SESSION['Message'])) {
            	echo "<div class='alert' id='mydiv' style='" . $_SESSION['BannerColor'] . "'>"
                     . "<p style='color:white;'>" . htmlspecialchars($_SESSION['Message']) . "</p>"
                     . "</div>";

            	unset($_SESSION['Message']);
            	unset($_SESSION['BannerColor']);
            } ?>
	    		<form action ="" enctype="multipart/form-data" method="post">
            	<div class="page-body">
	               <div class="row">
	                  <div class="col-sm-12">
	                     <div class="card mb-30">
	                        <div class="card-header">
	                        	<div class="col-sm-12">
		                        	<div class="listing-page-head">
												<div class="listing-title-wrap">
													<h1>Manage Videos</h1>
													<div class="listing-breadcrumb">
														<p class="float-end" style="color:red">* Note for Image Type - Please select only one from options. Both empty and both full are not valid.</p>
													</div>
												</div>

												<div class="listing-cta">
													<a href="youtube-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to Videos</a>
												</div>
											</div>
										</div>
						  			</div>

	                        <div class="card-body">
	                           <div class="row">
							 				<?php if(!$b['local_path']) { ?>
		                              <div class="col-sm-12">
		                                 <div class="commonSection">
		                                    <label>Video Title</label>
		                                    <input class="form-control" type="text" name="title" id="title" required value="<?php echo $b['title']; ?>" placeholder="Enter Heading">
		                                 </div>
                              		</div>

		                              <div class="col-sm-12">
		                                 <div class="commonSection">
		                                    <label>YouTube URL</label>
		                                    <input class="form-control" type="text" name="url" id="url" required value="<?php echo $b['youtube_url']; ?>" placeholder="Enter Heading">
		                                 </div>
		                              </div>
										  	<?php } else { ?>
										  		<div class="col-sm-12">
		                                 <div class="commonSection">
		                                    <label>Video Title</label>
		                                    <input class="form-control" type="text" name="title1" id="title1" required value="<?php echo $b['title']; ?>" placeholder="Enter Heading">
		                                 </div>
		                              </div>

		                              <div class="col-sm-12">
		                                 <div class="commonSection">
		                                    <label>YouTube URL</label>
		                                    <input class="form-control" type="text" name="url1" id="url1" required value="<?php echo $b['youtube_url']; ?>" placeholder="Enter Heading">
		                                 </div>
		                              </div>
										  	<?php }  ?>
							
                              	<div class="col-sm-12">
		                              <div class="commonSection">
		                                 <label>Image Type</label>
		                                 
		                                 <?php if(!$b['local_path']) { ?>
													  	<div class="radio-inline-group">
															<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();"  checked="">Image URL</label>
															<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" >Select New Image</label>
														</div>
										  			<?php } else { ?>
														<div class="radio-inline-group">
															<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show3();"  >Image URL</label>
															<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show4();"  checked="">Select New Image</label>
														</div>
										  			<?php  }  ?>
		                              </div>
		                           </div>

											<?php if(!$b['local_path']) { ?>
												<div class="col-sm-12" id="image_url">
		                                 <div class="commonSection">
		                                    <label>Image URL</label>
		                                    <input class="form-control" type="text" name="image" id="image" value="<?php echo $b['image']; ?>" placeholder="Enter url">
		                                 </div>
		                              </div>
									  
											  	<div class="row" id="select_image1">
													<div class="col-sm-6">
			                                 <div class="commonSection"> 
			                                    <label>Image</label>
			                                      <img src="<?php echo $b['local_path']; ?>" class="img-thumbnail" id="imgPreview" >
			                                 </div>
			                              </div>

											  		<div class="col-sm-6">
			                                 <div class="commonSection">
			                                    <label>Select Image</label>
		                                       <input type="file" name="myFile" id="myFile" class="form-control"><br>
											 				<button type="button" class="btn btn-sm btn-danger" onclick="res();">Reset Image</button>
			                                 </div>
													</div>
													
													<script>
														function res()
														{
															document.getElementById('myFile').value= "";
															var p = document.getElementById("image").value;
														
															if(p)
															{	
																document.getElementById("btnn").disabled = false;
															}
															else
															{	
																document.getElementById("btnn").disabled = true;	
															}
														}
													</script>
												</div>
											<?php	} else { ?>
												<div class="col-sm-12" id="image_url1">
		                                 <div class="commonSection">
		                                    <label>Image URL</label>
		                                    <input class="form-control" type="text" name="image1" id="image1" value="<?php echo $b['image']; ?>" placeholder="Enter url">
		                                 </div>
		                              </div>
												
												<div class="row" id="select_image">
													<div class="col-sm-6">
			                                 <div class="commonSection"> 
			                                    <label>Image</label>
			                                      <img src="<?php echo $b['local_path']; ?>" class="img-thumbnail" id="imgPreview" >
			                                 </div>
			                              </div>

										  			<div class="col-sm-6">
			                                 <div class="commonSection">
			                                    <label>Select Image</label>
		                                       <input type="file" name="myFile1" id="myFile1" class="form-control"><br>
											 				<button type="button" class="btn btn-sm btn-danger" onclick="res1();">Reset Image</button>
			                                 </div>
			                              </div>

													<script>
														function res1()
														{
															document.getElementById('myFile1').value= "";
															var p1 = document.getElementById("image1").value;

															if(p1)
															{	
																document.getElementById("btnn1").disabled = false;	
															}
															else
															{	
																document.getElementById("btnn1").disabled = true;	
															}
														}
													</script>
												</div>
											<?php  }  ?>
										</div>
                  			</div>
               			</div>

								<?php if(!$b['local_path']) { ?>
				               <div class="row">
				                  <div class="col-sm-2">
				                     <div class="commonSection">
				                        <input type="submit" class="btn btn-success btn-lg" id="btnn" name="update" value="Save">
				                     </div>
				                  </div>
				               </div> 
								<?php } else { ?>
									<div class="row">
				                  <div class="col-sm-2">
				                     <div class="commonSection">
				                        <input type="submit" class="btn btn-success btn-lg" id="btnn1" name="update1" value="Save">
				                     </div>
				                  </div>
				               </div>
								<?php } ?>
			 				</div>
			 			</div>
			 		</div>
		  		</form>
         </div>
      </div>
   </div>
</div>

<?php include_once('common/footer.php'); ?>

<script>
	$(document).ready(function() {
		var x = document.getElementById("myFile").value;
		var x1 = document.getElementById("image").value;

		if(x1 && x)
		{	
			document.getElementById("btnn").disabled = true;	
		}
		else if(!x1 && !x)
		{	
			document.getElementById("btnn").disabled = true;	
		}
		else
		{	
			document.getElementById("btnn").disabled = false;
		}
		
	
		$('#image').keyup(function() {
			var dInput = this.value;
			var x = document.getElementById("myFile").value;

			if(dInput && x)
			{	
				document.getElementById("btnn").disabled = true;	
			}
			else if(!dInput && !x)
			{	
				document.getElementById("btnn").disabled = true;	
			}
			else
			{	
				document.getElementById("btnn").disabled = false;
			}
		});
	
		document.getElementById('myFile').onchange = function () {
			var pInput = this.value;
			var y = document.getElementById("image").value;
			
			if(pInput && y)
			{	
				document.getElementById("btnn").disabled = true;	
			}
			else if(!pInput && !x)
			{	
				document.getElementById("btnn").disabled = true;	
			}
			else
			{	
				document.getElementById("btnn").disabled = false;
			}
		}
	});

	$(document).ready(function()
	{	
		var f = document.getElementById("myFile1").value;	
		var f1 = document.getElementById("image1").value;

		if(f1 && f)
		{	
			document.getElementById("btnn1").disabled = true;	
		}
		else if(!f1 && !f)
		{	
			document.getElementById("btnn1").disabled = false;	
		}
		else
		{	
			document.getElementById("btnn1").disabled = false;
		}

		$('#image1').keyup(function() {
			var dInput1 = this.value;
			var x2 = document.getElementById("myFile1").value;
			
			if(dInput1 && x2)
			{	
				document.getElementById("btnn1").disabled = true;	
			}
			else if(!dInput1 && !x2)
			{	
				document.getElementById("btnn1").disabled = true;	
			}
			else
			{	
				document.getElementById("btnn1").disabled = false;
			}
		});
		
		document.getElementById('myFile1').onchange = function () {
			var pInput1 = this.value;
			var y1 = document.getElementById("image1").value;

			if(pInput1 && y1)
			{	
				document.getElementById("btnn1").disabled = true;	
			}
			else if(!pInput1 && !y1)
			{	
				document.getElementById("btnn1").disabled = true;	
			}
			else
			{	
				document.getElementById("btnn1").disabled = false;
			}
		}
	})

	document.getElementById('select_image1').style.display = 'none';
	function show2()
	{	
		document.getElementById('image_url').style.display = 'none';
		document.getElementById('select_image1').style.display = 'block';
	}

	function show1()
	{
		document.getElementById('select_image1').style.display = 'none';
		document.getElementById('image_url').style.display = 'block';
	}

	document.getElementById('image_url1').style.display = 'none';
	function show3(){
		document.getElementById('image_url1').style.display = 'block';
		document.getElementById('select_image').style.display = 'none';
	}

	function show4(){
		document.getElementById('select_image').style.display = 'block';
		document.getElementById('image_url1').style.display = 'none';
	}							
</script>