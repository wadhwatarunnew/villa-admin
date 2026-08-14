<?php
error_reporting(0);

$id = $_GET['id'];

include "db.php";
$query3 = mysqli_query($con, "select * from project_types where id=$id");
$b = mysqli_fetch_assoc($query3);

if (isset($_POST['update'])) {
	$page = "Update";
	$metaTitle = $_POST['metaTitle'];
	$keyword = $_POST['keyword'];
	$disc = $_POST['disc'];
	$title = $_POST['title'];
	$cat = $_POST['cat'];
	$order = $_POST['order'];
	$editor1 = $_POST['editor1'];
	$imageUrl = isset($_POST['image']) ? trim($_POST['image']) : '';
	$myFile = isset($_FILES['myFile']['name']) ? $_FILES['myFile']['name'] : '';

	$path = "uploads/pageimages/project/types/";
	$path_original = "uploads/pageimages/project/types/";

	if ($imageUrl === '') {
		if ($myFile === '') {
			include "db.php";
			mysqli_query($con, "update project_types SET title='$title',content='$editor1',metatitle='$metaTitle',keyword='$keyword',discription='$disc',category='$cat',order_no='$order' where id=$id");
			header("refresh:2; url=edit-project-types.php?id=$id");
		} elseif ($myFile != '' && (file_exists("uploads/pageimages/" . $myFile) || file_exists("uploads/pageimages/addgallery/" . $myFile) || file_exists("uploads/pageimages/addgallery/project/" . $myFile) || file_exists("uploads/pageimages/addgallery/resort/" . $myFile) || file_exists("uploads/pageimages/blogs/" . $myFile) || file_exists("uploads/pageimages/blogs/single/" . $myFile) || file_exists("uploads/pageimages/contact/" . $myFile) || file_exists("uploads/pageimages/nav/" . $myFile) || file_exists("uploads/pageimages/nav/category/" . $myFile) || file_exists("uploads/pageimages/nav/types/" . $myFile) || file_exists("uploads/pageimages/project/" . $myFile) || file_exists("uploads/pageimages/project/category/" . $myFile) || file_exists("uploads/pageimages/project/types/" . $myFile) || file_exists("uploads/pageimages/resort/" . $myFile) || file_exists("uploads/pageimages/resort/category/" . $myFile) || file_exists("uploads/pageimages/resort/types/" . $myFile) || file_exists("uploads/pageimages/slider/" . $myFile) || file_exists("uploads/pageimages/youtube/" . $myFile))) {
			$FileExists = true;
			header("refresh:2; url=edit-project-types.php?id=$id");
		} else {
			move_uploaded_file($_FILES['myFile']['tmp_name'], $path . $myFile);
			$path = $path_original . $myFile;
			include "db.php";
			mysqli_query($con, "update project_types SET title='$title',content='$editor1',image='',local_path='$path',metatitle='$metaTitle',keyword='$keyword',discription='$disc',category='$cat',order_no='$order' where id=$id");
			header("refresh:2; url=edit-project-types.php?id=$id");
		}
	} else {
		include "db.php";
		mysqli_query($con, "update project_types SET title='$title',content='$editor1',image='$imageUrl',metatitle='$metaTitle',keyword='$keyword',discription='$disc',category='$cat',order_no='$order' where id=$id");
		header("refresh:2; url=edit-project-types.php?id=$id");
	}
}

if (isset($_POST['update1'])) {
	$page = "Update";
	$metaTitle1 = $_POST['metaTitle1'];
	$keyword1 = $_POST['keyword1'];
	$disc1 = $_POST['disc1'];
	$title1 = $_POST['title1'];
	$cat1 = $_POST['cat1'];
	$order1 = $_POST['order1'];
	$editor12 = $_POST['editor12'];
	$imageUrl1 = isset($_POST['image1']) ? trim($_POST['image1']) : '';
	$myFile1 = isset($_FILES['myFile1']['name']) ? $_FILES['myFile1']['name'] : '';

	$path2 = "uploads/pageimages/project/types/";
	$path_original2 = "uploads/pageimages/project/types/";

	if ($imageUrl1 === '') {
		if ($myFile1 === '') {
			include "db.php";
			mysqli_query($con, "update project_types SET title='$title1',content='$editor12',metatitle='$metaTitle1',keyword='$keyword1',discription='$disc1',category='$cat1',order_no='$order1' where id=$id");
			header("refresh:2; url=edit-project-types.php?id=$id");
		} elseif ($myFile1 != '' && (file_exists("uploads/pageimages/" . $myFile1) || file_exists("uploads/pageimages/addgallery/" . $myFile1) || file_exists("uploads/pageimages/addgallery/project/" . $myFile1) || file_exists("uploads/pageimages/addgallery/resort/" . $myFile1) || file_exists("uploads/pageimages/blogs/" . $myFile1) || file_exists("uploads/pageimages/blogs/single/" . $myFile1) || file_exists("uploads/pageimages/contact/" . $myFile1) || file_exists("uploads/pageimages/nav/" . $myFile1) || file_exists("uploads/pageimages/nav/category/" . $myFile1) || file_exists("uploads/pageimages/nav/types/" . $myFile1) || file_exists("uploads/pageimages/project/" . $myFile1) || file_exists("uploads/pageimages/project/category/" . $myFile1) || file_exists("uploads/pageimages/project/types/" . $myFile1) || file_exists("uploads/pageimages/resort/" . $myFile1) || file_exists("uploads/pageimages/resort/category/" . $myFile1) || file_exists("uploads/pageimages/resort/types/" . $myFile1) || file_exists("uploads/pageimages/slider/" . $myFile1) || file_exists("uploads/pageimages/youtube/" . $myFile1))) {
			$FileExists = true;
			header("refresh:2; url=edit-project-types.php?id=$id");
		} else {
			move_uploaded_file($_FILES['myFile1']['tmp_name'], $path2 . $myFile1);
			$path1 = $path_original2 . $myFile1;
			include "db.php";
			mysqli_query($con, "update project_types SET title='$title1',content='$editor12',local_path='$path1',metatitle='$metaTitle1',keyword='$keyword1',discription='$disc1',category='$cat1',order_no='$order1' where id=$id");
			header("refresh:2; url=edit-project-types.php?id=$id");
		}
	} else {
		include "db.php";
		mysqli_query($con, "update project_types SET title='$title1',content='$editor12',image='$imageUrl1',local_path='',metatitle='$metaTitle1',keyword='$keyword1',discription='$disc1',category='$cat1',order_no='$order1' where id=$id");
		header("refresh:2; url=edit-project-types.php?id=$id");
	}
}
?>

