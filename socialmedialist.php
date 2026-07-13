<?php $PageTitle = "Villatent: Review List Page"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="row">
                  <div class="col-sm-12">

                     <div class="card">
                        <div class="card-header">Manage Social Medias List 
                          <div class="addNew">
                              <a href="socialmedialist-inner.php">
                                 <button class="btn btn-success btn-sm" type="button"><i class="feather icon-plus"></i></button>
                              </a> 
                           </div>
                        </div>

                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-bordered">
                                 <thead>
                                       <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                 </thead>
                                 
                                 <tbody>
                                 <?php  
                                    include "db.php";

                                    $i = 1;

                                    $queri1= mysqli_query($con,"select * from footer_follow_us");

                                    while($q2=mysqli_fetch_assoc($queri1)){

                                       ?>
                                       <tr role="row">
                                          <td><?php echo $i; ?></td>
                                          <td><?php echo $q2['name']; ?></td>
                                          <td><?php echo $q2['link']; ?></td>
                                          <td><a href="edit-footer-social.php?id=<?php echo $q2['id']; ?>"><button class="btn btn-success btn-sm" type="button"><i class="feather icon-edit"></i></button>
                                          </a> 
                                          <a  href="delete-footer-social.php?id=<?php echo $q2['id']; ?>"><button class="btn btn-danger btn-sm" type="button"><i class="feather icon-trash-2"></i></button></a>
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
   </div>
</div>
<?php include_once('common/footer.php'); ?>