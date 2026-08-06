<?php 
   include_once('db.php');
   $PageTitle = "Villatent: Our Values";
   include_once('common/header.php');

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM company_values WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='values-list-page.php';</script>";
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
                     <h1>Why Choose Us (Features)</h1>
                     <p class="listing-subtitle">Manage features displayed in the Why Choose Us section on homepage.</p>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>About Us</span><span class="crumb-sep">&gt;</span><span>Our Values</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="add-value.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Feature</a>
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
                                 <th>Icon</th>
                                 <th>Title</th>
                                 <th>Description</th>
                                 <th>Display Order</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php
                              $Result = mysqli_query($con, "SELECT * FROM company_values");
                              $i=1;
                              while($Row = mysqli_fetch_assoc($Result)) { ?>
                                 <tr role="row">
                                    <td><?php echo $i; ?></td>
                                    <td><span class="material-icons" style="font-size:40px;"><?php echo $Row['icon']; ?></span></td>
                                    <td><?php echo $Row['title']; ?></td>
                                    <td><?php echo $Row['description']; ?></td>
                                    <td><?php echo $Row['display_order']; ?></td>
                                    <td><span class="status-badge status-active"><?php echo $Row['status']; ?></span></td>
                                    <td>
                                       <div class="table-actions">
                                          <a href="edit-value.php?id=<?php echo $Row['id']; ?>">
                                             <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                          </a>
                                          <a href="values-list-page.php?id=<?php echo $Row['id']; ?>" onclick="return confirm('Are you sure you want to delete this?');">
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
