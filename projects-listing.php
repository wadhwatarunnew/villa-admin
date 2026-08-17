<?php 
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Projects Listing";

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
                                 $i = 1;	 
                                 $query4= mysqli_query($con, "SELECT * FROM project_types");
                                 while($b=mysqli_fetch_assoc($query4)) {
                              ?>
                                 <tr role="row">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $b['category']; ?></td>
                                    <td><?php echo $b['metatitle']; ?></td>
                                    <td><?php echo $b['keyword']; ?></td>
                                    <td><?php echo $b['discription']; ?></td>
   									      <td><?php echo $b['title']; ?></td>     
                                    <td>
                                       <?php
                                          $hasTitle = trim((string)$b['title']) !== '';
                                          $hasCategory = trim((string)$b['category']) !== '';
                                          $statusLabel = ($hasTitle && $hasCategory) ? 'Published' : 'Draft';
                                          $statusClass = ($statusLabel === 'Published') ? 'status-published' : 'status-draft';
                                       ?>
                                       <span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span>
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
   								   <?php $i++; }  ?> 
                           </tbody>
                        </table>
                     </div>   
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include_once('common/footer.php'); ?>