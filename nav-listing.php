<?php $PageTitle = "Villatent: Navigation Bar"; ?>
<?php include_once('common/header.php'); ?>
<!---->
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Navigation Listing</h1>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Navigation Listing</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="add-nav-page.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add</a>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card">
                        <div class="card-header">Navigation Listing</div>

                        <div class="card-body">
                           <div class="table-responsive grid-scroll">
                              <table class="table table-bordered listing-table">
                                 <thead>
                                    <tr>
                                       <th>Sr. No.</th>
                                       <th>Name</th>
									            <th>Link</th>
									            <th>Position</th>
                                       <th>Meta Title</th>
                                       <th>Meta Keyword</th>
                                       <th>Meta Descripton</th>
                                       <th>Image</th>
                                       <th>Status</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>

                                 <tbody>
							            <?php
                                    $i = 1;	 
                                    $query4= mysqli_query($con,"select * from add_nav");
                                    while($b=mysqli_fetch_assoc($query4))
                                    {
                                    ?>
                                       <tr role="row">
                                          <td><?php echo $i; ?></td>
                                          <td><?php echo $b['name']; ?></td>
   											      <td><?php echo $b['link']; ?></td>
   											      <td><?php echo $b['position']; ?></td>
                                          <td><?php echo $b['metatitle']; ?></td>
                                          <td><?php echo $b['keyword']; ?></td>
                                          <td><?php echo $b['discription']; ?></td>
                                          <?php
									                  if(!$b['image'])
                                             {
										            ?>
												            <td>
                                                   <img src="<?php echo $b['local_path']; ?>" class="img-thumbnail" height="64" width="64">
                                                </td>
									                  <?php	 
										               }
                                             else
                                             {
                                             ?>
                                                <td>
                                                   <img src="<?php echo $b['image']; ?>" class="img-thumbnail" height="64" width="64">
                                                </td>
									 
									               <?php  }  ?>
                                                         <?php
                                                         $hasName = trim((string)$b['name']) !== '';
                                                         $hasImage = trim((string)$b['image']) !== '' || trim((string)$b['local_path']) !== '';
                                                         $statusLabel = ($hasName && $hasImage) ? 'Published' : 'Draft';
                                                         $statusClass = ($statusLabel === 'Published') ? 'status-published' : 'status-draft';
                                                         ?>
                                                         <td><span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span></td>
                                          <td>
                                              <div class="actions">
                                                            <div class="table-actions">
                                             <a href="edit-nav.php?id=<?php echo $b['id']; ?>">
                                                               <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                             </a>
                                             <a href="delete-nav.php?id=<?php echo $b['id']; ?>&link=<?php echo $b['link']; ?>">
                                                               <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                             </a>
                                                            </div>
                                             </div>
                                          </td>
                                       </tr>  
                                    <?php
                                       $i++;
                                    }  ?>
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