<?php
   include "db.php";
   include_once('common/header.php');
   require_once('common/pagination.class.php');
   $perPage = new PerPage(); 
   $PageTitle = "Villatent: Blog List Page";

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM blog_inner_content WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='blogs-listing.php';</script>";
      exit;
   }

   $search = $_GET['search'];
   $sql = "SELECT * FROM blog_inner_content";
   $paginationlink = "blogs-listing.php?search=$search&page=";    
   $pagination_setting = "all-links";
                   
   $page = 1;
   if(!empty($_GET["page"]))
   {
      $page = $_GET["page"];
   }

   if($search != '')
   {
      $sql = $sql . " WHERE title LIKE '%$search%'";
   }

   $start = ($page-1)*$perPage->perpage;
   if($start < 0) $start = 0;
   $query =  $sql . " ORDER BY id DESC LIMIT " . $start . "," . $perPage->perpage;
   $totalCount = mysqli_query($con,$sql);
   $query4 = mysqli_query($con,$query);

   if(empty($_GET["rowcount"]))
   {
      $_GET["rowcount"] = mysqli_num_rows($totalCount);
   }

   $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting);
   $i = 1;   
   if($page > 1)
   {
      $i = 10*($page - 1) + 1;
   }
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Blog Listings</h1>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Blog Listings</span>
                     </div>
                  </div>

                  <div class="listing-cta">
                     <a href="add-blog.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Blog</a>
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
                  <div class="col-sm-12">
                     <form method="GET" action="blogs-listing.php" class="listing-filter-form">
                        <div class="listing-filter-grid">
                           <div class="listing-filter-field listing-filter-search">
                              <label for="project-search">Search</label>
                              <div class="listing-input-wrap">
                                 <i class="feather icon-search"></i>
                                 <input type="text" name="search" id="project-search" class="form-control" placeholder="Search by blog title" value="<?php echo htmlspecialchars($search); ?>">
                              </div>
                           </div>

                           <div class="listing-filter-actions">
                              <button type="submit" class="btn btn-success btn-sm">
                                 <i class="feather icon-filter"></i>Apply Filters
                              </button>
                              <a href="blogs-listing.php" class="btn btn-primary btn-sm">
                                 <i class="feather icon-refresh-cw"></i>Reset
                              </a>
                           </div>
                        </div>
                     </form>
                  </div>

                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table table-bordered listing-table">
                           <thead>
                              <tr>
                                 <th>Sr. No.</th>
                                 <th>Title</th>
                                 <th>Date</th>
                                 <th>Image</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
							         <?php 
                                 if(mysqli_num_rows($query4) > 0) {
                                 while($b=mysqli_fetch_assoc($query4)) {
                              ?>
                                 <tr role="row">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $b['title']; ?></td>
                                    <td><?php echo $b['date']; ?></td>
                                    <?php if(!$b['image']) { ?>
												   <td>
                                          <img src="<?php echo $b['local_path']; ?>" class="img-thumbnail" height="64" width="64">
                                       </td>
											   <?php } else { ?>
                                       <td>
                                          <img src="<?php echo $b['image']; ?>" class="img-thumbnail" height="64" width="64">
                                       </td>
											   <?php  }  ?>

                                    <?php
                                       $hasTitle = trim((string)$b['title']) !== '';
                                       $hasImage = trim((string)$b['image']) !== '' || trim((string)$b['local_path']) !== '';
                                       $statusLabel = ($hasTitle && $hasImage) ? 'Published' : 'Draft';
                                       $statusClass = ($statusLabel === 'Published') ? 'status-published' : 'status-draft';
                                    ?>
                                    <td><span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span></td>
                                    <td>
                                       <div class="table-actions">
                                          <a href="edit-blog.php?id=<?php echo $b['id']; ?>">
                                             <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                          </a>

                                          <a href="blogs-listing.php?id=<?php echo $b['id']; ?>" onclick="return confirm('Are you sure you want to delete this blog?');">
                                             <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                          </a>
                                       </div>
                                    </td>
                                 </tr>
			                     <?php $i++; }
                              } else { ?>
                                 <tr role="row"><td colspan="6"><center>No Blog Found.</center></td></tr>
                              <?php } ?>
                           </tbody>
                        </table>
                        <input type="hidden" name="rowcount" id="rowcount" value="<?php echo $_GET["rowcount"]; ?>" />
                        
                        <?php if(!empty($perpageresult) && $_GET["rowcount"] > 10) { ?>
                           <div id="pagination"><?php print_r($perpageresult); ?> </div>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!---->
<script>
   function getresult(url)
   {
      window.location.href = url;
   }
</script>
<!---->
<?php include_once('common/footer.php'); ?>