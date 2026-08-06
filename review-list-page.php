<?php
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Review List Page";

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM home_testimonials WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='review-list-page.php';</script>";
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
                     <h1>Review Listings</h1>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Review Listings</span>
                     </div>
                  </div>

                  <div class="listing-cta">
                     <a href="add-review.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Review</a>
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
                        <table class="table table-bordered listing-table">
                           <thead>
                              <tr>
                                 <th>Sr. No</th>
                                 <th>Auther Name</th>
                                 <th>Auther Designation</th>
                                 <th>Auther Descripton</th>
                                 <th>Auther Image</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>

                           <tbody>
                              <?php  
                                 $i = 1;
                                 $queri1 = mysqli_query($con,"SELECT * FROM home_testimonials");
                                 while($q2 = mysqli_fetch_assoc($queri1))
                                 { 
                                    $hasName = trim((string)$q2['name']) !== '';
                                    $hasImage = trim((string)$q2['image']) !== '';
                                    $statusLabel = ($hasName && $hasImage) ? 'Published' : 'Draft';
                                    $statusClass = ($statusLabel === 'Published') ? 'status-published' : 'status-draft';
                                 ?>
                                    <tr role="row">
                                       <td><?php echo $i; ?></td>
                                       <td><?php echo $q2['name']; ?></td>
                                       <td><?php echo $q2['designation']; ?></td>
                                       <td>
                                          <p><?php echo $q2['discription']; ?></p>
                                       </td>
                                       <td>
                                          <img src="<?php echo $q2['image']; ?>" class="img-thumbnail" height="64" width="64">
                                       </td>
                                       <td>
                                          <span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span>
                                       </td>
                                       <td>
                                          <div class="table-actions">
                                             <a href="edit-review.php?id=<?php echo $q2['id']; ?>">
                                                <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                             </a>

                                             <a href="review-list-page.php?id=<?php echo $q2['id']; ?>">
                                                <button class="btn btn-outline-danger btn-sm table-action-btn" onclick="return confirm('Are you sure you want to delete this review?');"><i class="feather icon-trash-2"></i></button>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                 <?php  
                                    $i++;
                                 }
                              ?>
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