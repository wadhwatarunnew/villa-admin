<?php
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Projects";
	$FileExists = false;

	if (isset($_POST['sub']))
	{
		$page = "Update";
		$metaTitle = $_POST['metaTitle'];
		$keyword = $_POST['keyword'];
		$disc = $_POST['disc'];
		$cat = $_POST['cat'];
		$order = $_POST['order'];
		$subtitle = mysqli_real_escape_string($con, $_POST['small_heading']);
		$title = mysqli_real_escape_string($con, $_POST['title']);
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
				mysqli_query($con, "INSERT INTO project_types (metatitle, keyword, discription, category, order_no, subtitle, title, content, image, local_path, quote, client_name, designation, company, back_color, text_color, accent_color, border) VALUES ('$metaTitle', '$keyword', '$disc', '$cat', '$order', '$subtitle', '$title', '$editor1', '', '', '$quote', '$client_name', '$designation', '$company', '$back_color', '$text_color', '$accent_color', '$border')");
				$LastInsertID = mysqli_insert_id($con);
			}
			elseif ($myFile != '' && (file_exists("uploads/pageimages/" . $myFile) || file_exists("uploads/pageimages/addgallery/" . $myFile) || file_exists("uploads/pageimages/addgallery/project/" . $myFile) || file_exists("uploads/pageimages/addgallery/resort/" . $myFile) || file_exists("uploads/pageimages/blogs/" . $myFile) || file_exists("uploads/pageimages/blogs/single/" . $myFile) || file_exists("uploads/pageimages/contact/" . $myFile) || file_exists("uploads/pageimages/nav/" . $myFile) || file_exists("uploads/pageimages/nav/category/" . $myFile) || file_exists("uploads/pageimages/nav/types/" . $myFile) || file_exists("uploads/pageimages/project/" . $myFile) || file_exists("uploads/pageimages/project/category/" . $myFile) || file_exists("uploads/pageimages/project/types/" . $myFile) || file_exists("uploads/pageimages/resort/" . $myFile) || file_exists("uploads/pageimages/resort/category/" . $myFile) || file_exists("uploads/pageimages/resort/types/" . $myFile) || file_exists("uploads/pageimages/slider/" . $myFile) || file_exists("uploads/pageimages/youtube/" . $myFile))) {
				$FileExists = true;
			   	$_SESSION['BannerColor'] = "background-color:#FF0000;";
			   	$_SESSION['Message'] = "Selected image already exists!";
			   	echo "<script>window.location.href='add-project.php';</script>";
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

				mysqli_query($con, "INSERT INTO project_types (metatitle, keyword, discription, category, order_no, subtitle, title, content, image, local_path, quote, client_name, designation, company, back_color, text_color, accent_color, border) VALUES ('$metaTitle', '$keyword', '$disc', '$cat', '$order', '$subtitle', '$title', '$editor1', '', '$ImagePath', '$quote', '$client_name', '$designation', '$company', '$back_color', '$text_color', '$accent_color', '$border')");
				$LastInsertID = mysqli_insert_id($con);
			}
		}
		else
		{
			mysqli_query($con, "INSERT INTO project_types (metatitle, keyword, discription, category, order_no, subtitle, title, content, image, local_path, quote, client_name, designation, company, back_color, text_color, accent_color, border) VALUES ('$metaTitle', '$keyword', '$disc', '$cat', '$order', '$subtitle', '$title', '$editor1', '$imageUrl', '', '$quote', '$client_name', '$designation', '$company', '$back_color', '$text_color', '$accent_color', '$border')");
			$LastInsertID = mysqli_insert_id($con);
		}

		if($LastInsertID != '')
		{
			$CurrentDateTime = Date("Y-m-d H:i:s");
			if (isset($_POST['project_info']) && !empty($_POST['project_info']))
			{
				foreach ($_POST['project_info'] as $item) {
					$icon = isset($item['icon']) ? trim($item['icon']) : '';
				    $title = isset($item['title']) ? trim($item['title']) : '';
				    $description = isset($item['description']) ? trim($item['description']) : '';

				    if ($icon != '' && $title != '' && $description != '') {
				      mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, created_at) VALUES ('$LastInsertID', 'Project Info', '$title', '$description', '$icon', '$CurrentDateTime')");
				    }
				}
			}

			if (isset($_POST['challenges']) && !empty($_POST['challenges']))
			{
				foreach ($_POST['challenges'] as $item) {
					$title = isset($item['title']) ? trim($item['title']) : '';
				    $icon = isset($item['icon']) ? trim($item['icon']) : '';
				    $description = isset($item['description']) ? trim($item['description']) : '';
				    $orderNo = isset($item['order']) ? (int)$item['order'] : 0;

				    if ($icon != '' && $title != '' && $description != '') {
				      mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, sort_order, created_at) VALUES ('$LastInsertID', 'Challenges', '$title', '$description', '$icon', '$orderNo', '$CurrentDateTime')");
				    }
				}
			}

			if (isset($_POST['solutions']) && !empty($_POST['solutions']))
			{
				foreach ($_POST['solutions'] as $item) {
					$title = isset($item['title']) ? trim($item['title']) : '';
				    $icon = isset($item['icon']) ? trim($item['icon']) : '';
				    $description = isset($item['description']) ? trim($item['description']) : '';
				    $orderNo = isset($item['order']) ? (int)$item['order'] : 0;

				    if ($icon != '' && $title != '' && $description != '') {
				        mysqli_query($con, "INSERT INTO project_details (project_id, category, title, description, icon, sort_order, created_at) VALUES ('$LastInsertID', 'Solutions', '$title', '$description', '$icon', '$orderNo', '$CurrentDateTime')");
				    }
				}
			}

			$_SESSION['BannerColor'] = "background-color:#4BB543;";
      	$_SESSION['Message'] = "Added Successfully!";
      	echo "<script>window.location.href='add-project.php';</script>";
	     	exit;
		}
	}
