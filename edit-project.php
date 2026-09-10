<?php
	error_reporting(0);
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Projects";
	
	$id = $_GET['id'];
	$query3 = mysqli_query($con, "SELECT * FROM project_types WHERE id=$id");
	$b = mysqli_fetch_assoc($query3);

	if (isset($_POST['update']))
	{
		$Updated = false;
		$page = "Update";
		$metaTitle = $_POST['metaTitle'];
		$keyword = $_POST['keyword'];
		$disc = $_POST['disc'];
		$subtitle = mysqli_real_escape_string($con, $_POST['small_heading']);
		$title = mysqli_real_escape_string($con, $_POST['title']);
		$BannerDesc = mysqli_real_escape_string($con, $_POST['banner_desc']);
		$cat = $_POST['cat'];
		$order = $_POST['order'];
		$status = $_POST['status'];
		$editor1 = mysqli_real_escape_string($con, $_POST['editor1']);
		$quote = mysqli_real_escape_string($con, $_POST['quote']);
		$client_name = mysqli_real_escape_string($con, $_POST['client_name']);
		$designation = mysqli_real_escape_string($con, $_POST['designation']);
		$company = mysqli_real_escape_string($con, $_POST['company']);
		$back_color = $_POST['back_color'];
		$text_color = $_POST['text_color'];
		$accent_color = $_POST['accent_color'];
		$border = $_POST['border'];
		$imageUrl = isset($_POST['image']) ? trim($_POST['image']) : '';
		$myFile = isset($_FILES['myFile']['name']) ? $_FILES['myFile']['name'] : '';

		$path = "uploads/pageimages/project/types/";
		$path_original = "uploads/pageimages/project/types/";

		if ($imageUrl === '')
		{
			if ($myFile === '')
			{
				mysqli_query($con, "UPDATE project_types SET subtitle='$subtitle', title='$title', banner_desc='$BannerDesc', content='$editor1', metatitle='$metaTitle', keyword='$keyword', discription='$disc', category='$cat', order_no='$order', quote='$quote', client_name='$client_name', designation='$designation', company='$company', back_color='$back_color', text_color='$text_color', accent_color='$accent_color', border='$border', status='$status' WHERE id=$id");
				$Updated = true;
			}
			elseif ($myFile != '' && (file_exists("uploads/pageimages/" . $myFile) || file_exists("uploads/pageimages/addgallery/" . $myFile) || file_exists("uploads/pageimages/addgallery/project/" . $myFile) || file_exists("uploads/pageimages/addgallery/resort/" . $myFile) || file_exists("uploads/pageimages/blogs/" . $myFile) || file_exists("uploads/pageimages/blogs/single/" . $myFile) || file_exists("uploads/pageimages/contact/" . $myFile) || file_exists("uploads/pageimages/nav/" . $myFile) || file_exists("uploads/pageimages/nav/category/" . $myFile) || file_exists("uploads/pageimages/nav/types/" . $myFile) || file_exists("uploads/pageimages/project/" . $myFile) || file_exists("uploads/pageimages/project/category/" . $myFile) || file_exists("uploads/pageimages/project/types/" . $myFile) || file_exists("uploads/pageimages/resort/" . $myFile) || file_exists("uploads/pageimages/resort/category/" . $myFile) || file_exists("uploads/pageimages/resort/types/" . $myFile) || file_exists("uploads/pageimages/slider/" . $myFile) || file_exists("uploads/pageimages/youtube/" . $myFile)))
			{
				$FileExists = true;
		   	$_SESSION['BannerColor'] = "background-color:#FF0000;";
		   	$_SESSION['Message'] = "Selected image already exists!";
		   	echo "<script>window.location.href='edit-project.php?id=$id';</script>";
			   exit;
			}
			else
			{
				move_uploaded_file($_FILES['myFile']['tmp_name'], $path . $myFile);
				$path = $path_original . $myFile;

				mysqli_query($con, "UPDATE project_types SET subtitle='$subtitle', title='$title', banner_desc='$BannerDesc', content='$editor1', image='', local_path='$path', metatitle='$metaTitle', keyword='$keyword', discription='$disc', category='$cat', order_no='$order', quote='$quote', client_name='$client_name', designation='$designation', company='$company', back_color='$back_color', text_color='$text_color', accent_color='$accent_color', border='$border', status='$status' WHERE id=$id");
				$Updated = true;
			}
		}
		else
		{
			mysqli_query($con, "UPDATE project_types SET subtitle='$subtitle', title='$title', banner_desc='$BannerDesc', content='$editor1', image='$imageUrl', local_path='', metatitle='$metaTitle', keyword='$keyword', discription='$disc', category='$cat', order_no='$order', quote='$quote', client_name='$client_name', designation='$designation', company='$company', back_color='$back_color', text_color='$text_color', accent_color='$accent_color', border='$border', status='$status' WHERE id=$id");
			$Updated = true;
		}

		if($Updated)
		{
			$CurrentDateTime = Date("Y-m-d H:i:s");
			mysqli_query($con, "DELETE FROM project_details WHERE project_id=$id AND category='Project Info'");
			mysqli_query($con, "DELETE FROM project_details WHERE project_id=$id AND category='Challenges'");
			mysqli_query($con, "DELETE FROM project_details WHERE project_id=$id AND category='Solutions'");

			if (isset($_POST['project_info']) && !empty($_POST['project_info']))
			{
				foreach ($_POST['project_info'] as $item)
				{
					$icon = isset($item['icon']) ? trim($item['icon']) : '';
			   	$title = isset($item['title']) ? trim($item['title']) : '';
			   	$description = isset($item['description']) ? trim($item['description']) : '';

			   	if ($icon != '' && $title != '')
			   	{
			   		$title = mysqli_real_escape_string($con, $title);
			   		$description = mysqli_real_escape_string($con, $description);
			   		$subtitle = mysqli_real_escape_string($con, $_POST['small_heading']);
			        	mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, created_at) VALUES ('$id', 'Project Info', '$title', '$description', '$icon', '$CurrentDateTime')");
			   	}
				}
			}

			if (isset($_POST['challenges']) && !empty($_POST['challenges']))
			{
				foreach ($_POST['challenges'] as $item)
				{
					$title = "Challenges";
			   	$icon = "task_alt";
			   	$description = isset($item['description']) ? trim($item['description']) : '';
			   	$orderNo = isset($item['order']) ? (int)$item['order'] : 0;

			    	if ($description != '')
			    	{
			    		$title = mysqli_real_escape_string($con, $title);
			    		$description = mysqli_real_escape_string($con, $description);
			   		$subtitle = mysqli_real_escape_string($con, $_POST['small_heading']);
			      	mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, sort_order, created_at) VALUES ('$id', 'Challenges', '$title', '$description', '$icon', '$orderNo', '$CurrentDateTime')");
			   	}
				}
			}

			if (isset($_POST['solutions']) && !empty($_POST['solutions']))
			{
				foreach ($_POST['solutions'] as $item)
				{
					$title = "Solutions";
				   $icon = "check_circle";
				   $description = isset($item['description']) ? trim($item['description']) : '';
				   $orderNo = isset($item['order']) ? (int)$item['order'] : 0;

			   	if ($description != '')
			   	{
			   		$title = mysqli_real_escape_string($con, $title);
			   		$description = mysqli_real_escape_string($con, $description);
			      	mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, sort_order, created_at) VALUES ('$id', 'Solutions', '$title', '$description', '$icon', '$orderNo', '$CurrentDateTime')");
			   	}
				}
			}

			$_SESSION['BannerColor'] = "background-color:#4BB543;";
      	$_SESSION['Message'] = "Updated Successfully!";
      	echo "<script>window.location.href='edit-project.php?id=$id';</script>";
	     	exit;
		}
	}
