<?php $PageTitle = "Villatent: Counters"; ?>
<?php include_once('common/header.php'); ?>
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
                                 <th>Suffix</th>
                                 <th>Status</th>
                                 <th>Display Order</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr role="row">
                                 <td>1</td>
                                 <td><span class="material-icons" style="font-size:40px;">emoji_events</span></td>
                                 <td>Years of Experience</td>
                                 <td>30+</td>
                                 <td>+</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>1</td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-counter.php?id=1">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-counter.php?id=1">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              <tr role="row">
                                 <td>2</td>
                                 <td><span class="material-icons" style="font-size:40px;">work</span></td>
                                 <td>Projects Completed</td>
                                 <td>500+</td>
                                 <td>+</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>2</td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-counter.php?id=2">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-counter.php?id=2">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              <tr role="row">
                                 <td>3</td>
                                 <td><span class="material-icons" style="font-size:40px;">public</span></td>
                                 <td>Countries Served</td>
                                 <td>40+</td>
                                 <td>+</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>3</td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-counter.php?id=3">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-counter.php?id=3">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              <tr role="row">
                                 <td>4</td>
                                 <td><span class="material-icons" style="font-size:40px;">thumb_up</span></td>
                                 <td>Client Satisfaction</td>
                                 <td>100%</td>
                                 <td>%</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>4</td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-counter.php?id=4">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-counter.php?id=4">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
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