?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<form action="" enctype="multipart/form-data" method="post" id="projectInternalsForm">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Add Project</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Projects</span><span class="crumb-sep">&gt;</span><span>Add New</span>
								</div>
							</div>
							<div class="listing-cta">
								<a href="projects-listing.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<input type="submit" class="btn btn-success btn-sm" id="btnn" name="sub" value="Save" form="projectInternalsForm">
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
							<div class="card-header">Project Overview Content</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-3 col-md-6">
										<div class="commonSection">
											<label>Section Small Title</label>
											<input type="text" class="form-control" name="small_heading" id="small_heading" placeholder="PROJECT OVERVIEW">
										</div>
									</div>
									<div class="col-lg-5 col-md-6">
										<div class="commonSection">
											<label>Main Heading</label>
											<input class="form-control" type="text" required name="title" id="title" placeholder="Enter main heading">
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection">
											<label>Category</label>
											<select class="form-control" name="cat" required>
												<option value="">--Select--</option>
												<?php
												include "db.php";
												$queryl = mysqli_query($con, "select * from project_category group by title");
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
											<input class="form-control" type="number" name="order" id="order" placeholder="1">
										</div>
									</div>
									<div class="col-md-12">
										<div class="commonSection mb-0">
											<label>Description</label>
											<textarea name="editor1" id="editor1" class="form-control" rows="5" required placeholder="Enter description"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card mb-30">
							<div class="card-header d-flex justify-content-between align-items-center">
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
												<th style="width:120px;">Actions</th>
											</tr>
										</thead>
										<tbody id="projectInfoTableBody" data-empty-cols="4"></tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header d-flex justify-content-between align-items-center">
										<span>Challenges List</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#challengeModal">+ Add Challenge</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Title</th>
														<th>Icon</th>
														<th>Description</th>
														<th>Order</th>
														<th style="width:120px;">Actions</th>
													</tr>
												</thead>
												<tbody id="challengeTableBody" data-empty-cols="5"></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header d-flex justify-content-between align-items-center">
										<span>Solutions List</span>
										<button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#solutionModal">+ Add Solution</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Title</th>
														<th>Icon</th>
														<th>Description</th>
														<th>Order</th>
														<th style="width:120px;">Actions</th>
													</tr>
												</thead>
												<tbody id="solutionTableBody" data-empty-cols="5"></tbody>
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
											<textarea class="form-control" name="quote" rows="5" placeholder="Enter testimonial quote"></textarea>
										</div>
									</div>
									<div class="col-lg-3 col-md-6">
										<div class="commonSection">
											<label>Client Name</label>
											<input class="form-control" type="text" name="client_name" placeholder="Client name">
										</div>
									</div>
									<div class="col-lg-3 col-md-6">
										<div class="commonSection">
											<label>Designation</label>
											<input class="form-control" type="text" name="designation" placeholder="Designation">
										</div>
									</div>
									<div class="col-lg-4 col-md-6">
										<div class="commonSection mb-0">
											<label>Company / Hotel Name</label>
											<input class="form-control" type="text" name="company" placeholder="Company name">
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection mb-0">
											<label>Background Color</label>
											<input class="form-control" type="text" name="back_color" placeholder="#0E3528">
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection mb-0">
											<label>Text Color</label>
											<input class="form-control" type="text" name="text_color" placeholder="#FFFFFF">
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection mb-0">
											<label>Accent Color</label>
											<input class="form-control" type="text" name="accent_color" placeholder="#C9A45A">
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection mb-0">
											<label>Border Radius</label>
											<input class="form-control" type="number" name="border" placeholder="12">
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
									<div class="commonSection"><label>Title</label><input type="text" class="form-control" id="challengeTitle" placeholder="Extreme weather conditions"></div>
									<div class="commonSection">
										<label>Icon</label>
										<div class="counter-icon-box">
											<div class="counter-icon-preview">
												<span class="material-icons" id="challengeIconPreview">warning</span>
											</div>
											<input type="hidden" id="challengeIcon" value="warning">
											<button type="button" class="btn btn-success btn-sm" data-icon-target="challenge" onclick="openProjectIconPicker('challenge')"><i class="feather icon-edit"></i> Change Icon</button>
											<div class="counter-icon-help" id="challengeSelectedIconName">Selected: warning</div>
										</div>
									</div>
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
									<div class="commonSection"><label>Title</label><input type="text" class="form-control" id="solutionTitle" placeholder="High-quality all-weather fabrics"></div>
									<div class="commonSection">
										<label>Icon</label>
										<div class="counter-icon-box">
											<div class="counter-icon-preview">
												<span class="material-icons" id="solutionIconPreview">verified</span>
											</div>
											<input type="hidden" id="solutionIcon" value="verified">
											<button type="button" class="btn btn-success btn-sm" data-icon-target="solution" onclick="openProjectIconPicker('solution')"><i class="feather icon-edit"></i> Change Icon</button>
											<div class="counter-icon-help" id="solutionSelectedIconName">Selected: verified</div>
										</div>
									</div>
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

					<script>
						(function() {
							var rowToDelete = null;
							var activeIconTarget = null;
							var editingState = {
								projectInfo: null,
								challenge: null,
								solution: null
							};

							var iconList = [
								'home', 'apartment', 'cottage', 'house', 'hotel',
								'groups', 'people', 'person', 'person_outline', 'face',
								'verified', 'badge', 'workspace_premium', 'emoji_events', 'star',
								'public', 'language', 'location_on', 'map', 'place',
								'construction', 'foundation', 'build', 'architecture', 'engineering',
								'trending_up', 'show_chart', 'timeline', 'insights', 'analytics',
								'favorite', 'thumb_up', 'mood', 'support_agent', 'handshake',
								'calendar_today', 'schedule', 'access_time', 'history', 'event',
								'warning', 'task_alt', 'check_circle', 'gpp_good', 'bolt'
							];

							function actionButtons() {
								return '<div class="action-btn-group"><button type="button" class="btn btn-sm btn-outline-success js-edit-row" title="Edit"><i class="feather icon-edit-2"></i></button><button type="button" class="btn btn-sm btn-outline-danger js-delete-row" title="Delete"><i class="feather icon-trash-2"></i></button></div>';
							}

							function iconCell(iconName) {
								return '<span class="material-icons">' + iconName + '</span><div class="counter-icon-help">' + iconName + '</div>';
							}

							function ensureEmptyState(tbodyId) {
								var tbody = document.getElementById(tbodyId);
								if (!tbody) {
									return;
								}
								var rows = Array.prototype.slice.call(tbody.querySelectorAll('tr')).filter(function(row) {
									return !row.classList.contains('no-record-row');
								});
								var emptyRow = tbody.querySelector('.no-record-row');
								if (rows.length === 0) {
									if (!emptyRow) {
										emptyRow = document.createElement('tr');
										emptyRow.className = 'no-record-row';
										emptyRow.innerHTML = '<td colspan="' + (tbody.getAttribute('data-empty-cols') || '4') + '">No record found. Click on Add.</td>';
										tbody.appendChild(emptyRow);
									}
								} else if (emptyRow) {
									emptyRow.remove();
								}
							}

							function openModal(id) {
								var modalEl = document.getElementById(id);
								if (!modalEl) {
									return;
								}
								bootstrap.Modal.getOrCreateInstance(modalEl).show();
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

							function appendProjectInfoRow(icon, title, description) {
								var tbody = document.getElementById('projectInfoTableBody');
								if (!tbody) {
									return;
								}
								ensureEmptyState('projectInfoTableBody');
								var row = document.createElement('tr');
								row.innerHTML = '<td data-icon="' + icon + '">' + iconCell(icon) + '</td><td>' + title + '</td><td>' + description + '</td><td>' + actionButtons() + '</td>';
								tbody.appendChild(row);
								ensureEmptyState('projectInfoTableBody');
							}

							function appendChallengeRow(title, icon, description, order) {
								var tbody = document.getElementById('challengeTableBody');
								if (!tbody) {
									return;
								}
								ensureEmptyState('challengeTableBody');
								var row = document.createElement('tr');
								row.innerHTML = '<td>' + title + '</td><td data-icon="' + icon + '">' + iconCell(icon) + '</td><td>' + description + '</td><td>' + order + '</td><td>' + actionButtons() + '</td>';
								tbody.appendChild(row);
								ensureEmptyState('challengeTableBody');
							}

							function appendSolutionRow(title, icon, description, order) {
								var tbody = document.getElementById('solutionTableBody');
								if (!tbody) {
									return;
								}
								ensureEmptyState('solutionTableBody');
								var row = document.createElement('tr');
								row.innerHTML = '<td>' + title + '</td><td data-icon="' + icon + '">' + iconCell(icon) + '</td><td>' + description + '</td><td>' + order + '</td><td>' + actionButtons() + '</td>';
								tbody.appendChild(row);
								ensureEmptyState('solutionTableBody');
							}

							function resetProjectInfoModal() {
								document.getElementById('piIcon').value = 'home';
								document.getElementById('piIconPreview').textContent = 'home';
								document.getElementById('piSelectedIconName').textContent = 'Selected: home';
								document.getElementById('piTitle').value = '';
								document.getElementById('piDescription').value = '';
								document.getElementById('saveProjectInfo').textContent = 'Add Item';
								document.querySelector('#projectInfoModal .modal-title').textContent = 'Add Project Information';
								editingState.projectInfo = null;
							}

							function resetChallengeModal() {
								document.getElementById('challengeTitle').value = '';
								document.getElementById('challengeIcon').value = 'warning';
								document.getElementById('challengeIconPreview').textContent = 'warning';
								document.getElementById('challengeSelectedIconName').textContent = 'Selected: warning';
								document.getElementById('challengeDescription').value = '';
								document.getElementById('challengeOrder').value = '';
								document.getElementById('saveChallenge').textContent = 'Add Challenge';
								document.querySelector('#challengeModal .modal-title').textContent = 'Add Challenge';
								editingState.challenge = null;
							}

							function resetSolutionModal() {
								document.getElementById('solutionTitle').value = '';
								document.getElementById('solutionIcon').value = 'verified';
								document.getElementById('solutionIconPreview').textContent = 'verified';
								document.getElementById('solutionSelectedIconName').textContent = 'Selected: verified';
								document.getElementById('solutionDescription').value = '';
								document.getElementById('solutionOrder').value = '';
								document.getElementById('saveSolution').textContent = 'Add Solution';
								document.querySelector('#solutionModal .modal-title').textContent = 'Add Solution';
								editingState.solution = null;
							}

							document.getElementById('saveProjectInfo').addEventListener('click', function() {
							    var icon = document.getElementById('piIcon').value.trim();
							    var title = document.getElementById('piTitle').value.trim();
							    var description = document.getElementById('piDescription').value.trim();

							    if (!icon || !title || !description) {
							        alert('Please fill all Project Information fields.');
							        return;
							    }

							    if (editingState.projectInfo) {

							        editingState.projectInfo.cells[0].setAttribute(
							            'data-icon',
							            icon
							        );

							        editingState.projectInfo.cells[0].innerHTML =
							            iconCell(icon);

							        editingState.projectInfo.cells[1].textContent =
							            title;

							        editingState.projectInfo.cells[2].textContent =
							            description;

							    } else {
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

							document.getElementById('saveChallenge').addEventListener('click', function() {
							    var title = document.getElementById('challengeTitle').value.trim();
							    var icon = document.getElementById('challengeIcon').value.trim();
							    var description = document.getElementById('challengeDescription').value.trim();
							    var order = document.getElementById('challengeOrder').value.trim();

							    if (!title || !icon || !description || !order) {
							        alert('Please fill all Challenge fields.');
							        return;
							    }

							    if (editingState.challenge) {
							        editingState.challenge.cells[0].textContent =
							            title;

							        editingState.challenge.cells[1].setAttribute(
							            'data-icon',
							            icon
							        );

							        editingState.challenge.cells[1].innerHTML =
							            iconCell(icon);

							        editingState.challenge.cells[2].textContent =
							            description;

							        editingState.challenge.cells[3].textContent =
							            order;
							    } else {
							        appendChallengeRow(
							            title,
							            icon,
							            description,
							            order
							        );
							    }

							    updateDynamicFormInputs();
							    closeModal('challengeModal');
							    resetChallengeModal();
							});

							document.getElementById('saveSolution').addEventListener('click', function() {

							    var title = document.getElementById('solutionTitle').value.trim();
							    var icon = document.getElementById('solutionIcon').value.trim();
							    var description = document.getElementById('solutionDescription').value.trim();
							    var order = document.getElementById('solutionOrder').value.trim();


							    if (!title || !icon || !description || !order) {
							        alert('Please fill all Solution fields.');
							        return;
							    }


							    if (editingState.solution) {
							        editingState.solution.cells[0].textContent =
							            title;

							        editingState.solution.cells[1].setAttribute(
							            'data-icon',
							            icon
							        );

							        editingState.solution.cells[1].innerHTML =
							            iconCell(icon);

							        editingState.solution.cells[2].textContent =
							            description;

							        editingState.solution.cells[3].textContent =
							            order;
							    } else {
							        appendSolutionRow(
							            title,
							            icon,
							            description,
							            order
							        );
							    }

							    updateDynamicFormInputs();
							    closeModal('solutionModal');
							    resetSolutionModal();
							});

							document.addEventListener('click', function(event) {
								var editBtn = event.target.closest('.js-edit-row');
								if (editBtn) {
									var editRow = editBtn.closest('tr');
									var tbody = editRow ? editRow.closest('tbody') : null;
									if (!editRow || !tbody) {
										return;
									}

									if (tbody.id === 'projectInfoTableBody') {
										editingState.projectInfo = editRow;
										var piIcon = editRow.cells[0].getAttribute('data-icon') || 'home';
										document.getElementById('piIcon').value = piIcon;
										document.getElementById('piIconPreview').textContent = piIcon;
										document.getElementById('piSelectedIconName').textContent = 'Selected: ' + piIcon;
										document.getElementById('piTitle').value = editRow.cells[1].textContent.trim();
										document.getElementById('piDescription').value = editRow.cells[2].textContent.trim();
										document.getElementById('saveProjectInfo').textContent = 'Update';
										document.querySelector('#projectInfoModal .modal-title').textContent = 'Edit Project Information';
										openModal('projectInfoModal');
									}

									if (tbody.id === 'challengeTableBody') {
										editingState.challenge = editRow;
										document.getElementById('challengeTitle').value = editRow.cells[0].textContent.trim();
										var challengeIcon = editRow.cells[1].getAttribute('data-icon') || 'warning';
										document.getElementById('challengeIcon').value = challengeIcon;
										document.getElementById('challengeIconPreview').textContent = challengeIcon;
										document.getElementById('challengeSelectedIconName').textContent = 'Selected: ' + challengeIcon;
										document.getElementById('challengeDescription').value = editRow.cells[2].textContent.trim();
										document.getElementById('challengeOrder').value = editRow.cells[3].textContent.trim();
										document.getElementById('saveChallenge').textContent = 'Update';
										document.querySelector('#challengeModal .modal-title').textContent = 'Edit Challenge';
										openModal('challengeModal');
									}

									if (tbody.id === 'solutionTableBody') {
										editingState.solution = editRow;
										document.getElementById('solutionTitle').value = editRow.cells[0].textContent.trim();
										var solutionIcon = editRow.cells[1].getAttribute('data-icon') || 'verified';
										document.getElementById('solutionIcon').value = solutionIcon;
										document.getElementById('solutionIconPreview').textContent = solutionIcon;
										document.getElementById('solutionSelectedIconName').textContent = 'Selected: ' + solutionIcon;
										document.getElementById('solutionDescription').value = editRow.cells[2].textContent.trim();
										document.getElementById('solutionOrder').value = editRow.cells[3].textContent.trim();
										document.getElementById('saveSolution').textContent = 'Update';
										document.querySelector('#solutionModal .modal-title').textContent = 'Edit Solution';
										openModal('solutionModal');
									}
									return;
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

							    /*
							     * Rebuild submitted data after deleting.
							     */
							    updateDynamicFormInputs();
							    rowToDelete = null;
							    closeModal('confirmDeleteModal');
							});

							document.getElementById('confirmDeleteModal').addEventListener('hidden.bs.modal', function() {
								rowToDelete = null;
							});

							document.getElementById('projectInfoModal').addEventListener('hidden.bs.modal', resetProjectInfoModal);
							document.getElementById('challengeModal').addEventListener('hidden.bs.modal', resetChallengeModal);
							document.getElementById('solutionModal').addEventListener('hidden.bs.modal', resetSolutionModal);

							function openIconPicker(target) {
								activeIconTarget = target;
								document.getElementById('project_icon_search').value = '';
								var pickerItems = document.querySelectorAll('#project_icon_grid .icon-picker-item');
								Array.prototype.forEach.call(pickerItems, function(item) {
									item.style.display = '';
								});
								openModal('projectIconPickerModal');
							}

							window.openProjectIconPicker = openIconPicker;

							var iconGrid = document.getElementById('project_icon_grid');
							iconList.forEach(function(name) {
								var btn = document.createElement('button');
								btn.type = 'button';
								btn.className = 'icon-picker-item';
								btn.setAttribute('data-icon', name);
								btn.setAttribute('title', name);
								btn.innerHTML = '<span class="material-icons">' + name + '</span><span class="icon-picker-label">' + name + '</span>';
								iconGrid.appendChild(btn);
							});

							document.getElementById('project_icon_search').addEventListener('input', function() {
								var term = this.value.toLowerCase();
								var pickerItems = document.querySelectorAll('#project_icon_grid .icon-picker-item');
								Array.prototype.forEach.call(pickerItems, function(item) {
									var name = item.getAttribute('data-icon').toLowerCase();
									item.style.display = name.indexOf(term) !== -1 ? '' : 'none';
								});
							});

							document.addEventListener('click', function(event) {
								var iconItem = event.target.closest('#project_icon_grid .icon-picker-item');
								if (!iconItem || !activeIconTarget) {
									return;
								}
								var iconName = iconItem.getAttribute('data-icon');
								if (activeIconTarget === 'pi') {
									document.getElementById('piIcon').value = iconName;
									document.getElementById('piIconPreview').textContent = iconName;
									document.getElementById('piSelectedIconName').textContent = 'Selected: ' + iconName;
								}
								if (activeIconTarget === 'challenge') {
									document.getElementById('challengeIcon').value = iconName;
									document.getElementById('challengeIconPreview').textContent = iconName;
									document.getElementById('challengeSelectedIconName').textContent = 'Selected: ' + iconName;
								}
								if (activeIconTarget === 'solution') {
									document.getElementById('solutionIcon').value = iconName;
									document.getElementById('solutionIconPreview').textContent = iconName;
									document.getElementById('solutionSelectedIconName').textContent = 'Selected: ' + iconName;
								}
								closeModal('projectIconPickerModal');
							});

							['projectInfoTableBody', 'challengeTableBody', 'solutionTableBody'].forEach(function(tbodyId) {
								ensureEmptyState(tbodyId);
							});

							function addHiddenInput(container, name, value) {
							    var input = document.createElement('input');
							    input.type = 'hidden';
							    input.name = name;
							    input.value = value || '';
							    container.appendChild(input);
							}

							function updateDynamicFormInputs() {
							    var projectContainer = document.getElementById('projectInfoHiddenInputs');
							    var challengeContainer = document.getElementById('challengeHiddenInputs');
							    var solutionContainer = document.getElementById('solutionHiddenInputs');

							    if (!projectContainer ||
							        !challengeContainer ||
							        !solutionContainer) {
							        return;
							    }

							    /*
							     * Clear old hidden inputs.
							     * They will be rebuilt from the current table rows.
							     */
							    projectContainer.innerHTML = '';
							    challengeContainer.innerHTML = '';
							    solutionContainer.innerHTML = '';

							    /* =========================================================
							       PROJECT INFORMATION
							    ========================================================= */

							    var projectRows = document.querySelectorAll(
							        '#projectInfoTableBody tr:not(.no-record-row)'
							    );

							    Array.prototype.forEach.call(projectRows, function(row, index) {

							        var icon = row.cells[0].getAttribute('data-icon') || '';
							        var title = row.cells[1].textContent.trim();
							        var description = row.cells[2].textContent.trim();

							        addHiddenInput(
							            projectContainer,
							            'project_info[' + index + '][icon]',
							            icon
							        );

							        addHiddenInput(
							            projectContainer,
							            'project_info[' + index + '][title]',
							            title
							        );

							        addHiddenInput(
							            projectContainer,
							            'project_info[' + index + '][description]',
							            description
							        );

							    });


							    /* =========================================================
							       CHALLENGES
							    ========================================================= */

							    var challengeRows = document.querySelectorAll(
							        '#challengeTableBody tr:not(.no-record-row)'
							    );

							    Array.prototype.forEach.call(challengeRows, function(row, index) {

							        var title = row.cells[0].textContent.trim();
							        var icon = row.cells[1].getAttribute('data-icon') || '';
							        var description = row.cells[2].textContent.trim();
							        var order = row.cells[3].textContent.trim();

							        addHiddenInput(
							            challengeContainer,
							            'challenges[' + index + '][title]',
							            title
							        );

							        addHiddenInput(
							            challengeContainer,
							            'challenges[' + index + '][icon]',
							            icon
							        );

							        addHiddenInput(
							            challengeContainer,
							            'challenges[' + index + '][description]',
							            description
							        );

							        addHiddenInput(
							            challengeContainer,
							            'challenges[' + index + '][order]',
							            order
							        );
							    });


							    /* =========================================================
							       SOLUTIONS
							    ========================================================= */

							    var solutionRows = document.querySelectorAll(
							        '#solutionTableBody tr:not(.no-record-row)'
							    );

							    Array.prototype.forEach.call(solutionRows, function(row, index) {

							        var title = row.cells[0].textContent.trim();
							        var icon = row.cells[1].getAttribute('data-icon') || '';
							        var description = row.cells[2].textContent.trim();
							        var order = row.cells[3].textContent.trim();

							        addHiddenInput(
							            solutionContainer,
							            'solutions[' + index + '][title]',
							            title
							        );

							        addHiddenInput(
							            solutionContainer,
							            'solutions[' + index + '][icon]',
							            icon
							        );

							        addHiddenInput(
							            solutionContainer,
							            'solutions[' + index + '][description]',
							            description
							        );

							        addHiddenInput(
							            solutionContainer,
							            'solutions[' + index + '][order]',
							            order
							        );
							    });
							}
						})();

						document.getElementById('projectInternalsForm').addEventListener('submit', function() {
						    updateDynamicFormInputs();
						});
					</script>
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
		document.getElementById('select_image').style.display = 'block';
		document.getElementById('image_url').style.display = 'none';
	}

	function show1()
	{
		document.getElementById('select_image').style.display = 'none';
		document.getElementById('image_url').style.display = 'block';
	}
</script>