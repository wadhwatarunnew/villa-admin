<?php $PageTitle = "Villatent: Projects Category"; ?>
<?php include_once('common/header.php'); ?>
   <div class="pcoded-content">
      <div class="pcoded-inner-content">
         <div class="main-body">
            <div class="page-wrapper">
               <div class="page-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-header">Manage project Category List Page
                            <div class="addNew">
                             <a href="add-project-category.php">
                                    <button class="btn btn-success btn-sm" type="button"><i class="feather icon-plus"></i> Add</button>
                             </a> 
                             </div>
                           </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-bordered">
                                    <thead>
                                       <tr>
                                          <th>Sr. No.</th>
                                          <th>Title</th>
                                          <th>Meta Title</th>
                                         <th>Meta Keyword</th>
                                         <th>Meta Descripton</th>
                                          <th>Image</th>
                                          
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
								   
   									         <?php

                                       include "db.php";
                                       $i = 1;	 
                                       $query4= mysqli_query($con,"select * from project_category");
                                       while($b=mysqli_fetch_assoc($query4)){

                                       ?>
                                          <tr role="row">
                                             <td><?php echo $i; ?></td>
                                             <td><?php echo $b['title']; ?></td>
                                             <td><?php echo $b['metatitle']; ?></td>
                                             <td><?php echo $b['keyword']; ?></td>
                                             <td><?php echo $b['discription']; ?></td>
                                                
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
                                                <td>
                                                     <div class="actions">
                                                   <a href="edit-project-category.php?id=<?php echo $b['id']; ?>">
                                                      <button class="btn btn-success btn-sm" type="button"><i class="feather icon-edit"></i></button>
                                                   </a> 
                                                   <a href="delete-project-category.php?id=<?php echo $b['id']; ?>">
                                                      <button class="btn btn-danger btn-sm" type="button"><i class="feather icon-trash-2"></i></button>
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
      </div>
   </div>
<?php include_once('common/footer.php'); ?>