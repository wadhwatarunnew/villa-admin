<?php
	error_reporting(0);
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Get Quote Page";

	$seoRow = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM get_quote_seo ORDER BY id ASC LIMIT 1"));
	$contentRow = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM get_quote_content ORDER BY id ASC LIMIT 1"));

	if (isset($_POST['update_content']))
	{
		$page = "Update";
		$metaTitle = $_POST['metaTitle'];
		$keyword = $_POST['keyword'];
		$disc = $_POST['disc'];
		$logo_url = $_POST['logo_url'];
		$main_heading = $_POST['main_heading'];
		$description = $_POST['description'];
		$help_title = $_POST['help_title'];
		$help_phone = $_POST['help_phone'];
		$email_title = $_POST['email_title'];
		$email_address = $_POST['email_address'];
		$hours_title = $_POST['hours_title'];
		$hours_text = $_POST['hours_text'];
		$location_title = $_POST['location_title'];
		$location_text = $_POST['location_text'];
		$contentId = (int)$contentRow['id'];

		if($metaTitle != '' && $keyword != '' && $disc != '')
	   {
	    	$CurrentDateTime = Date("Y-m-d H:i:s");
	      mysqli_query($con, "UPDATE get_quote_seo SET title='$metaTitle', keyword='$keyword', discription='$disc', updated_at='$CurrentDateTime'");
	   }

		mysqli_query($con, "UPDATE get_quote_content SET logo_url='$logo_url', main_heading='$main_heading', description='$description', help_title='$help_title', help_phone='$help_phone', email_title='$email_title', email_address='$email_address', hours_title='$hours_title', hours_text='$hours_text', location_title='$location_title', location_text='$location_text' WHERE id=$contentId");

		$_SESSION['BannerColor'] = "background-color:#4BB543;";
      $_SESSION['Message'] = "Updated Successfully!";
      echo "<script>window.location.href='get-quote-page.php';</script>";
      exit;
	}
?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<form action="" method="post" id="getQuoteContentForm">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Get Quote Page</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Pages</span><span class="crumb-sep">&gt;</span><span>Get Quote</span>
								</div>
							</div>
							<div class="listing-cta">
								<a href="dashboard.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<input type="submit" class="btn btn-success btn-sm" name="update_content" value="Save" form="getQuoteContentForm">
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
											<textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Meta Title"><?php echo $seoRow['title']; ?></textarea>
										</div>

										<div class="commonSection">
											<label>Meta Keyword</label>
											<textarea name="keyword" id="metaKeyword" class="form-control" required placeholder="Enter Meta Keyword"><?php echo $seoRow['keyword']; ?></textarea>
										</div>
										<div class="commonSection">
											<label>Meta Description</label>
											<textarea name="disc" id="metaDescription" class="form-control" required placeholder="Enter Meta Description"><?php echo $seoRow['discription']; ?></textarea>
										</div>
									</div>
								</div>

								<div class="card mb-30">
									<div class="card-header">Logo Image</div>
									<div class="card-body">
										<div class="commonSection mb-0">
											<label>Logo Image URL</label>
											<input type="text" class="form-control" name="logo_url" id="logo_url" value="<?php echo $contentRow['logo_url']; ?>" placeholder="images/logo.svg" form="getQuoteContentForm">
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-8 col-md-12">
								<div class="card mb-30">
									<div class="card-header">Get Quote Content</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-12">
												<div class="commonSection">
													<label>Main Heading</label>
													<input type="text" class="form-control" name="main_heading" id="main_heading" value="<?php echo $contentRow['main_heading']; ?>" placeholder="Why Choose The Villa Tent?" required>
												</div>
											</div>

											<div class="col-md-12">
												<div class="commonSection">
													<label>Description</label>
													<textarea class="form-control" name="description" id="description" rows="4" placeholder="Enter section description" required><?php echo $contentRow['description']; ?></textarea>
												</div>
											</div>

											<div class="col-md-6">
												<div class="commonSection">
													<label>Need Help Title</label>
													<input type="text" class="form-control" name="help_title" value="<?php echo $contentRow['help_title']; ?>" placeholder="Need Help?">
												</div>
											</div>

											<div class="col-md-6">
												<div class="commonSection">
													<label>Phone Number</label>
													<input type="text" class="form-control" name="help_phone" value="<?php echo $contentRow['help_phone']; ?>" placeholder="+91 98136 27021">
												</div>
											</div>

											<div class="col-md-6">
												<div class="commonSection">
													<label>Email Title</label>
													<input type="text" class="form-control" name="email_title" value="<?php echo $contentRow['email_title']; ?>" placeholder="Email Us">
												</div>
											</div>

											<div class="col-md-6">
												<div class="commonSection">
													<label>Email Address</label>
													<input type="text" class="form-control" name="email_address" value="<?php echo $contentRow['email_address']; ?>" placeholder="info@thevillatent.com">
												</div>
											</div>

											<div class="col-md-6">
												<div class="commonSection">
													<label>Working Hours Title</label>
													<input type="text" class="form-control" name="hours_title" value="<?php echo $contentRow['hours_title']; ?>" placeholder="Working Hours">
												</div>
											</div>

											<div class="col-md-6">
												<div class="commonSection">
													<label>Working Hours Text</label>
													<input type="text" class="form-control" name="hours_text" value="<?php echo $contentRow['hours_text']; ?>" placeholder="Mon - Sat: 10 AM - 7 PM">
												</div>
											</div>

											<div class="col-md-12">
												<div class="commonSection">
													<label>Location Title</label>
													<input type="text" class="form-control" name="location_title" value="<?php echo $contentRow['location_title']; ?>" placeholder="Our Location">
												</div>
											</div>

											<div class="col-md-12">
												<div class="commonSection mb-0">
													<label>Location Text</label>
													<textarea class="form-control" name="location_text" rows="4" placeholder="Enter location text"><?php echo $contentRow['location_text']; ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="update_content" value="1">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once('common/footer.php'); ?>