<?php $PageTitle = "Villatent: Projects"; ?>
<?php include_once('common/header.php'); ?>
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
								<a href="project-listings.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<?php if(!$b['local_path']){ ?>
								<input type="submit" class="btn btn-success btn-sm" id="btnn" name="update" value="Save" form="editProjectTypesForm">
								<?php }else{ ?>
								<input type="submit" class="btn btn-success btn-sm" id="btnn1" name="update1" value="Save" form="editProjectTypesForm">
								<?php } ?>
							</div>
						</div>

						<?php include "alert-update.php"; ?>

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
							<div class="card-header">Project Overview Content</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-3 col-md-6">
										<div class="commonSection">
											<label>Section Small Title</label>
											<input type="text" class="form-control" name="small_heading_ui" id="small_heading_ui" placeholder="PROJECT OVERVIEW" value="PROJECT OVERVIEW">
										</div>
									</div>
									<div class="col-lg-5 col-md-6">
										<div class="commonSection">
											<label>Main Heading</label>
											<?php if(!$b['local_path']){ ?>
											<input class="form-control" type="text" required name="title" id="title" value="<?php echo $b['title']; ?>" placeholder="Enter main heading">
											<?php }else{ ?>
											<input class="form-control" type="text" required name="title1" id="title" value="<?php echo $b['title']; ?>" placeholder="Enter main heading">
											<?php } ?>
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection">
											<label>Category</label>
											<select class="form-control" name="<?php echo !$b['local_path'] ? 'cat' : 'cat1'; ?>" required>
												<option value="<?php echo $b['category']; ?>"><?php echo $b['category']; ?></option>
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
											<input class="form-control" type="number" name="<?php echo !$b['local_path'] ? 'order' : 'order1'; ?>" id="order" value="<?php echo $b['order_no']; ?>" placeholder="1">
										</div>
									</div>
									<div class="col-md-12">
										<div class="commonSection mb-0">
											<label>Description</label>
											<?php if(!$b['local_path']){ ?>
											<textarea name="editor1" id="editor1" class="form-control" rows="5" required placeholder="Enter description"><?php echo $b['content']; ?></textarea>
											<?php }else{ ?>
											<textarea name="editor12" id="editor12" class="form-control" rows="5" required placeholder="Enter description"><?php echo $b['content']; ?></textarea>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card mb-30">
							<div class="card-header">Project Information List</div>
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
											<tr>
												<td><input type="text" class="form-control form-control-sm" value="feather icon-users" readonly></td>
												<td><input type="text" class="form-control form-control-sm" value="Client" readonly></td>
												<td><input type="text" class="form-control form-control-sm" value="The Villa Tent Hospitality Partner" readonly></td>
												<td>
													<div class="action-btn-group">
														<button type="button" class="btn btn-sm btn-outline-success js-row-edit" title="Edit"><i class="feather icon-edit-2"></i></button>
														<button type="button" class="btn btn-sm btn-outline-danger js-delete-row" title="Delete"><i class="feather icon-trash-2"></i></button>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header">Challenges List</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Title</th>
														<th>Icon</th>
														<th>Description</th>
														<th>Order</th>
														<th style="width:140px;">Actions</th>
													</tr>
												</thead>
												<tbody id="challengeTableBody" data-empty-cols="5">
													<tr>
														<td><input type="text" class="form-control form-control-sm" value="Extreme weather conditions" readonly></td>
														<td><input type="text" class="form-control form-control-sm" value="feather icon-alert-triangle" readonly></td>
														<td><input type="text" class="form-control form-control-sm" value="Extreme weather conditions ranging from hot summers to cool winters." readonly></td>
														<td><input type="number" class="form-control form-control-sm" value="1" readonly></td>
														<td>
															<div class="action-btn-group">
																<button type="button" class="btn btn-sm btn-outline-success js-row-edit" title="Edit"><i class="feather icon-edit-2"></i></button>
																<button type="button" class="btn btn-sm btn-outline-danger js-delete-row" title="Delete"><i class="feather icon-trash-2"></i></button>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12">
								<div class="card mb-30">
									<div class="card-header">Solutions List</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered table-sm mb-0 listing-table">
												<thead>
													<tr>
														<th>Title</th>
														<th>Icon</th>
														<th>Description</th>
														<th>Order</th>
														<th style="width:140px;">Actions</th>
													</tr>
												</thead>
												<tbody id="solutionTableBody" data-empty-cols="5">
													<tr>
														<td><input type="text" class="form-control form-control-sm" value="High-quality all-weather fabrics" readonly></td>
														<td><input type="text" class="form-control form-control-sm" value="feather icon-shield" readonly></td>
														<td><input type="text" class="form-control form-control-sm" value="Used high-quality, all-weather fabrics and insulated roofing for maximum comfort." readonly></td>
														<td><input type="number" class="form-control form-control-sm" value="1" readonly></td>
														<td>
															<div class="action-btn-group">
																<button type="button" class="btn btn-sm btn-outline-success js-row-edit" title="Edit"><i class="feather icon-edit-2"></i></button>
																<button type="button" class="btn btn-sm btn-outline-danger js-delete-row" title="Delete"><i class="feather icon-trash-2"></i></button>
															</div>
														</td>
													</tr>
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
											<textarea class="form-control" name="testimonial_quote_ui" rows="5" placeholder="Enter testimonial quote">The Villa Tent delivered beyond our expectations.</textarea>
										</div>
									</div>
									<div class="col-lg-3 col-md-6">
										<div class="commonSection">
											<label>Client Name</label>
											<input class="form-control" type="text" name="testimonial_client_name_ui" value="General Manager" placeholder="Client name">
										</div>
									</div>
									<div class="col-lg-3 col-md-6">
										<div class="commonSection">
											<label>Designation</label>
											<input class="form-control" type="text" name="testimonial_designation_ui" value="The Oberoi Rajgarh Palace" placeholder="Designation">
										</div>
									</div>
									<div class="col-lg-4 col-md-6">
										<div class="commonSection mb-0">
											<label>Company / Hotel Name</label>
											<input class="form-control" type="text" name="testimonial_company_ui" value="The Oberoi Rajgarh Palace" placeholder="Company name">
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection mb-0">
											<label>Background Color</label>
											<input class="form-control" type="text" name="testimonial_bg_ui" value="#0E3528" placeholder="#0E3528">
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection mb-0">
											<label>Text Color</label>
											<input class="form-control" type="text" name="testimonial_text_ui" value="#FFFFFF" placeholder="#FFFFFF">
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection mb-0">
											<label>Accent Color</label>
											<input class="form-control" type="text" name="testimonial_accent_ui" value="#C9A45A" placeholder="#C9A45A">
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="commonSection mb-0">
											<label>Border Radius</label>
											<input class="form-control" type="number" name="testimonial_radius_ui" value="12" placeholder="12">
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>

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

							document.addEventListener('click', function(event) {
								var editBtn = event.target.closest('.js-row-edit');
								if (editBtn) {
									var row = editBtn.closest('tr');
									if (!row) {
										return;
									}
									var rowInputs = row.querySelectorAll('input');
									if (!rowInputs.length) {
										return;
									}
									var isLocked = rowInputs[0].hasAttribute('readonly');
									Array.prototype.forEach.call(rowInputs, function(input) {
										if (isLocked) {
											input.removeAttribute('readonly');
										} else {
											input.setAttribute('readonly', 'readonly');
										}
									});
									if (isLocked) {
										editBtn.classList.remove('btn-outline-success');
										editBtn.classList.add('btn-success');
										editBtn.setAttribute('title', 'Save');
										var iconEdit = editBtn.querySelector('i');
										if (iconEdit) {
											iconEdit.className = 'feather icon-check';
										}
										rowInputs[0].focus();
									} else {
										editBtn.classList.remove('btn-success');
										editBtn.classList.add('btn-outline-success');
										editBtn.setAttribute('title', 'Edit');
										var iconSave = editBtn.querySelector('i');
										if (iconSave) {
											iconSave.className = 'feather icon-edit-2';
										}
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
								rowToDelete = null;
								closeModal('confirmDeleteModal');
							});

							document.getElementById('confirmDeleteModal').addEventListener('hidden.bs.modal', function() {
								rowToDelete = null;
							});

							['projectInfoTableBody', 'challengeTableBody', 'solutionTableBody'].forEach(function(tbodyId) {
								ensureEmptyState(tbodyId);
							});
						})();
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once('common/footer.php'); ?>
