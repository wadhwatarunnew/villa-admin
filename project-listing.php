<?php $PageTitle = "Villatent: Resorts Listing"; ?>
<?php include_once('common/header.php'); ?>
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
                     <a href="project-internal.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Resort</a>
                  </div>
               </div>
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
                                   <?php

                                   include "db.php";
                                   $i = 1;	 
                                   $query4= mysqli_query($con,"select * from resort_types");
                                   while($b=mysqli_fetch_assoc($query4)){

                                    ?>
                                    <tr role="row">
                                       <td><?php echo $i; ?></td>
                                       <td><?php echo $b['category']; ?></td>
                                       <td><?php echo $b['metatitle']; ?></td>
                                       <td><?php echo $b['keyword']; ?></td>
                                       <td><?php echo $b['discription']; ?></td>

                                       <td><?php echo $b['title']; ?></td>

                                       <td>
                                          <?php
                                          $hasTitle = trim((string)$b['title']) !== '';
                                          $hasCategory = trim((string)$b['category']) !== '';
                                          $statusLabel = ($hasTitle && $hasCategory) ? 'Published' : 'Draft';
                                          $statusClass = ($statusLabel === 'Published') ? 'status-published' : 'status-draft';
                                          ?>
                                          <span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span>
                                       </td>

                                       <td>
                                            <div class="actions">
                                          <div class="table-actions">
                                          <a href="edit-tent-types.php?id=<?php echo $b['id']; ?>">
                                             <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                          </a> 
                                          <a href="delete-tent-types.php?id=<?php echo $b['id']; ?>">
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