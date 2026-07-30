<?php $PageTitle = "Villatent: Brands"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Brands</h1>
                     <p class="listing-subtitle">Manage brand logos displayed on the homepage.</p>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Brands</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="add-brand.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Brand</a>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table table-bordered listing-table">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Logo</th>
                                 <th>Alt Text</th>
                                 <th>Link (URL)</th>
                                 <th>Display Order</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr role="row">
                                 <td>1</td>
                                 <td><img src="uploads/brands/taj-logo.png" alt="Taj Hotels" class="brand-logo-thumb"></td>
                                 <td>Taj Hotels</td>
                                 <td><a href="https://www.tajhotels.com" target="_blank" class="brand-link">https://www.tajhotels.com</a></td>
                                 <td>1</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-brand.php?id=1">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-brand.php?id=1">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              <tr role="row">
                                 <td>2</td>
                                 <td><img src="uploads/brands/oberoi-logo.png" alt="The Oberoi Group" class="brand-logo-thumb"></td>
                                 <td>The Oberoi Group</td>
                                 <td><a href="https://www.oberoihotels.com" target="_blank" class="brand-link">https://www.oberoihotels.com</a></td>
                                 <td>2</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-brand.php?id=2">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-brand.php?id=2">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              <tr role="row">
                                 <td>3</td>
                                 <td><img src="uploads/brands/itc-logo.png" alt="ITC Hotels" class="brand-logo-thumb"></td>
                                 <td>ITC Hotels</td>
                                 <td><a href="https://www.itchotels.com" target="_blank" class="brand-link">https://www.itchotels.com</a></td>
                                 <td>3</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-brand.php?id=3">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-brand.php?id=3">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              <tr role="row">
                                 <td>4</td>
                                 <td><img src="uploads/brands/aman-logo.png" alt="Aman Resorts" class="brand-logo-thumb"></td>
                                 <td>Aman Resorts</td>
                                 <td><a href="https://www.aman.com" target="_blank" class="brand-link">https://www.aman.com</a></td>
                                 <td>4</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-brand.php?id=4">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-brand.php?id=4">
                                          <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
                                    </div>
                                 </td>
                              </tr>
                              <tr role="row">
                                 <td>5</td>
                                 <td><img src="uploads/brands/raffles-logo.png" alt="Raffles Hotels & Resorts" class="brand-logo-thumb"></td>
                                 <td>Raffles Hotels & Resorts</td>
                                 <td><a href="https://www.raffles.com" target="_blank" class="brand-link">https://www.raffles.com</a></td>
                                 <td>5</td>
                                 <td><span class="status-badge status-active">Active</span></td>
                                 <td>
                                    <div class="table-actions">
                                       <a href="edit-brand.php?id=5">
                                          <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                       </a>
                                       <a href="delete-brand.php?id=5">
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
