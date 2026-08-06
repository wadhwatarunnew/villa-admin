<?php 
   include_once('db.php');
   include_once('common/header.php');
   $PageTitle = "Villatent: Mission & Vision";
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Mission & Vision Section</h1>
                     <p class="listing-subtitle">Manage mission & vision section displayed on the homepage.</p>
                     <div class="listing-breadcrumb">
                        <span>Home</span><span class="crumb-sep">&gt;</span><span>Mission & Vision</span>
                     </div>
                  </div>
                  <!-- <div class="listing-cta">
                     <a href="edit-mission-vision.php?id=1" class="btn btn-success btn-sm"><i class="feather icon-edit"></i> Edit Section</a>
                  </div> -->
               </div>

               <div class="row">
                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table table-bordered listing-table">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Left Image</th>
                                 <th>Mission</th>
                                 <th>Vision</th>
                                 <th>Status</th>
                                 <th>Updated On</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php
                              $MissionResult = mysqli_query($con, "SELECT * FROM mission_vision");
                              while($MissionRow = mysqli_fetch_assoc($MissionResult)) { ?>
                                 <tr role="row">
                                    <td>1</td>
                                    <td><img src="<?php echo $MissionRow['image']; ?>" alt="Mission Vision" class="mission-vision-thumb img-thumbnail" width="200" height="50"></td>
                                    <td>
                                       <strong><?php echo $MissionRow['mission_title']; ?></strong><br>
                                       <?php echo $MissionRow['mission_heading']; ?><br><br>
                                       <?php echo $MissionRow['mission_desc']; ?>
                                    </td>
                                    <td>
                                       <strong><?php echo $MissionRow['vision_title']; ?></strong><br>
                                       <?php echo $MissionRow['vision_heading']; ?><br><br>
                                       <?php echo $MissionRow['vision_desc']; ?>
                                    </td>
                                    <td><span class="status-badge status-active"><?php echo $MissionRow['status']; ?></span></td>
                                    <td><?php echo Date('d M Y' , strtotime($MissionRow['updated_at'])); ?><br><?php echo Date('g:i A' , strtotime($MissionRow['updated_at'])); ?></td>
                                    <td>
                                       <div class="table-actions">
                                          <a href="edit-mission-vision.php?id=<?php echo $MissionRow['id'];?>">
                                             <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                          </a>
                                       </div>
                                    </td>
                                 </tr>
                           <?php } ?>
                           </tbody>
                        </table>
                     </div>
                     <div class="listing-info-text">Showing 1 to 1 of 1 entry</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include_once('common/footer.php'); ?>
