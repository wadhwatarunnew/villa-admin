<?php $PageTitle = "Villatent: Our Founders"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Vision Behind The Villa Tent</h1>
                     <p class="listing-subtitle">Manage team/vision members displayed in this section.</p>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>About Us</span><span class="crumb-sep">&gt;</span><span>Our Founders</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="add-founder.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Member</a>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table table-bordered listing-table">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Photo</th>
                                 <th>Name</th>
                                 <th>Designation</th>
                                 <th>Short Description</th>
                                 <th>Display Order</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr role="row">
                                 <td>1</td>
                                 <td><img src="images/default-profile.png" alt="Ajay Garg" class="founder-thumb" width="200" height="50"></td>
                                 <td>Ajay Garg</td>
                                 <td>Founder & CEO</td>
                                 <td>Our journey started with a simple belief that outdoor hospitality could be as luxurious and comfortable as any five star experience.</td>
                                 <td>1</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-founder.php?id=1">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-founder.php?id=1">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              <tr role="row">
                                 <td>2</td>
                                 <td><img src="images/default-profile.png" alt="Akshat Garg" class="founder-thumb" width="200" height="50"></td>
                                 <td>Akshat Garg</td>
                                 <td>Co-Founder & Director</td>
                                 <td>Design, quality, and precision are at the heart of everything we do. We blend traditional craftsmanship with modern technology to deliver timeless structures that stand the test of time.</td>
                                 <td>2</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-founder.php?id=2">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-founder.php?id=2">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="listing-info-text">Showing 1 to 2 of 2 members</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include_once('common/footer.php'); ?>
