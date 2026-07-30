<?php $PageTitle = "Villatent: Home Slider"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Home Sliders</h1>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Home Sliders</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="home-new-slider.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add New Slider</a>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                        <div class="table-responsive">
                           <table class="table table-bordered listing-table">
                              <thead>
                                 <tr>
                                    <th>ID</th>
                                    <th>Banner Preview</th>
                                    <th>Title</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                 </tr>
                              </thead>
                              <tbody>

                                 <?php

                                 include "db.php";
                                 $i = 1;	 
                                 $query4= mysqli_query($con,"select * from home_slider");
                                 while($b=mysqli_fetch_assoc($query4)){

                                    ?>
                                    <tr role="row">
                                       <td><?php echo $i;?></td>

                                       <?php

                                       if(!$b['image']){

                                        ?>

                                        <td>
                                          <img src="<?php echo $b['local_path']; ?>" class="img-thumbnail" height="64" width="64">
                                       </td>

                                       <?php	 


                                    }else{

                                       ?>

                                       <td>
                                          <img src="<?php echo $b['image']; ?>" class="img-thumbnail" height="64" width="64">
                                       </td>

                                    <?php  }  ?>

                                    <td><?php echo $b['title']; ?></td>
                                    <td><?php echo $b['order_number']; ?></td>

                                    <?php
                                    $hasTitle = trim((string)$b['title']) !== '';
                                    $hasImage = trim((string)$b['image']) !== '' || trim((string)$b['local_path']) !== '';
                                    $statusLabel = ($hasTitle && $hasImage) ? 'Published' : 'Draft';
                                    $statusClass = ($statusLabel === 'Published') ? 'status-published' : 'status-draft';
                                    ?>

                                    <td><span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span></td>
                                    <td>
                                       <div class="table-actions">
                                     <a href="edit-home-slider.php?id=<?php echo $b['id']; ?>">
                                        <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button></a> 
                                        <a href="delete-home-slider.php?id=<?php echo $b['id']; ?>">
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
<!---->
<?php include_once('common/footer.php'); ?>