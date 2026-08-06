<?php
   $PageTitle = "Villatent: Add Brand";
   include_once('common/header.php');

   $id = $_GET["id"];
   $Brands = mysqli_query($con, "SELECT * FROM brands WHERE id=$id");
   $Row = mysqli_fetch_assoc($Brands);

   if (isset($_POST['saveBrand']))
   {
      $BrandName   = $_POST['alt_text'];
      $BrandLink   = $_POST['link_url'];
      $Order       = $_POST['display_order'];
      $Status      = $_POST['status'];
      $myFile      = $_FILES['logo']['name'];

      $path          = "uploads/pageimages/logo/";
      $path_original = "uploads/pageimages/logo/";
      
      $CheckDuplicate = mysqli_query($con, "SELECT * FROM brands WHERE link='$BrandLink' AND id != '$id'");
      if(mysqli_num_rows($CheckDuplicate) > 0)
      {
         $_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "Brand already exists!";
         echo "<script>window.location.href='edit-brand.php?id=$id';</script>";
         exit;
      }

      if (isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK)
      {
         move_uploaded_file($_FILES['logo']['tmp_name'],$path.$myFile) ;
         $path = $path_original.$myFile;

         mysqli_query($con, "UPDATE brands SET name='$BrandName', link='$BrandLink', logo='$path', display_order='$Order', status='$Status' WHERE id=$id");
      }
      else
      {
         mysqli_query($con, "UPDATE brands SET name='$BrandName', link='$BrandLink', display_order='$Order', status='$Status' WHERE id=$id");
      }
          
      $_SESSION['BannerColor'] = "background-color:#4BB543;";
      $_SESSION['Message'] = "Updated Successfully!";
      echo "<script>window.location.href='edit-brand.php?id=$id';</script>";
      exit;
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
                        <h1>Edit Brand</h1>
                        <p class="listing-subtitle">Upload brand logo and details to be displayed on the homepage.</p>
                        <div class="listing-breadcrumb">
                           <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Brands</span><span class="crumb-sep">&gt;</span><span>Edit Brand</span>
                        </div>
                     </div>
                     <div class="listing-cta">
                        <a href="brands-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to Brands</a>
                        <button type="submit" class="btn btn-success btn-sm" name="saveBrand"><i class="feather icon-save"></i> Save Brand</button>
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
                     <div class="col-lg-4 col-md-6 mb-20">
                        <div class="card">
                           <div class="card-body">
                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Logo <span class="required">*</span></label>
                                 <div class="brand-logo-upload" id="brand_logo_upload">
                                    <input type="file" name="logo" id="brand_logo_input" accept="image/*" style="display: none;">
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
                                       <input type="text" class="form-control banner-form-control" name="alt_text" value="<?php echo $Row['name']; ?>" id="alt_text" maxlength="100" placeholder="e.g. Taj Hotels" required>
                                       <div class="counter-help-text">This text will be used for accessibility and SEO</div>
                                       <div class="counter-char-counter"><span id="alt_char_count">0</span>/100</div>
                                    </div>

                                    <div class="form-group mb-0">
                                       <label class="banner-form-label">Link (URL)</label>
                                       <input type="url" class="form-control banner-form-control" name="link_url" id="link_url" value="<?php echo $Row['link']; ?>" maxlength="255" placeholder="https://www.example.com">
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
                                       <input type="number" class="form-control banner-form-control" name="display_order" id="display_order" value="<?php echo $Row['display_order']; ?>" value="1" min="0" required>
                                       <div class="counter-help-text">Lower numbers will display first</div>
                                    </div>

                                    <div class="form-group mb-0">
                                       <label class="banner-form-label">Status <span class="required">*</span></label>
                                       <select class="form-control banner-form-control" name="status" id="status" required>
                                          <option value="Active"  <?php echo ($Row["status"] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                          <option value="Inactive" <?php echo ($Row["status"] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
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
