<?php
include "db.php";
session_start();

$query2 = mysqli_query($con, "select * from profile_info");
$d = mysqli_fetch_assoc($query2);

$query222 = mysqli_query($con, "select * from login");
$d2 = mysqli_fetch_assoc($query222);

if (isset($_FILES) && !empty($_FILES)) {
	$path = "uploads/profile/";
	$path_original = "uploads/profile/" . $_FILES['file']['name'];
	$response = array();

	if (move_uploaded_file($_FILES['file']['tmp_name'], $path_original)) {
		if ($d['image'] != '' && file_exists($path . $d['image'])) {
			unlink($path . $d['image']);
		}

		mysqli_query($con, "UPDATE profile_info SET image='" . $_FILES['file']['name'] . "' where id=" . $d['id']);
		$d['image'] = $_FILES['file']['name'];

		$response['status'] = true;
		$response['message'] = "Image uploaded successfully.";
		$response['image'] = $path_original;
	} else {
		$response['status'] = false;
		$response['message'] = "Sorry, image not uploaded, please try again!";
		$response['image'] = "";
	}
	echo json_encode($response);
	die;
}

if (isset($_POST['upuser'])) {
	$username = $_POST['username'];
	mysqli_query($con, "UPDATE login SET user='$username' ");
	header("location:index.php");
}

if (isset($_POST['update'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$dob = $_POST['dob'];
	$email = $_POST['email'];

	mysqli_query($con, "UPDATE profile_info SET fname='$fname',lname='$lname',dob='$dob',email='$email' ");
	header("location:index.php");
}

if (isset($_POST['update1'])) {
	$opwd = $_POST['opwd'];
	$npwd = $_POST['npwd'];
	$cpwd = $_POST['cpwd'];

	$qu = mysqli_query($con, "SELECT * FROM login");
	$h = mysqli_fetch_assoc($qu);
	if ($h['password'] && password_verify($opwd, $h['password'])) {
		$hashed_password = password_hash($cpwd, PASSWORD_BCRYPT);
		mysqli_query($con, "UPDATE login SET password='$hashed_password'");
		header("location:index.php");
	} else {
		?>
		<script>
			alert("Wrong Old Password");
		</script>
		<?php
	}
}
?>

<?php $PageTitle = "Villatent: Profile"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="listing-page-head">
						<div class="listing-title-wrap">
							<h1>Profile Settings</h1>
							<div class="listing-breadcrumb">
								<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Settings</span><span class="crumb-sep">&gt;</span><span>Profile</span>
							</div>
						</div>
						<div class="listing-cta">
							<a href="index.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
						</div>
					</div>

					<div class="card mb-30">
						<div class="card-header">Profile Information</div>
						<div class="card-body">
							<form action="" method="post" id="profileInfoForm">
								<div class="row">
									<div class="col-lg-4 col-md-12">
										<div id="message"></div>
										<div class="profileImage">
											<img src="<?php echo ($d['image'] != '') ? 'uploads/profile/' . $d['image'] : 'images/profileimage.jpg'; ?>" alt="Profile" title="Profile" id="profileImage">
										</div>
										<div class="counter-help-text" style="margin-bottom:12px;">
											Last login: <?php echo $_SESSION['lastlogin']; ?>
										</div>
										<input type="file" id="myfile" name="upload" style="display:none;" accept="image/*">
										<button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myfile').click();">
											<i class="feather icon-upload"></i> Change Photo
										</button>
									</div>
									<div class="col-lg-8 col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="commonSection">
													<label>First Name</label>
													<input type="text" class="form-control" name="fname" value="<?php echo $d['fname']; ?>" placeholder="First name">
												</div>
											</div>
											<div class="col-md-6">
												<div class="commonSection">
													<label>Last Name</label>
													<input type="text" class="form-control" name="lname" value="<?php echo $d['lname']; ?>" placeholder="Last name">
												</div>
											</div>
											<div class="col-md-6">
												<div class="commonSection">
													<label>Date of Birth</label>
													<input type="date" class="form-control" name="dob" value="<?php echo $d['dob']; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="commonSection">
													<label>Email</label>
													<input type="email" class="form-control" name="email" value="<?php echo $d['email']; ?>" placeholder="abc@example.com">
												</div>
											</div>
											<div class="col-md-12">
												<div class="listing-cta" style="justify-content:flex-end;">
													<input type="submit" class="btn btn-success btn-sm" name="update" value="Save Profile">
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6 col-md-12">
							<div class="card mb-30">
								<div class="card-header">Change Username</div>
								<div class="card-body">
									<form action="" method="post" id="usernameForm">
										<div class="commonSection">
											<label>Current Username</label>
											<input type="text" class="form-control" value="<?php echo $d2['user']; ?>" readonly>
										</div>
										<div class="commonSection">
											<label>New Username</label>
											<input type="text" class="form-control" name="username" required placeholder="Enter new username">
										</div>
										<div class="listing-cta" style="justify-content:flex-end;">
											<input type="submit" class="btn btn-success btn-sm" name="upuser" value="Update Username">
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-12">
							<div class="card mb-30">
								<div class="card-header">Change Password</div>
								<div class="card-body">
									<form action="" method="post" id="passwordForm">
										<div class="commonSection">
											<label>Old Password</label>
											<input type="password" class="form-control" name="opwd" placeholder="Old password">
										</div>
										<div class="commonSection">
											<label>New Password</label>
											<input type="password" class="form-control" id="start" name="npwd" placeholder="New password">
										</div>
										<div class="commonSection">
											<label>Confirm Password</label>
											<input type="password" class="form-control" id="end" name="cpwd" placeholder="Confirm password">
											<div id="d" class="counter-help-text" style="margin-top:6px;color:#dc3545;"></div>
										</div>
										<div class="listing-cta" style="justify-content:flex-end;">
											<input type="submit" id="Button" class="btn btn-success btn-sm" name="update1" value="Update Password">
										</div>
									</form>
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
	document.getElementById('Button').disabled = true;
	$('#end').on('keyup', function() {
		var v = $('#start').val();
		var e = $('#end').val();
		if (v !== '' && v === e) {
			document.getElementById('d').innerHTML = 'Password matched';
			document.getElementById('d').style.color = 'green';
			document.getElementById('Button').disabled = false;
		} else {
			document.getElementById('d').innerHTML = 'Passwords do not match';
			document.getElementById('d').style.color = '#dc3545';
			document.getElementById('Button').disabled = true;
		}
	});
</script>

<script>
	$(document).ready(function() {
		$('#myfile').change(function() {
			var file_data = $('#myfile').prop('files')[0];
			var form_data = new FormData();
			form_data.append('file', file_data);
			$.ajax({
				url: 'profile.php',
				type: 'POST',
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				success: function(data) {
					var result = JSON.parse(data);
					var $messageDiv = $('#message');
					$messageDiv.hide().removeClass('alert alert-success alert-danger').html(result.message);
					if (result.status) {
						$('#profileImage').attr('src', result.image);
						$messageDiv.show();
						$messageDiv.addClass('alert alert-success').fadeIn(1500);
					} else {
						$messageDiv.show();
						$messageDiv.addClass('alert alert-danger').fadeIn(1500);
					}

					setTimeout(function() {
						$messageDiv.fadeOut(1500);
					}, 3000);
				}
			});
		});
	});
</script>
