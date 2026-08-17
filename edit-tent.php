<?php
	error_reporting(0);
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Resorts";

	$id = $_GET['id'];
	$query3 = mysqli_query($con, "SELECT * FROM resort_types WHERE id=$id");
	$b = mysqli_fetch_assoc($query3);

	if (isset($_POST['update']))
	{
		$Updated = false;
		$page = "Update";
		$metaTitle = $_POST['metaTitle'];
		$keyword = $_POST['keyword'];
		$disc = $_POST['disc'];
		$title = $_POST['title'];
		$cat = $_POST['cat'];
		$order = $_POST['order'];
		$status = $_POST['status'];
		$editor1 = mysqli_real_escape_string($con, $_POST['editor1']);
		$y_url = $_POST['y_url'];
		$imageUrl = $_POST['image'];
		$myFile = $_FILES['floor_plan_image']['name'];

		$path = "uploads/pageimages/resort/types/";
		$path_original = "uploads/pageimages/resort/types/";

		if (!$imageUrl)
		{
			if ($myFile != '' && (file_exists("uploads/pageimages/" . $myFile) || file_exists("uploads/pageimages/addgallery/" . $myFile) || file_exists("uploads/pageimages/addgallery/project/" . $myFile) || file_exists("uploads/pageimages/addgallery/resort/" . $myFile) || file_exists("uploads/pageimages/blogs/" . $myFile) || file_exists("uploads/pageimages/blogs/single/" . $myFile) || file_exists("uploads/pageimages/contact/" . $myFile) || file_exists("uploads/pageimages/nav/" . $myFile) || file_exists("uploads/pageimages/nav/category/" . $myFile) || file_exists("uploads/pageimages/nav/types/" . $myFile) || file_exists("uploads/pageimages/project/" . $myFile) || file_exists("uploads/pageimages/project/category/" . $myFile) || file_exists("uploads/pageimages/project/types/" . $myFile) || file_exists("uploads/pageimages/resort/" . $myFile) || file_exists("uploads/pageimages/resort/category/" . $myFile) || file_exists("uploads/pageimages/resort/types/" . $myFile) || file_exists("uploads/pageimages/slider/" . $myFile) || file_exists("uploads/pageimages/youtube/" . $myFile)))
			{
				$FileExists = true;
		   	$_SESSION['BannerColor'] = "background-color:#FF0000;";
		   	$_SESSION['Message'] = "Selected image already exists!";
		   	echo "<script>window.location.href='edit-tent.php?id=$id';</script>";
		   	exit;
			}
			else
			{
				move_uploaded_file($_FILES['floor_plan_image']['tmp_name'], $path . $myFile);
				$path = $path_original . $myFile;

				mysqli_query($con, "UPDATE resort_types SET title='$title', content='$editor1', image='', local_path='$path', metatitle='$metaTitle', keyword='$keyword', discription='$disc', y_url='$y_url', category='$cat', order_no='$order', status='$status' WHERE id=$id");
				$Updated = true;
			}
		}
		else
		{
			mysqli_query($con, "UPDATE resort_types SET title='$title', content='$editor1', image='$imageUrl', metatitle='$metaTitle', keyword='$keyword', discription='$disc', y_url='$y_url', category='$cat', order_no='$order', status='$status' WHERE id=$id");
			$Updated = true;
		}

		if($Updated)
		{
			$CurrentDateTime = Date("Y-m-d H:i:s");
			$CurrentDateTime = Date("Y-m-d H:i:s");
	 		mysqli_query($con, "DELETE FROM tent_details WHERE tent_id=$id AND category='Quick Info'");
	 		mysqli_query($con, "DELETE FROM tent_details WHERE tent_id=$id AND category='Features'");
	 		mysqli_query($con, "DELETE FROM tent_details WHERE tent_id=$id AND category='Materials'");
	 		mysqli_query($con, "DELETE FROM tent_details WHERE tent_id=$id AND category='Specifications'");
	 		
			if (isset($_POST['quick_info']) && !empty($_POST['quick_info']))
			{
				$titles = $_POST['quick_info']['title'];
	 			$descriptions = $_POST['quick_info']['description'];

	 			foreach ($titles as $key => $specTitle)
			   {
					$title = mysqli_real_escape_string($con, $titles[$key]);
			      $description = mysqli_real_escape_string($con, $descriptions[$key]);

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, description, created_at) VALUES ('$id', 'Quick Info', '$title', '$description', '$CurrentDateTime')");
			   }
			}

			if (isset($_POST['features']) && !empty($_POST['features']))
			{
				$titles = $_POST['features']['title'];
	 			$descriptions = $_POST['features']['description'];

	 			foreach ($titles as $key => $specTitle)
			   {
					$title = mysqli_real_escape_string($con, $titles[$key]);
			      $description = mysqli_real_escape_string($con, $descriptions[$key]);

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, description, created_at) VALUES ('$id', 'Features', '$title', '$description', '$CurrentDateTime')");
			   }
			}

			if (isset($_POST['materials']) && !empty($_POST['materials']))
			{
				$titles = $_POST['materials']['title'];
	 			$descriptions = $_POST['materials']['description'];

	 			foreach ($titles as $key => $specTitle)
			   {
					$title = mysqli_real_escape_string($con, $titles[$key]);
			      $description = mysqli_real_escape_string($con, $descriptions[$key]);

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, description, created_at) VALUES ('$id', 'Materials', '$title', '$description', '$CurrentDateTime')");
			   }
			}

			if (isset($_POST['specifications']) && !empty($_POST['specifications']))
			{
			   $titles = $_POST['specifications']['title'];
			   $feet = $_POST['specifications']['feet'];
			   $meters = $_POST['specifications']['meters'];

			   foreach ($titles as $key => $specTitle)
			   {
			      $specTitle = mysqli_real_escape_string($con, $specTitle);
					$specFeet = mysqli_real_escape_string($con, $feet[$key]);
			      $specMeters = mysqli_real_escape_string($con, $meters[$key]);

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, feet, meters, created_at) VALUES ('$id', 'Specifications', '$specTitle', '$specFeet', '$specMeters', '$CurrentDateTime')");
			   }
			}

			$_SESSION['BannerColor'] = "background-color:#4BB543;";
      	$_SESSION['Message'] = "Updated Successfully!";
      	echo "<script>window.location.href='edit-tent.php?id=$id';</script>";
	     	exit;
		}
	}

	if (isset($_POST['update1']))
	{
		$Updated = false;
		$page = "Update";
		$metaTitle1 = $_POST['metaTitle1'];
		$keyword1 = $_POST['keyword1'];
		$disc1 = $_POST['disc1'];
		$title1 = $_POST['title1'];
		$cat1 = $_POST['cat1'];
		$order1 = $_POST['order1'];
		$status = $_POST['status'];
		$editor12 =  mysqli_real_escape_string($con, $_POST['editor12']);
		$y_url1 = $_POST['y_url1'];
		$imageUrl1 = $_POST['image1'];
		$myFile1 = $_FILES['floor_plan_image']['name'];

		$path2 = "uploads/pageimages/resort/types/";
		$path_original2 = "uploads/pageimages/resort/types/";

		if (!$imageUrl1)
		{
			if ($myFile1 != '' && (file_exists("uploads/pageimages/" . $myFile1) || file_exists("uploads/pageimages/addgallery/" . $myFile1) || file_exists("uploads/pageimages/addgallery/project/" . $myFile1) || file_exists("uploads/pageimages/addgallery/resort/" . $myFile1) || file_exists("uploads/pageimages/blogs/" . $myFile1) || file_exists("uploads/pageimages/blogs/single/" . $myFile1) || file_exists("uploads/pageimages/contact/" . $myFile1) || file_exists("uploads/pageimages/nav/" . $myFile1) || file_exists("uploads/pageimages/nav/category/" . $myFile1) || file_exists("uploads/pageimages/nav/types/" . $myFile1) || file_exists("uploads/pageimages/project/" . $myFile1) || file_exists("uploads/pageimages/project/category/" . $myFile1) || file_exists("uploads/pageimages/project/types/" . $myFile1) || file_exists("uploads/pageimages/resort/" . $myFile1) || file_exists("uploads/pageimages/resort/category/" . $myFile1) || file_exists("uploads/pageimages/resort/types/" . $myFile1) || file_exists("uploads/pageimages/slider/" . $myFile1) || file_exists("uploads/pageimages/youtube/" . $myFile1))) {
				$FileExists = true;
		   	$_SESSION['BannerColor'] = "background-color:#FF0000;";
		   	$_SESSION['Message'] = "Selected image already exists!";
		   	echo "<script>window.location.href='edit-tent.php?id=$id';</script>";
		   	exit;
			}
			else
			{
				move_uploaded_file($_FILES['floor_plan_image']['tmp_name'], $path2 . $myFile1);
				$path1 = $path_original2 . $myFile1;

				if (!$_FILES['floor_plan_image']['name'])
				{
					mysqli_query($con, "UPDATE resort_types SET title='$title1', content='$editor12', metatitle='$metaTitle1', keyword='$keyword1', discription='$disc1', y_url='$y_url1', category='$cat1', order_no='$order1', status='$status' WHERE id=$id");
					$Updated = true;
				}
				else
				{
					mysqli_query($con,  "UPDATE resort_types SET title='$title1', content='$editor12', local_path='$path1', metatitle='$metaTitle1', keyword='$keyword1', discription='$disc1', y_url='$y_url1', category='$cat1', order_no='$order1', status='$status' WHERE id=$id");
					$Updated = true;
				}
			}
		}
		else
		{
			mysqli_query($con, "UPDATE resort_types SET title='$title1', content='$editor12', image='$imageUrl1', local_path='', metatitle='$metaTitle1', keyword='$keyword1', discription='$disc1', y_url='$y_url1', category='$cat1', order_no='$order1', status='$status' WHERE id=$id");
			$Updated = true;
		}

		if($Updated)
		{
			$CurrentDateTime = Date("Y-m-d H:i:s");
	 		mysqli_query($con, "DELETE FROM tent_details WHERE tent_id=$id AND category='Quick Info'");
	 		mysqli_query($con, "DELETE FROM tent_details WHERE tent_id=$id AND category='Features'");
	 		mysqli_query($con, "DELETE FROM tent_details WHERE tent_id=$id AND category='Materials'");
	 		mysqli_query($con, "DELETE FROM tent_details WHERE tent_id=$id AND category='Specifications'");

			if (isset($_POST['quick_info']) && !empty($_POST['quick_info']))
			{
				$titles = $_POST['quick_info']['title'];
	 			$descriptions = $_POST['quick_info']['description'];

			   foreach ($titles as $key => $specTitle)
			   {
					$title = mysqli_real_escape_string($con, $titles[$key]);
			      $description = mysqli_real_escape_string($con, $descriptions[$key]);

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, description, created_at) VALUES ('$id', 'Quick Info', '$title', '$description', '$CurrentDateTime')");
			   }
			}

			if (isset($_POST['features']) && !empty($_POST['features']))
			{
				$titles = $_POST['features']['title'];
	 			$descriptions = $_POST['features']['description'];

	 			foreach ($titles as $key => $specTitle)
			   {
					$title = mysqli_real_escape_string($con, $titles[$key]);
			      $description = mysqli_real_escape_string($con, $descriptions[$key]);

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, description, created_at) VALUES ('$id', 'Features', '$title', '$description', '$CurrentDateTime')");
			   }
			}

			if (isset($_POST['materials']) && !empty($_POST['materials']))
			{
				$titles = $_POST['materials']['title'];
	 			$descriptions = $_POST['materials']['description'];

	 			foreach ($titles as $key => $specTitle)
			   {
					$title = mysqli_real_escape_string($con, $titles[$key]);
			      $description = mysqli_real_escape_string($con, $descriptions[$key]);

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, description, created_at) VALUES ('$id', 'Materials', '$title', '$description', '$CurrentDateTime')");
			   }
			}

			if (isset($_POST['specifications']) && !empty($_POST['specifications']))
			{
			   $titles = $_POST['specifications']['title'];
			   $feet = $_POST['specifications']['feet'];
			   $meters = $_POST['specifications']['meters'];

			   foreach ($titles as $key => $specTitle)
			   {
			      $specTitle = mysqli_real_escape_string($con, $specTitle);
					$specFeet = mysqli_real_escape_string($con, $feet[$key]);
			      $specMeters = mysqli_real_escape_string($con, $meters[$key]);

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, feet, meters, created_at) VALUES ('$id', 'Specifications', '$specTitle', '$specFeet', '$specMeters', '$CurrentDateTime')");
			   }
			}

			$_SESSION['BannerColor'] = "background-color:#4BB543;";
      	$_SESSION['Message'] = "Updated Successfully!";
      	echo "<script>window.location.href='edit-tent.php?id=$id';</script>";
	     	exit;
		}
	}
