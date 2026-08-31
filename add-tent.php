<?php
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Project";

	$FileExists = false;
	if (isset($_POST['sub']))
	{
		$page = "Update";
		$metaTitle = $_POST['metaTitle'];
		$keyword = $_POST['keyword'];
		$disc = $_POST['disc'];
		$cat = $_POST['cat'];
		$title = mysqli_real_escape_string($con, $_POST['title']);
		$editor1 = mysqli_real_escape_string($con, $_POST['editor1']);
		$order = $_POST['order'];
		$status = $_POST['status'];
		$y_url = isset($_POST['y_url']) ? $_POST['y_url'] : '';
		$editor2 = isset($_POST['editor2']) ? $_POST['editor2'] : '';
		$imageUrl = isset($_POST['image']) ? $_POST['image'] : '';
		$myFile = isset($_FILES['myFile']['name']) ? $_FILES['myFile']['name'] : '';
		$FloorImage = isset($_FILES['floor_plan_image']['name']) ? $_FILES['floor_plan_image']['name'] : '';

		$path = "uploads/pageimages/resort/types/";
		$path_original = "uploads/pageimages/resort/types/";

		$FloorPath = "";
		if(isset($_FILES['floor_plan_image']['name']) && $_FILES['floor_plan_image']['name'] != '')
		{
			move_uploaded_file($_FILES['floor_plan_image']['tmp_name'], $path.$FloorImage);
			$FloorPath = $path_original.$FloorImage;
		}

		if(!$imageUrl)
		{
			if($myFile == '')
			{
				mysqli_query($con,"INSERT INTO resort_types (metatitle, keyword, discription, category, order_no, title, content, y_url, dimension, image, status) VALUES ('$metaTitle', '$keyword', '$disc', '$cat', '$order', '$title', '$editor1', '$y_url', '$editor2', '', '$status') ");
				$LastInsertID = mysqli_insert_id($con);
			}
			elseif($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile) || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
			{
				$FileExists = true;
		   	$_SESSION['BannerColor'] = "background-color:#FF0000;";
		   	$_SESSION['Message'] = "Selected image already exists!";
		   	echo "<script>window.location.href='add-tent.php';</script>";
		   	exit;
			}
			else 
			{
				$ImagePath = "";
				if(isset($_FILES['myFile']['name']) && $_FILES['myFile']['name'] != '')
				{
					move_uploaded_file($_FILES['myFile']['tmp_name'], $path.$myFile);
					$ImagePath = $path_original.$myFile;
				}

				mysqli_query($con,"INSERT INTO resort_types (metatitle, keyword, discription, category, order_no, title, content, y_url, dimension, local_path, image, floor_image, status) VALUES ('$metaTitle', '$keyword', '$disc', '$cat', '$order', '$title', '$editor1', '$y_url', '$editor2', '$ImagePath', '', '$FloorPath', '$status') ");
				$LastInsertID = mysqli_insert_id($con);
			}
		}
		else
		{
			mysqli_query($con, "INSERT INTO resort_types (metatitle, keyword, discription, category, order_no, title, content, y_url, dimension, local_path, image, floor_image, status) VALUES ('$metaTitle', '$keyword', '$disc', '$cat', '$order', '$title', '$editor1', '$y_url', '$editor2', '', '$imageUrl', '$FloorPath', '$status')");
			$LastInsertID = mysqli_insert_id($con);
		}

		if($LastInsertID != '')
		{
			$CurrentDateTime = Date("Y-m-d H:i:s");
			if (isset($_POST['quick_info']) && !empty($_POST['quick_info']))
			{
				$titles = $_POST['quick_info']['title'];
	 			$descriptions = $_POST['quick_info']['description'];

			   foreach ($titles as $key => $specTitle)
			   {
					$title = mysqli_real_escape_string($con, $titles[$key]);
			      $description = mysqli_real_escape_string($con, $descriptions[$key]);

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, description, created_at) VALUES ('$LastInsertID', 'Quick Info', '$title', '$description', '$CurrentDateTime')");
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

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, description, created_at) VALUES ('$LastInsertID', 'Features', '$title', '$description', '$CurrentDateTime')");
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

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, description, created_at) VALUES ('$LastInsertID', 'Materials', '$title', '$description', '$CurrentDateTime')");
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

			      mysqli_query($con, "INSERT INTO tent_details (tent_id, category, title, feet, meters, created_at) VALUES ('$LastInsertID', 'Specifications', '$specTitle', '$specFeet', '$specMeters', '$CurrentDateTime')");
			   }
			}

			$_SESSION['BannerColor'] = "background-color:#4BB543;";
      	$_SESSION['Message'] = "Added Successfully!";
      	echo "<script>window.location.href='add-tent.php';</script>";
	     	exit;
		}
	}