?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<form action="" enctype="multipart/form-data" method="post" id="editProjectTypesForm">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Edit Project Types</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Projects</span><span class="crumb-sep">&gt;</span><span>Edit</span>
								</div>
							</div>
							<div class="listing-cta">
								<a href="projects-listing.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<input type="submit" class="btn btn-success btn-sm" id="btnn" name="update" value="Save" form="editProjectTypesForm">
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
											<textarea name="metaTitle" id="metaTitle" class="form-control" placeholder="Enter Meta Title"><?php echo $b['metatitle']; ?></textarea>
										</div>
									</div>
									<div class="col-md-4">
										<div class="commonSection">
											<label>Meta Keyword</label>
											<textarea name="keyword" id="metaKeyword" class="form-control" placeholder="Enter Meta Keyword"><?php echo $b['keyword']; ?></textarea>
										</div>
									</div>
									<div class="col-md-4">
										<div class="commonSection">
											<label>Meta Description</label>
											<textarea name="disc" id="metaDescription" class="form-control" placeholder="Enter Meta Description"><?php echo $b['discription']; ?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card mb-30">
							<div class="card-header">Project Overview Content</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-3 col-md-6">
										<div class="commonSection">
											<label>Section Small Title</label>
											<input type="text" class="form-control" name="small_heading" id="small_heading_ui" placeholder="PROJECT OVERVIEW" value="PROJECT OVERVIEW">
										</div>
									</div>
									<div class="col-lg-5 col-md-6">
										<div class="commonSection">
											<label>Main Heading</label>
											<input class="form-control" type="text" required name="title" id="title" value="<?php echo $b['title']; ?>" placeholder="Enter main heading">
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection">
											<label>Category</label>
											<select class="form-control" name="cat" required>
												<option value="<?php echo $b['category']; ?>"><?php echo $b['category']; ?></option>
												<?php
													$queryl = mysqli_query($con, "SELECT * FROM project_category");
													while($l = mysqli_fetch_assoc($queryl)) {
												?>
													<option value="<?php echo $l['title']; ?>"><?php echo $l['title']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection">
											<label>Order No.</label>
											<input class="form-control" type="number" name="order" id="order" value="<?php echo $b['order_no']; ?>" placeholder="1">
										</div>
									</div>
									<div class="col-md-8">
										<div class="commonSection mb-0">
											<label>Description</label>
											<textarea name="editor1" id="editor1" class="form-control" rows="5" required placeholder="Enter description"><?php echo $b['content']; ?></textarea>
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
									<div class="col-md-4">
										<div class="commonSection">
											<label>Banner Description</label>
											<textarea class="form-control" name="banner_desc" id="banner_desc" rows="5" required placeholder="Enter banner description"><?php echo $b['banner_desc']; ?></textarea>
										</div>

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

						<div class="card mb-30">
							<div class="card-header">
								<span>Project Information List</span>
								<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#projectInfoModal">+ Add New Item</button>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered table-sm mb-0 listing-table">
										<thead>
											<tr>
												<th>Icon</th>
												<th>Title</th>
												<th>Description</th>
												<th style="width:140px;">Actions</th>
											</tr>
										</thead>
										<tbody id="projectInfoTableBody" data-empty-cols="4">
											<?php
												$Result = mysqli_query($con, "SELECT * FROM project_details WHERE project_id=$id AND category='Project Info'");
												$i=0;
												while($Row = mysqli_fetch_assoc($Result)) {
											?>
												<tr>
													<td data-icon="<?php echo $Row['icon']; ?>"><span class="material-icons"><?php echo $Row['icon']; ?></span></td>
													<td><?php echo $Row['title']; ?></td>
													<td><?php echo $Row['description']; ?></td>
													<td>
														<div class="action-btn-group">
															<button type="button" class="btn btn-sm btn-outline-success js-edit-row" title="Edit"><i class="feather icon-edit-2"></i></button>
															<button type="button" class="btn btn-sm btn-outline-danger js-delete-row" title="Delete"><i class="feather icon-trash-2"></i></button>
														</div>
													</td>
												</tr>
											<?php $i++; } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header">
										<span>Challenges List</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#challengeModal">+ Add Challenge</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Description</th>
														<th>Order</th>
														<th style="width:140px;">Actions</th>
													</tr>
												</thead>
												<tbody id="challengeTableBody" data-empty-cols="5">
													<?php
														$Result = mysqli_query($con, "SELECT * FROM project_details WHERE project_id=$id AND category='Challenges'");
														$i=0;
														while($Row = mysqli_fetch_assoc($Result)) {
													?>
														<tr>
															<td><?php echo $Row['description']; ?></td>
															<td><?php echo $Row['sort_order']; ?></td>
															<td>
																<div class="action-btn-group">
																	<button type="button" class="btn btn-sm btn-outline-success js-edit-row" title="Edit"><i class="feather icon-edit-2"></i></button>
																	<button type="button" class="btn btn-sm btn-outline-danger js-delete-row" title="Delete"><i class="feather icon-trash-2"></i></button>
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
										<span>Solutions List</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#solutionModal">+ Add Solution</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Description</th>
														<th>Order</th>
														<th style="width:140px;">Actions</th>
													</tr>
												</thead>
												<tbody id="solutionTableBody" data-empty-cols="5">
													<?php
														$Result = mysqli_query($con, "SELECT * FROM project_details WHERE project_id=$id AND category='Solutions'");
														$i=0;
														while($Row = mysqli_fetch_assoc($Result)) {
													?>
														<tr>
															<td><?php echo $Row['description']; ?></td>
															<td><?php echo $Row['sort_order']; ?></td>
															<td>
																<div class="action-btn-group">
																	<button type="button" class="btn btn-sm btn-outline-success js-edit-row" title="Edit"><i class="feather icon-edit-2"></i></button>
																	<button type="button" class="btn btn-sm btn-outline-danger js-delete-row" title="Delete"><i class="feather icon-trash-2"></i></button>
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
						</div>

						<div class="card mb-30">
							<div class="card-header">Testimonial Card Section</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-6 col-md-12">
										<div class="commonSection">
											<label>Quote</label>
											<textarea class="form-control" name="quote" rows="5" placeholder="Enter testimonial quote"><?php echo $b['quote']; ?></textarea>
										</div>
									</div>
									<div class="col-lg-3 col-md-6">
										<div class="commonSection">
											<label>Client Name</label>
											<input class="form-control" type="text" name="client_name" value="<?php echo $b['client_name']; ?>" placeholder="Client name">
										</div>
									</div>
									<div class="col-lg-3 col-md-6">
										<div class="commonSection mb-0">
											<label>Location</label>
											<input class="form-control" type="text" name="company" value="<?php echo $b['company']; ?>" placeholder="Location">
										</div>
									</div>
									<div class="col-lg-3 col-md-6" style="display: none;">
										<div class="commonSection">
											<label>Designation</label>
											<input class="form-control" type="text" name="designation" value="<?php echo $b['designation']; ?>" placeholder="Designation">
										</div>
									</div>
									<div class="col-lg-2 col-md-6" style="display: none;">
										<div class="commonSection mb-0">
											<label>Background Color</label>
											<input class="form-control" type="text" name="back_color" value="<?php echo $b['back_color']; ?>" placeholder="#0E3528">
										</div>
									</div>
									<div class="col-lg-2 col-md-6" style="display: none;">
										<div class="commonSection mb-0">
											<label>Text Color</label>
											<input class="form-control" type="text" name="text_color" value="<?php echo $b['text_color']; ?>" placeholder="#FFFFFF">
										</div>
									</div>
									<div class="col-lg-2 col-md-6" style="display: none;">
										<div class="commonSection mb-0">
											<label>Accent Color</label>
											<input class="form-control" type="text" name="accent_color" value="<?php echo $b['accent_color']; ?>" placeholder="#C9A45A">
										</div>
									</div>
									<div class="col-lg-2 col-md-6" style="display: none;">
										<div class="commonSection mb-0">
											<label>Border Radius</label>
											<input class="form-control" type="number" name="border" value="<?php echo $b['border']; ?>" placeholder="12">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-12">
							<div class="card mb-30">
								<div class="card-header">Banner Image</div>
								<div class="card-body">
									<div class="banner-image-upload">
										<?php
											$imagePath = "images/default-profile.png";
											if(isset($b['local_path']) && $b['local_path'] != '')
											{
												$imagePath = $b['local_path'];
											}
											else if (isset($b['image']) && $b['image'] != '')
											{
												$imagePath = $b['image'];
											}
										?>
										<img src="<?php echo $imagePath; ?>" class="banner-image-preview" id="imgPreview" alt="Banner Image" onerror="this.src='images/default-profile.png';">
										<div class="banner-recommended-size">Recommended size: 1920x800px</div>
										<div class="radio-inline-group" style="margin-top: 12px;">
											<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();" <?php echo ($b['image'] != '') ? 'checked' : ''; ?>>Image URL</label>
											<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" <?php echo ($b['local_path'] != '') ? 'checked' : ''; ?>>Select New Image</label>
										</div>

										<div id="image_url" style="margin-top: 12px; display: <?php echo ($b['image'] != '') ? 'block' : 'none'; ?>;">
											<input class="form-control banner-form-control" type="text" name="image" id="image" placeholder="Enter image URL" value="<?php echo $b['image']; ?>">
										</div>

										<div id="select_image" style="margin-top: 12px; display: <?php echo ($b['local_path'] != '') ? 'block' : 'none'; ?>">
											<input type="hidden" name="banner_image" value="<?php echo $b['local_path']; ?>">
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

						<!-- Dynamic Project Information form inputs -->
						<div id="projectInfoHiddenInputs"></div>

						<!-- Dynamic Challenges form inputs -->
						<div id="challengeHiddenInputs"></div>

						<!-- Dynamic Solutions form inputs -->
						<div id="solutionHiddenInputs"></div>

						<input type="hidden" name="sub" value="1">
					</form>

					<div class="modal fade" id="projectInfoModal" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Project Information</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<div class="commonSection">
										<label>Icon</label>
										<div class="counter-icon-box">
											<div class="counter-icon-preview">
												<span class="material-icons" id="piIconPreview">home</span>
											</div>
											<input type="hidden" id="piIcon" value="home">
											<button type="button" class="btn btn-success btn-sm" data-icon-target="pi" onclick="openProjectIconPicker('pi')"><i class="feather icon-edit"></i> Change Icon</button>
											<div class="counter-icon-help" id="piSelectedIconName">Selected: home</div>
										</div>
									</div>
									<div class="commonSection"><label>Title</label><input type="text" class="form-control" id="piTitle" placeholder="Client"></div>
									<div class="commonSection mb-0"><label>Description</label><textarea class="form-control" id="piDescription" rows="3" placeholder="The Villa Tent Hospitality Partner"></textarea></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-success" id="saveProjectInfo">Add Item</button>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="challengeModal" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Challenge</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<div class="commonSection"><label>Description</label><textarea class="form-control" id="challengeDescription" rows="3" placeholder="Enter description"></textarea></div>
									<div class="commonSection mb-0"><label>Order</label><input type="number" class="form-control" id="challengeOrder" placeholder="1"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-success" id="saveChallenge">Add Challenge</button>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="solutionModal" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Solution</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<div class="commonSection"><label>Description</label><textarea class="form-control" id="solutionDescription" rows="3" placeholder="Enter description"></textarea></div>
									<div class="commonSection mb-0"><label>Order</label><input type="number" class="form-control" id="solutionOrder" placeholder="1"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-success" id="saveSolution">Add Solution</button>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="projectIconPickerModal" tabindex="-1" aria-labelledby="projectIconPickerModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="projectIconPickerModalLabel">Select Material Icon</h5>
									<a href="https://fonts.google.com/icons" target="_blank" class="btn btn-link btn-sm">Browse all icons <i class="feather icon-external-link"></i></a>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<input type="text" class="form-control mb-3" id="project_icon_search" placeholder="Search icons...">
									<div class="icon-picker-grid" id="project_icon_grid"></div>
								</div>
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
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once('common/footer.php'); ?>

<script>
	(function () {

		var rowToDelete = null;

		var editingState = {
			projectInfo: null,
			challenge: null,
			solution: null
		};

		var activeIconTarget = null;

		/* =========================================================
		   HELPERS
		========================================================= */

		function openModal(id) {
			var modalEl = document.getElementById(id);

			if (!modalEl) {
				return;
			}

			bootstrap.Modal
				.getOrCreateInstance(modalEl)
				.show();
		}

		function closeModal(id) {
			var modalEl = document.getElementById(id);

			if (!modalEl) {
				return;
			}

			var modal = bootstrap.Modal.getInstance(modalEl);

			if (modal) {
				modal.hide();
			}
		}

		function escapeHtml(value) {
			var div = document.createElement('div');

			div.textContent = value || '';

			return div.innerHTML;
		}

		function ensureEmptyState(tbodyId) {

			var tbody = document.getElementById(tbodyId);

			if (!tbody) {
				return;
			}

			var rows = Array.prototype.slice.call(
				tbody.querySelectorAll('tr')
			).filter(function (row) {
				return !row.classList.contains('no-record-row');
			});

			var emptyRow = tbody.querySelector('.no-record-row');

			if (rows.length === 0) {

				if (!emptyRow) {

					emptyRow = document.createElement('tr');

					emptyRow.className = 'no-record-row';

					emptyRow.innerHTML =
						'<td colspan="' +
						(tbody.getAttribute('data-empty-cols') || '4') +
						'">' +
						'No record found. Click on Add.' +
						'</td>';

					tbody.appendChild(emptyRow);
				}

			} else if (emptyRow) {

				emptyRow.remove();
			}
		}

		function actionButtons() {

			return `
				<div class="action-btn-group">

					<button
						type="button"
						class="btn btn-sm btn-outline-success js-edit-row"
						title="Edit">
						<i class="feather icon-edit-2"></i>
					</button>

					<button
						type="button"
						class="btn btn-sm btn-outline-danger js-delete-row"
						title="Delete">
						<i class="feather icon-trash-2"></i>
					</button>

				</div>
			`;
		}


		/* =========================================================
		   ADD PROJECT INFO
		========================================================= */

		function appendProjectInfoRow(icon, title, description) {

			var tbody =
				document.getElementById('projectInfoTableBody');

			if (!tbody) {
				return;
			}

			var emptyRow =
				tbody.querySelector('.no-record-row');

			if (emptyRow) {
				emptyRow.remove();
			}

			var row =
				document.createElement('tr');

			row.innerHTML = `

				<td data-icon="${escapeHtml(icon)}">

					<span class="material-icons">
						${escapeHtml(icon)}
					</span>

					<div class="counter-icon-help">
						${escapeHtml(icon)}
					</div>

				</td>

				<td>
					${escapeHtml(title)}
				</td>

				<td>
					${escapeHtml(description)}
				</td>

				<td>
					${actionButtons()}
				</td>
			`;

			tbody.appendChild(row);

			updateDynamicFormInputs();
		}


		/* =========================================================
		   ADD CHALLENGE
		========================================================= */

		function appendChallengeRow(description, order) {

			var tbody =
				document.getElementById('challengeTableBody');

			if (!tbody) {
				return;
			}

			var emptyRow =
				tbody.querySelector('.no-record-row');

			if (emptyRow) {
				emptyRow.remove();
			}

			var row =
				document.createElement('tr');

			row.innerHTML = `

				<td>
					${escapeHtml(description)}
				</td>

				<td>
					${escapeHtml(order)}
				</td>

				<td>
					${actionButtons()}
				</td>
			`;

			tbody.appendChild(row);

			updateDynamicFormInputs();
		}


		/* =========================================================
		   ADD SOLUTION
		========================================================= */

		function appendSolutionRow(description, order) {

			var tbody =
				document.getElementById('solutionTableBody');

			if (!tbody) {
				return;
			}

			var emptyRow =
				tbody.querySelector('.no-record-row');

			if (emptyRow) {
				emptyRow.remove();
			}

			var row =
				document.createElement('tr');

			row.innerHTML = `

				<td>
					${escapeHtml(description)}
				</td>

				<td>
					${escapeHtml(order)}
				</td>

				<td>
					${actionButtons()}
				</td>
			`;

			tbody.appendChild(row);

			updateDynamicFormInputs();
		}


		/* =========================================================
		   PROJECT INFO SAVE / UPDATE
		========================================================= */

		document
			.getElementById('saveProjectInfo')
			.addEventListener('click', function () {

				var icon =
					document.getElementById('piIcon').value.trim();

				var title =
					document.getElementById('piTitle').value.trim();

				var description =
					document.getElementById('piDescription').value.trim();


				if (!icon || !title || !description) {

					alert(
						'Please fill all Project Information fields.'
					);

					return;
				}


				/* EDIT */

				if (editingState.projectInfo) {

					var row =
						editingState.projectInfo;

					row.cells[0]
						.setAttribute('data-icon', icon);

					row.cells[0].innerHTML =

						'<span class="material-icons">' +
						escapeHtml(icon) +
						'</span>' +

						'<div class="counter-icon-help">' +
						escapeHtml(icon) +
						'</div>';

					row.cells[1].textContent =
						title;

					row.cells[2].textContent =
						description;

				}

				/* ADD */

				else {

					appendProjectInfoRow(
						icon,
						title,
						description
					);
				}


				updateDynamicFormInputs();

				closeModal('projectInfoModal');

				resetProjectInfoModal();
			});


		/* =========================================================
		   CHALLENGE SAVE / UPDATE
		========================================================= */

		document
			.getElementById('saveChallenge')
			.addEventListener('click', function () {

				var description =
					document
						.getElementById('challengeDescription')
						.value
						.trim();

				var order =
					document
						.getElementById('challengeOrder')
						.value
						.trim();


				if (!description || !order) {

					alert(
						'Please fill all Challenge fields.'
					);

					return;
				}


				/* EDIT */

				if (editingState.challenge) {

					var row =
						editingState.challenge;

					row.cells[0].textContent =
						description;

					row.cells[1].textContent =
						order;

				}

				/* ADD */

				else {

					appendChallengeRow(
						description,
						order
					);
				}


				updateDynamicFormInputs();

				closeModal('challengeModal');

				resetChallengeModal();
			});


		/* =========================================================
		   SOLUTION SAVE / UPDATE
		========================================================= */

		document
			.getElementById('saveSolution')
			.addEventListener('click', function () {

				var description =
					document
						.getElementById('solutionDescription')
						.value
						.trim();

				var order =
					document
						.getElementById('solutionOrder')
						.value
						.trim();


				if (!description || !order) {

					alert(
						'Please fill all Solution fields.'
					);

					return;
				}


				/* EDIT */

				if (editingState.solution) {

					var row =
						editingState.solution;

					row.cells[0].textContent =
						description;

					row.cells[1].textContent =
						order;

				}

				/* ADD */

				else {

					appendSolutionRow(
						description,
						order
					);
				}


				updateDynamicFormInputs();

				closeModal('solutionModal');

				resetSolutionModal();
			});


		/* =========================================================
		   EDIT / DELETE BUTTONS
		========================================================= */

		document.addEventListener(
			'click',
			function (event) {

				/* =====================
				   EDIT
				===================== */

				var editBtn =
					event.target.closest('.js-edit-row');

				if (editBtn) {

					var row =
						editBtn.closest('tr');

					var tbody =
						row ? row.closest('tbody') : null;

					if (!row || !tbody) {
						return;
					}


					/* PROJECT INFO */

					if (
						tbody.id ===
						'projectInfoTableBody'
					) {

						editingState.projectInfo =
							row;

						var icon =
							row.cells[0]
								.getAttribute('data-icon') ||
							'home';

						document
							.getElementById('piIcon')
							.value = icon;

						document
							.getElementById('piIconPreview')
							.textContent = icon;

						document
							.getElementById('piSelectedIconName')
							.textContent =
							'Selected: ' + icon;

						document
							.getElementById('piTitle')
							.value =
							row.cells[1]
								.textContent
								.trim();

						document
							.getElementById('piDescription')
							.value =
							row.cells[2]
								.textContent
								.trim();

						document
							.getElementById('saveProjectInfo')
							.textContent =
							'Update';

						document
							.querySelector(
								'#projectInfoModal .modal-title'
							)
							.textContent =
							'Edit Project Information';

						openModal(
							'projectInfoModal'
						);

						return;
					}


					/* CHALLENGE */

					if (
						tbody.id ===
						'challengeTableBody'
					) {

						editingState.challenge =
							row;

						document
							.getElementById('challengeDescription')
							.value =
							row.cells[0]
								.textContent
								.trim();

						document
							.getElementById('challengeOrder')
							.value =
							row.cells[1]
								.textContent
								.trim();

						document
							.getElementById('saveChallenge')
							.textContent =
							'Update';

						document
							.querySelector(
								'#challengeModal .modal-title'
							)
							.textContent =
							'Edit Challenge';

						openModal(
							'challengeModal'
						);

						return;
					}


					/* SOLUTION */

					if (
						tbody.id ===
						'solutionTableBody'
					) {

						editingState.solution =
							row;

						document
							.getElementById('solutionDescription')
							.value =
							row.cells[0]
								.textContent
								.trim();

						document
							.getElementById('solutionOrder')
							.value =
							row.cells[1]
								.textContent
								.trim();

						document
							.getElementById('saveSolution')
							.textContent =
							'Update';

						document
							.querySelector(
								'#solutionModal .modal-title'
							)
							.textContent =
							'Edit Solution';

						openModal(
							'solutionModal'
						);

						return;
					}
				}


				/* =====================
				   DELETE
				===================== */

				var deleteBtn =
					event.target.closest('.js-delete-row');

				if (deleteBtn) {

					rowToDelete =
						deleteBtn.closest('tr');

					openModal(
						'confirmDeleteModal'
					);
				}
			}
		);


		/* =========================================================
		   CONFIRM DELETE
		========================================================= */

		document
			.getElementById('confirmDeleteYes')
			.addEventListener('click', function () {

				if (!rowToDelete) {
					return;
				}

				var tbody =
					rowToDelete.closest('tbody');

				rowToDelete.remove();

				updateDynamicFormInputs();

				if (tbody) {
					ensureEmptyState(
						tbody.id
					);
				}

				rowToDelete = null;

				closeModal(
					'confirmDeleteModal'
				);
			});


		document
			.getElementById('confirmDeleteModal')
			.addEventListener(
				'hidden.bs.modal',
				function () {

					rowToDelete = null;
				}
			);


		/* =========================================================
		   RESET MODALS
		========================================================= */

		function resetProjectInfoModal() {

			document
				.getElementById('piIcon')
				.value = 'home';

			document
				.getElementById('piIconPreview')
				.textContent = 'home';

			document
				.getElementById('piSelectedIconName')
				.textContent =
				'Selected: home';

			document
				.getElementById('piTitle')
				.value = '';

			document
				.getElementById('piDescription')
				.value = '';

			document
				.getElementById('saveProjectInfo')
				.textContent =
				'Add Item';

			document
				.querySelector(
					'#projectInfoModal .modal-title'
				)
				.textContent =
				'Add Project Information';

			editingState.projectInfo =
				null;
		}


		function resetChallengeModal() {

			document
				.getElementById('challengeDescription')
				.value = '';

			document
				.getElementById('challengeOrder')
				.value = '';

			document
				.getElementById('saveChallenge')
				.textContent =
				'Add Challenge';

			document
				.querySelector(
					'#challengeModal .modal-title'
				)
				.textContent =
				'Add Challenge';

			editingState.challenge =
				null;
		}


		function resetSolutionModal() {

			document
				.getElementById('solutionDescription')
				.value = '';

			document
				.getElementById('solutionOrder')
				.value = '';

			document
				.getElementById('saveSolution')
				.textContent =
				'Add Solution';

			document
				.querySelector(
					'#solutionModal .modal-title'
				)
				.textContent =
				'Add Solution';

			editingState.solution =
				null;
		}


		document
			.getElementById('projectInfoModal')
			.addEventListener(
				'hidden.bs.modal',
				resetProjectInfoModal
			);

		document
			.getElementById('challengeModal')
			.addEventListener(
				'hidden.bs.modal',
				resetChallengeModal
			);

		document
			.getElementById('solutionModal')
			.addEventListener(
				'hidden.bs.modal',
				resetSolutionModal
			);


		/* =========================================================
		   ICON PICKER
		========================================================= */

		var iconList = [
			'home',
			'apartment',
			'cottage',
			'house',
			'hotel',
			'groups',
			'people',
			'person',
			'person_outline',
			'face',
			'verified',
			'badge',
			'workspace_premium',
			'emoji_events',
			'star',
			'public',
			'language',
			'location_on',
			'map',
			'place',
			'construction',
			'foundation',
			'build',
			'architecture',
			'engineering',
			'trending_up',
			'show_chart',
			'timeline',
			'insights',
			'analytics',
			'favorite',
			'thumb_up',
			'mood',
			'support_agent',
			'handshake',
			'calendar_today',
			'schedule',
			'access_time',
			'history',
			'event',
			'warning',
			'task_alt',
			'check_circle',
			'gpp_good',
			'bolt'
		];


		function openIconPicker(target) {

			activeIconTarget =
				target;

			document
				.getElementById('project_icon_search')
				.value = '';

			var items =
				document.querySelectorAll(
					'#project_icon_grid .icon-picker-item'
				);

			Array.prototype.forEach.call(
				items,
				function (item) {
					item.style.display = '';
				}
			);

			openModal(
				'projectIconPickerModal'
			);
		}


		window.openProjectIconPicker =
			openIconPicker;


		var iconGrid =
			document.getElementById(
				'project_icon_grid'
			);


		iconList.forEach(function (name) {

			var btn =
				document.createElement('button');

			btn.type = 'button';

			btn.className =
				'icon-picker-item';

			btn.setAttribute(
				'data-icon',
				name
			);

			btn.setAttribute(
				'title',
				name
			);

			btn.innerHTML =
				'<span class="material-icons">' +
				name +
				'</span>' +

				'<span class="icon-picker-label">' +
				name +
				'</span>';

			iconGrid.appendChild(btn);
		});


		document
			.getElementById('project_icon_search')
			.addEventListener(
				'input',
				function () {

					var term =
						this.value.toLowerCase();

					var items =
						document.querySelectorAll(
							'#project_icon_grid .icon-picker-item'
						);

					Array.prototype.forEach.call(
						items,
						function (item) {

							var name =
								item
									.getAttribute(
										'data-icon'
									)
									.toLowerCase();

							item.style.display =
								name.indexOf(term) !== -1
									? ''
									: 'none';
						}
					);
				}
			);


		document.addEventListener(
			'click',
			function (event) {

				var iconItem =
					event.target.closest(
						'#project_icon_grid .icon-picker-item'
					);

				if (
					!iconItem ||
					!activeIconTarget
				) {
					return;
				}

				var iconName =
					iconItem.getAttribute(
						'data-icon'
					);


				if (
					activeIconTarget === 'pi'
				) {

					document
						.getElementById('piIcon')
						.value =
						iconName;

					document
						.getElementById('piIconPreview')
						.textContent =
						iconName;

					document
						.getElementById('piSelectedIconName')
						.textContent =
						'Selected: ' +
						iconName;
				}


				closeModal(
					'projectIconPickerModal'
				);
			}
		);


		/* =========================================================
		   HIDDEN INPUTS
		========================================================= */

		function addHiddenInput(
			container,
			name,
			value
		) {

			var input =
				document.createElement('input');

			input.type = 'hidden';

			input.name = name;

			input.value =
				value || '';

			container.appendChild(
				input
			);
		}


		function updateDynamicFormInputs() {

			var projectContainer =
				document.getElementById(
					'projectInfoHiddenInputs'
				);

			var challengeContainer =
				document.getElementById(
					'challengeHiddenInputs'
				);

			var solutionContainer =
				document.getElementById(
					'solutionHiddenInputs'
				);


			if (
				!projectContainer ||
				!challengeContainer ||
				!solutionContainer
			) {
				return;
			}


			projectContainer.innerHTML = '';

			challengeContainer.innerHTML = '';

			solutionContainer.innerHTML = '';


			/* =========================
			   PROJECT INFO
			========================= */

			var projectRows =
				document.querySelectorAll(
					'#projectInfoTableBody > tr:not(.no-record-row)'
				);


			Array.prototype.forEach.call(
				projectRows,
				function (row, index) {

					var icon =
						(
							row.cells[0]
								.getAttribute('data-icon') ||
							''
						).trim();

					var title =
						row.cells[1]
							.textContent
							.trim();

					var description =
						row.cells[2]
							.textContent
							.trim();


					addHiddenInput(
						projectContainer,
						'project_info[' +
						index +
						'][icon]',
						icon
					);

					addHiddenInput(
						projectContainer,
						'project_info[' +
						index +
						'][title]',
						title
					);

					addHiddenInput(
						projectContainer,
						'project_info[' +
						index +
						'][description]',
						description
					);
				}
			);


			/* =========================
			   CHALLENGES
			========================= */

			var challengeRows =
				document.querySelectorAll(
					'#challengeTableBody > tr:not(.no-record-row)'
				);


			Array.prototype.forEach.call(
				challengeRows,
				function (row, index) {

					var description =
						row.cells[0]
							.textContent
							.trim();

					var order =
						row.cells[1]
							.textContent
							.trim();


					addHiddenInput(
						challengeContainer,
						'challenges[' +
						index +
						'][description]',
						description
					);

					addHiddenInput(
						challengeContainer,
						'challenges[' +
						index +
						'][order]',
						order
					);
				}
			);


			/* =========================
			   SOLUTIONS
			========================= */

			var solutionRows =
				document.querySelectorAll(
					'#solutionTableBody > tr:not(.no-record-row)'
				);


			Array.prototype.forEach.call(
				solutionRows,
				function (row, index) {

					var description =
						row.cells[0]
							.textContent
							.trim();

					var order =
						row.cells[1]
							.textContent
							.trim();


					addHiddenInput(
						solutionContainer,
						'solutions[' +
						index +
						'][description]',
						description
					);

					addHiddenInput(
						solutionContainer,
						'solutions[' +
						index +
						'][order]',
						order
					);
				}
			);
		}


		/* =========================================================
		   INITIALIZE
		========================================================= */

		[
			'projectInfoTableBody',
			'challengeTableBody',
			'solutionTableBody'
		].forEach(function (id) {

			ensureEmptyState(id);
		});


		updateDynamicFormInputs();


		/* =========================================================
		   FORM SUBMIT
		========================================================= */

		var form =
			document.getElementById(
				'editProjectTypesForm'
			);

		if (form) {

			form.addEventListener(
				'submit',
				function () {

					updateDynamicFormInputs();
				}
			);
		}

	})();
</script>

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
		document.getElementById('select_image').style.display = 'block';
		document.getElementById('image_url').style.display = 'none';
	}

	function show1()
	{
		document.getElementById('select_image').style.display = 'none';
		document.getElementById('image_url').style.display = 'block';
	}
</script>