?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<form action="" enctype="multipart/form-data" method="post" id="editTentTypeForm">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Edit Tents</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Tents</span><span class="crumb-sep">&gt;</span><span>Edit</span>
								</div>
							</div>

							<div class="listing-cta">
								<a href="tents-listing.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<?php if(!$b['local_path']){ ?>
									<input type="submit" class="btn btn-success btn-sm" id="btnn" name="update" value="Save" form="editTentTypeForm">
								<?php }else{ ?>
									<input type="submit" class="btn btn-success btn-sm" id="btnn1" name="update1" value="Save" form="editTentTypeForm">
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
						<div class="card mb-30">
							<div class="card-header">SEO Metadata</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-4">
										<div class="commonSection">
											<label>Meta Title</label>
											<?php if(!$b['local_path']){ ?>
												<textarea name="metaTitle" id="metaTitle" class="form-control" placeholder="Enter Meta Title"><?php echo $b['metatitle']; ?></textarea>
											<?php }else{ ?>
												<textarea name="metaTitle1" id="metaTitle" class="form-control" placeholder="Enter Meta Title"><?php echo $b['metatitle']; ?></textarea>
											<?php } ?>
										</div>
									</div>

									<div class="col-md-4">
										<div class="commonSection">
											<label>Meta Keyword</label>
											<?php if(!$b['local_path']){ ?>
												<textarea name="keyword" id="metaKeyword" class="form-control" placeholder="Enter Meta Keyword"><?php echo $b['keyword']; ?></textarea>
											<?php }else{ ?>
												<textarea name="keyword1" id="metaKeyword" class="form-control" placeholder="Enter Meta Keyword"><?php echo $b['keyword']; ?></textarea>
											<?php } ?>
										</div>
									</div>

									<div class="col-md-4">
										<div class="commonSection">
											<label>Meta Description</label>
											<?php if(!$b['local_path']){ ?>
												<textarea name="disc" id="metaDescription" class="form-control" placeholder="Enter Meta Description"><?php echo $b['discription']; ?></textarea>
											<?php }else{ ?>
												<textarea name="disc1" id="metaDescription" class="form-control" placeholder="Enter Meta Description"><?php echo $b['discription']; ?></textarea>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card mb-30">
							<div class="card-header">Hero Section</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-4">
										<div class="commonSection">
											<label>Collection/Category Label</label>
											<select class="form-control" name="<?php echo !$b['local_path'] ? 'cat' : 'cat1'; ?>" required>
												<option value="<?php echo $b['category']; ?>"><?php echo $b['category']; ?></option>
												<?php
													$queryl = mysqli_query($con,"SELECT * from resort_category group by title");
													while($l = mysqli_fetch_assoc($queryl)) {
												?>
													<option value="<?php echo $l['title']; ?>"><?php echo $l['title']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="col-md-4">
										<div class="commonSection">
											<label>Tent Name</label>
											<input class="form-control" type="text" required name="<?php echo !$b['local_path'] ? 'title' : 'title1'; ?>" id="title" value="<?php echo $b['title']; ?>" placeholder="Enter tent name">
										</div>
									</div>

									<div class="col-md-4">
										<div class="commonSection">
											<label>Order No.</label>
											<input class="form-control" type="number" name="<?php echo !$b['local_path'] ? 'order' : 'order1'; ?>" id="order" value="<?php echo $b['order_no']; ?>" placeholder="Enter order number">
										</div>
									</div>

									<div class="col-md-8">
										<div class="commonSection">
											<label>Short Description</label>
											<textarea class="form-control" name="<?php echo !$b['local_path'] ? 'editor1' : 'editor12'; ?>" id="editor1" rows="4" required placeholder="Enter short description"><?php echo $b['content']; ?></textarea>
										</div>
									</div>

									<div class="col-md-4">
										<div class="commonSection">
											<label>Status</label>
											<select class="form-control" name="status">
												<option value="Published" <?php echo ($b['status'] == "Published") ? "selected" : ''; ?>>Published</option>
												<option value="Draft" <?php echo ($b['status'] == "Draft") ? "selected" : ''; ?>>Draft</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header">
										<span>Features Quick Info</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#addItemModal">+ Add Item</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Title</th>
														<th>Description</th>
														<th style="width:120px;">Actions</th>
													</tr>
												</thead>

												<tbody id="quickInfoTableBody" data-empty-cols="3">
													<?php
														$MatResult = mysqli_query($con, "SELECT * FROM tent_details WHERE tent_id=$id AND category='Quick Info'");
														while($MatRow = mysqli_fetch_assoc($MatResult)) {
													?>
														<tr>
															<td><input type="text" class="form-control form-control-sm" name="quick_info[title][]" value="<?php echo $MatRow['title']; ?>"></td>
															<td><input type="text" class="form-control form-control-sm" name="quick_info[description][]" value="<?php echo $MatRow['description']; ?>"></td>
															<td>
																<div class="action-btn-group">
																	<button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button>
																</div>
															</td>
														</tr>
													<?php $i++; } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header">
										<span>Features &amp; Benefits</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#addFeatureModal">+ Add Feature</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Title</th>
														<th>Description</th>
														<th style="width:120px;">Actions</th>
													</tr>
												</thead>
												<tbody id="featureTableBody" data-empty-cols="3">
													<?php
														$MatResult = mysqli_query($con, "SELECT * FROM tent_details WHERE tent_id=$id AND category='Features'");
														while($MatRow = mysqli_fetch_assoc($MatResult)) {
													?>
														<tr>
															<td><input type="text" class="form-control form-control-sm" name="features[title][]" value="<?php echo $MatRow['title']; ?>"></td>
															<td><input type="text" class="form-control form-control-sm" name="features[description][]" value="<?php echo $MatRow['description']; ?>"></td>
															<td>
																<div class="action-btn-group">
																	<button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button>
																</div>
															</td>
														</tr>
													<?php $i++; } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header">
										<span>Materials</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#addMaterialModal">+ Add Material</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Title</th>
														<th>Description</th>
														<th style="width:120px;">Actions</th>
													</tr>
												</thead>
												<tbody id="materialTableBody" data-empty-cols="3">
													<?php
														$MatResult = mysqli_query($con, "SELECT * FROM tent_details WHERE tent_id=$id AND category='Materials'");
														while($MatRow = mysqli_fetch_assoc($MatResult)) {
													?>
														<tr>
															<td><input type="text" class="form-control form-control-sm" name="materials[title][]" value="<?php echo $MatRow['title']; ?>"></td>
															<td><input type="text" class="form-control form-control-sm" name="materials[description][]" value="<?php echo $MatRow['description']; ?>"></td>
															<td>
																<div class="action-btn-group">
																	<button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button>
																</div>
															</td>
														</tr>
													<?php $i++; } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header">
										<span>Specifications</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#addSpecificationModal">+ Add Specification</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Title</th>
														<th>Feet</th>
														<th>Meters</th>
														<th style="width:120px;">Actions</th>
													</tr>
												</thead>
												<tbody id="specificationTableBody" data-empty-cols="4">
													<?php
														$SpecsResult = mysqli_query($con, "SELECT * FROM tent_details WHERE tent_id=$id AND category='Specifications'");
														while($SpecsRow = mysqli_fetch_assoc($SpecsResult)) {
													?>
														<tr>
															<td><input type="text" class="form-control form-control-sm" name="specifications[title][]" value="<?php echo $SpecsRow['title']; ?>"></td>
															<td><input type="text" class="form-control form-control-sm" name="specifications[feet][]" value="<?php echo $SpecsRow['feet']; ?>"></td>
															<td><input type="text" class="form-control form-control-sm" name="specifications[meters][]" value="<?php echo $SpecsRow['meters']; ?>"></td>
															<td>
																<div class="action-btn-group">
																	<!-- <button type="button" class="btn btn-sm btn-outline-success js-edit-spec" title="Edit"><i class="feather icon-edit-2"></i></button> -->
																	<button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button>
																</div>
															</td>
														</tr>
													<?php $i++; } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header">Floor Plan</div>
									<div class="card-body">
										<label class="banner-form-label">Floor Plan Image <span class="required">*</span></label>
										<div class="banner-image-upload">
											<?php
												$imagePath = "images/default-profile.png";
												if(isset($b['local_path']) && $b['local_path'] != '')
												{
													$imagePath = $b['local_path'];
												}
											?>

											<img src="<?php echo $imagePath; ?>" class="banner-image-preview" id="floorPlanPreview" alt="Floor Plan Image">
											<div class="banner-recommended-size">Recommended size: 1200x800px</div>
											<input type="file" name="floor_plan_image" id="floorPlanFile" style="display:none;" accept="image/*">
											<button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('floorPlanFile').click();">
												<i class="feather icon-upload"></i> Change Image
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addItemModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Add Quick Info Item</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
			<div class="modal-body">
				<div class="commonSection"><label>Title</label><input type="text" class="form-control" id="quickItemTitle" placeholder="Enter title"></div>
				<div class="commonSection"><label>Description</label><textarea class="form-control" id="quickItemDescription" rows="3" placeholder="Enter description"></textarea></div>
			</div>
			<div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button type="button" class="btn btn-success" id="saveQuickItem">Add Item</button></div>
		</div>
	</div>
</div>

<div class="modal fade" id="addFeatureModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Add Feature</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
			<div class="modal-body">
				<div class="commonSection"><label>Title</label><input type="text" class="form-control" id="featureTitle" placeholder="Enter title"></div>
				<div class="commonSection"><label>Description</label><textarea class="form-control" id="featureDescription" rows="3" placeholder="Enter description"></textarea></div>
			</div>
			<div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button type="button" class="btn btn-success" id="saveFeature">Add Feature</button></div>
		</div>
	</div>
</div>

<div class="modal fade" id="addMaterialModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Add Material</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
			<div class="modal-body">
				<div class="commonSection"><label>Title</label><input type="text" class="form-control" id="materialTitle" placeholder="Enter title"></div>
				<div class="commonSection"><label>Description</label><textarea class="form-control" id="materialDescription" rows="3" placeholder="Enter description"></textarea></div>
			</div>
			<div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button type="button" class="btn btn-success" id="saveMaterial">Add Material</button></div>
		</div>
	</div>
</div>

<div class="modal fade" id="addSpecificationModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Add Specification</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
			<div class="modal-body">
				<div class="commonSection"><label>Title</label><input type="text" class="form-control" id="specTitle" placeholder="Enter title"></div>
				<div class="row">
					<div class="col-md-6">
						<div class="commonSection"><label>Feet</label><input type="text" class="form-control" id="specFeet" placeholder="Enter feet"></div>
					</div>
					<div class="col-md-6">
						<div class="commonSection"><label>Meters</label><input type="text" class="form-control" id="specMeters" placeholder="Enter meters"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button type="button" class="btn btn-success" id="saveSpecification">Add Specification</button></div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirm Delete</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<p class="confirm-delete-text mb-0">Are you sure you want to delete?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
				<button type="button" class="btn btn-danger" id="confirmDeleteYes">Yes</button>
			</div>
		</div>
	</div>
</div>
<?php include_once('common/footer.php'); ?>

<script>
	(function() {
		var floorInput = document.getElementById('floorPlanFile');
		var floorPreview = document.getElementById('floorPlanPreview');
		if (!floorInput || !floorPreview) {
			return;
		}

		floorInput.addEventListener('change', function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					floorPreview.src = e.target.result;
				};
				reader.readAsDataURL(this.files[0]);
			}
		});

	})();

	(function() {
		var editingRowByModal = {};
		var rowToDelete = null;

		var modalConfig = {
			addItemModal: {
				tbodyId: 'quickInfoTableBody',
				saveBtnId: 'saveQuickItem',
				modeTitle: 'Add Quick Info Item',
				modeEditTitle: 'Edit Quick Info Item'
			},
			addFeatureModal: {
				tbodyId: 'featureTableBody',
				saveBtnId: 'saveFeature',
				modeTitle: 'Add Feature',
				modeEditTitle: 'Edit Feature'
			},
			addMaterialModal: {
				tbodyId: 'materialTableBody',
				saveBtnId: 'saveMaterial',
				modeTitle: 'Add Material',
				modeEditTitle: 'Edit Material'
			},
			addSpecificationModal: {
				tbodyId: 'specificationTableBody',
				saveBtnId: 'saveSpecification',
				modeTitle: 'Add Specification',
				modeEditTitle: 'Edit Specification'
			}
		};

		function actionButtons() {
			return '<div class="action-btn-group"><button type="button" class="btn btn-sm btn-outline-primary btn-action-edit" title="Edit"><i class="feather icon-edit-2"></i></button><button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button></div>';
		}

		function getDataRows(tbody) {
			if (!tbody) {
				return [];
			}
			return Array.prototype.slice.call(tbody.querySelectorAll('tr')).filter(function(row) {
				return !row.classList.contains('no-record-row');
			});
		}

		function ensureEmptyState(tbodyId) {
			var tbody = document.getElementById(tbodyId);
			if (!tbody) {
				return;
			}
			var rows = getDataRows(tbody);
			var emptyRow = tbody.querySelector('.no-record-row');
			if (rows.length === 0) {
				if (!emptyRow) {
					emptyRow = document.createElement('tr');
					emptyRow.className = 'no-record-row';
					emptyRow.innerHTML = '<td colspan="' + (tbody.getAttribute('data-empty-cols') || '3') + '">No record found. Click on Add.</td>';
					tbody.appendChild(emptyRow);
				}
			} else if (emptyRow) {
				emptyRow.remove();
			}
		}

		function createHiddenInput(name, value) {
	    	var input = document.createElement('input');
	    	input.type = 'hidden';
	    	input.name = name;
	    	input.value = value;
	    	return input;
		}

		function appendRow(tbodyId, title, description) {
	    	var tbody = document.getElementById(tbodyId);
	    	if (!tbody || !title || !description) {
	        	return;
	    	}

	    	var emptyRow = tbody.querySelector('.no-record-row');
	    	if (emptyRow) {
	        	emptyRow.remove();
	    	}

	    	var prefix = '';
	    	if (tbodyId === 'quickInfoTableBody') {
	        	prefix = 'quick_info';
	    	} 
	    	else if (tbodyId === 'featureTableBody') {
	        	prefix = 'features';
	    	} 
	    	else if (tbodyId === 'materialTableBody') {
	        	prefix = 'materials';
	    	}

	    	var row = document.createElement('tr');
	    	var titleTd = document.createElement('td');
	    	titleTd.textContent = title;

	    	var descriptionTd = document.createElement('td');
	    	descriptionTd.textContent = description;

	    	var actionTd = document.createElement('td');
	    	actionTd.innerHTML = actionButtons();

	    	titleTd.appendChild(
	        	createHiddenInput(prefix + '[title][]', title)
	    	);

	    	descriptionTd.appendChild(
	        createHiddenInput(prefix + '[description][]', description)
	    	);

	    	row.appendChild(titleTd);
	    	row.appendChild(descriptionTd);
	    	row.appendChild(actionTd);

	    	tbody.appendChild(row);

	    	ensureEmptyState(tbodyId);
		}

		function appendSpecificationRow(tbodyId, title, feet, meters) {
         var tbody = document.getElementById(tbodyId);

         if (!tbody || !title || !feet || !meters) {
           return;
         }

         var emptyRow = tbody.querySelector('.no-record-row');

         if (emptyRow) {
           emptyRow.remove();
         }

         var row = document.createElement('tr');

         // Title
         var titleTd = document.createElement('td');
         titleTd.textContent = title;

         var titleHidden = document.createElement('input');
         titleHidden.type = 'hidden';
         titleHidden.name = 'specifications[title][]';
         titleHidden.value = title;

         titleTd.appendChild(titleHidden);

         // Feet
         var feetTd = document.createElement('td');

         var feetInput = document.createElement('input');
         feetInput.type = 'text';
         feetInput.className = 'form-control form-control-sm';
         feetInput.value = feet;

         var feetHidden = document.createElement('input');
         feetHidden.type = 'hidden';
         feetHidden.name = 'specifications[feet][]';
         feetHidden.value = feet;

         feetTd.appendChild(feetInput);
         feetTd.appendChild(feetHidden);

         // Meters
         var metersTd = document.createElement('td');

         var metersInput = document.createElement('input');
         metersInput.type = 'text';
         metersInput.className = 'form-control form-control-sm';
         metersInput.value = meters;

         var metersHidden = document.createElement('input');
         metersHidden.type = 'hidden';
         metersHidden.name = 'specifications[meters][]';
         metersHidden.value = meters;

         metersTd.appendChild(metersInput);
         metersTd.appendChild(metersHidden);

         // Actions
         var actionTd = document.createElement('td');
         actionTd.innerHTML = actionButtons();

         row.appendChild(titleTd);
         row.appendChild(feetTd);
         row.appendChild(metersTd);
         row.appendChild(actionTd);

         tbody.appendChild(row);

         ensureEmptyState(tbodyId);
      }

		function updateSpecificationHiddenInputs(row) {
		   if (!row) {
		      return;
		   }

		   var titleInput = row.cells[0].querySelector(
		      'input[name="specifications[title][]"]'
		   );

		   var feetInput = row.cells[1].querySelector(
		      'input[name="specifications[feet][]"]'
		   );

		   var metersInput = row.cells[2].querySelector(
		      'input[name="specifications[meters][]"]'
		   );

		   if (titleInput) {
		      titleInput.value = row.cells[0].childNodes[0].textContent.trim();
		   }

		   if (feetInput) {
		      feetInput.value = row.cells[1].querySelector(
		         'input.form-control'
		      ).value;
		   }

		   if (metersInput) {
		      metersInput.value = row.cells[2].querySelector(
		         'input.form-control'
		      ).value;
		   }
		}

		function closeModal(id) {
			var el = document.getElementById(id);
			if (!el) {
				return;
			}
			var modal = bootstrap.Modal.getInstance(el);
			if (modal) {
				modal.hide();
			}
		}

		function openModal(id) {
			var el = document.getElementById(id);
			if (!el) {
				return;
			}
			bootstrap.Modal.getOrCreateInstance(el).show();
		}

		function setModalHeading(modalId, isEdit) {
			var modalEl = document.getElementById(modalId);
			var cfg = modalConfig[modalId];
			if (!modalEl || !cfg) {
				return;
			}
			var titleEl = modalEl.querySelector('.modal-title');
			var saveBtn = document.getElementById(cfg.saveBtnId);
			if (titleEl) {
				titleEl.textContent = isEdit ? cfg.modeEditTitle : cfg.modeTitle;
			}
			if (saveBtn) {
				saveBtn.textContent = isEdit ? 'Update' : cfg.modeTitle.replace('Add ', 'Add ');
			}
		}

		function clearAndResetModal(modalId) {
			setModalHeading(modalId, false);
			if (modalId === 'addSpecificationModal') {
				document.getElementById('specTitle').value = '';
				document.getElementById('specFeet').value = '';
				document.getElementById('specMeters').value = '';
			} else if (modalId === 'addItemModal') {
				document.getElementById('quickItemTitle').value = '';
				document.getElementById('quickItemDescription').value = '';
			} else if (modalId === 'addFeatureModal') {
				document.getElementById('featureTitle').value = '';
				document.getElementById('featureDescription').value = '';
			} else if (modalId === 'addMaterialModal') {
				document.getElementById('materialTitle').value = '';
				document.getElementById('materialDescription').value = '';
			}
			editingRowByModal[modalId] = null;
		}

		function handleSimpleSave(modalId, title, description) {
			var editingRow = editingRowByModal[modalId];
			if (!title || !description) {
				return;
			}
			if (editingRow) {
				editingRow.cells[0].textContent = title;
				editingRow.cells[1].textContent = description;
			} else {
				appendRow(modalConfig[modalId].tbodyId, title, description);
			}
			closeModal(modalId);
			clearAndResetModal(modalId);
		}

		function handleSpecSave() {

		   var modalId = 'addSpecificationModal';

		   var title = document.getElementById('specTitle').value.trim();
		   var feet = document.getElementById('specFeet').value.trim();
		   var meters = document.getElementById('specMeters').value.trim();

		   var editingRow = editingRowByModal[modalId];

		   if (!title || !feet || !meters) {
		   alert('Please fill all specification fields.');
		   return;
		   }

		   if (editingRow) {

		   // Update Title
		   editingRow.cells[0].childNodes[0].textContent = title;

		   var titleHidden = editingRow.cells[0].querySelector(
		      'input[type="hidden"]'
		   );

		   if (titleHidden) {
		      titleHidden.value = title;
		   }

		   // Update Feet
		   var feetInput = editingRow.cells[1].querySelector(
		      'input.form-control'
		   );

		   var feetHidden = editingRow.cells[1].querySelector(
		      'input[type="hidden"]'
		   );

		   if (feetInput) {
		      feetInput.value = feet;
		   }

		   if (feetHidden) {
		      feetHidden.value = feet;
		   }

		   // Update Meters
		   var metersInput = editingRow.cells[2].querySelector(
		      'input.form-control'
		   );

		   var metersHidden = editingRow.cells[2].querySelector(
		      'input[type="hidden"]'
		   );

		   if (metersInput) {
		      metersInput.value = meters;
		   }

		   if (metersHidden) {
		      metersHidden.value = meters;
		   }

		   } else {

		   appendSpecificationRow(
		      'specificationTableBody',
		      title,
		      feet,
		      meters
		   );
		   }

		   closeModal(modalId);
		   clearAndResetModal(modalId);
		}

		document.getElementById('saveQuickItem').addEventListener('click', function() {
			handleSimpleSave('addItemModal', document.getElementById('quickItemTitle').value.trim(), document.getElementById('quickItemDescription').value.trim());
		});

		document.getElementById('saveFeature').addEventListener('click', function() {
			handleSimpleSave('addFeatureModal', document.getElementById('featureTitle').value.trim(), document.getElementById('featureDescription').value.trim());
		});

		document.getElementById('saveMaterial').addEventListener('click', function() {
			handleSimpleSave('addMaterialModal', document.getElementById('materialTitle').value.trim(), document.getElementById('materialDescription').value.trim());
		});

		document.getElementById('saveSpecification').addEventListener('click', function() {
			handleSpecSave();
		});

		document.addEventListener('click', function(event) {
			var editBtn = event.target.closest('.btn-action-edit');
			if (editBtn) {
				var editRow = editBtn.closest('tr');
				var tbody = editRow ? editRow.closest('tbody') : null;
				if (!editRow || !tbody) {
					return;
				}

				if (tbody.id === 'quickInfoTableBody') {
					editingRowByModal.addItemModal = editRow;
					document.getElementById('quickItemTitle').value = editRow.cells[0].textContent.trim();
					document.getElementById('quickItemDescription').value = editRow.cells[1].textContent.trim();
					setModalHeading('addItemModal', true);
					openModal('addItemModal');
				}

				if (tbody.id === 'featureTableBody') {
					editingRowByModal.addFeatureModal = editRow;
					document.getElementById('featureTitle').value = editRow.cells[0].textContent.trim();
					document.getElementById('featureDescription').value = editRow.cells[1].textContent.trim();
					setModalHeading('addFeatureModal', true);
					openModal('addFeatureModal');
				}

				if (tbody.id === 'materialTableBody') {
					editingRowByModal.addMaterialModal = editRow;
					document.getElementById('materialTitle').value = editRow.cells[0].textContent.trim();
					document.getElementById('materialDescription').value = editRow.cells[1].textContent.trim();
					setModalHeading('addMaterialModal', true);
					openModal('addMaterialModal');
				}

				if (tbody.id === 'specificationTableBody') {
				   editingRowByModal.addSpecificationModal = editRow;

				   var title = editRow.cells[0].childNodes[0]
				     ? editRow.cells[0].childNodes[0].textContent.trim()
				     : '';

				   var feetInput = editRow.cells[1].querySelector(
				     'input.form-control'
				   );

				   var metersInput = editRow.cells[2].querySelector(
				     'input.form-control'
				   );

				   document.getElementById('specTitle').value = title;

				   document.getElementById('specFeet').value =
				     feetInput ? feetInput.value.trim() : '';

				   document.getElementById('specMeters').value =
				     metersInput ? metersInput.value.trim() : '';

				   setModalHeading('addSpecificationModal', true);

				   openModal('addSpecificationModal');
				}
			}

			var deleteBtn = event.target.closest('.js-delete-row');
			if (deleteBtn) {
				rowToDelete = deleteBtn.closest('tr');
				openModal('confirmDeleteModal');
			}
		});

		document.getElementById('confirmDeleteYes').addEventListener('click', function() {
			if (rowToDelete) {
				var parentTbody = rowToDelete.closest('tbody');
				rowToDelete.remove();
				if (parentTbody && parentTbody.id) {
					ensureEmptyState(parentTbody.id);
				}
			}
			rowToDelete = null;
			closeModal('confirmDeleteModal');
		});

		document.getElementById('confirmDeleteModal').addEventListener('hidden.bs.modal', function() {
			rowToDelete = null;
		});

		['addItemModal', 'addFeatureModal', 'addMaterialModal', 'addSpecificationModal'].forEach(function(modalId) {
			var modalEl = document.getElementById(modalId);
			if (!modalEl) {
				return;
			}
			modalEl.addEventListener('hidden.bs.modal', function() {
				clearAndResetModal(modalId);
			});
		});

		['quickInfoTableBody', 'featureTableBody', 'materialTableBody', 'specificationTableBody'].forEach(function(tbodyId) {
			ensureEmptyState(tbodyId);
		});
	})();

	(function() {
		function getDataRows(tbody) {
			if (!tbody) {
				return [];
			}
			return Array.prototype.slice.call(tbody.querySelectorAll('tr')).filter(function(row) {
				return !row.classList.contains('no-record-row');
			});
		}

		function ensureEmptyState(tbodyId) {
			var tbody = document.getElementById(tbodyId);
			if (!tbody) {
				return;
			}
			var rows = getDataRows(tbody);
			var emptyRow = tbody.querySelector('.no-record-row');
			if (rows.length === 0) {
				if (!emptyRow) {
					emptyRow = document.createElement('tr');
					emptyRow.className = 'no-record-row';
					emptyRow.innerHTML = '<td colspan="' + (tbody.getAttribute('data-empty-cols') || '3') + '">No record found. Click on Add.</td>';
					tbody.appendChild(emptyRow);
				}
			} else if (emptyRow) {
				emptyRow.remove();
			}
		}

		document.addEventListener('click', function(event) {
			var editBtn = event.target.closest('.js-edit-spec');
			if (editBtn) {
				var specRow = editBtn.closest('tr');
				if (!specRow) {
					return;
				}
				var inputs = specRow.querySelectorAll('td input');
				if (!inputs.length) {
					return;
				}
				var isLocked = inputs[0].hasAttribute('readonly');
				if (isLocked) {
					Array.prototype.forEach.call(inputs, function(input) {
						input.removeAttribute('readonly');
					});
					editBtn.setAttribute('title', 'Save');
					editBtn.classList.remove('btn-outline-success');
					editBtn.classList.add('btn-success');
					var icon = editBtn.querySelector('i');
					if (icon) {
						icon.className = 'feather icon-check';
					}
					inputs[0].focus();
				} else {
					Array.prototype.forEach.call(inputs, function(input) {
						input.setAttribute('readonly', 'readonly');
					});
					editBtn.setAttribute('title', 'Edit');
					editBtn.classList.remove('btn-success');
					editBtn.classList.add('btn-outline-success');
					var iconReset = editBtn.querySelector('i');
					if (iconReset) {
						iconReset.className = 'feather icon-edit-2';
					}
				}
				return;
			}
		});

		['quickInfoTableBody', 'featureTableBody', 'materialTableBody', 'specificationTableBody'].forEach(function(tbodyId) {
			ensureEmptyState(tbodyId);
		});
	})();

	function res(){
		document.getElementById('myFile').value = "";
		var p = document.getElementById("image").value;
		if (document.getElementById("btnn")) {
			document.getElementById("btnn").disabled = !p;
		}
	}

	function res1(){
		document.getElementById('myFile1').value = "";
		var p1 = document.getElementById("image1").value;
		if (document.getElementById("btnn1")) {
			document.getElementById("btnn1").disabled = !p1;
		}
	}

	$(document).ready(function() {
		if (document.getElementById('myFile') && document.getElementById('image') && document.getElementById('btnn')) {
			var x = document.getElementById("myFile").value;
			var x1 = document.getElementById("image").value;
			document.getElementById("btnn").disabled = (x1 && x) || (!x1 && !x);

			$('#image').keyup(function() {
				var dInput = this.value;
				var xf = document.getElementById("myFile").value;
				document.getElementById("btnn").disabled = (dInput && xf) || (!dInput && !xf);
			});

			document.getElementById('myFile').onchange = function () {
				var pInput = this.value;
				var y = document.getElementById("image").value;
				document.getElementById("btnn").disabled = (pInput && y) || (!pInput && !y);
			};
		}

		if (document.getElementById('myFile1') && document.getElementById('image1') && document.getElementById('btnn1')) {
			var f = document.getElementById("myFile1").value;
			var f1 = document.getElementById("image1").value;
			document.getElementById("btnn1").disabled = (f1 && f) || (!f1 && !f);

			$('#image1').keyup(function() {
				var dInput1 = this.value;
				var x2 = document.getElementById("myFile1").value;
				document.getElementById("btnn1").disabled = (dInput1 && x2) || (!dInput1 && !x2);
			});

			document.getElementById('myFile1').onchange = function () {
				var pInput1 = this.value;
				var y1 = document.getElementById("image1").value;
				document.getElementById("btnn1").disabled = (pInput1 && y1) || (!pInput1 && !y1);
			};
		}
	});

	if (document.getElementById('select_image1')) {
		document.getElementById('select_image1').style.display = 'none';
	}
	function show2(){
		document.getElementById('image_url').style.display = 'none';
		document.getElementById('select_image1').style.display = 'block';
	}

	function show1(){
		document.getElementById('select_image1').style.display = 'none';
		document.getElementById('image_url').style.display = 'block';
	}

	if (document.getElementById('image_url1')) {
		document.getElementById('image_url1').style.display = 'none';
	}
	function show3(){
		document.getElementById('image_url1').style.display = 'block';
		document.getElementById('select_image').style.display = 'none';
	}

	function show4(){
		document.getElementById('select_image').style.display = 'block';
		document.getElementById('image_url1').style.display = 'none';
	}
</script>