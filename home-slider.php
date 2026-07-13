<?php $PageTitle = "Villatent: Home Slider"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card">
                        <div class="card-header">Manage Home Slider
                          <div class="addNew">
                             <a href="home-new-slider.php">
                               <button class="btn btn-success btn-sm" type="button"><i class="feather icon-plus"></i></button>
                            </a> 
                         </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>Sr. No</th>
                                    <th>Image Title</th>
                                    <th>Image</th>
                                    <th>Slider Order</th>
                                    <th>Action</th>
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
                                       <td><?php echo $b['title']; ?></td>

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

                                    <td><?php echo $b['order_number']; ?></td>
                                    <td>
                                     <a href="edit-home-slider.php?id=<?php echo $b['id']; ?>">
                                        <button class="btn btn-success btn-sm" type="button"><i class="feather icon-edit"></i></button></a> 
                                        <a href="delete-home-slider.php?id=<?php echo $b['id']; ?>">
                                           <button class="btn btn-danger btn-sm" type="button"><i class="feather icon-trash-2"></i></button>
                                        </a>
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
 </div>
</div>
<!---->
<?php include_once('common/footer.php'); ?>