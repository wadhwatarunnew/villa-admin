 <?php
 error_reporting(0);
 if (isset($_POST['j'])){
 	
 	$page = "Update";
 	
 	$types = $_POST['types'];
 	
 	$id = $_POST['id'];
 	
 	$p1 = $_POST['p1'];
 	$p2 = $_POST['p2'];
 	$p3 = $_POST['p3'];
 	$p4 = $_POST['p4'];
 	$p5 = $_POST['p5'];
 	$p6 = $_POST['p6'];
 	$p7 = $_POST['p7'];
 	$p8 = $_POST['p8'];
 	$p9 = $_POST['p9'];
 	$p10 = $_POST['p10'];
 	
 	

 	$check1 =  $_POST['check'][0];

 	if($check1){
 		
 		include "db.php";

 		mysqli_query($con,"update add_gallery set $check1='' where id=$id ");
 		
 	}

 	$check2 =  $_POST['check'][1];

 	if($check2){
 		
 		include "db.php";

 		mysqli_query($con,"update add_gallery set $check2='' where id=$id ");
 		
 	}

 	$check3 =  $_POST['check'][2];

 	if($check3){
 		
 		include "db.php";

 		mysqli_query($con,"update add_gallery set $check3='' where id=$id ");
 		
 	}


 	$check4 =  $_POST['check'][3];

 	if($check4){
 		
 		include "db.php";

 		mysqli_query($con,"update add_gallery set $check4='' where id=$id ");
 		
 	}

 	$check5 =  $_POST['check'][4];

 	if($check5){
 		
 		include "db.php";

 		mysqli_query($con,"update add_gallery set $check5='' where id=$id ");
 		
 	}

 	$check6 =  $_POST['check'][5];

 	if($check6){
 		
 		include "db.php";

 		mysqli_query($con,"update add_gallery set $check6='' where id=$id ");
 		
 	}

 	$check7 =  $_POST['check'][6];

 	if($check7){
 		
 		include "db.php";

 		mysqli_query($con,"update add_gallery set $check7='' where id=$id ");
 		
 	}

 	$check8 =  $_POST['check'][7];

 	if($check8){
 		
 		include "db.php";

 		mysqli_query($con,"update add_gallery set $check8='' where id=$id ");
 		
 	}

 	$check9 =  $_POST['check'][8];

 	if($check9){
 		
 		include "db.php";

 		mysqli_query($con,"update add_gallery set $check9='' where id=$id ");
 		
 	}

 	$check10 =  $_POST['check'][9];

 	if($check10){
 		
 		include "db.php";

 		mysqli_query($con,"update add_gallery set $check10='' where id=$id ");
 		
 	}

 	
 	header( "refresh:2; url=delete-gallery.php" );
	//header("location:delete-gallery.php");

 }


 ?>

 <?php $PageTitle = "Villatent: Gallery"; ?>
 <?php include_once('common/header.php'); ?>
 <div class="pcoded-content">
 	<div class="pcoded-inner-content">
 		<div class="main-body">
 			<div class="page-wrapper">
				<div class="page-body">
					<div class="listing-page-head">
						<div class="listing-title-wrap">
							<h1>Delete Gallery</h1>
							<div class="listing-breadcrumb">
								<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Gallery</span><span class="crumb-sep">&gt;</span><span>Delete</span>
							</div>
						</div>
						<div class="listing-cta">
							<a href="add-gallery.php" class="btn btn-outline-primary btn-sm"><i class="feather icon-plus"></i> Add</a>
							<a href="update-gallery.php" class="btn btn-outline-secondary btn-sm"><i class="feather icon-edit"></i> Update</a>
						</div>
					</div>

					<?php include "alert-delete.php" ?>

					<div class="card mb-30">
						<div class="card-header">Select Gallery To Delete</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-md-12">
									<div class="commonSection">
										<label>Gallery Type <span class="required">*</span></label>
										<select name="state" class="form-control country input" required>
											<option value="">--Select--</option>
											<option value="Resort Tents">Resort Tents</option>
											<option value="Projects">Projects</option>
										</select>
									</div>

									<div id="response"></div>
								</div>
							</div>
						</div>
					</div>

					<div id="response1"></div>
				</div>
 			</div>
 		</div>
 	</div>
 </div>

<script>
	$(document).ready(function(){
		$("select.country").change(function(){
			var selectedCountry = $(".country option:selected").val();
			$.ajax({
				type: "POST",
				url: "categoryAjaxDelete.php",
				data: { country : selectedCountry }
			}).done(function(data){
				$("#response").html(data);
			});
		});
	});
</script>

<?php include_once('common/footer.php'); ?>