<?php
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Youtube Inner Page";

	if (isset($_POST['update']))
	{	
		$page 	 = "Update";
		$title 	 = mysqli_real_escape_string($con, $_POST['title']);
		$url  	 = mysqli_real_escape_string($con, $_POST['url']);
		$imageUrl = $_POST['image'];
		$myFile = $_FILES['myFile']['name'];

		$path="uploads/pageimages/youtube/";
		$path_original="uploads/pageimages/youtube/";
		
		if(!$imageUrl)
		{	
			if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
			{
				$FileExists = true;
			   $_SESSION['BannerColor'] = "background-color:#FF0000;";
			   $_SESSION['Message'] = "Selected image already exists!";
			   echo "<script>window.location.href='add-youtube.php';</script>";
			   exit;
			}
			else
			{	
				move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
				$path = $path_original.$myFile;
				
				mysqli_query($con, "INSERT INTO youtube_video (title, youtube_url, local_path) VALUES ('$title', '$url', '$path') ");
	        	
				$_SESSION['BannerColor'] = "background-color:#4BB543;";
		      $_SESSION['Message'] = "Added Successfully!";
		      echo "<script>window.location.href='add-youtube.php';</script>";
		     	exit;
			}
		}
		else
		{	
			mysqli_query($con, "INSERT INTO youtube_video (title, youtube_url, image) VALUES ('$title', '$url', '$imageUrl') ");
			
			$_SESSION['BannerColor'] = "background-color:#4BB543;";
	      $_SESSION['Message'] = "Added Successfully!";
	      echo "<script>window.location.href='add-youtube.php';</script>";
	     	exit;
		}
	}
?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<form action="" enctype="multipart/form-data" method="post" id="youtubeInnerForm">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Add YouTube Video</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>YouTube</span><span class="crumb-sep">&gt;</span><span>Add Video</span>
								</div>
							</div>
							<div class="listing-cta">
								<a href="youtube-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<input type="submit" class="btn btn-success btn-sm" name="update" id="btnn" value="Save" form="youtubeInnerForm">
							</div>
						</div>

						<?php if (!empty($_SESSION['Message'])) {
		            	echo "<div class='alert' id='mydiv' style='" . $_SESSION['BannerColor'] . "'>"
		                     . "<p style='color:white;'>" . htmlspecialchars($_SESSION['Message']) . "</p>"
		                     . "</div>";

		            	unset($_SESSION['Message']);
		            	unset($_SESSION['BannerColor']);
		            } ?>
						<div class="row">
							<div class="col-lg-4 col-md-12">
								<div class="card mb-30">
									<div class="card-header">Video Details</div>
									<div class="card-body">
										<div class="commonSection">
											<label>Video Title</label>
											<input class="form-control" type="text" name="title" required id="title" placeholder="Enter title">
										</div>
										<div class="commonSection">
											<label>YouTube URL</label>
											<input class="form-control" type="text" name="url" required id="url" placeholder="Enter YouTube URL">
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-8 col-md-12">
								<div class="row">
									<div class="col-lg-6 col-md-12">
										<div class="card mb-30">
											<div class="card-header">Thumbnail Image <span class="required">*</span></div>
											<div class="card-body">
												<div class="banner-image-upload">
													<img src="images/default-profile.png" class="banner-image-preview" id="imgPreview" alt="Video Thumbnail" onerror="this.src='images/default-profile.png';">
													<div class="banner-recommended-size">Recommended size: 1280x720px</div>
													<div class="radio-inline-group" style="margin-top: 12px;">
														<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();" checked="">Image URL</label>
														<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();">Select New Image</label>
													</div>

													<div id="image_url" style="margin-top: 12px;">
														<input class="form-control banner-form-control" type="text" name="image" id="image" placeholder="Enter image URL">
													</div>
													
													<div id="select_image" style="display: none; margin-top: 12px;">
														<input type="file" name="myFile" id="myFile" style="display: none;" accept="image/*">
														<div class="banner-upload-actions">
															<button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile').click();"><i class="feather icon-upload"></i> Change Image</button>
															<button type="button" class="btn btn-sm btn-danger" onclick="reset();">Reset Image</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-md-12">
										<div class="card mb-30">
											<div class="card-header">Media Rules</div>
											<div class="card-body">
												<p class="text-danger">* Note for Image Type: select only one option. Both empty and both filled are not valid.</p>
												<div class="commonSection">
													<label>Upload Guidance</label>
													<p class="mb-0">Use either a hosted thumbnail URL or upload one local image file.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once('common/footer.php'); ?>

<script>
	$(document).ready(function() {		
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

	function reset()
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

	function show1()
	{
		document.getElementById('select_image').style.display = 'none';	
		document.getElementById('image_url').style.display = 'block';
	}

	function show2()
	{
		document.getElementById('select_image').style.display = 'block';	
		document.getElementById('image_url').style.display = 'none';
	}
</script>