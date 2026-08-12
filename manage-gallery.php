<?php $PageTitle = "Villatent: Manage Gallery"; ?>
<?php include_once('common/header.php'); ?>
<?php
$selectedTentCategory = isset($_GET['tent_category']) ? trim((string)$_GET['tent_category']) : '';
$selectedProjectCategory = isset($_GET['project_category']) ? trim((string)$_GET['project_category']) : '';

$tentCategories = array();
$projectCategories = array();

$tentCategoryQuery = mysqli_query($con, "SELECT title FROM resort_category ORDER BY order_no ASC, id DESC");
if ($tentCategoryQuery) {
   while ($item = mysqli_fetch_assoc($tentCategoryQuery)) {
      if (!empty($item['title'])) {
         $tentCategories[] = $item['title'];
      }
   }
}

$projectCategoryQuery = mysqli_query($con, "SELECT title FROM project_category ORDER BY order_no ASC, id DESC");
if ($projectCategoryQuery) {
   while ($item = mysqli_fetch_assoc($projectCategoryQuery)) {
      if (!empty($item['title'])) {
         $projectCategories[] = $item['title'];
      }
   }
}

$galleryRows = array();
$galleryQuery = mysqli_query($con, "SELECT * FROM add_gallery ORDER BY id DESC");
if ($galleryQuery) {
   while ($galleryItem = mysqli_fetch_assoc($galleryQuery)) {
      $galleryRows[] = $galleryItem;
   }
}

$galleryDisplayRows = array();
foreach ($galleryRows as $row) {
   $rowType = isset($row['types']) ? trim((string)$row['types']) : '';
   $rowTitle = isset($row['title']) ? trim((string)$row['title']) : '';

   if ($selectedTentCategory !== '' && strtolower($rowType) === 'resort tents') {
      if (stripos($rowTitle, $selectedTentCategory) === false) {
         continue;
      }
   }

   if ($selectedProjectCategory !== '' && strtolower($rowType) === 'projects') {
      if (stripos($rowTitle, $selectedProjectCategory) === false) {
         continue;
      }
   }

   for ($i = 1; $i <= 10; $i++) {
      $key = 'p' . $i;
      $img = isset($row[$key]) ? trim((string)$row[$key]) : '';
      if ($img !== '') {
         $galleryDisplayRows[] = array(
            'types' => $rowType,
            'title' => $rowTitle,
            'image' => $img,
            'source_id' => isset($row['id']) ? (int)$row['id'] : 0,
         );
      }
   }
}

$perPage = 20;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) {
   $currentPage = 1;
}

$totalRecords = count($galleryDisplayRows);
$totalPages = (int)ceil($totalRecords / $perPage);
if ($totalPages < 1) {
   $totalPages = 1;
}
if ($currentPage > $totalPages) {
   $currentPage = $totalPages;
}

