<?php $PageTitle = "Villatent: Banners"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Banners</h1>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Banners</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="new-banner.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add New Banner</a>
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
                                 <th>Page Name</th>
                                 <th>Title</th>
                                 <th>Sort Order</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr role="row">
                                 <td>1</td>
                                 <td><img src="https://via.placeholder.com/64x64.png?text=B" class="img-thumbnail" height="64" width="64" alt="Banner Preview"></td>
                                 <td>Home</td>
                                 <td>Summer Escape</td>
                                 <td>1</td>
                                 <td><span class="status-badge status-published">Published</span></td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="javascript:void(0);">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="javascript:void(0);">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              <tr role="row">
                                 <td>2</td>
                                 <td><img src="https://via.placeholder.com/64x64.png?text=B" class="img-thumbnail" height="64" width="64" alt="Banner Preview"></td>
                                 <td>Home</td>
                                 <td>Weekend Retreat</td>
                                 <td>2</td>
                                 <td><span class="status-badge status-draft">Draft</span></td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="javascript:void(0);">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="javascript:void(0);">
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