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
		$metaTitle = $_POST['metaTitle'];
	    $keyword   = $_POST['keyword'];
	    $disc      = $_POST['disc'];
		$title = mysqli_real_escape_string($con, $_POST['title']);
		$editor1 = mysqli_real_escape_string($con, $_POST['editor1']);
		$imageUrl = $_POST['image'];
		$myFile = $_FILES['myFile']['name'];

		$path="uploads/pageimages/youtube/";
		$path_original="uploads/pageimages/youtube/";

		if($metaTitle != '' && $keyword != '' && $disc != '')
		{
			mysqli_query($con,"UPDATE youtube_seo_meta_data SET title='$metaTitle',keyword='$keyword',discription='$disc' ");
		}

		if (isset($_FILES['myFile']['name']) && $_FILES['myFile']['name'] != '')
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
			mysqli_query($con, "UPDATE youtube_content SET title='$title', content='$editor1', image='$imageUrl', local_path=''");
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
								<input type="submit" class="btn btn-success btn-sm" id="btnn" name="update" value="Save">
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
										<div class="row">
											<div class="col-sm-12">
												<div class="commonSection">
													<label>Meta Title</label>
													<textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Meta Title"><?php echo $d['title']; ?></textarea>
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Meta Keyword</label>
													<textarea name="keyword" id="metaTitle" class="form-control" required placeholder="Enter Keyword"><?php echo $d['keyword']; ?></textarea>
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Meta Description</label>
													<textarea name="disc" id="metaTitle" class="form-control" required placeholder="Enter Description"><?php echo $d['discription']; ?></textarea>
												</div>
											</div>
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
			                                       	<?php
			                                          	$middlePreviewImage = "images/default-profile.png";
			                                          	if (!empty($e['local_path'])) {
			                                             	$middlePreviewImage = $e['local_path'];
			                                          	} elseif (!empty($e['image'])) {
			                                             	$middlePreviewImage = $e['image'];
			                                          	}
			                                       	?>
			                                       	<img src="<?php echo $middlePreviewImage; ?>" class="banner-image-preview" id="imgPreview" alt="Banner Image" onerror="this.src='images/default-profile.png';">
			                                       	<div class="banner-recommended-size">Recommended size: 1920x800px</div>

			                                       	<div class="radio-inline-group" style="margin-top: 12px;">
			                                          	<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();" <?php echo ($e['image'] != '') ? 'checked' : ''; ?>>Image URL</label>
			                                          	<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" <?php echo ($e['local_path'] != '') ? 'checked' : ''; ?>>Select Image</label>
			                                       	</div>
			                                       	<div id="image_url" style="margin-top: 12px;">
			                                          	<input class="form-control banner-form-control" type="text" name="image" id="image" value="<?php echo $e['image']; ?>" placeholder="Enter image URL">
			                                       	</div>
			                                       	<div id="select_image1" style="display: none; margin-top: 12px; display: <?php echo ($e['local_path'] != '') ? 'block' : 'none'; ?>">
			                                          	<input type="hidden" name="banner_image" value="<?php echo $e['local_path']; ?>">
			                                          	<input type="file" name="myFile" id="myFile" style="display: none;" accept="image/*">
			                                          	<div class="banner-upload-actions">
			                                             	<button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile').click();">
			                                                	<i class="feather icon-upload"></i> Change Image
			                                             	</button>
			                                             	<!-- <button type="button" class="btn btn-sm btn-danger" onclick="res();">Reset Image</button> -->
			                                          	</div>
			                                       	</div>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>

				                    <div class="col-lg-6 col-md-12">
				                    	<div class="card mb-30">
											<div class="card-header">
												<div>
													<p>Manage Youtube Content Section</p>
												</div>
											</div>

											<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<div class="commonSection">
															<label>Title</label>
															<!-- <input class="form-control" type="text" name="title" required id="title" value="<?php echo $e['title']; ?>" placeholder="Enter Heading"> -->
															<textarea name="title" id="title" rows="4" cols="20"><?php echo $e['title']; ?></textarea>
					                                       	<script type="text/javascript">
					                                          	CKEDITOR.editorConfig = function (config) {
					                                             	config.language = 'es';
					                                             	config.uiColor = '#F7B42C';
					                                             	config.height = 100;
					                                             	config.toolbarCanCollapse = true;

					                                          	};
					                                          	CKEDITOR.replace('title');
					                                       	</script>
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

<script type="text/javascript">
	(function() {
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
	})();

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

   function res()
   {
      document.getElementById('myFile').value= "";
   }
</script>