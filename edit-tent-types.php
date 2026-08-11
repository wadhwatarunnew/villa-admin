<?php
error_reporting(0);

$id = $_GET['id'];

include "db.php";
$query3 = mysqli_query($con, "select * from resort_types where id=$id");
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
	$y_url = $_POST['y_url'];
	$editor2 = $_POST['editor2'];
	$imageUrl = $_POST['image'];
	$myFile = $_FILES['myFile']['name'];

	$path = "uploads/pageimages/resort/types/";
	$path_original = "uploads/pageimages/resort/types/";

	if (!$imageUrl) {
		if ($myFile != '' && (file_exists("uploads/pageimages/" . $myFile) || file_exists("uploads/pageimages/addgallery/" . $myFile) || file_exists("uploads/pageimages/addgallery/project/" . $myFile) || file_exists("uploads/pageimages/addgallery/resort/" . $myFile) || file_exists("uploads/pageimages/blogs/" . $myFile) || file_exists("uploads/pageimages/blogs/single/" . $myFile) || file_exists("uploads/pageimages/contact/" . $myFile) || file_exists("uploads/pageimages/nav/" . $myFile) || file_exists("uploads/pageimages/nav/category/" . $myFile) || file_exists("uploads/pageimages/nav/types/" . $myFile) || file_exists("uploads/pageimages/project/" . $myFile) || file_exists("uploads/pageimages/project/category/" . $myFile) || file_exists("uploads/pageimages/project/types/" . $myFile) || file_exists("uploads/pageimages/resort/" . $myFile) || file_exists("uploads/pageimages/resort/category/" . $myFile) || file_exists("uploads/pageimages/resort/types/" . $myFile) || file_exists("uploads/pageimages/slider/" . $myFile) || file_exists("uploads/pageimages/youtube/" . $myFile))) {
			$FileExists = true;
			header("refresh:2; url=edit-tent-types.php?id=$id");
		} else {
			move_uploaded_file($_FILES['myFile']['tmp_name'], $path . $myFile);
			$path = $path_original . $myFile;
			include "db.php";
			mysqli_query($con, "update resort_types SET title='$title',content='$editor1',image='',local_path='$path',metatitle='$metaTitle',keyword='$keyword',discription='$disc',y_url='$y_url',dimension='$editor2',category='$cat',order_no='$order' where id=$id");
			header("refresh:2; url=edit-tent-types.php?id=$id");
		}
	} else {
		include "db.php";
		mysqli_query($con, "update resort_types SET title='$title',content='$editor1',image='$imageUrl',metatitle='$metaTitle',keyword='$keyword',discription='$disc',y_url='$y_url',dimension='$editor2',category='$cat',order_no='$order' where id=$id");
		header("refresh:2; url=edit-tent-types.php?id=$id");
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
	$y_url1 = $_POST['y_url1'];
	$editor22 = $_POST['editor22'];
	$imageUrl1 = $_POST['image1'];
	$myFile1 = $_FILES['myFile1']['name'];

	$path2 = "uploads/pageimages/resort/types/";
	$path_original2 = "uploads/pageimages/resort/types/";

	if (!$imageUrl1) {
		if ($myFile1 != '' && (file_exists("uploads/pageimages/" . $myFile1) || file_exists("uploads/pageimages/addgallery/" . $myFile1) || file_exists("uploads/pageimages/addgallery/project/" . $myFile1) || file_exists("uploads/pageimages/addgallery/resort/" . $myFile1) || file_exists("uploads/pageimages/blogs/" . $myFile1) || file_exists("uploads/pageimages/blogs/single/" . $myFile1) || file_exists("uploads/pageimages/contact/" . $myFile1) || file_exists("uploads/pageimages/nav/" . $myFile1) || file_exists("uploads/pageimages/nav/category/" . $myFile1) || file_exists("uploads/pageimages/nav/types/" . $myFile1) || file_exists("uploads/pageimages/project/" . $myFile1) || file_exists("uploads/pageimages/project/category/" . $myFile1) || file_exists("uploads/pageimages/project/types/" . $myFile1) || file_exists("uploads/pageimages/resort/" . $myFile1) || file_exists("uploads/pageimages/resort/category/" . $myFile1) || file_exists("uploads/pageimages/resort/types/" . $myFile1) || file_exists("uploads/pageimages/slider/" . $myFile1) || file_exists("uploads/pageimages/youtube/" . $myFile1))) {
			$FileExists = true;
			header("refresh:2; url=edit-tent-types.php?id=$id");
		} else {
			include "db.php";
			move_uploaded_file($_FILES['myFile1']['tmp_name'], $path2 . $myFile1);
			$path1 = $path_original2 . $myFile1;

			if (!$_FILES['myFile1']['name']) {
				mysqli_query($con, "update resort_types SET title='$title1',content='$editor12',metatitle='$metaTitle1',keyword='$keyword1',discription='$disc1',y_url='$y_url1',dimension='$editor22',category='$cat1',order_no='$order1' where id=$id");
				header("refresh:2; url=edit-tent-types.php?id=$id");
			} else {
				mysqli_query($con, "update resort_types SET title='$title1',content='$editor12',local_path='$path1',metatitle='$metaTitle1',keyword='$keyword1',discription='$disc1',y_url='$y_url1',dimension='$editor22',category='$cat1',order_no='$order1' where id=$id");
				header("refresh:2; url=edit-tent-types.php?id=$id");
			}
		}
	} else {
		include "db.php";
		mysqli_query($con, "update resort_types SET title='$title1',content='$editor12',image='$imageUrl1',local_path='',metatitle='$metaTitle1',keyword='$keyword1',discription='$disc1',y_url='$y_url1',dimension='$editor22',category='$cat1',order_no='$order1' where id=$id");
		header("refresh:2; url=edit-tent-types.php?id=$id");
	}
}
?>

