<?php 
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Youtube Page";

	$query2 = mysqli_query($con, "SELECT * FROM youtube_seo_meta_data");
	$d = mysqli_fetch_assoc($query2);	

	$query3 = mysqli_query($con, "SELECT * FROM youtube_content");
	$e = mysqli_fetch_assoc($query3);	

	if (isset($_POST['update']))
	{	
		$page = "Update";
		$title = $_POST['title'];
		$editor1 = $_POST['editor1'];
		$imageUrl = $_POST['image'];
		$myFile=$_FILES['myFile']['name'];

		$path="uploads/pageimages/youtube/";
		$path_original="uploads/pageimages/youtube/";

		if($metaTitle != '' && $keyword != '' && $disc != '')
		{
			mysqli_query($con,"UPDATE youtube_seo_meta_data SET title='$metaTitle',keyword='$keyword',discription='$disc' ");
		}

		if(!$imageUrl)
		{
			if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
			{
				$FileExists = true;
			   $_SESSION['BannerColor'] = "background-color:#FF0000;";
			   $_SESSION['Message'] = "Selected image already exists!";
			   echo "<script>window.location.href='youtube-page.php';</script>";
			   exit;
			}
			else
			{
				move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
				$path=$path_original.$myFile;
				
				mysqli_query($con, "UPDATE youtube_content SET title='$title', content='$editor1', image='', local_path='$path'");
				$_SESSION['BannerColor'] = "background-color:#4BB543;";
		      	$_SESSION['Message'] = "Updated Successfully!";
		      	echo "<script>window.location.href='youtube-page.php';</script>";
		     	exit;
			}
		}
		else
		{
			mysqli_query($con, "UPDATE youtube_content SET title='$title', content='$editor1', image='$imageUrl'");
			$_SESSION['BannerColor'] = "background-color:#4BB543;";
		   	$_SESSION['Message'] = "Updated Successfully!";
		   	echo "<script>window.location.href='youtube-page.php';</script>";
		 	exit;
		}
	}
