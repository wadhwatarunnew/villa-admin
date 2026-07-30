<?php $PageTitle = "Villatent: Add Brand"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <form action="" enctype="multipart/form-data" method="post">
               <div class="page-body">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Add Brand</h1>
                        <p class="listing-subtitle">Upload brand logo and details to be displayed on the homepage.</p>
                        <div class="listing-breadcrumb">
                           <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Brands</span><span class="crumb-sep">&gt;</span><span>Add Brand</span>
                        </div>
                     </div>
                     <div class="listing-cta">
                        <a href="brands-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to Brands</a>
                        <input type="submit" class="btn btn-success btn-sm" name="save_brand" value="Save Brand">
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-4 col-md-6 mb-20">
                        <div class="card">
                           <div class="card-body">
                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Logo <span class="required">*</span></label>
                                 <div class="brand-logo-upload" id="brand_logo_upload">
                                    <input type="file" name="logo" id="brand_logo_input" accept="image/*" style="display: none;" required>
                                    <div class="brand-logo-placeholder" id="brand_logo_placeholder">
                                       <span class="material-icons">cloud_upload</span>
                                       <div class="brand-upload-text"><strong>Click to upload</strong> or drag and drop</div>
                                       <div class="brand-upload-hint">Only image files allowed (SVG, PNG, JPG, GIF, WEBP)</div>
                                       <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="document.getElementById('brand_logo_input').click();">Choose File</button>
                                    </div>
                                    <div class="brand-logo-preview" id="brand_logo_preview" style="display: none;">
                                       <img src="" alt="Brand Logo Preview" id="brand_logo_img">
                                       <button type="button" class="btn btn-sm btn-danger" onclick="resetBrandLogo();">Remove</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-8 col-md-6">
                        <div class="row">
                           <div class="col-lg-6 col-md-12 mb-20">
                              <div class="card">
                                 <div class="card-body">
                                    <div class="form-group mb-20">
                                       <label class="banner-form-label">Alt Text <span class="required">*</span></label>
                                       <input type="text" class="form-control banner-form-control" name="alt_text" id="alt_text" maxlength="100" placeholder="e.g. Taj Hotels" required>
                                       <div class="counter-help-text">This text will be used for accessibility and SEO</div>
                                       <div class="counter-char-counter"><span id="alt_char_count">0</span>/100</div>
                                    </div>

                                    <div class="form-group mb-0">
                                       <label class="banner-form-label">Link (URL)</label>
                                       <input type="url" class="form-control banner-form-control" name="link_url" id="link_url" maxlength="255" placeholder="https://www.example.com">
                                       <div class="counter-help-text">Add brand website link (optional)</div>
                                       <div class="counter-char-counter"><span id="link_char_count">0</span>/255</div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-6 col-md-12 mb-20">
                              <div class="card">
                                 <div class="card-body">
                                    <div class="form-group mb-20">
                                       <label class="banner-form-label">Display Order <span class="required">*</span></label>
                                       <input type="number" class="form-control banner-form-control" name="display_order" id="display_order" value="1" min="0" required>
                                       <div class="counter-help-text">Lower numbers will display first</div>
                                    </div>

                                    <div class="form-group mb-0">
                                       <label class="banner-form-label">Status <span class="required">*</span></label>
                                       <select class="form-control banner-form-control" name="status" id="status" required>
                                          <option value="active" selected>Active</option>
                                          <option value="inactive">Inactive</option>
                                       </select>
                                       <div class="counter-help-text">Show or hide this brand on the website</div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </form>
         </div>
      </div>
   </div>
</div>



<?php include_once('common/footer.php'); ?>