<?php $PageTitle = "Villatent: Resorts"; ?>
<?php include_once('common/header.php'); ?>
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
								<a href="project-listing.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<?php if(!$b['local_path']){ ?>
								<input type="submit" class="btn btn-success btn-sm" id="btnn" name="update" value="Save" form="editTentTypeForm">
								<?php }else{ ?>
								<input type="submit" class="btn btn-success btn-sm" id="btnn1" name="update1" value="Save" form="editTentTypeForm">
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
							<div class="card-header">Hero Section</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-4">
										<div class="commonSection">
											<label>Collection/Category Label</label>
											<select class="form-control" name="<?php echo !$b['local_path'] ? 'cat' : 'cat1'; ?>" required>
												<option value="<?php echo $b['category']; ?>"><?php echo $b['category']; ?></option>
												<?php
												include "db.php";
												$queryl = mysqli_query($con,"select * from resort_category group by title");
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
									<div class="col-md-12">
										<div class="commonSection">
											<label>Short Description</label>
											<textarea class="form-control" name="<?php echo !$b['local_path'] ? 'editor1' : 'editor12'; ?>" id="editor1" rows="4" required placeholder="Enter short description"><?php echo $b['content']; ?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card mb-30">
							<div class="card-header">Features Quick Info</div>
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
											<tr>
												<td>Size</td>
												<td>65 SQM</td>
												<td>
													<div class="action-btn-group">
														<button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button>
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
									<div class="card-header">Features &amp; Benefits</div>
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
													<tr>
														<td>Elegant Accommodation</td>
														<td>Spacious bedroom with premium comfort.</td>
														<td>
															<div class="action-btn-group">
																<button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button>
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
									<div class="card-header">Materials</div>
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
													<tr>
														<td>450 GSM Shade Net</td>
														<td>Top layer for shade and UV protection.</td>
														<td>
															<div class="action-btn-group">
																<button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button>
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
									<div class="card-header">Specifications</div>
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
													<tr>
														<td><input type="text" class="form-control form-control-sm" value="Overall Size" readonly></td>
														<td><input type="text" class="form-control form-control-sm" value="23 ft" readonly></td>
														<td><input type="text" class="form-control form-control-sm" value="7 m" readonly></td>
														<td>
															<div class="action-btn-group">
																<button type="button" class="btn btn-sm btn-outline-success js-edit-spec" title="Edit"><i class="feather icon-edit-2"></i></button>
																<button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button>
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
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card mb-30">
							<div class="card-header">7 Status</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="commonSection">
											<label>Status</label>
											<select class="form-control" name="status_ui">
												<option value="published">Published</option>
												<option value="draft">Draft</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php if(!$b['local_path']){ ?>
						<input type="hidden" name="y_url" value="<?php echo $b['y_url']; ?>">
						<input type="hidden" name="editor2" value="<?php echo htmlspecialchars($b['dimension'], ENT_QUOTES); ?>">
						<?php }else{ ?>
						<input type="hidden" name="y_url1" value="<?php echo $b['y_url']; ?>">
						<input type="hidden" name="editor22" value="<?php echo htmlspecialchars($b['dimension'], ENT_QUOTES); ?>">
						<?php } ?>
					</form>

					
				</div>

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
				</script>

				<script>
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

							var deleteBtn = event.target.closest('.js-delete-row');
							if (!deleteBtn) {
								return;
							}
							var rowToDelete = deleteBtn.closest('tr');
							if (!rowToDelete) {
								return;
							}
							var parentTbody = rowToDelete.closest('tbody');
							rowToDelete.remove();
							if (parentTbody && parentTbody.id) {
								ensureEmptyState(parentTbody.id);
							}
						});

						['quickInfoTableBody', 'featureTableBody', 'materialTableBody', 'specificationTableBody'].forEach(function(tbodyId) {
							ensureEmptyState(tbodyId);
						});
					})();
				</script>

				<script>
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
				</script>

				<script>
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
				</script>

				<script>
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
				</script>

				<script>
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
			</div>
		</div>
	</div>
</div>
<?php include_once('common/footer.php'); ?>
