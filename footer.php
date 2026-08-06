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
		$toptitle = $_POST['toptitle'];
		$editor1 = $_POST['editor1'];
		
		mysqli_query($con, "UPDATE footer_about_us SET title='$toptitle',content='$editor1' ");
		
		$_SESSION['BannerColor'] = "background-color:#4BB543;";
	  	$_SESSION['Message'] = "Updated Successfully!";
	  	echo "<script>window.location.href='footer.php';</script>";
	  	exit;
	};

	if (isset($_POST['save1']))
	{
		$title = $_POST['title'];
		$name  = $_POST['name'];
		$link  = $_POST['link'];
		$name1 = $_POST['name1'];
		$link1 = $_POST['link1'];
		$name2 = $_POST['name2'];
		$link2 = $_POST['link2'];
		$name3 = $_POST['name3'];
		$link3 = $_POST['link3'];
		$name4 = $_POST['name4'];
		$link4 = $_POST['link4'];
		$name5 = $_POST['name5'];
		$link5 = $_POST['link5'];
		$name6 = $_POST['name6'];
		$link6 = $_POST['link6'];
		
		mysqli_query($con, "UPDATE footer_quick_links SET title='$title', name_one='$name', link_one='$link', name_two='$name1', link_two='$link1', name_three='$name2', link_three='$link2', name_four='$name3', link_four='$link3', name_five='$name4', link_five='$link4', name_six='$name5', link_six='$link5', name_seven='$name6', link_seven='$link6'");
		
		$_SESSION['BannerColor'] = "background-color:#4BB543;";
	  	$_SESSION['Message'] = "Updated Successfully!";
	  	echo "<script>window.location.href='footer.php';</script>";
	  	exit;
	};

	if (isset($_POST['save2']))
	{
		$title = $_POST['title'];
		$name  = $_POST['name'];
		$link  = $_POST['link'];
		$name1 = $_POST['name1'];
		$link1 = $_POST['link1'];
		$name2 = $_POST['name2'];
		$link2 = $_POST['link2'];
		$name3 = $_POST['name3'];
		$link3 = $_POST['link3'];
		$name4 = $_POST['name4'];
		$link4 = $_POST['link4'];
		$name5 = $_POST['name5'];
		$link5 = $_POST['link5'];
		$name6 = $_POST['name6'];
		$link6 = $_POST['link6'];
		
		mysqli_query($con, "UPDATE footer_resort_tents SET title='$title', name_one='$name', link_one='$link', name_two='$name1', link_two='$link1', name_three='$name2', link_three='$link2', name_four='$name3', link_four='$link3', name_five='$name4', link_five='$link4', name_six='$name5', link_six='$link5', name_seven='$name6', link_seven='$link6' ");
		
		$_SESSION['BannerColor'] = "background-color:#4BB543;";
	  	$_SESSION['Message'] = "Updated Successfully!";
	  	echo "<script>window.location.href='footer.php';</script>";
	  	exit;
	};

	if (isset($_POST['save3']))
	{	
		$title   = $_POST['title'];
		$address = $_POST['address'];
		$mobile  = $_POST['mobile'];
		$email   = $_POST['email'];
		
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
					<div class="row">
						<div class="col-sm-12">
							<div class="listing-page-head">
								<div class="listing-title-wrap">
									<h1>Footer Settings</h1>
									<div class="listing-breadcrumb">
										<span>Home</span><span class="crumb-sep">&gt;</span><span>Footer</span>
									</div>
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
							
							<form action ="" method="post">
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
										<input type="submit" class="btn btn-success btn-lg" name="save" value="Save">
									</div>
								</div>
							</form>
						</div>
					
						<div class="col-sm-6">
							<?php
								$query3= mysqli_query($con,"SELECT * FROM footer_get_in_touch");
								$d=mysqli_fetch_assoc($query3);
							?>
							<form action ="" method="post">
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

										<input type="submit" class="btn btn-success btn-lg" name="save3" value="Save">
									</div>
								</div>
							</form>
						</div>
					
						<div class="col-sm-6">
							<?php
								$query1 = mysqli_query($con,"SELECT * FROM footer_quick_links");
								$b = mysqli_fetch_assoc($query1);
							?>
							<form action ="" method="post">
								<div class="card mb-30">
									<div class="card-header">Quick Links </div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="commonSection">
													<label>Title</label>
													<input class="form-control" type="text" name="title" id="title" value="<?php echo $b['title']; ?>" placeholder="Enter Heading">
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Quick Links </label> 
													Name : <input class="form-control" type="text" name="name" id="name" value="<?php echo $b['name_one']; ?>" placeholder="Enter Quick Links"><br>
													Link : <input class="form-control" type="text" name="link" id="link" value="<?php echo $b['link_one']; ?>" placeholder="Enter Quick Links"><br>
													Name : <input class="form-control" type="text" name="name1" id="name1" value="<?php echo $b['name_two']; ?>" placeholder="Enter Quick Links"><br>
													link : <input class="form-control" type="text" name="link1" id="link1" value="<?php echo $b['link_two']; ?>" placeholder="Enter Quick Links"><br>
													Name : <input class="form-control" type="text" name="name2" id="name2" value="<?php echo $b['name_three']; ?>" placeholder="Enter Quick Links"><br>
													Link : <input class="form-control" type="text" name="link2" id="link2" value="<?php echo $b['link_three']; ?>" placeholder="Enter Quick Links"><br>
													Name : <input class="form-control" type="text" name="name3" id="name3" value="<?php echo $b['name_four']; ?>" placeholder="Enter Quick Links"><br>
													Link : <input class="form-control" type="text" name="link3" id="link3" value="<?php echo $b['link_four']; ?>" placeholder="Enter Quick Links"><br>
													
													<?php if($f['name_five']) { ?>
														<div class="">
															Name : <input class="form-control" type="text" name="name4" id="name4" value="<?php echo $b['name_five']; ?>" placeholder="Enter Quick Links"><br>
															Link : <input class="form-control" type="text" name="link4" id="link4" value="<?php echo $b['link_five']; ?>" placeholder="Enter Quick Links"><br>
														</div>
													<?php } else { ?>
														<div class="focu1">
															Name : <input class="form-control" type="text" name="name4" id="name4" value="<?php echo $b['name_five']; ?>" placeholder="Enter Quick Links"><br>
															Link : <input class="form-control" type="text" name="link4" id="link4" value="<?php echo $b['link_five']; ?>" placeholder="Enter Quick Links"><br>
														</div>
													<?php } ?>
													
													<?php if($f['name_six']) { ?>
														<div class="">
															Name : <input class="form-control" type="text" name="name5" id="name5" value="<?php echo $b['name_six']; ?>" placeholder="Enter Quick Links"><br>
															Link : <input class="form-control" type="text" name="link5" id="link5" value="<?php echo $b['link_six']; ?>" placeholder="Enter Quick Links"><br>
														</div>
													<?php } else { ?>
														<div class="focu1">
															Name : <input class="form-control" type="text" name="name5" id="name5" value="<?php echo $b['name_six']; ?>" placeholder="Enter Quick Links"><br>
															Link : <input class="form-control" type="text" name="link5" id="link5" value="<?php echo $b['link_six']; ?>" placeholder="Enter Quick Links"><br>
														</div>
													<?php  }  ?>
													
													<?php if($f['name_seven']) { ?>
														<div class="">
															Name : <input class="form-control" type="text" name="name6" id="name6" value="<?php echo $b['name_seven']; ?>" placeholder="Enter Quick Links"><br>
															Link : <input class="form-control" type="text" name="link6" id="link6" value="<?php echo $b['link_seven']; ?>" placeholder="Enter Quick Links"><br>
														</div>
													<?php } else { ?>
														<div class="focu1">
															Name : <input class="form-control" type="text" name="name6" id="name6" value="<?php echo $b['name_seven']; ?>" placeholder="Enter Quick Links"><br>
															Link : <input class="form-control" type="text" name="link6" id="link6" value="<?php echo $b['link_seven']; ?>" placeholder="Enter Quick Links"><br>
														</div>
													<?php } ?>
												</div>
											</div>
											<br>
										</div>
										
										<input type="button" id="btnnn" class="btn btn-sm btn-primary" value="Add"><br><br>
										<input type="submit" class="btn btn-success btn-lg" name="save1" value="Save">
									</div>
								</div>
							</form>
						</div>
				
						<div class="col-sm-6">
							<?php
								$query2 = mysqli_query($con,"SELECT * FROM footer_resort_tents");
								$c = mysqli_fetch_assoc($query2);
							?>
							<form action ="" method="post">
								<div class="card mb-30">
									<div class="card-header">Resort Tents</div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="commonSection">
													<label>Title</label>
													<input class="form-control" type="text" name="title" id="title" value="<?php echo $c['title']; ?>" placeholder="Enter Heading">
												</div>
											</div>

											<div class="col-sm-12">
												<div class="commonSection">
													<label>Resort Tents Listing </label> 
													Name : <input class="form-control" type="text" name="name" id="name" value="<?php echo $c['name_one']; ?>" placeholder="Enter tents Listing"><br>
													Link : <input class="form-control" type="text" name="link" id="link" value="<?php echo $c['link_one']; ?>" placeholder="Enter tents Listing"><br>
													Name : <input class="form-control" type="text" name="name1" id="name1" value="<?php echo $c['name_two']; ?>" placeholder="Enter tents Listing"><br>
													Link : <input class="form-control" type="text" name="link1" id="link1" value="<?php echo $c['link_two']; ?>" placeholder="Enter tents Listing"><br>
													Name : <input class="form-control" type="text" name="name2" id="name2" value="<?php echo $c['name_three']; ?>" placeholder="Enter tents Listing"><br>
													Link : <input class="form-control" type="text" name="link2" id="link2" value="<?php echo $c['link_three']; ?>" placeholder="Enter tents Listing"><br>
													Name : <input class="form-control" type="text" name="name3" id="name3" value="<?php echo $c['name_four']; ?>" placeholder="Enter tents Listing"><br>
													Link : <input class="form-control" type="text" name="link3" id="link3" value="<?php echo $c['link_four']; ?>" placeholder="Enter tents Listing"><br>
													
													<?php if($c['name_five']) { ?>
														<div class="">
															Name : <input class="form-control" type="text" name="name4" id="name4" value="<?php echo $c['name_five']; ?>" placeholder="Enter tents Listing"><br>
															Link : <input class="form-control" type="text" name="link4" id="link4" value="<?php echo $c['link_five']; ?>" placeholder="Enter tents Listing"><br>
														</div>
													<?php } else { ?>
														<div class="focu2">
															Name : <input class="form-control" type="text" name="name4" id="name4" value="<?php echo $c['name_five']; ?>" placeholder="Enter tents Listing"><br>
															Link : <input class="form-control" type="text" name="link4" id="link4" value="<?php echo $c['link_five']; ?>" placeholder="Enter tents Listing"><br>
														</div>
													<?php } ?>
													
													<?php if($c['name_six']) { ?>
														<div class="">
															Name : <input class="form-control" type="text" name="name5" id="name5" value="<?php echo $c['name_six']; ?>" placeholder="Enter tents Listing"><br>
															Link : <input class="form-control" type="text" name="link5" id="link5" value="<?php echo $c['link_six']; ?>" placeholder="Enter tents Listing"><br>
														</div>
													<?php } else { ?>
														<div class="focu2">
															Name : <input class="form-control" type="text" name="name5" id="name5" value="<?php echo $c['name_six']; ?>" placeholder="Enter tents Listing"><br>
															Link : <input class="form-control" type="text" name="link5" id="link5" value="<?php echo $c['link_six']; ?>" placeholder="Enter tents Listing"><br>
														</div>
													<?php } ?>
													
													<?php if($c['name_seven']) { ?>
														<div class="">
															Name : <input class="form-control" type="text" name="name6" id="name6" value="<?php echo $c['name_seven']; ?>" placeholder="Enter tents Listing"><br>
															Link : <input class="form-control" type="text" name="link6" id="link6" value="<?php echo $c['link_seven']; ?>" placeholder="Enter tents Listing"><br>
														</div>
													<?php } else { ?>
														<div class="focu2">
															Name : <input class="form-control" type="text" name="name6" id="name6" value="<?php echo $c['name_seven']; ?>" placeholder="Enter tents Listing"><br>
															Link : <input class="form-control" type="text" name="link6" id="link6" value="<?php echo $c['link_seven']; ?>" placeholder="Enter tents Listing"><br>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>

										<input type="button" id="btnnn1" class="btn btn-sm btn-primary" value="Add"><br><br>
										<input type="submit" class="btn btn-success btn-lg" name="save2" value="Save">
									</div>
								</div>
							</form>
							
							<script>
								$('.focu2').hide();
								var count2 = 0;
								$('#btnnn1').on('click',function(){
									$('.focu2:eq('+count2+')').show();
									count2++;
									
									if(count2==3){
										
										$('#btnnn1').hide();
									};
									
								});
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