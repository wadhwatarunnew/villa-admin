<?php
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Social Media";

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM footer_follow_us WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='socialmedialist.php';</script>";
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
                     <h1>Social Medias Listing</h1>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Social Medias Listing</span>
                     </div>
                  </div>

                  <div class="listing-cta">
                     <a href="add-media.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Social Media</a>
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
                                 <th>Sr. No.</th>
                                 <th>Name</th>
                                 <th>Link</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
                                 $i = 1;
                                 $queri1 = mysqli_query($con,"SELECT * FROM footer_follow_us");
                                 while($q2 = mysqli_fetch_assoc($queri1))
                                 {
                                    $hasName = trim((string)$q2['name']) !== '';
                                    $hasLink = trim((string)$q2['link']) !== '';
                                    $statusLabel = ($hasName && $hasLink) ? 'Published' : 'Draft';
                                    $statusClass = ($statusLabel === 'Published') ? 'status-published' : 'status-draft';
                                 ?>
                                    <tr role="row">
                                       <td><?php echo $i; ?></td>
                                       <td><?php echo $q2['name']; ?></td>
                                       <td><?php echo $q2['link']; ?></td>
                                       <td><span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span></td>
                                       <td>
                                          <div class="table-actions">
                                             <a href="edit-media.php?id=<?php echo $q2['id']; ?>">
                                                <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                             </a> 

                                             <a  href="socialmedialist.php?id=<?php echo $q2['id']; ?>" onclick="return confirm('Are you sure you want to delete this?');">
                                                <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
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