<?php
   include "db.php";
   $PageTitle = "Villatent: Brands";
   include_once('common/header.php');

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM brands WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='brands-list-page.php';</script>";
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
                     <h1>Brands</h1>
                     <p class="listing-subtitle">Manage brand logos displayed on the homepage.</p>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Brands</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="add-brand.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Brand</a>
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
                                 <th>Logo</th>
                                 <th>Alt Text</th>
                                 <th>Link (URL)</th>
                                 <th>Display Order</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $i = 1;   
                              $Brands = mysqli_query($con,"SELECT * FROM brands ORDER BY display_order");
                              while($Row = mysqli_fetch_assoc($Brands))
                              {
                                 ?>
                                 <tr role="row">
                                    <td><?php echo $i;?></td>
                                    <td><img src="uploads/brands/taj-logo.png" alt="Taj Hotels" class="brand-logo-thumb"></td>
                                    <td><?php echo $Row['name'];?></td>
                                    <td><a href="<?php echo $Row['link'];?>" target="_blank" class="brand-link"><?php echo $Row['link'];?></a></td>
                                    <td><?php echo $Row['display_order'];?></td>
                                    <td><span class="status-badge status-active"><?php echo $Row['status'];?></span></td>
                                    <td>
                                       <div class="table-actions">
                                          <a href="edit-brand.php?id=<?php echo $Row['id'];?>">
                                             <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                          </a>
                                          <a href="brands-list-page.php?id=<?php echo $Row['id'];?>" onclick="return confirm('Are you sure you want to delete this brand?');">
                                             <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                          </a>
                                       </div>
                                    </td>
                                 </tr>
                              <?php $i++; } ?>
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