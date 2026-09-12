<?php 
   include "db.php";
   include_once('common/header.php');
   require_once('common/pagination.class.php');
   $PageTitle = "Villatent: Projects Listing";

   $search = $_GET['search'];
   $category = $_GET['category'];

   $perPage = new PerPage();
   $sql = "SELECT * FROM project_types";
   $paginationlink = "projects-listing.php?search=$search&category=$category&page=";    
   $pagination_setting = "all-links";
                   
   $page = 1;
   if(!empty($_GET["page"]))
   {
      $page = $_GET["page"];
   }

   if($search != '' && $category != '' && $category != 'All')
   {
      $sql = $sql . " WHERE title LIKE '%$search%' AND category = '$category'";
   }
   else if($search != '')
   {
      $sql = $sql . " WHERE title LIKE '%$search%'";
   }
   else if($category != '' && $category != 'All')
   {
      $sql = $sql . " WHERE category = '$category'";
   }
   $start = ($page-1)*$perPage->perpage;
   if($start < 0) $start = 0;

   $query =  $sql . " ORDER BY id DESC limit " . $start . "," . $perPage->perpage;
   $totalCount = mysqli_query($con, $sql);
   $query2 = mysqli_query($con, $query);

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

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM project_types WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='projects-listing.php';</script>";
      exit;
   }
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
      			<div class="listing-page-head">
      				<div class="listing-title-wrap">
      					<h1>Projects Listing</h1>
      					<div class="listing-breadcrumb">
      						<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Projects Listing</span>
      					</div>
      				</div>

      				<div class="listing-cta">
      					<a href="add-project.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Project</a>
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
                  <form method="GET" action="projects-listing.php" class="listing-filter-form">
                     <div class="listing-filter-grid">
                        <div class="listing-filter-field listing-filter-search">
                           <label for="project-search">Search</label>
                           <div class="listing-input-wrap">
                              <i class="feather icon-search"></i>
                              <input type="text" name="search" id="project-search" class="form-control" placeholder="Search by project title, keyword, description..." value="<?php echo htmlspecialchars($search); ?>">
                           </div>
                        </div>

                        <div class="listing-filter-field listing-filter-category">
                           <label for="mySelector">Project Category</label>
                           <div class="listing-input-wrap">
                              <i class="feather icon-folder"></i>
                              <select class="form-control" name="category" id="mySelector">
                              <option value="" >--Select Category--</option>
                              <option value="All" <?php echo ($category == 'All') ? "selected" : ""; ?>>All</option>
                              <?php
                                 $queryl= mysqli_query($con,"SELECT * FROM project_types GROUP BY category");
                                 while($l=mysqli_fetch_assoc($queryl)) { ?>
                                    <option value="<?php echo $l['category']; ?>" <?php echo ($category == $l['category']) ? "selected" : ""; ?>><?php echo $l['category']; ?></option>
                                 <?php  }  ?>
                              </select>
                           </div>
                       </div>

                        <div class="listing-filter-actions">
                           <button type="submit" class="btn btn-success btn-sm">
                              <i class="feather icon-filter"></i>Apply Filters
                           </button>
                           <a href="projects-listing.php" class="btn btn-primary btn-sm">
                              <i class="feather icon-refresh-cw"></i>Reset
                           </a>
                        </div>
                     </div>
                  </form>
                   </div>
                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table table-bordered table-fixed listing-table" id='myTable'>
                           <thead>
                              <tr>
                                 <th>Sr.No</th>
                                 <th>Project Category</th>
                                 <th>Meta Title</th>
                                 <th>Meta Keyword</th>
                                 <th>Meta Descripton</th>
                                 <th>Tent Name</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
      							   <?php 
                                 // $query4= mysqli_query($con, "SELECT * FROM project_types ORDER BY id DESC");
                                 if(mysqli_num_rows($query2) > 0) {
                                 while($b=mysqli_fetch_assoc($query2)) {
                                 $statusClass = ($b['status'] === 'Published') ? 'status-published' : 'status-draft';
                              ?>
                                 <tr role="row">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $b['category']; ?></td>
                                    <td><?php echo $b['metatitle']; ?></td>
                                    <td><?php echo $b['keyword']; ?></td>
                                    <td><?php echo $b['discription']; ?></td>
   									      <td><?php echo $b['title']; ?></td>     
                                    <td>
                                       <span class="status-badge <?php echo $statusClass; ?>"><?php echo $b['status']; ?></span>
                                    </td>
                                    <td>
                                       <div class="actions">
                                          <div class="table-actions">
                                             <a href="edit-project.php?id=<?php echo $b['id']; ?>">
                                                <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                             </a>

                                             <a href="projects-listing.php?id=<?php echo $b['id']; ?>" onclick="return confirm('Are you sure you want to delete this project?')">
                                                <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                             </a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
   								   <?php $i++; }
                              } else { ?>
                                 <tr role="row"><td colspan="8"><center>No Project Found.</center></td></tr>
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
<?php include_once('common/footer.php'); ?>

<script>
   function getresult(url)
   {
      window.location.href = url;
   }
</script>