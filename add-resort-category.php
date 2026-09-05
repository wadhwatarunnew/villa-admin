<?php
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Resort Category";

	$FileExists = false;
	if (isset($_POST['sub']))
	{
		$page 	   	= "Update";
		$metaTitle 	= $_POST['metaTitle'];
		$keyword 	= $_POST['keyword'];
		$disc 		= $_POST['disc'];	
		$order 		= $_POST['order'];
		$title 		= mysqli_real_escape_string($con, $_POST['title']);
		$ShortDesc  = mysqli_real_escape_string($con, $_POST['short_description']);
		$editor1 	= mysqli_real_escape_string($con, $_POST['editor1']);
		$color 		= $_POST['color'];
		$imageUrl 	= $_POST['image'];
		$myFile 		= $_FILES['myFile']['name'];

		$path="uploads/pageimages/resort/category/";
		$path_original="uploads/pageimages/resort/category/";

		if(!$imageUrl)
		{
			if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
			{
				$FileExists = true;
		   	$_SESSION['BannerColor'] = "background-color:#FF0000;";
		   	$_SESSION['Message'] = "Selected image already exists!";
		   	echo "<script>window.location.href='add-resort-category.php';</script>";
			   exit;
			}
			else
			{
				move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
				$path = $path_original.$myFile;
				
				mysqli_query($con, "INSERT INTO resort_category (metatitle, keyword, discription, title, order_no, short_desc, content, local_path, color) VALUES ('$metaTitle', '$keyword', '$disc', '$title', '$order', '$ShortDesc', '$editor1', '$path', '$color')");
	        	$_SESSION['BannerColor'] = "background-color:#4BB543;";
	      	$_SESSION['Message'] = "Added Successfully!";
	      	echo "<script>window.location.href='add-resort-category.php';</script>";
		     	exit;
			}
		}
		else
		{	
			mysqli_query($con, "INSERT INTO resort_category (metatitle, keyword, discription, title, order_no, short_desc, content, image, color) VALUES ('$metaTitle', '$keyword', '$disc', '$title', '$order', '$ShortDesc', '$editor1', '$imageUrl', '$color')");
			$_SESSION['BannerColor'] = "background-color:#4BB543;";
      	$_SESSION['Message'] = "Added Successfully!";
      	echo "<script>window.location.href='add-resort-category.php';</script>";
	     	exit;
		}
	}
?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<form action="" enctype="multipart/form-data" method="post" id="resortCategoryForm">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Add Tent Category</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Resort Category</span><span class="crumb-sep">&gt;</span><span>Add New</span>
								</div>
							</div>

							<div class="listing-cta">
								<a href="resort-category-listing.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<input type="submit" class="btn btn-success btn-sm" id="btnn" name="sub" value="Save Category" form="resortCategoryForm">
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
									<div class="card-header">Seo Meta Tags</div>
									<div class="card-body">
										<div class="commonSection">
											<label>Meta Title</label>
											<textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Meta Title"></textarea>
										</div>

										<div class="commonSection">
											<label>Meta Keyword</label>
											<textarea name="keyword" id="metaKeyword" class="form-control" required placeholder="Enter Keyword"></textarea>
										</div>

										<div class="commonSection">
											<label>Meta Description</label>
											<textarea name="disc" id="metaDescription" class="form-control" required placeholder="Enter Description"></textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-8 col-md-12">
								<div class="row">
									<div class="col-lg-6 col-md-12">
										<div class="card mb-30">
											<div class="card-header">Banner Image <span class="required">*</span></div>
											<div class="card-body">
												<div class="banner-image-upload">
													<img src="images/default-profile.png" class="banner-image-preview" id="imgPreview" alt="Banner Image" onerror="this.src='images/default-profile.png';">
													<div class="banner-recommended-size">Recommended size: 1920x800px</div>
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
															<button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile').click();">
																<i class="feather icon-upload"></i> Change Image
															</button>
															<button type="button" class="btn btn-sm btn-danger" onclick="rese();">Reset Image</button>
														</div>
													</div>
												</div>
											</div>
										
											<div class="col-sm-12" id="select_image" style="display: none;">
										    	<div class="commonSection">
	    											<label>Select Image</label>
													<input type="file" name="myFile" id="myFile" class="form-control"><br>
													<button type="button" class="btn btn-sm btn-danger" onclick="rese();">Reset Image</button><br>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-md-12">
										<div class="card mb-30">
											<div class="card-header">Resort Category Content</div>
											<div class="card-body">
												<div class="row">
													<div class="col-sm-8">
														<div class="commonSection">
															<label>Title</label>
															<input class="form-control" type="text" required name="title" id="title" placeholder="Enter Heading">
														</div>
													</div>

													<div class="col-sm-4">
														<div class="commonSection">
															<label>Order No.</label>
															<input class="form-control" type="number" name="order" id="order" placeholder="Page Order no">
														</div>
													</div>

													<div class="commonSection">
														<label>Short Description</label>
														<textarea class="form-control" name="short_description" id="short_description" rows="3" placeholder="Enter short description"></textarea>
													</div>

													<div class="col-sm-12">
														<div class="commonSection">
															<label>Content</label>
															<textarea name="editor1" id="editor1" rows="10" cols="80" required></textarea>
															<script>
																CKEDITOR.editorConfig = function (config) {
																	config.language = 'es';
																	config.uiColor = '#F7B42C';
																	config.height = 300;
																	config.toolbarCanCollapse = true;
																};
																CKEDITOR.replace('editor1');
															</script>
														</div>
													</div>

													<div class="col-sm-12" style="display: none;">
														<div class="commonSection">
															<label>Color</label>
															<input class="form-control" type="text" name="color" id="color">
															<input type="color" id="colorPicker" style="width: 20%; margin-top: 10px;">
														</div>
													</div>
												</div>
												<input type="hidden" name="sub" value="1">
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
    $('#colorPicker').on('input', function() {
        var selectedColor = $(this).val();
        $('#color').val(selectedColor);
    });

	CKEDITOR.editorConfig = function (config) {
		config.language = 'es';
		config.uiColor = '#F7B42C';
		config.height = 300;
		config.toolbarCanCollapse = true;
		
	};
	CKEDITOR.replace('editor1');

	// document.getElementById("btnn").disabled = true;				
	$(document).ready(function() {
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
		};
	});

	function show2()
	{
		document.getElementById('select_image').style.display = 'block';	
		document.getElementById('image_url').style.display = 'none';
	}

	function show1()
	{
		document.getElementById('select_image').style.display = 'none';	
		document.getElementById('image_url').style.display = 'block';
	}

	function rese()
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
