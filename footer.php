<?php
	include "db.php";
	$PageTitle = "Villatent: Footer";
	include_once('common/header.php');

	$queryl= mysqli_query($con, "SELECT * FROM footer_quick_links");
	$f=mysqli_fetch_assoc($queryl);

	$queryj= mysqli_query($con, "SELECT * FROM footer_resort_tents");
	$j=mysqli_fetch_assoc($queryj);

	if (isset($_POST['save']))
	{	
		$toptitle = mysqli_real_escape_string($con, $_POST['toptitle']);
		$editor1 = mysqli_real_escape_string($con, $_POST['editor1']);
		$title   = mysqli_real_escape_string($con, $_POST['title']);
		$address = mysqli_real_escape_string($con, $_POST['address']);
		$mobile  = mysqli_real_escape_string($con, $_POST['mobile']);
		$email   = mysqli_real_escape_string($con, $_POST['email']);
		
		mysqli_query($con, "UPDATE footer_about_us SET title='$toptitle',content='$editor1' ");
		mysqli_query($con, "UPDATE footer_get_in_touch SET title='$title', address='$address', mobile='$mobile', email='$email'");
		
		$_SESSION['BannerColor'] = "background-color:#4BB543;";
	  	$_SESSION['Message'] = "Updated Successfully!";
	  	echo "<script>window.location.href='footer.php';</script>";
	  	exit;
	};
?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<form action ="" method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="listing-page-head">
									<div class="listing-title-wrap">
										<h1>Footer Settings</h1>
										<div class="listing-breadcrumb">
											<span>Home</span><span class="crumb-sep">&gt;</span><span>Footer</span>
										</div>
									</div>

									<div class="listing-cta">
				                     	<button type="submit" class="btn btn-success btn-sm" name="save"><i class="feather icon-save"></i> Save Banner</button>
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
							<div class="col-sm-6">
								<?php
									$query = mysqli_query($con,"SELECT * FROM footer_about_us");
									$a = mysqli_fetch_assoc($query);
								?>
								
								<div class="card mb-30">
									<div class="card-header">About us</div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="commonSection">
													<label>Title</label>
													<input class="form-control" type="text" name="toptitle" id="toptitle" value="<?php echo $a['title']; ?>" placeholder="Enter Heading">
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Content</label>
													<textarea name="editor1" id="editor1" rows="10" cols="80"><?php echo $a['content']; ?></textarea>
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						
							<div class="col-sm-6">
								<?php
									$query3 = mysqli_query($con,"SELECT * FROM footer_get_in_touch");
									$d = mysqli_fetch_assoc($query3);
								?>
								<div class="card mb-30">
									<div class="card-header">Get In Touch</div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="commonSection">
													<label>Title</label>
													<input class="form-control" type="text" name="title" id="title" value="<?php echo $d['title']; ?>" placeholder="Enter Heading">
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Address </label> 
													<textarea class="form-control" name="address" placeholder="Address"><?php echo $d['address']; ?></textarea>
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Phone No </label> 
													<input class="form-control" type="text" name="mobile" id="mobile" value="<?php echo $d['mobile']; ?>" placeholder="Enter Phone No">
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Email </label> 
													<input class="form-control" type="text" name="email" id="email" value="<?php echo $d['email']; ?>" placeholder="Enter Email">
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
    </div>
</div>
<?php include_once('common/footer.php'); ?>

<script>
	CKEDITOR.editorConfig = function (config) {
		config.language = 'es';
		config.uiColor = '#F7B42C';
		config.height = 300;
		config.toolbarCanCollapse = true;
		
	};
	CKEDITOR.replace('editor1');
</script>