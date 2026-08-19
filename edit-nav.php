<?php
	error_reporting(0);
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Navigation Bar";
	
	$id=$_GET['id'];
	$query33 = mysqli_query($con,"SELECT * FROM add_nav WHERE id=$id");						
	$b3 = mysqli_fetch_assoc($query33);	

	if (isset($_POST['update']))
	{
		$page = "Update";	
		$name = $_POST['name'];
		$link = $_POST['link'];
		$position = $_POST['position'];
		$metaTitle = $_POST['metaTitle'];
		$keyword = $_POST['keyword'];
		$disc = $_POST['disc'];
		$title = $_POST['title'];
		$editor1 = $_POST['editor1'];
		$imageUrl = $_POST['image'];
		$myFile = $_FILES['myFile']['name'];
		$BannerImagePath = $_POST['banner_image'];
		$path = "uploads/pageimages/nav/";
		$path_original = "uploads/pageimages/nav/";

		if ($_FILES['myFile']['name'] != '')
		{
			if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
			{
				$FileExists = true;
	         $_SESSION['BannerColor'] = "background-color:#FF0000;";
	         $_SESSION['Message'] = "Selected image already exists!";
	         echo "<script>window.location.href='edit-nav.php?id=$id';</script>";
	         exit;
			}
			else
			{
				if(isset($_FILES['myFile']['name']) && $_FILES['myFile']['name'] != '')
				{
					move_uploaded_file($_FILES['myFile']['tmp_name'], $path.$myFile) ;
					$BannerImagePath = $path_original.$myFile;
				}


				mysqli_query($con,"UPDATE add_nav SET title='$title', name='$name', link='$link', position='$position', content='$editor1', image='', local_path='$BannerImagePath', metatitle='$metaTitle', keyword='$keyword', discription='$disc' WHERE id=$id");

		      $_SESSION['BannerColor'] = "background-color:#4BB543;";
		      $_SESSION['Message'] = "Updated Successfully!";
		      echo "<script>window.location.href='edit-nav.php?id=$id';</script>";
		      exit;
			}
		}
		else
		{
			mysqli_query($con,"UPDATE add_nav SET title='$title', name='$name', link='$link', position='$position', content='$editor1', image='$imageUrl', local_path='', metatitle='$metaTitle', keyword='$keyword', discription='$disc' WHERE id=$id");
	    	
	    	$_SESSION['BannerColor'] = "background-color:#4BB543;";
        	$_SESSION['Message'] = "Updated Successfully!";
        	echo "<script>window.location.href='edit-nav.php?id=$id';</script>";
        	exit;
		};
	};
?>

<!---->
<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<form action ="" enctype="multipart/form-data" method="post">
						<div class="row">
                     <div class="col-sm-12">
                        <div class="listing-page-head">
                           <div class="listing-title-wrap">
                              <h1>Update Navigation</h1>
                              <div class="listing-breadcrumb">
                                 <span>General Settings</span><span class="crumb-sep">&gt;</span>Edit Navigation
                              </div>
                           </div>

                           <div class="listing-cta">
                           	<a href="nav-listing.php" class="btn btn-sm btn-primary">Back</a>
                              <button type="submit" class="btn btn-success btn-sm" name="update"><i class="feather icon-save"></i> Save</button>
                           </div>
                        </div>
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
							<div class="col-sm-4">
								<div class="commonSection">
									Name : <input class="form-control" type="text" name="name" id="name" value="<?php echo $b3['name']; ?>"  placeholder="">
								</div>
							</div>

							<div class="col-sm-4">
								<div class="commonSection">
									Link : <input class="form-control" type="text" name="link" id="link" value="<?php echo $b3['link']; ?>" placeholder="" readonly>
								</div>
							</div>

							<div class="col-sm-4">
								Position: 
								<select class="form-control" name="position">
									<option value="<?php echo $b3['position']; ?>"><?php echo $b3['position']; ?></option>
									<option value="header">Header</option>
									<option value="footer">Footer</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-4">
								<div class="card mb-30">
									<div class="card-header">Seo Meta Tags</div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="commonSection">
													<label>Meta Title</label>
													<textarea name="metaTitle" id="metaTitle" class="form-control" required   placeholder="Enter Meta Title"><?php echo $b3['metatitle']; ?></textarea>
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Meta Keyword</label>
													<textarea name="keyword" id="metaTitle" class="form-control" required placeholder="Enter Keyword"><?php echo $b3['keyword']; ?></textarea>
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Meta Description</label>
													<textarea name="disc" id="metaTitle" class="form-control" required placeholder="Enter Description"><?php echo $b3['discription']; ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="card">
                           <div class="card-body">
                              <div class="form-group">
                                 <label class="banner-form-label">Banner Image <span class="required">*</span></label>
                                 <div class="banner-image-upload">
                                 	<?php
                                 		$imagePath = $b3['local_path'];
                                 		if($b3['image'] != '')
                                 		{
                                 			$imagePath = $b3['image'];
                                 		}
                                 	?>

                                    <img src="<?php echo $imagePath; ?>" class="banner-image-preview" id="imgPreview" alt="Banner Image">

                                    <div class="banner-recommended-size">Recommended size: 1920x800px</div>
                                    <div class="radio-inline-group">
                                       <label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();" onclick="show1();" <?php echo ($b3['image'] != '') ? 'checked' : ''; ?>>Image URL</label>
										   		<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" onclick="show2();" <?php echo ($b3['local_path'] != '') ? 'checked' : ''; ?>>Select New Image</label>
                                    </div>

                                    <div id="image_url" style="margin-top: 12px;display: <?php echo ($b3['image'] != '') ? 'block' : 'none'; ?>;">
                                       <input class="form-control banner-form-control" type="text" name="image" id="image" placeholder="Enter image URL" value="<?php echo $b3['image']; ?>">
                                    </div>

                                    <div id="select_image" style="display: none; margin-top: 12px;display: <?php echo ($b3['local_path'] != '') ? 'block' : 'none'; ?>;">
                                    	<input type="hidden" name="banner_image" value="<?php echo $b3['local_path']; ?>">
                                       <input type="file" name="myFile" id="myFile" style="display: none;" accept="image/*">
                                       <div class="banner-upload-actions">
                                          <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile').click();">
                                             <i class="feather icon-upload"></i> Change Image
                                          </button>
                                          <button type="button" class="btn btn-sm btn-danger" onclick="reset();">Reset Image</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

							<div class="col-sm-4">
								<div class="card mb-30">
									<div class="card-header">Manage Page Content</div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="commonSection">
													<label>Title</label>
													<input class="form-control" type="text" value="<?php echo $b3['title']; ?>" required name="title" id="title" placeholder="Enter Heading">
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Content</label>
													<textarea name="editor1" id="editor1"  rows="10" cols="80" required><?php echo $b3['content']; ?></textarea>
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
<!---->

<?php include_once('common/footer.php'); ?>

<script>		 
	$(document).ready(function() {
		$('#mydiv').delay(3000).hide(0);

		var fileInput = document.getElementById('myFile');
		var filePreview = document.getElementById('imgPreview');
		if (!fileInput || !filePreview) {
			return;
		}

		fileInput.addEventListener('change', function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					filePreview.src = e.target.result;
				};
				reader.readAsDataURL(this.files[0]);
			}
		});
	});

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
		};
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
		};
	});

	function show2()
	{
		document.getElementById('image_url').style.display = 'none';
		document.getElementById('select_image').style.display = 'block';
	}

	function show1()
	{
		document.getElementById('select_image').style.display = 'none';
		document.getElementById('image_url').style.display = 'block';
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
</script>