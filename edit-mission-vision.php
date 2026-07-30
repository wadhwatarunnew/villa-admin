<?php $PageTitle = "Villatent: Edit Mission & Vision"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <form action="" enctype="multipart/form-data" method="post">
               <div class="page-body">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Edit Mission & Vision Section</h1>
                        <p class="listing-subtitle">Update mission & vision section content.</p>
                        <div class="listing-breadcrumb">
                           <span>Home</span><span class="crumb-sep">&gt;</span><span>Mission & Vision</span><span class="crumb-sep">&gt;</span><span>Edit Section</span>
                        </div>
                     </div>
                     <div class="listing-cta">
                        <a href="mission-vision-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to List</a>
                        <input type="submit" class="btn btn-success btn-sm" name="update_mission_vision" value="Save Changes">
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-4 col-md-12 mb-20">
                        <div class="card">
                           <div class="card-header">Left Side Image</div>
                           <div class="card-body">
                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Background Image <span class="required">*</span></label>
                                 <div class="mission-vision-image-box">
                                    <img src="images/default-profile.png" alt="Mission Vision Background" id="mission_vision_image_preview" class="mission-vision-preview-img">
                                    <input type="file" name="background_image" id="background_image" accept="image/*" style="display: none;">
                                    <div class="mission-vision-image-actions">
                                       <button type="button" class="btn btn-outline-success btn-sm" onclick="document.getElementById('background_image').click();">
                                          <i class="feather icon-image"></i> Change Image
                                       </button>
                                       <button type="button" class="btn btn-outline-danger btn-sm" onclick="resetMissionVisionImage();">Remove Image</button>
                                    </div>
                                    <div class="counter-help-text">Recommended size: 1200x800px (3:2)<br>Max Size: 2MB. Formats: JPG, PNG, WEBP</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-4 col-md-6 mb-20">
                        <div class="card">
                           <div class="card-header">Mission Content</div>
                           <div class="card-body">
                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Sub Heading <span class="required">*</span></label>
                                 <input type="text" class="form-control banner-form-control" name="mission_sub_heading" id="mission_sub_heading" maxlength="50" value="OUR MISSION" placeholder="Enter sub heading" required>
                                 <div class="counter-char-counter"><span id="mission_sub_char_count">11</span>/50</div>
                              </div>

                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Heading <span class="required">*</span></label>
                                 <input type="text" class="form-control banner-form-control" name="mission_heading" id="mission_heading" maxlength="100" value="To Create Extraordinary Stays That Leave Lasting Memories" placeholder="Enter heading" required>
                                 <div class="counter-char-counter"><span id="mission_heading_char_count">57</span>/100</div>
                              </div>

                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Description <span class="required">*</span></label>
                                 <textarea name="mission_description" id="mission_description" class="form-control banner-form-control" rows="6" maxlength="300" placeholder="Enter description..." required>We are committed to designing and manufacturing luxury tents that blend elegance, comfort and nature to create unforgettable experiences.</textarea>
                                 <div class="counter-char-counter"><span id="mission_desc_char_count">116</span>/300</div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-4 col-md-6 mb-20">
                        <div class="card">
                           <div class="card-header">Vision Content</div>
                           <div class="card-body">
                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Sub Heading <span class="required">*</span></label>
                                 <input type="text" class="form-control banner-form-control" name="vision_sub_heading" id="vision_sub_heading" maxlength="50" value="OUR VISION" placeholder="Enter sub heading" required>
                                 <div class="counter-char-counter"><span id="vision_sub_char_count">10</span>/50</div>
                              </div>

                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Heading <span class="required">*</span></label>
                                 <input type="text" class="form-control banner-form-control" name="vision_heading" id="vision_heading" maxlength="100" value="To Be The World's Most Trusted Glamping Partner" placeholder="Enter heading" required>
                                 <div class="counter-char-counter"><span id="vision_heading_char_count">45</span>/100</div>
                              </div>

                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Description <span class="required">*</span></label>
                                 <textarea name="vision_description" id="vision_description" class="form-control banner-form-control" rows="6" maxlength="300" placeholder="Enter description..." required>We envision a world where luxury and nature exist in perfect harmony, and we strive to be at the forefront of this movement.</textarea>
                                 <div class="counter-char-counter"><span id="vision_desc_char_count">101</span>/300</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row mt-20">
                     <div class="col-lg-6 col-md-6 mb-20">
                        <div class="card">
                           <div class="card-body">
                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Status <span class="required">*</span></label>
                                 <select class="form-control banner-form-control" name="status" id="status" required>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                 </select>
                                 <div class="counter-help-text">Show or hide this section on the website</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 mb-20">
                        <div class="card">
                           <div class="card-body">
                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Display Order <span class="required">*</span></label>
                                 <input type="number" class="form-control banner-form-control" name="display_order" id="display_order" value="1" min="0" required>
                                 <div class="counter-help-text">Lower numbers will display first</div>
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

<script>
   function resetMissionVisionImage(){
      document.getElementById('background_image').value = "";
      document.getElementById('mission_vision_image_preview').src = "images/default-profile.png";
   }

   $(document).ready(function(){
      $('#background_image').on('change', function(){
         var input = this;
         if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
               $('#mission_vision_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
         }
      });

      $('#mission_sub_heading').on('input', function(){
         $('#mission_sub_char_count').text($(this).val().length);
      });

      $('#mission_heading').on('input', function(){
         $('#mission_heading_char_count').text($(this).val().length);
      });

      $('#mission_description').on('input', function(){
         $('#mission_desc_char_count').text($(this).val().length);
      });

      $('#vision_sub_heading').on('input', function(){
         $('#vision_sub_char_count').text($(this).val().length);
      });

      $('#vision_heading').on('input', function(){
         $('#vision_heading_char_count').text($(this).val().length);
      });

      $('#vision_description').on('input', function(){
         $('#vision_desc_char_count').text($(this).val().length);
      });
   });
</script>

<?php include_once('common/footer.php'); ?>
