<?php 
   include_once('db.php');
   include_once('common/header.php');
   $PageTitle = "Villatent: Edit Mission & Vision";

   $id = $_GET['id'];
   $MissionResult = mysqli_query($con, "SELECT * FROM mission_vision WHERE id='$id'");
   $MissionRow = mysqli_fetch_assoc($MissionResult);

   if (isset($_POST['update_mission_vision']))
   {
      $MissionTitle     = mysqli_real_escape_string($con, $_POST['mission_sub_heading']);
      $MissionHeading   = mysqli_real_escape_string($con, $_POST['mission_heading']);  
      $MissionDesc      = mysqli_real_escape_string($con, $_POST['mission_description']);
      $VisionTitle      = mysqli_real_escape_string($con, $_POST['vision_sub_heading']);
      $VisionHeading    = mysqli_real_escape_string($con, $_POST['vision_heading']);
      $VisionDesc       = mysqli_real_escape_string($con, $_POST['vision_description']);
      $DisplayOrder     = $_POST['display_order'];
      $Status           = $_POST['status'];
      $ImageFile        = $_FILES['background_image']['name'];
      $CurrentDateTime  = Date("Y-m-d H:i:s");

      $path = "uploads/pageimages/";
      $path_original = "uploads/pageimages/";

      if($ImageFile != '')
      {
         if(isset($_FILES["background_image"]["name"]) && $_FILES["background_image"]["name"] != '' && move_uploaded_file($_FILES['background_image']['tmp_name'], $path.$ImageFile))
         {
            $path = $path_original.$ImageFile;
            mysqli_query($con, "UPDATE mission_vision SET mission_title='$MissionTitle', mission_heading='$MissionHeading', mission_desc='$MissionDesc', vision_title='$VisionTitle', vision_heading='$VisionHeading', vision_desc='$VisionDesc', image='$path', display_order='$DisplayOrder', status='$Status', updated_at='$CurrentDateTime' WHERE id='$id'");

            $_SESSION['BannerColor'] = "background-color:#4BB543;";
            $_SESSION['Message'] = "Updated Successfully!";
            echo "<script>window.location.href='edit-mission-vision.php?id=$id';</script>";
            exit;
         }
         else
         {
            $_SESSION['BannerColor'] = "background-color:#FF0000;";
            $_SESSION['Message'] = "Unable to update image!";
            echo "<script>window.location.href='edit-mission-vision.php?id=$id';</script>";
            exit;
         }
      }
      else
      {
         mysqli_query($con, "UPDATE mission_vision SET mission_title='$MissionTitle', mission_heading='$MissionHeading', mission_desc='$MissionDesc', vision_title='$VisionTitle', vision_heading='$VisionHeading', vision_desc='$VisionDesc', display_order='$DisplayOrder', status='$Status', updated_at='$CurrentDateTime' WHERE id='$id'");

         $_SESSION['BannerColor'] = "background-color:#4BB543;";
         $_SESSION['Message'] = "Updated Successfully!";
         echo "<script>window.location.href='edit-mission-vision.php?id=$id';</script>";
         exit;
      }
   }
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <?php if (!empty($_SESSION['Message'])) {
               echo "<div class='alert' id='mydiv' style='" . $_SESSION['BannerColor'] . "'>"
                        . "<p style='color:white;'>" . htmlspecialchars($_SESSION['Message']) . "</p>"
                        . "</div>";

               unset($_SESSION['Message']);
               unset($_SESSION['BannerColor']);
            } ?>
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
                        <button type="submit" class="btn btn-success btn-sm" name="update_mission_vision"><i class="feather icon-save"></i> Save Changes</button>
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
                                    <img src="<?php echo $MissionRow['image']; ?>" alt="Mission Vision Background" id="mission_vision_image_preview" class="mission-vision-preview-img">
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
                                 <input type="text" class="form-control banner-form-control" name="mission_sub_heading" id="mission_sub_heading" maxlength="50" value="<?php echo $MissionRow['mission_title']; ?>" placeholder="Enter sub heading" required>
                                 <div class="counter-char-counter"><span id="mission_sub_char_count">11</span>/50</div>
                              </div>

                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Heading <span class="required">*</span></label>
                                 <input type="text" class="form-control banner-form-control" name="mission_heading" id="mission_heading" maxlength="100" value="<?php echo $MissionRow['mission_heading']; ?>" placeholder="Enter heading" required>
                                 <div class="counter-char-counter"><span id="mission_heading_char_count">57</span>/100</div>
                              </div>

                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Description <span class="required">*</span></label>
                                 <textarea name="mission_description" id="mission_description" class="form-control banner-form-control" rows="6" maxlength="300" placeholder="Enter description..." required><?php echo $MissionRow['mission_desc']; ?></textarea>
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
                                 <input type="text" class="form-control banner-form-control" name="vision_sub_heading" id="vision_sub_heading" maxlength="50" value="<?php echo $MissionRow['vision_title']; ?>" placeholder="Enter sub heading" required>
                                 <div class="counter-char-counter"><span id="vision_sub_char_count">10</span>/50</div>
                              </div>

                              <div class="form-group mb-20">
                                 <label class="banner-form-label">Heading <span class="required">*</span></label>
                                 <input type="text" class="form-control banner-form-control" name="vision_heading" id="vision_heading" maxlength="100" value="<?php echo $MissionRow['vision_heading']; ?>" placeholder="Enter heading" required>
                                 <div class="counter-char-counter"><span id="vision_heading_char_count">45</span>/100</div>
                              </div>

                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Description <span class="required">*</span></label>
                                 <textarea name="vision_description" id="vision_description" class="form-control banner-form-control" rows="6" maxlength="300" placeholder="Enter description..." required><?php echo $MissionRow['vision_desc']; ?></textarea>
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
                                    <option value="Active" <?php echo ($MissionRow['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="Inactive" <?php echo ($MissionRow['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
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
   function resetMissionVisionImage()
   {
      document.getElementById('background_image').value = "";
      document.getElementById('mission_vision_image_preview').src = "images/default-profile.png";
   }

   $(document).ready(function(){
      $('#background_image').on('change', function() {
         var input = this;
         if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
               $('#mission_vision_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
         }
      });

      $('#mission_sub_heading').on('input', function() {
         $('#mission_sub_char_count').text($(this).val().length);
      });

      $('#mission_heading').on('input', function() {
         $('#mission_heading_char_count').text($(this).val().length);
      });

      $('#mission_description').on('input', function() {
         $('#mission_desc_char_count').text($(this).val().length);
      });

      $('#vision_sub_heading').on('input', function() {
         $('#vision_sub_char_count').text($(this).val().length);
      });

      $('#vision_heading').on('input', function() {
         $('#vision_heading_char_count').text($(this).val().length);
      });

      $('#vision_description').on('input', function() {
         $('#vision_desc_char_count').text($(this).val().length);
      });
   });
</script>

<?php include_once('common/footer.php'); ?>