?>

<style type="text/css">
	/* Main Bootstrap modal */
	.modal {
	    z-index: 1055;
	}

	/* Icon picker modal should be above the main modal */
	#quickInfoMaterialIconModal {
	    z-index: 1075;
	}

	/* Its backdrop should also be above the main modal,
	   but below the icon picker itself */
	.modal-backdrop.icon-picker-backdrop {
	    z-index: 1070;
	}

	.icon-picker-item.selected {
	    border-color: #198754;
	    background-color: #eaf7ef;
	    box-shadow: 0 0 0 2px rgba(25, 135, 84, 0.15);
	}

	.icon-picker-item.selected .material-icons {
	    color: #198754;
	}
</style>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<form action="" enctype="multipart/form-data" method="post" id="projectInternalForm">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Add Tents</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Tents</span><span class="crumb-sep">&gt;</span><span>Add New</span>
								</div>
							</div>

							<div class="listing-cta">
								<a href="tents-listing.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<input type="submit" class="btn btn-success btn-sm" id="btnn" name="sub" value="Save" form="projectInternalForm">
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
											<textarea name="metaTitle" id="metaTitle" class="form-control" placeholder="Enter Meta Title"></textarea>
										</div>
									</div>
									<div class="col-md-4">
										<div class="commonSection">
											<label>Meta Keyword</label>
											<textarea name="keyword" id="metaKeyword" class="form-control" placeholder="Enter Meta Keyword"></textarea>
										</div>
									</div>
									<div class="col-md-4">
										<div class="commonSection">
											<label>Meta Description</label>
											<textarea name="disc" id="metaDescription" class="form-control" placeholder="Enter Meta Description"></textarea>
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
											<select class="form-control" name="cat" required>
												<option value="">--Select--</option>
												<?php
													$queryl = mysqli_query($con,"SELECT * FROM resort_category ORDER BY title ASC");
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
											<input class="form-control" type="text" required name="title" id="title" placeholder="Enter tent name">
										</div>
									</div>
									<div class="col-md-4">
										<div class="commonSection">
											<label>Order No.</label>
											<input class="form-control" type="number" name="order" id="order" placeholder="Enter order number">
										</div>
									</div>
									<div class="col-md-8">
										<div class="commonSection">
											<label>Short Description</label>
											<textarea class="form-control" name="editor1" id="editor1" rows="4" required placeholder="Enter short description"></textarea>
										</div>
									</div>

									<div class="col-md-4">
										<div class="commonSection">
											<label>Status</label>
											<select class="form-control" name="status">
												<option value="Published">Published</option>
												<option value="Draft">Draft</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header d-flex justify-content-between align-items-center">
										<span>Features Quick Info</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#addItemModal">+ Add Item</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Icon</th>
														<th>Title</th>
														<th>Description</th>
														<th style="width:120px;">Actions</th>
													</tr>
												</thead>
												<tbody id="quickInfoTableBody" data-empty-cols="3">
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header d-flex justify-content-between align-items-center">
										<span>Features &amp; Benefits</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#addFeatureModal">+ Add Feature</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Icon</th>
														<th>Title</th>
														<th>Description</th>
														<th style="width:120px;">Actions</th>
													</tr>
												</thead>
												<tbody id="featureTableBody" data-empty-cols="3">
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header d-flex justify-content-between align-items-center">
										<span>Materials</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#addMaterialModal">+ Add Material</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Icon</th>
														<th>Title</th>
														<th>Description</th>
														<th style="width:120px;">Actions</th>
													</tr>
												</thead>
												<tbody id="materialTableBody" data-empty-cols="3">
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header d-flex justify-content-between align-items-center">
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
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header">Banner Image</div>
									<div class="card-body">
										<div class="banner-image-upload">
											<img src="images/default-profile.png" class="banner-image-preview" id="imgPreview" alt="Banner Image" onerror="this.src='images/default-profile.png';">
											<div class="banner-recommended-size">Recommended size: 1920x800px</div>
											<div class="radio-inline-group" style="margin-top: 12px;">
												<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();" checked="">Image URL</label>
												<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();">Select New Image</label>
											</div>

											<div id="image_url" style="margin-top: 12px;">
												<input class="form-control banner-form-control" type="text" name="image" id="image" placeholder="Enter image URL">
											</div>

											<div id="select_image" style="display: none; margin-top: 12px;">
												<input type="file" name="myFile" id="myFile" style="display: none;" accept="image/*">
												<div class="banner-upload-actions">
													<button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile').click();">
														<i class="feather icon-upload"></i> Change Image
													</button>
													<!-- <button type="button" class="btn btn-sm btn-danger" onclick="reset('myFile', 'imgPreview');">Reset Image</button> -->
												</div>
											</div>
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
											<img src="images/default-profile.png" class="banner-image-preview" id="floorPlanPreview" alt="Floor Plan Image">
											<div class="banner-recommended-size">Recommended size: 1200x800px</div>
											<input type="file" name="floor_plan_image" id="floorPlanFile" style="display:none;" accept="image/*">
											<button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('floorPlanFile').click();">
												<i class="feather icon-upload"></i> Change Image
											</button>
											<!-- <button type="button" class="btn btn-sm btn-danger" onclick="reset('floorPlanFile', 'floorPlanPreview');">Reset Image</button> -->
										</div>
									</div>
								</div>
							</div>
						</div>

						<input type="hidden" name="sub" value="1">
					</form>

					<div class="modal fade" id="addItemModal" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header"><h5 class="modal-title">Add Quick Info Item</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
								<div class="modal-body">
									<div class="commonSection">
										<label>Icon</label>
										<div class="counter-icon-box">
									        <div class="counter-icon-preview" style="margin-bottom:8px;">
									            <span class="material-icons" id="quickItemIconUiPreview">home</span>
									        </div>

									        <div class="d-flex align-items-center justify-content-between"
									             style="gap:10px; margin-bottom:8px;">

									            <button type="button"
									                    class="btn btn-outline-secondary btn-sm"
									                    onclick="openQuickInfoIconModal('quickInfo')">
									                Open Material Icons
									            </button>

									            <span class="counter-icon-help" style="margin:0;">
									                Choose any icon name
									            </span>
									        </div>

									        <input type="text"
									               class="form-control"
									               id="quickItemIconUiOnly"
									               value="home"
									               placeholder="Ex: home, verified, location_on">

									        <div class="counter-icon-help">
									            UI only (not saved yet)
									        </div>
									    </div>
									</div>
									<div class="commonSection"><label>Title</label><input type="text" class="form-control" id="quickItemTitle" placeholder="Enter title"></div>
									<div class="commonSection"><label>Description</label><textarea class="form-control" id="quickItemDescription" rows="3" placeholder="Enter description"></textarea></div>
								</div>
								<div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button type="button" class="btn btn-success" id="saveQuickItem">Add Item</button></div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="addFeatureModal" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header"><h5 class="modal-title">Add Feature</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
								<div class="modal-body">
									<div class="commonSection">
									    <label>Icon</label>
									    <div class="counter-icon-box">
									        <div class="counter-icon-preview" style="margin-bottom:8px;">
									            <span class="material-icons" id="featureIconUiPreview">home</span>
									        </div>

									        <div class="d-flex align-items-center justify-content-between"
									             style="gap:10px; margin-bottom:8px;">

									            <button type="button"
									                    class="btn btn-outline-secondary btn-sm"
									                    onclick="openQuickInfoIconModal('feature')">
									                Open Material Icons
									            </button>

									            <span class="counter-icon-help" style="margin:0;">
									                Choose any icon name
									            </span>
									        </div>

									        <input type="text"
									               class="form-control"
									               id="featureIconUiOnly"
									               value="home"
									               placeholder="Ex: home, verified, location_on">

									        <div class="counter-icon-help">
									            UI only (not saved yet)
									        </div>
									    </div>
									</div>
									<div class="commonSection"><label>Title</label><input type="text" class="form-control" id="featureTitle" placeholder="Enter title"></div>
									<div class="commonSection"><label>Description</label><textarea class="form-control" id="featureDescription" rows="3" placeholder="Enter description"></textarea></div>
								</div>
								<div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button type="button" class="btn btn-success" id="saveFeature">Add Feature</button></div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="addMaterialModal" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header"><h5 class="modal-title">Add Material</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
								<div class="modal-body">
									<div class="commonSection">
									    <label>Icon</label>
									    <div class="counter-icon-box">
									        <div class="counter-icon-preview" style="margin-bottom:8px;">
									            <span class="material-icons" id="materialIconUiPreview">home</span>
									        </div>

									        <div class="d-flex align-items-center justify-content-between"
									             style="gap:10px; margin-bottom:8px;">

									            <button type="button"
									                    class="btn btn-outline-secondary btn-sm"
									                    onclick="openQuickInfoIconModal('material')">
									                Open Material Icons
									            </button>

									            <span class="counter-icon-help" style="margin:0;">
									                Choose any icon name
									            </span>
									        </div>

									        <input type="text"
									               class="form-control"
									               id="materialIconUiOnly"
									               value="home"
									               placeholder="Ex: home, verified, location_on">

									        <div class="counter-icon-help">
									            UI only (not saved yet)
									        </div>
									    </div>
									</div>
									<div class="commonSection"><label>Title</label><input type="text" class="form-control" id="materialTitle" placeholder="Enter title"></div>
									<div class="commonSection"><label>Description</label><textarea class="form-control" id="materialDescription" rows="3" placeholder="Enter description"></textarea></div>
								</div>
								<div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button type="button" class="btn btn-success" id="saveMaterial">Add Material</button></div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="addSpecificationModal" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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

					<div class="modal fade" id="quickInfoMaterialIconModal" tabindex="-1" aria-labelledby="quickInfoMaterialIconModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="quickInfoMaterialIconModalLabel">Select Material Icon</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<input type="text" class="form-control mb-3" id="quickInfoIconSearch" placeholder="Search icons...">
									<div class="icon-picker-grid" id="quickInfoIconGrid"></div>
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
	document.getElementById("btnn").disabled = false;

	function show2()
	{
		document.getElementById('select_image').style.display = 'block';
		document.getElementById('image_url').style.display = 'none';
	}

	function show1()
	{
		document.getElementById('select_image').style.display = 'none';
		document.getElementById('image_url').style.display = 'block';
	}

	function reset(id, preview)
	{
		document.getElementById(id).value = "";
		document.getElementById(preview).src = "images/default-profile.png";
	}

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

	(function() {
		var editingRowByModal = {};
		var rowToDelete = null;
		var quickInfoIconList = ['home','apartment','cottage','house','hotel','groups','people','person','person_outline','face','verified','badge','workspace_premium','emoji_events','star','public','language','location_on','map','place','construction','foundation','build','architecture','engineering','trending_up','show_chart','timeline','insights','analytics','favorite','thumb_up','mood','support_agent','handshake','calendar_today','schedule','access_time','history','event','warning','task_alt','check_circle','gpp_good','bolt'];

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

		function appendRow(tbodyId, icon, title, description) {

		    var tbody = document.getElementById(tbodyId);

		    if (!tbody || !icon || !title || !description) {
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

		    // ICON
		    var iconTd = document.createElement('td');

		    var iconPreview = document.createElement('span');
		    iconPreview.className = 'material-icons';
		    iconPreview.textContent = icon;

		    iconTd.appendChild(iconPreview);

		    iconTd.appendChild(
		        createHiddenInput(prefix + '[icon][]', icon)
		    );

		    // TITLE
		    var titleTd = document.createElement('td');
		    titleTd.textContent = title;

		    titleTd.appendChild(
		        createHiddenInput(prefix + '[title][]', title)
		    );

		    // DESCRIPTION
		    var descriptionTd = document.createElement('td');
		    descriptionTd.textContent = description;

		    descriptionTd.appendChild(
		        createHiddenInput(prefix + '[description][]', description)
		    );

		    // ACTIONS
		    var actionTd = document.createElement('td');
		    actionTd.innerHTML = actionButtons();

		    row.appendChild(iconTd);
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
				document.getElementById('quickItemIconUiOnly').value = 'home';
				document.getElementById('quickItemIconUiPreview').textContent = 'home';
				document.getElementById('quickItemTitle').value = '';
				document.getElementById('quickItemDescription').value = '';
			} else if (modalId === 'addFeatureModal') {
				document.getElementById('featureIconUiOnly').value = 'home';
				document.getElementById('featureIconUiPreview').textContent = 'home';
				document.getElementById('featureTitle').value = '';
				document.getElementById('featureDescription').value = '';
			} else if (modalId === 'addMaterialModal') {
				document.getElementById('materialIconUiOnly').value = 'home';
				document.getElementById('materialIconUiPreview').textContent = 'home';
				document.getElementById('materialTitle').value = '';
				document.getElementById('materialDescription').value = '';
			}
			editingRowByModal[modalId] = null;
		}

		function handleSimpleSave(modalId, icon, title, description) {

		    var editingRow = editingRowByModal[modalId];

		    if (!icon || !title || !description) {
		        alert('Please fill all fields.');
		        return;
		    }

		    if (editingRow) {

		        var iconSpan = editingRow.cells[0].querySelector('.material-icons');

		        if (iconSpan) {
		            iconSpan.textContent = icon;
		        }

		        var iconHidden = editingRow.cells[0].querySelector(
		            'input[type="hidden"]'
		        );

		        if (iconHidden) {
		            iconHidden.value = icon;
		        }

		        editingRow.cells[1].childNodes[0].textContent = title;

		        var titleHidden = editingRow.cells[1].querySelector(
		            'input[type="hidden"]'
		        );

		        if (titleHidden) {
		            titleHidden.value = title;
		        }

		        editingRow.cells[2].childNodes[0].textContent = description;

		        var descriptionHidden = editingRow.cells[2].querySelector(
		            'input[type="hidden"]'
		        );

		        if (descriptionHidden) {
		            descriptionHidden.value = description;
		        }

		    } else {

		        appendRow(
		            modalConfig[modalId].tbodyId,
		            icon,
		            title,
		            description
		        );
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
			handleSimpleSave(
						        'addItemModal',
						        document.getElementById('quickItemIconUiOnly').value.trim(),
						        document.getElementById('quickItemTitle').value.trim(),
						        document.getElementById('quickItemDescription').value.trim()
						    );
		});

		document.getElementById('saveFeature').addEventListener('click', function() {
			handleSimpleSave(
						        'addFeatureModal',
						        document.getElementById('featureIconUiOnly').value.trim(),
						        document.getElementById('featureTitle').value.trim(),
						        document.getElementById('featureDescription').value.trim()
						    );
		});

		document.getElementById('saveMaterial').addEventListener('click', function() {
			handleSimpleSave(
						        'addMaterialModal',
						        document.getElementById('materialIconUiOnly').value.trim(),
						        document.getElementById('materialTitle').value.trim(),
						        document.getElementById('materialDescription').value.trim()
						    );
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

				    var icon = editRow.cells[0]
				        .querySelector('.material-icons');

				    var title = editRow.cells[1]
				        .childNodes[0]
				        .textContent
				        .trim();

				    var description = editRow.cells[2]
				        .childNodes[0]
				        .textContent
				        .trim();

				    document.getElementById('quickItemIconUiOnly').value =
				        icon ? icon.textContent.trim() : 'home';

				    document.getElementById('quickItemIconUiPreview').textContent =
				        icon ? icon.textContent.trim() : 'home';

				    document.getElementById('quickItemTitle').value = title;
				    document.getElementById('quickItemDescription').value = description;

				    setModalHeading('addItemModal', true);
				    openModal('addItemModal');
				}

				if (tbody.id === 'featureTableBody') {
				    editingRowByModal.addFeatureModal = editRow;

				    var icon = editRow.cells[0]
				        .querySelector('.material-icons');

				    document.getElementById('featureIconUiOnly').value =
				        icon ? icon.textContent.trim() : 'home';

				    document.getElementById('featureIconUiPreview').textContent =
				        icon ? icon.textContent.trim() : 'home';

				    document.getElementById('featureTitle').value =
				        editRow.cells[1].childNodes[0].textContent.trim();

				    document.getElementById('featureDescription').value =
				        editRow.cells[2].childNodes[0].textContent.trim();

				    setModalHeading('addFeatureModal', true);
				    openModal('addFeatureModal');
				}

				if (tbody.id === 'materialTableBody') {
				    editingRowByModal.addMaterialModal = editRow;

				    var icon = editRow.cells[0]
				        .querySelector('.material-icons');

				    document.getElementById('materialIconUiOnly').value =
				        icon ? icon.textContent.trim() : 'home';

				    document.getElementById('materialIconUiPreview').textContent =
				        icon ? icon.textContent.trim() : 'home';

				    document.getElementById('materialTitle').value =
				        editRow.cells[1].childNodes[0].textContent.trim();

				    document.getElementById('materialDescription').value =
				        editRow.cells[2].childNodes[0].textContent.trim();

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

		var iconModalEl = document.getElementById('quickInfoMaterialIconModal');
		var iconGridEl = document.getElementById('quickInfoIconGrid');
		var iconSearchEl = document.getElementById('quickInfoIconSearch');

		var currentIconTarget = 'quickInfo';

		var iconTargets = {
		    quickInfo: {
		        input: 'quickItemIconUiOnly',
		        preview: 'quickItemIconUiPreview',
		        modal: 'addItemModal'
		    },

		    feature: {
		        input: 'featureIconUiOnly',
		        preview: 'featureIconUiPreview',
		        modal: 'addFeatureModal'
		    },

		    material: {
		        input: 'materialIconUiOnly',
		        preview: 'materialIconUiPreview',
		        modal: 'addMaterialModal'
		    }
		};

		if (iconGridEl) {

		    quickInfoIconList.forEach(function(name) {

		        var btn = document.createElement('button');

		        btn.type = 'button';
		        btn.className = 'icon-picker-item';
		        btn.setAttribute('data-icon', name);
		        btn.setAttribute('title', name);

		        btn.innerHTML =
		            '<span class="material-icons">' + name + '</span>' +
		            '<span class="icon-picker-label">' + name + '</span>';

		        iconGridEl.appendChild(btn);
		    });
		}

		if (iconSearchEl) {

		    iconSearchEl.addEventListener('input', function() {

		        var term = this.value.toLowerCase();

		        var pickerItems =
		            document.querySelectorAll(
		                '#quickInfoIconGrid .icon-picker-item'
		            );

		        Array.prototype.forEach.call(
		            pickerItems,
		            function(item) {

		                var name =
		                    item.getAttribute('data-icon').toLowerCase();

		                item.style.display =
		                    name.indexOf(term) !== -1
		                        ? 'inline-flex'
		                        : 'none';
		            }
		        );
		    });
		}

		/* --------------------------------
		   OPEN ICON MODAL
		-------------------------------- */

		window.openQuickInfoIconModal = function(target) {

		    currentIconTarget = target || 'quickInfo';

		    if (!iconTargets[currentIconTarget]) {
		        currentIconTarget = 'quickInfo';
		    }

		    var targetConfig = iconTargets[currentIconTarget];

		    // Reset search
		    if (iconSearchEl) {
		        iconSearchEl.value = '';
		    }

		    var pickerItems = document.querySelectorAll(
		        '#quickInfoIconGrid .icon-picker-item'
		    );

		    // Show all icons and remove previous selection
		    Array.prototype.forEach.call(
		        pickerItems,
		        function(item) {
		            item.style.display = 'inline-flex';
		            item.classList.remove('selected');
		        }
		    );

		    // Get current icon from the input.
		    // If empty, use home.
		    var input = document.getElementById(targetConfig.input);
		    var preview = document.getElementById(targetConfig.preview);

		    var currentIcon = input && input.value.trim()
		        ? input.value.trim()
		        : 'home';

		    // Make sure input + preview have the icon
		    if (input) {
		        input.value = currentIcon;
		    }

		    if (preview) {
		        preview.textContent = currentIcon;
		    }

		    // Select the current icon in the picker
		    var selectedItem = document.querySelector(
		        '#quickInfoIconGrid .icon-picker-item[data-icon="' +
		        CSS.escape(currentIcon) +
		        '"]'
		    );

		    // If current icon isn't in the list, select home
		    if (!selectedItem) {
		        currentIcon = 'home';

		        if (input) {
		            input.value = 'home';
		        }

		        if (preview) {
		            preview.textContent = 'home';
		        }

		        selectedItem = document.querySelector(
		            '#quickInfoIconGrid .icon-picker-item[data-icon="home"]'
		        );
		    }

		    if (selectedItem) {
		        selectedItem.classList.add('selected');
		    }

		    // Show icon modal ON TOP of the current modal
		    if (iconModalEl) {
		        bootstrap.Modal
		            .getOrCreateInstance(iconModalEl, {
		                backdrop: true,
		                focus: true
		            })
		            .show();
		    }
		};

		/* --------------------------------
		   SELECT ICON
		-------------------------------- */

		if (iconGridEl) {

		    iconGridEl.addEventListener('click', function(event) {

		        var iconItem =
		            event.target.closest('.icon-picker-item');

		        if (!iconItem) {
		            return;
		        }

		        var iconName =
		            iconItem.getAttribute('data-icon');

		        var target =
		            iconTargets[currentIconTarget];

		        var input =
		            document.getElementById(target.input);

		        var preview =
		            document.getElementById(target.preview);

		        // Remove previous selected state
		        var selectedItems = document.querySelectorAll(
		            '#quickInfoIconGrid .icon-picker-item.selected'
		        );

		        Array.prototype.forEach.call(
		            selectedItems,
		            function(item) {
		                item.classList.remove('selected');
		            }
		        );

		        // Select clicked icon
		        iconItem.classList.add('selected');

		        if (input) {
		            input.value = iconName;
		        }

		        if (preview) {
		            preview.textContent = iconName;
		        }

		        // Close ONLY icon picker
		        if (iconModalEl) {

		            var iconModal =
		                bootstrap.Modal.getInstance(iconModalEl);

		            if (iconModal) {
		                iconModal.hide();
		            }
		        }
		    });
		}

		if (iconModalEl) {

		    iconModalEl.addEventListener(
		        'hidden.bs.modal',
		        function() {

		            var backdrop =
		                document.querySelector(
		                    '.modal-backdrop.icon-picker-backdrop'
		                );

		            if (backdrop) {
		                backdrop.classList.remove('icon-picker-backdrop');
		            }

		        }
		    );
		}

		/* --------------------------------
		   MANUAL ICON INPUT
		-------------------------------- */

		[
		    {
		        input: 'quickItemIconUiOnly',
		        preview: 'quickItemIconUiPreview'
		    },
		    {
		        input: 'featureIconUiOnly',
		        preview: 'featureIconUiPreview'
		    },
		    {
		        input: 'materialIconUiOnly',
		        preview: 'materialIconUiPreview'
		    }
		].forEach(function(item) {

		    var input =
		        document.getElementById(item.input);

		    var preview =
		        document.getElementById(item.preview);

		    if (input && preview) {

		        input.addEventListener('input', function() {

		            preview.textContent =
		                this.value.trim() || 'home';
		        });
		    }
		});
	})();
</script>