?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
			        <form action ="" enctype="multipart/form-data" method="post">
			        	<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Youtube Page</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Youtube</span><span class="crumb-sep">&gt;</span><span>Edit Content</span>
								</div>
							</div>
							<div class="listing-cta">
								<a href="youtube-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<?php if(!$e['local_path']) { ?>
									<input type="submit" class="btn btn-success btn-sm" id="btnn" name="update" value="Save">
								<?php } else { ?>
									<input type="submit" class="btn btn-success btn-sm" id="btnn1" name="update1" value="Save">
								<?php } ?>
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
							<div class="col-sm-12">
								<div class="card mb-30">
									<div class="card-header">Seo Meta Tags</div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-4">
												<div class="commonSection">
													<label>Meta Title</label>
													<textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Meta Title"><?php echo $d['title']; ?></textarea>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="commonSection">
													<label>Meta Keyword</label>
													<textarea name="keyword" id="metaTitle" class="form-control" required placeholder="Enter Keyword"><?php echo $d['keyword']; ?></textarea>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="commonSection">
													<label>Meta Description</label>
													<textarea name="disc" id="metaTitle" class="form-control" required placeholder="Enter Description"><?php echo $d['discription']; ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row ">
							<div class="col-sm-12">
								<div class="card mb-30">
									<div class="card-header">Manage Youtube Content Section
										<p class="float-end" style="color:red">* Note for Image Type - Please select only one from options. Both empty and both full are not valid.</p>
									</div>

									<div class="card-body">
										<div class="row">
											<?php if(!$e['local_path']) { ?>
												<div class="col-sm-12">
													<div class="commonSection">
														<label>Title</label>
														<input class="form-control" type="text" name="title" required id="title" value="<?php echo $e['title']; ?>" placeholder="Enter Heading">
													</div>
												</div>

												<div class="col-sm-12">
													<div class="commonSection">
														<label>Content</label>
														<textarea name="editor1" id="editor1" rows="10" cols="80" required><?php echo $e['content']; ?></textarea>
														<script type="text/javascript">
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
											<?php  } else { ?>
												<div class="col-sm-12">
													<div class="commonSection">
														<label>Title</label>
														<input class="form-control" type="text" name="title1" id="title1" required value="<?php echo $e['title']; ?>" placeholder="Enter Heading">
													</div>
												</div>

												<div class="col-sm-12">
													<div class="commonSection">
														<label>Content</label>
														<textarea name="editor2" id="editor2" rows="10" cols="80" required><?php echo $e['content']; ?></textarea>
													</div>
												</div>
											<?php } ?>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Image Type</label>
													<?php if(!$e['local_path']) { ?>
														<div class="radio-inline-group" style="display: inline-block !important;">
													    	<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();"  checked="">Image URL</label>
													    	<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" >Select Image</label>
														</div>
													<?php } else { ?>
														<div class="radio-inline-group" style="display: inline-block !important;">
														   <label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show3();"  >Image URL</label>
														   <label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show4();"  checked="">Select Image</label>
														</div>
													<?php } ?>
												</div>
											</div>
											
											<?php if(!$e['local_path']) { ?>
												<div class="col-sm-12" id="image_url">
													<div class="commonSection">
														<label>Image URL</label>
														<input class="form-control" type="text" name="image" id="image" value="<?php echo $e['image']; ?>" placeholder="Enter url">
													</div>
												</div>
										
												<div class="row" id="select_image1">
													<div class="col-sm-6">
														<div class="commonSection"> 
															<label>Image</label>
															<img src="<?php echo $e['local_path']; ?>" class="img-thumbnail" id="imgPreview" >
														</div>
													</div>

													<div class="col-sm-6">
														<div class="commonSection">
															<label>Select Image</label>
															<input type="file" name="myFile" id="myFile" class="form-control"><br>
															<button type="button" class="btn btn-sm btn-danger" onclick="res();">Reset Image</button>
														</div>
													</div>
												</div>
											<?php	} else { ?>
												<div class="col-sm-12" id="image_url1">
													<div class="commonSection">
														<label>Image URL</label>
														<input class="form-control" type="text" name="image1" id="image1" value="<?php echo $e['image']; ?>" placeholder="Enter url">
													</div>
												</div>
												
												<div class="row" id="select_image">
													<div class="col-sm-6">
														<div class="commonSection"> 
															<label>Image</label>
															<img src="<?php echo $e['local_path']; ?>" class="img-thumbnail" id="imgPreview" >
														</div>
													</div>

													<div class="col-sm-6">
														<div class="commonSection">
															<label>Select Image</label>
															<input type="file" name="myFile1" id="myFile1" class="form-control"><br>
															<button type="button" class="btn btn-sm btn-danger" onclick="res1();">Reset Image</button>
														</div>
													</div>
												</div>
											<?php  }  ?>
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

<script type="text/javascript">
	CKEDITOR.editorConfig = function (config) {
		config.language = 'es';
		config.uiColor = '#F7B42C';
		config.height = 300;
		config.toolbarCanCollapse = true;
		
	};
	CKEDITOR.replace('editor2');

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
		
	$(document).ready(function() {
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
	});

	document.getElementById('select_image1').style.display = 'none';
	function show1()
	{
		document.getElementById('select_image1').style.display = 'none';	
		document.getElementById('image_url').style.display = 'inline-block';
	}

	function show2()
	{	
		document.getElementById('image_url').style.display = 'none';
		document.getElementById('select_image1').style.display = 'inline-block';
	}

	document.getElementById('image_url1').style.display = 'none';
	function show3()
	{	
		document.getElementById('image_url1').style.display = 'inline-block';
		document.getElementById('select_image').style.display = 'none';
	}

	function show4()
	{
		document.getElementById('select_image').style.display = 'inline-block';	
		document.getElementById('image_url1').style.display = 'none';
	}

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