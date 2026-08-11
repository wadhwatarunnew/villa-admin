<?php
error_reporting(0);

$id = $_GET['id'];
include "db.php";

$query3 = mysqli_query($con,"select * from youtube_video where id=$id");
$b = mysqli_fetch_assoc($query3);

if (isset($_POST['update'])){
	$page = "Update";
	$title = $_POST['title'];
	$url = $_POST['url'];
	$imageUrl = $_POST['image'];
	$myFile = $_FILES['myFile']['name'];

	$path = "uploads/pageimages/youtube/";
	$path_original = "uploads/pageimages/youtube/";

	if(!$imageUrl){
		if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile) || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile))) {
			$FileExists = true;
			header("refresh:2; url=edit-youtube.php?id=$id");
		} else {
			include "db.php";
			move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile);
			$path = $path_original.$myFile;
			mysqli_query($con,"update youtube_video SET title='$title',youtube_url='$url',image='',local_path='$path' where id=$id");
			header("refresh:2; url=edit-youtube.php?id=$id");
		}
	} else {
		include "db.php";
		mysqli_query($con,"update youtube_video SET title='$title',youtube_url='$url',image='$imageUrl' where id=$id");
		header("refresh:2; url=edit-youtube.php?id=$id");
	}
}

if (isset($_POST['update1'])){
	$page = "Update";
	$title1 = $_POST['title1'];
	$url1 = $_POST['url1'];
	$imageUrl1 = $_POST['image1'];
	$myFile1 = $_FILES['myFile1']['name'];

	$path2 = "uploads/pageimages/youtube/";
	$path_original2 = "uploads/pageimages/youtube/";

	if(!$imageUrl1){
		include "db.php";
		if($myFile1 != '' && (file_exists("uploads/pageimages/".$myFile1) || file_exists("uploads/pageimages/addgallery/".$myFile1) || file_exists("uploads/pageimages/addgallery/project/".$myFile1) || file_exists("uploads/pageimages/addgallery/resort/".$myFile1) || file_exists("uploads/pageimages/blogs/".$myFile1) || file_exists("uploads/pageimages/blogs/single/".$myFile1) || file_exists("uploads/pageimages/contact/".$myFile1) || file_exists("uploads/pageimages/nav/".$myFile1) || file_exists("uploads/pageimages/nav/category/".$myFile1) || file_exists("uploads/pageimages/nav/types/".$myFile1) || file_exists("uploads/pageimages/project/".$myFile1) || file_exists("uploads/pageimages/project/category/".$myFile1) || file_exists("uploads/pageimages/project/types/".$myFile1) || file_exists("uploads/pageimages/resort/".$myFile1) || file_exists("uploads/pageimages/resort/category/".$myFile1) || file_exists("uploads/pageimages/resort/types/".$myFile1) || file_exists("uploads/pageimages/slider/".$myFile1) || file_exists("uploads/pageimages/youtube/".$myFile1))) {
			$FileExists = true;
			header("refresh:2; url=edit-youtube.php?id=$id");
		} else {
			move_uploaded_file($_FILES['myFile1']['tmp_name'],$path2.$myFile1);
			$path1 = $path_original2.$myFile1;
			if(!$_FILES['myFile1']['name']){
				mysqli_query($con,"update youtube_video SET title='$title1',youtube_url='$url1' where id=$id");
				header("refresh:2; url=edit-youtube.php?id=$id");
			} else {
				mysqli_query($con,"update youtube_video SET title='$title1',youtube_url='$url1',local_path='$path1' where id=$id");
				header("refresh:2; url=edit-youtube.php?id=$id");
			}
		}
	} else {
		include "db.php";
		mysqli_query($con,"update youtube_video SET title='$title1',youtube_url='$url1',image='$imageUrl1',local_path='' where id=$id");
		header("refresh:2; url=edit-youtube.php?id=$id");
	}
}
?>

