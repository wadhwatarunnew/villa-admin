<?php $PageTitle = "Villatent: Review List Page"; ?>
<?php include_once('common/header.php'); ?>
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
                     <a href="review-inner-page.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Review</a>
                  </div>
               </div>
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
                           include "db.php";

                           $i = 1;
                           
                           $queri1= mysqli_query($con,"select * from home_testimonials");
                           
                           while($q2=mysqli_fetch_assoc($queri1)){

                              ?>
                              <tr role="row">
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $q2['name']; ?></td>
                                 <td><?php echo $q2['designation']; ?></td>
                                 <td><p><?php echo $q2['discription']; ?></p></td>
                                 <td><img src="<?php echo $q2['image']; ?>" class="img-thumbnail" height="64" width="64"></td>
                                 <?php
                                 $hasName = trim((string)$q2['name']) !== '';
                                 $hasImage = trim((string)$q2['image']) !== '';
                                 $statusLabel = ($hasName && $hasImage) ? 'Published' : 'Draft';
                                 $statusClass = ($statusLabel === 'Published') ? 'status-published' : 'status-draft';
                                 ?>
                                 <td><span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span></td>
                                 <td><div class="table-actions"><a href="edit-review.php?id=<?php echo $q2['id']; ?>"><button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                 </a> 
                                 <a  href="delete-review.php?id=<?php echo $q2['id']; ?>"><button class="btn btn-outline-danger btn-sm table-action-btn" onclick="myFunction(<?php echo $q2['id']; ?>)" type="button"><i class="feather icon-trash-2"></i></button></a></div>
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