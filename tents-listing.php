<?php
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Resorts Listing";

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM resort_types WHERE id='$id'");
      mysqli_query($con, "DELETE FROM tent_details WHERE tent_id='$id'");

      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='tents-listing.php';</script>";
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
                     <h1>Tents Listings</h1>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Tents Listings</span>
                     </div>
                  </div>

                  <div class="listing-cta">
                     <a href="add-tent.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Tent</a>
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
                                 <th>Category</th>
                                 <th>Meta Title</th>
                                 <th>Meta Keyword</th>
                                 <th>Meta Descripton</th>
                                 <th>Tent Name</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $i = 1;	 
                                 $query4 = mysqli_query($con,"SELECT * FROM resort_types ORDER BY id DESC");
                                 while($b = mysqli_fetch_assoc($query4)) {
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
                                             <a href="edit-tent.php?id=<?php echo $b['id']; ?>">
                                                <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                             </a>

                                             <a href="tents-listing.php?id=<?php echo $b['id']; ?>" onclick="return confirm('Are you sure you want to delete this tent?')">
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