<?php $PageTitle = "Villatent: Youtube Inner Page"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="listing-page-head">
						<div class="listing-title-wrap">
							<h1>Edit YouTube Video</h1>
							<div class="listing-breadcrumb">
								<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>YouTube</span><span class="crumb-sep">&gt;</span><span>Edit</span>
							</div>
						</div>
						<div class="listing-cta">
							<a href="youtube-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
							<?php if(!$b['local_path']){ ?>
							<input type="submit" class="btn btn-success btn-sm" id="btnn" name="update" value="Save" form="editYoutubeForm">
							<?php }else{ ?>
							<input type="submit" class="btn btn-success btn-sm" id="btnn1" name="update1" value="Save" form="editYoutubeForm">
							<?php } ?>
						</div>
					</div>

					<form action="" enctype="multipart/form-data" method="post" id="editYoutubeForm">
						<div class="row">
							<div class="col-lg-4 col-md-12">
								<?php include "alert-update.php"; ?>
								<div class="card mb-30">
									<div class="card-header">Video Details</div>
									<div class="card-body">
										<?php if(!$b['local_path']){ ?>
										<div class="commonSection">
											<label>Video Title</label>
											<input class="form-control" type="text" name="title" id="title" required value="<?php echo $b['title']; ?>" placeholder="Enter title">
										</div>
										<div class="commonSection">
											<label>YouTube URL</label>
											<input class="form-control" type="text" name="url" id="url" required value="<?php echo $b['youtube_url']; ?>" placeholder="Enter YouTube URL">
										</div>
										<?php } else { ?>
										<div class="commonSection">
											<label>Video Title</label>
											<input class="form-control" type="text" name="title1" id="title1" required value="<?php echo $b['title']; ?>" placeholder="Enter title">
										</div>
										<div class="commonSection">
											<label>YouTube URL</label>
											<input class="form-control" type="text" name="url1" id="url1" required value="<?php echo $b['youtube_url']; ?>" placeholder="Enter YouTube URL">
										</div>
										<?php } ?>
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
													<?php
													$middlePreviewImage = "images/default-profile.png";
													if (!empty($b['local_path'])) {
														$middlePreviewImage = $b['local_path'];
													} elseif (!empty($b['image'])) {
														$middlePreviewImage = $b['image'];
													}
													?>
													<img src="<?php echo $middlePreviewImage; ?>" class="banner-image-preview" id="imgPreview" alt="Video Thumbnail" onerror="this.src='images/default-profile.png';">
													<div class="banner-recommended-size">Recommended size: 1280x720px</div>

													<?php if(!$b['local_path']){ ?>
													<div class="radio-inline-group" style="margin-top: 12px;">
														<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();" checked="">Image URL</label>
														<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();">Select New Image</label>
													</div>
													<div id="image_url" style="margin-top: 12px;">
														<input class="form-control banner-form-control" type="text" name="image" id="image" value="<?php echo $b['image']; ?>" placeholder="Enter image URL">
													</div>
													<div id="select_image1" style="display: none; margin-top: 12px;">
														<input type="file" name="myFile" id="myFile" style="display: none;" accept="image/*">
														<div class="banner-upload-actions">
															<button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile').click();"><i class="feather icon-upload"></i> Change Image</button>
															<button type="button" class="btn btn-sm btn-danger" onclick="res();">Reset Image</button>
														</div>
													</div>
													<?php }else{ ?>
													<div class="radio-inline-group" style="margin-top: 12px;">
														<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show3();">Image URL</label>
														<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show4();" checked="">Select New Image</label>
													</div>
													<div id="image_url1" style="display: none; margin-top: 12px;">
														<input class="form-control banner-form-control" type="text" name="image1" id="image1" value="<?php echo $b['image']; ?>" placeholder="Enter image URL">
													</div>
													<div id="select_image" style="margin-top: 12px;">
														<input type="file" name="myFile1" id="myFile1" style="display: none;" accept="image/*">
														<div class="banner-upload-actions">
															<button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile1').click();"><i class="feather icon-upload"></i> Change Image</button>
															<button type="button" class="btn btn-sm btn-danger" onclick="res1();">Reset Image</button>
														</div>
													</div>
													<?php } ?>
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

												<?php if(!$b['local_path']){ ?>
												<input type="hidden" name="update" value="1">
												<?php }else{ ?>
												<input type="hidden" name="update1" value="1">
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>

					<script>
						function res(){
							document.getElementById('myFile').value = "";
							var p = document.getElementById("image").value;
							document.getElementById("btnn").disabled = !p;
							$('#imgPreview').attr('src', p || 'images/default-profile.png');
						}

						function res1(){
							document.getElementById('myFile1').value = "";
							var p1 = document.getElementById("image1").value;
							document.getElementById("btnn1").disabled = !p1;
							$('#imgPreview').attr('src', p1 || 'images/default-profile.png');
						}
					</script>

					<script>
						$(document).ready(function() {
							if (document.getElementById("btnn")) {
								var x = document.getElementById("myFile").value;
								var x1 = document.getElementById("image").value;
								document.getElementById("btnn").disabled = (x1 && x) || (!x1 && !x);

								$('#image').on('input', function() {
									var dInput = this.value;
									$('#imgPreview').attr('src', dInput || 'images/default-profile.png');
									var fileVal = document.getElementById("myFile").value;
									document.getElementById("btnn").disabled = (dInput && fileVal) || (!dInput && !fileVal);
								});

								document.getElementById('myFile').onchange = function () {
									if (this.files && this.files[0]) {
										var reader = new FileReader();
										reader.onload = function(e) {
											$('#imgPreview').attr('src', e.target.result);
										};
										reader.readAsDataURL(this.files[0]);
									}
									var pInput = this.value;
									var y = document.getElementById("image").value;
									document.getElementById("btnn").disabled = (pInput && y) || (!pInput && !y);
								};
							}

							if (document.getElementById("btnn1")) {
								var f = document.getElementById("myFile1").value;
								var f1 = document.getElementById("image1").value;
								document.getElementById("btnn1").disabled = (f1 && f) || (!f1 && !f);

								$('#image1').on('input', function() {
									var dInput1 = this.value;
									$('#imgPreview').attr('src', dInput1 || 'images/default-profile.png');
									var x2 = document.getElementById("myFile1").value;
									document.getElementById("btnn1").disabled = (dInput1 && x2) || (!dInput1 && !x2);
								});

								document.getElementById('myFile1').onchange = function () {
									if (this.files && this.files[0]) {
										var reader1 = new FileReader();
										reader1.onload = function(e) {
											$('#imgPreview').attr('src', e.target.result);
										};
										reader1.readAsDataURL(this.files[0]);
									}
									var pInput1 = this.value;
									var y1 = document.getElementById("image1").value;
									document.getElementById("btnn1").disabled = (pInput1 && y1) || (!pInput1 && !y1);
								};
							}
						});
					</script>

					<?php if(!$b['local_path']){ ?>
					<script>
						document.getElementById('select_image1').style.display = 'none';
						function show2(){
							document.getElementById('image_url').style.display = 'none';
							document.getElementById('select_image1').style.display = 'block';
						}

						function show1(){
							document.getElementById('select_image1').style.display = 'none';
							document.getElementById('image_url').style.display = 'block';
						}
					</script>
					<?php }else{ ?>
					<script>
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
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once('common/footer.php'); ?>
