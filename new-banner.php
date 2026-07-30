<?php $PageTitle = "Villatent: Add New Home Banner"; ?>
<?php include_once('common/header.php'); ?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Add Banner</h1>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Banners</span><span class="crumb-sep">&gt;</span><span>Add New</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="javascript:void(0);" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
                  
                     <a href="javascript:void(0);" class="btn btn-success btn-sm"><i class="feather icon-save"></i> Save Banner</a>
                  </div>
               </div>

               <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                     <div class="col-lg-4 col-md-6 mb-20">
                        <div class="card">
                           <div class="card-body">
                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Select Page <span class="required">*</span></label>
                                 <select class="form-control banner-form-control" name="page_name" id="page_name">
                                    <option value="home" selected>Home</option>
                                    <option value="about">About Us</option>
                                    <option value="contact">Contact Us</option>
                                    <option value="tents">Tents</option>
                                    <option value="projects">Projects</option>
                                    <option value="blogs">Blogs</option>
                                 </select>
                              </div>

                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Banner Sub Title <span class="required">*</span></label>
                                 <input type="text" class="form-control banner-form-control" name="banner_sub_title" id="banner_sub_title" placeholder="Enter banner sub title" value="Luxury Glamping Experiences">
                              </div>
                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Banner Title <span class="required">*</span></label>
                                 <input type="text" class="form-control banner-form-control" name="banner_title" id="banner_title" placeholder="Enter banner title" value="Luxury Glamping Experiences">
                              </div>

                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Description <span class="required">*</span></label>
                                 <textarea class="form-control banner-form-control" name="banner_description" id="banner_description" rows="5" maxlength="150" placeholder="Enter banner description">Crafted for comfort. Designed for nature. Inspired for you.</textarea>
                                 <div class="banner-char-counter"><span id="char_count">0</span>/150</div>
                              </div>

                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Button Text</label>
                                 <input type="text" class="form-control banner-form-control" name="button_text" id="button_text" placeholder="Enter button text" value="Explore Tents">
                              </div>

                              <div class="form-group">
                                 <label class="banner-form-label">Button URL</label>
                                 <input type="text" class="form-control banner-form-control" name="button_url" id="button_url" placeholder="Enter button URL" value="/tents">
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-4 col-md-6 mb-20">
                        <div class="card">
                           <div class="card-body">
                              <div class="form-group">
                                 <label class="banner-form-label">Banner Image <span class="required">*</span></label>
                                 <div class="banner-image-upload">
                                    <img src="uploads/pageimages/slider/Ultra-Luxury-Ganesha-Resort-Tent.jpg" class="banner-image-preview" id="banner_image_preview" alt="Banner Image">
                                    <div class="banner-recommended-size">Recommended size: 1920x800px</div>
                                    <input type="file" name="banner_image" id="banner_image" style="display:none;" accept="image/*">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('banner_image').click();">
                                       <i class="feather icon-upload"></i> Change Image
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-4 col-md-12 mb-20">
                        <div class="card mb-20">
                           <div class="card-body">
                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Status <span class="required">*</span></label>
                                 <select class="form-control banner-form-control" name="status" id="status">
                                    <option value="published" selected>Published</option>
                                    <option value="draft">Draft</option>
                                 </select>
                              </div>

                              <div class="form-group">
                                 <label class="banner-form-label">Sort Order</label>
                                 <input type="number" class="form-control banner-form-control" name="sort_order" id="sort_order" placeholder="Enter sort order" value="1" min="0">
                              </div>
                           </div>
                        </div>

                        <div class="card">
                           <div class="card-body">
                              <div class="banner-section-heading">Preview</div>
                              <div class="banner-preview-card">
                                 <img src="uploads/pageimages/slider/Ultra-Luxury-Ganesha-Resort-Tent.jpg" id="preview_bg_image" alt="Preview Background" class="banner-preview-bg">
                                 <div class="banner-preview-content">
                                      <div class="banner-preview-sub-title" id="preview_sub_title">Luxury Glamping Experiences</div>
                                     <div class="banner-preview-title" id="preview_title">Luxury Glamping Experiences</div>
                                    <div class="banner-preview-desc" id="preview_description">Crafted for comfort. Designed for nature. Inspired for you.</div>
                                    <a href="javascript:void(0);" class="btn btn-secondary" id="preview_button">Explore Tents</a>
                                    
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
</div>



<?php include_once('common/footer.php'); ?>
