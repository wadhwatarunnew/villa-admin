<?php
   include_once('db.php');
   include_once('common/header.php');
   $PageTitle = "Villatent: Add Member";

   if (isset($_POST['save_member']))
   {
      $Name          = mysqli_real_escape_string($con, $_POST['name']);
      $Designation   = mysqli_real_escape_string($con, $_POST['designation']);
      $Bio           = mysqli_real_escape_string($con, $_POST['short_description']);
      $DisplayOrder  = $_POST['display_order'];
      $Status        = $_POST['status'];
      $ImageFile     = $_FILES['photo']['name'];

      $path = "uploads/founders/";
      $path_original = "uploads/founders/";

      if($ImageFile != '')
      {
         if((file_exists("uploads/pageimages/".$ImageFile) || file_exists("uploads/pageimages/addgallery/".$ImageFile) || file_exists("uploads/pageimages/addgallery/project/".$ImageFile) || file_exists("uploads/pageimages/addgallery/resort/".$ImageFile) || file_exists("uploads/pageimages/blogs/".$ImageFile) || file_exists("uploads/pageimages/blogs/single/".$ImageFile)  || file_exists("uploads/pageimages/contact/".$ImageFile) || file_exists("uploads/pageimages/nav/".$ImageFile) || file_exists("uploads/pageimages/nav/category/".$ImageFile) || file_exists("uploads/pageimages/nav/types/".$ImageFile) || file_exists("uploads/pageimages/project/".$ImageFile) || file_exists("uploads/pageimages/project/category/".$ImageFile) || file_exists("uploads/pageimages/project/types/".$ImageFile) || file_exists("uploads/pageimages/resort/".$ImageFile) || file_exists("uploads/pageimages/resort/category/".$ImageFile) || file_exists("uploads/pageimages/resort/types/".$ImageFile) || file_exists("uploads/pageimages/slider/".$ImageFile) || file_exists("uploads/pageimages/youtube/".$ImageFile)))
         {
            $FileExists = true;
            $_SESSION['BannerColor'] = "background-color:#FF0000;";
            $_SESSION['Message'] = "Selected image already exists!";
            echo "<script>window.location.href='add-founder.php';</script>";
            exit;
         }
         else
         {
            move_uploaded_file($_FILES['photo']['tmp_name'],$path.$ImageFile) ;
            $path = $path_original.$ImageFile;
            
            mysqli_query($con, "INSERT INTO founders (name, designation, bio, image, display_order, status) VALUES ('$Name', '$Designation', '$Bio', '$path', '$DisplayOrder', '$Status')");

            $_SESSION['BannerColor'] = "background-color:#4BB543;";
            $_SESSION['Message'] = "Added Successfully!";
            echo "<script>window.location.href='add-founder.php';</script>";
            exit;
         }
      }
      else
      {
         mysqli_query($con, "INSERT INTO founders (name, designation, bio, display_order, status) VALUES ('$Name', '$Designation', '$Bio', '$DisplayOrder', '$Status')");

         $_SESSION['BannerColor'] = "background-color:#4BB543;";
         $_SESSION['Message'] = "Added Successfully!";
         echo "<script>window.location.href='add-founder.php';</script>";
         exit;
      }
   }