$startIndex = ($currentPage - 1) * $perPage;
$paginatedRows = array_slice($galleryDisplayRows, $startIndex, $perPage);
?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Manage Gallery</h1>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Gallery</span><span class="crumb-sep">&gt;</span><span>Manage</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="add-gallery.php" class="btn btn-primary btn-sm"><i class="feather icon-plus"></i> Add Gallery</a>
                  </div>
               </div>

               <div class="card mb-30">
                  <div class="card-header">Gallery Listing</div>
                  <div class="card-body">
                     <form method="get" class="row" style="margin-bottom:16px;">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <div class="commonSection" style="margin-bottom:12px;">
                              <label>Tents Category</label>
                              <select name="tent_category" class="form-control">
                                 <option value="">All Tents Categories</option>
                                 <?php foreach ($tentCategories as $cat) { ?>
                                    <option value="<?php echo htmlspecialchars((string)$cat, ENT_QUOTES, 'UTF-8'); ?>" <?php echo ($selectedTentCategory === $cat) ? 'selected' : ''; ?>><?php echo htmlspecialchars((string)$cat, ENT_QUOTES, 'UTF-8'); ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <div class="commonSection" style="margin-bottom:12px;">
                              <label>Project Category</label>
                              <select name="project_category" class="form-control">
                                 <option value="">All Project Categories</option>
                                 <?php foreach ($projectCategories as $cat) { ?>
                                    <option value="<?php echo htmlspecialchars((string)$cat, ENT_QUOTES, 'UTF-8'); ?>" <?php echo ($selectedProjectCategory === $cat) ? 'selected' : ''; ?>><?php echo htmlspecialchars((string)$cat, ENT_QUOTES, 'UTF-8'); ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                           <div class="listing-cta" style="justify-content:flex-start; padding-top:30px;">
                              <button type="submit" class="btn btn-primary btn-sm"><i class="feather icon-filter"></i> Apply</button>
                              <a href="manage-gallery.php" class="btn btn-outline-secondary btn-sm">Reset</a>
                           </div>
                        </div>
                     </form>

                     <div class="table-responsive">
                        <table class="table table-bordered listing-table">
                           <thead>
                              <tr>
                                 <th>Sr. No</th>
                                 <th>Category</th>
                                 <th>Tent / Project Name</th>
                                 <th>Image</th>
                                 <th>URL</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if (!empty($paginatedRows)) { ?>
                                 <?php $sr = $startIndex + 1; ?>
                                 <?php foreach ($paginatedRows as $row) { ?>
                                    <tr role="row">
                                       <td><?php echo $sr++; ?></td>
                                       <td><?php echo htmlspecialchars((string)$row['types'], ENT_QUOTES, 'UTF-8'); ?></td>
                                       <td><?php echo htmlspecialchars((string)$row['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                                       <td>
                                          <img src="<?php echo htmlspecialchars((string)$row['image'], ENT_QUOTES, 'UTF-8'); ?>" class="img-thumbnail" height="64" width="64" style="object-fit:cover;" onerror="this.src='images/default-profile.png';">
                                       </td>
                                       <td>
                                          <a href="<?php echo htmlspecialchars((string)$row['image'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank">View Image URL</a>
                                       </td>
                                       <td>
                                          <div class="table-actions">
                                             <a href="update-gallery.php" class="btn btn-outline-success btn-sm table-action-btn" title="Update Gallery"><i class="feather icon-edit"></i></a>
                                             <a href="delete-gallery.php" class="btn btn-outline-danger btn-sm table-action-btn" title="Delete Gallery"><i class="feather icon-trash-2"></i></a>
                                          </div>
                                       </td>
                                    </tr>
                                 <?php } ?>
                              <?php } else { ?>
                                 <tr>
                                    <td colspan="6" class="text-center">No gallery records found.</td>
                                 </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>

                     <?php if ($totalRecords > 0) { ?>
                        <div class="d-flex justify-content-between align-items-center" style="margin-top: 14px;">
                           <div class="counter-help-text">
                              Showing <?php echo $startIndex + 1; ?> to <?php echo $startIndex + count($paginatedRows); ?> of <?php echo $totalRecords; ?> records
                           </div>
                        </div>

                        <?php if ($totalPages > 1) { ?>
                           <?php
                           $baseParams = array(
                              'tent_category' => $selectedTentCategory,
                              'project_category' => $selectedProjectCategory,
                           );

                           $buildPageUrl = function ($pageNum) use ($baseParams) {
                              $params = $baseParams;
                              $params['page'] = $pageNum;
                              return 'manage-gallery.php?' . http_build_query($params);
                           };
                           ?>
                           <div id="pagination">
                              <?php if ($currentPage == 1) { ?>
                                 <span class="link first disabled">&#8810;</span><span class="link disabled">&#60;</span>
                              <?php } else { ?>
                                 <a class="link first" href="<?php echo htmlspecialchars($buildPageUrl(1), ENT_QUOTES, 'UTF-8'); ?>">&#8810;</a><a class="link" href="<?php echo htmlspecialchars($buildPageUrl($currentPage - 1), ENT_QUOTES, 'UTF-8'); ?>">&#60;</a>
                              <?php } ?>

                              <?php if (($currentPage - 3) > 0) { ?>
                                 <?php if ($currentPage == 1) { ?>
                                    <span class="link current">1</span>
                                 <?php } else { ?>
                                    <a class="link" href="<?php echo htmlspecialchars($buildPageUrl(1), ENT_QUOTES, 'UTF-8'); ?>">1</a>
                                 <?php } ?>
                              <?php } ?>

                              <?php if (($currentPage - 3) > 1) { ?>
                                 <span class="dot">...</span>
                              <?php } ?>

                              <?php for ($p = $currentPage - 2; $p <= $currentPage + 2; $p++) { ?>
                                 <?php if ($p < 1 || $p > $totalPages) { continue; } ?>
                                 <?php if ($currentPage == $p) { ?>
                                    <span class="link current"><?php echo $p; ?></span>
                                 <?php } else { ?>
                                    <a class="link" href="<?php echo htmlspecialchars($buildPageUrl($p), ENT_QUOTES, 'UTF-8'); ?>"><?php echo $p; ?></a>
                                 <?php } ?>
                              <?php } ?>

                              <?php if (($totalPages - ($currentPage + 2)) > 1) { ?>
                                 <span class="dot">...</span>
                              <?php } ?>

                              <?php if (($totalPages - ($currentPage + 2)) > 0) { ?>
                                 <?php if ($currentPage == $totalPages) { ?>
                                    <span class="link current"><?php echo $totalPages; ?></span>
                                 <?php } else { ?>
                                    <a class="link" href="<?php echo htmlspecialchars($buildPageUrl($totalPages), ENT_QUOTES, 'UTF-8'); ?>"><?php echo $totalPages; ?></a>
                                 <?php } ?>
                              <?php } ?>

                              <?php if ($currentPage < $totalPages) { ?>
                                 <a class="link" href="<?php echo htmlspecialchars($buildPageUrl($currentPage + 1), ENT_QUOTES, 'UTF-8'); ?>">></a><a class="link" href="<?php echo htmlspecialchars($buildPageUrl($totalPages), ENT_QUOTES, 'UTF-8'); ?>">&#8811;</a>
                              <?php } else { ?>
                                 <span class="link disabled">></span><span class="link disabled">&#8811;</span>
                              <?php } ?>
                           </div>
                        <?php } ?>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include_once('common/footer.php'); ?>