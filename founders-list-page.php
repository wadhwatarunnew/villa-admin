<?php
   include_once('db.php');
   $PageTitle = "Villatent: Our Founders";
   include_once('common/header.php');

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM founders WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='founders-list-page.php';</script>";
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
                     <h1>Vision Behind The Villa Tent</h1>
                     <p class="listing-subtitle">Manage team/vision members displayed in this section.</p>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>About Us</span><span class="crumb-sep">&gt;</span><span>Our Founders</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="add-founder.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Member</a>
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
                                 <th>#</th>
                                 <th>Photo</th>
                                 <th>Name</th>
                                 <th>Designation</th>
                                 <th>Short Description</th>
                                 <th>Display Order</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php
                              $Result = mysqli_query($con, "SELECT * FROM founders");
                              $i=1;
                              while($Row = mysqli_fetch_assoc($Result)) { ?>
                                 <tr role="row">
                                    <td><?php echo $i; ?></td>
                                    <td><img src="<?php echo $Row['image']; ?>" alt="Ajay Garg" class="founder-thumb" width="200" height="50"></td>
                                    <td><?php echo $Row['name']; ?></td>
                                    <td><?php echo $Row['designation']; ?></td>
                                    <td><?php echo $Row['bio']; ?></td>
                                    <td><?php echo $Row['display_order']; ?></td>
                                    <td><span class="status-badge status-active"><?php echo $Row['status']; ?></span></td>
                                    <td>
                                       <div class="table-actions">
                                          <a href="edit-founder.php?id=<?php echo $Row['id']; ?>">
                                             <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                          </a>
                                          <a href="founders-list-page.php?id=<?php echo $Row['id']; ?>" onclick="return confirm('Are you sure you want to delete this?');">
                                             <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                          </a>
                                       </div>
                                    </td>
                                 </tr>
                           <?php $i++; } ?>
                           </tbody>
                        </table>
                     </div>
                     <!-- <div class="listing-info-text">Showing 1 to 2 of 2 members</div> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include_once('common/footer.php'); ?>