?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <form action="" enctype="multipart/form-data" method="post">
               <div class="page-body">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Add Member</h1>
                        <p class="listing-subtitle">Add new member to be displayed in the Vision section.</p>
                        <div class="listing-breadcrumb">
                           <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Our Founders</span><span class="crumb-sep">&gt;</span><span>Add Member</span>
                        </div>
                     </div>
                     <div class="listing-cta">
                        <a href="founders-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to List</a>
                        <input type="submit" class="btn btn-success btn-sm" name="save_member" value="Save Member">
                     </div>
                  </div>

                  <?php if (!empty($_SESSION['Message'])) {
                     echo "<div class='alert' id='mydiv' style='" . $_SESSION['BannerColor'] . "'>"
                              . "<p style='color:white;'>" . htmlspecialchars($_SESSION['Message']) . "</p>"
                              . "</div>";

                     unset($_SESSION['Message']);
                     unset($_SESSION['BannerColor']);
                  } ?>
                  <div class="row">
                     <div class="col-lg-4 col-md-5 mb-20">
                        <div class="card">
                           <div class="card-body">
                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Photo <span class="required">*</span></label>
                                 <div class="founder-photo-upload" id="founder_photo_upload">
                                    <input type="file" name="photo" id="founder_photo_input" accept="image/*" style="display: none;" required>
                                    <div class="founder-photo-placeholder" id="founder_photo_placeholder">
                                       <span class="material-icons">backup</span>
                                       <div class="founder-upload-text"><strong>Click to upload</strong> or drag and drop</div>
                                       <div class="founder-upload-hint">JPG, PNG (Max. 2MB)</div>
                                       <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="document.getElementById('founder_photo_input').click();">Choose File</button>
                                    </div>
                                    <div class="founder-photo-preview" id="founder_photo_preview" style="display: none;">
                                       <img src="" alt="Founder Photo Preview" id="founder_photo_img">
                                       <button type="button" class="btn btn-sm btn-danger" onclick="resetFounderPhoto();">Remove</button>
                                    </div>
                                 </div>
                                 <div class="banner-recommended-size">Recommended size: 800x800px</div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-8 col-md-7">
                        <div class="row">
                           <div class="col-lg-6 col-md-12 mb-20">
                              <div class="card">
                                 <div class="card-body">
                                    <div class="form-group mb-20">
                                       <label class="banner-form-label">Name <span class="required">*</span></label>
                                       <input type="text" class="form-control banner-form-control" name="name" id="name" maxlength="100" placeholder="e.g. Ajay Garg" required>
                                       <div class="counter-char-counter text-end"><span id="name_char_count">0</span>/100</div>
                                    </div>

                                    <div class="form-group mb-0">
                                       <label class="banner-form-label">Designation <span class="required">*</span></label>
                                       <input type="text" class="form-control banner-form-control" name="designation" id="designation" maxlength="100" placeholder="e.g. Founder & CEO" required>
                                       <div class="counter-char-counter text-end"><span id="designation_char_count">0</span>/100</div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-6 col-md-12 mb-20">
                              <div class="card">
                                 <div class="card-body">
                                    <div class="form-group mb-20">
                                       <label class="banner-form-label">Short Description <span class="required">*</span></label>
                                       <textarea name="short_description" id="short_description" class="form-control banner-form-control" rows="6" maxlength="300" placeholder="Write short description..." required></textarea>
                                       <div class="counter-char-counter text-end"><span id="desc_char_count">0</span>/300</div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-6 col-md-12 mb-20">
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

                           <div class="col-lg-6 col-md-12 mb-20">
                              <div class="card">
                                 <div class="card-body">
                                    <div class="form-group mb-0">
                                       <label class="banner-form-label">Status <span class="required">*</span></label>
                                       <select class="form-control banner-form-control" name="status" id="status" required>
                                          <option value="Active" selected>Active</option>
                                          <option value="Inactive">Inactive</option>
                                       </select>
                                       <div class="counter-help-text">Show or hide this member on the website</div>
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

<script>
   function resetFounderPhoto(){
      document.getElementById('founder_photo_input').value = "";
      document.getElementById('founder_photo_preview').style.display = 'none';
      document.getElementById('founder_photo_placeholder').style.display = 'block';
      document.getElementById('founder_photo_img').src = "";
   }

   $(document).ready(function(){
      $('#founder_photo_input').on('change', function(){
         var input = this;
         if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
               $('#founder_photo_img').attr('src', e.target.result);
               $('#founder_photo_placeholder').hide();
               $('#founder_photo_preview').show();
            }
            reader.readAsDataURL(input.files[0]);
         }
      });

      $('#founder_photo_upload').on('dragover', function(e){
         e.preventDefault();
         e.stopPropagation();
         $(this).addClass('drag-over');
      });

      $('#founder_photo_upload').on('dragleave', function(e){
         e.preventDefault();
         e.stopPropagation();
         $(this).removeClass('drag-over');
      });

      $('#founder_photo_upload').on('drop', function(e){
         e.preventDefault();
         e.stopPropagation();
         $(this).removeClass('drag-over');
         var files = e.originalEvent.dataTransfer.files;
         if(files.length > 0){
            $('#founder_photo_input')[0].files = files;
            $('#founder_photo_input').trigger('change');
         }
      });

      $('#name').on('input', function(){
         $('#name_char_count').text($(this).val().length);
      });

      $('#designation').on('input', function(){
         $('#designation_char_count').text($(this).val().length);
      });

      $('#short_description').on('input', function(){
         $('#desc_char_count').text($(this).val().length);
      });
   });
</script>

<?php include_once('common/footer.php'); ?>
