<?php
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Counters";

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM counters WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='counters-list-page.php';</script>";
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
                     <h1>Counters</h1>
                     <p class="listing-subtitle">Manage counter items displayed on the homepage.</p>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Counters</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="counters-inner-page.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Counter</a>
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
                                 <th>Number</th>
                                 <th>Status</th>
                                 <th>Display Order</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $i = 1;   
                              $Result = mysqli_query($con, "SELECT * FROM counters");
                              while($CounterRow = mysqli_fetch_assoc($Result))
                              {
                                 ?>
                                 <tr role="row">
                                    <td><?php echo $i; ?></td>
                                    <td><span class="material-icons" style="font-size:40px;"><?php echo $CounterRow['icon']; ?></span></td>
                                    <td><?php echo $CounterRow['title']; ?></td>
                                    <td><?php echo $CounterRow['number']."".$CounterRow['suffix']; ?></td>
                                    <td><span class="status-badge status-active"><?php echo $CounterRow['status']; ?></span></td>
                                    <td><?php echo $CounterRow['display_order']; ?></td>
                                    <td>
                                       <div class="table-actions">
                                          <a href="edit-counter.php?id=<?php echo $CounterRow['id']; ?>">
                                             <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                          </a>
                                          <a href="counters-list-page.php?id=<?php echo $CounterRow['id']; ?>" onclick="return confirm('Are you sure you want to delete this counter?');">
                                             <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                          </a>
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
