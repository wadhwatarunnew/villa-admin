<?php
   include "db.php";
   $PageTitle = "Header";
   include_once('common/header.php');
   include_once('common/sidebar.php');

   $FileExists = false;
   $query4 = mysqli_query($con,"SELECT * FROM logo");											
   $b = mysqli_fetch_assoc($query4);

   if (isset($_POST['Update']))
   {
      // echo "<pre>"; print_r($_POST);
      // echo "<pre>"; print_r($_FILES); die;
      $MetaTitle     = $_POST['metaTitle'];
      $MetaKeyword   = $_POST['keyword'];
      $MetaDesc      = $_POST['desc'];
      $LogoPath      = $_POST['logo_image'];
      $FavPath       = $_POST['fav_image'];
      $BrochurePath  = $_POST['brochure_path'];
   	
      $LogoFile      = $_FILES['logo_file']['name'];
      $FavFile       = $_FILES['fav_file']['name'];
      $BrochureFile  = $_FILES['brochure_file']['name'];

      $paths = "uploads/logo/";
      $path_originals = "uploads/logo/";

      if($LogoFile != '' && file_exists("uploads/logo/".$LogoFile))
      {
         $FileExists = true;

         $_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "Selected logo already exists!";
         echo "<script>window.location.href='header.php';</script>";
         exit;
      }
      else
      {
         if($_FILES['logo_file']['name'] != '')
         {
            move_uploaded_file($_FILES['logo_file']['tmp_name'], $paths.$LogoFile) ;
            $LogoPath = $path_originals.$LogoFile;
         }
      }

      if($FavFile != '' && file_exists("uploads/logo/".$FavFile))
      {
         $FileExists = true;
         $_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "Selected favicon already exists!";
         echo "<script>window.location.href='header.php';</script>";
         exit;
      }
      else
      {
         if($_FILES['fav_file']['name'] != '')
         {
            move_uploaded_file($_FILES['fav_file']['tmp_name'], $paths.$FavFile) ;
            $FavPath = $path_originals.$FavFile;
         }
      }

      if($BrochureFile != '' && file_exists("uploads/".$BrochureFile))
      {
         $FileExists = true;
         $_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "Selected brochure already exists!";
         echo "<script>window.location.href='header.php';</script>";
         exit;
      }
      else
      {
         if($_FILES['brochure_file']['name'] != '')
         {
            if ($_FILES['brochure_file']['size'] > 5 * 1024 * 1024)
            {
               die('PDF must be less than 5 MB.');
            }

            // Check MIME type
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES['brochure_file']['tmp_name']);
            finfo_close($finfo);

            if ($mime !== 'application/pdf')
            {
               $_SESSION['BannerColor'] = "background-color:#FF0000;";
               $_SESSION['Message'] = "Only PDF files are allowed.";
               echo "<script>window.location.href='header.php';</script>";
               exit;
            }

            $extension = strtolower(pathinfo($_FILES['brochure_file']['name'], PATHINFO_EXTENSION));
            if ($extension !== 'pdf')
            {
               $_SESSION['BannerColor'] = "background-color:#FF0000;";
               $_SESSION['Message'] = "Only PDF files are allowed.";
               echo "<script>window.location.href='header.php';</script>";
               exit;
            }

            move_uploaded_file($_FILES['brochure_file']['tmp_name'], "uploads/".$BrochureFile) ;
            $BrochurePath = "uploads/".$BrochureFile;
         }
      }

      mysqli_query($con, "UPDATE logo SET path='$LogoPath', favicon='$FavPath', brochure='$BrochurePath', meta_title='$MetaTitle', meta_keyword='$MetaKeyword', meta_desc='$MetaDesc'");
      $_SESSION['BannerColor'] = "background-color:#4BB543;";
      $_SESSION['Message'] = "Updated Successfully!";
      echo "<script>window.location.href='header.php';</script>";
      exit;
   }
?>

<!---->
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <form action="" enctype="multipart/form-data" method="post">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="listing-page-head">
                           <div class="listing-title-wrap">
                              <h1>Header Settings</h1>
                              <div class="listing-breadcrumb">
                                 <span>Home</span><span class="crumb-sep">&gt;</span><span>Header</span>
                              </div>
                           </div>

                           <div class="listing-cta">
                              <button type="submit" class="btn btn-success btn-sm" name="Update"><i class="feather icon-save"></i> Save</button>
                           </div>
                        </div>
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
                     <div class="col-sm-4">
                        <div class="card mb-20">
                           <div class="card-header">Upload Logo</div>
                           <div class="card-body">
                              <div class="row align-items-center">
                                 <div class="col-sm-8">
                                    <div class="form-group mb-0">
                                       <div class="banner-image-upload" style="min-height:180px;">
                                          <input type="hidden" name="logo_image" value="<?php echo $b['path']; ?>">
                                          <img src="<?php echo $b['path']; ?>" class="banner-image-preview" id="logo_banner_preview" alt="Logo" style="height:180px;object-fit:contain;">
                                          <div class="banner-recommended-size">Recommended size: 200x60px</div>
                                          <input type="file" name="logo_file" id="logo_file" style="display: none;" accept="image/*">
                                          <div class="banner-upload-actions">
                                             <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('logo_file').click();">
                                                <i class="feather icon-upload"></i> Change Image
                                             </button>
                                             <button type="button" class="btn btn-sm btn-danger" onclick="resetLogo();">Reset Image</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="form-group mb-0">
                                       <label class="banner-form-label">Logo Preview</label>
                                       <img src="<?php echo $b['path']; ?>" alt="Logo Preview" id="logo_preview" class="img-thumbnail" style="width:100%;max-height:220px;object-fit:contain;border-radius:6px;background:var(--color-bg-soft);" onerror="this.src='images/default-profile.png';">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-sm-4">
                        <div class="card mb-20">
                           <div class="card-header">Upload Favicon</div>
                           <div class="card-body">
                              <div class="row align-items-center">
                                 <div class="col-sm-8">
                                    <div class="form-group mb-0">
                                       <div class="banner-image-upload" style="min-height:180px;">
                                          <input type="hidden" name="fav_image" value="<?php echo $b['favicon']; ?>">
                                          <img src="<?php echo $b['favicon']; ?>" class="banner-image-preview" id="favicon_banner_preview" alt="Favicon" style="height:180px;object-fit:contain;" onerror="this.src='images/default-profile.png';">
                                          <div class="banner-recommended-size">Recommended size: 64x64px</div>
                                          <input type="file" name="fav_file" id="fav_file" style="display: none;" accept="image/*">
                                          <div class="banner-upload-actions">
                                             <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('fav_file').click();">
                                                <i class="feather icon-upload"></i> Change Image
                                             </button>
                                             <button type="button" class="btn btn-sm btn-danger" onclick="resetFavicon();">Reset Image</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="form-group mb-0">
                                       <label class="banner-form-label">Logo Preview</label>
                                       <img src="<?php echo $b['favicon']; ?>" alt="Favicon Preview" id="favicon_preview" class="img-thumbnail" style="width:100%;max-height:220px;object-fit:contain;border-radius:6px;background:var(--color-bg-soft);" onerror="this.src='images/default-profile.png';">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-sm-4">
                        <div class="card mb-20">
                           <div class="card-header">Download Brochure</div>
                           <div class="card-body">
                              <div class="row align-items-center">
                                 <div class="col-sm-8">
                                    <div class="form-group mb-0">
                                       <div class="banner-image-upload" style="min-height:180px;">
                                          <input type="hidden" name="brochure_path" value="<?php echo $b['brochure']; ?>">
                                          <div class="text-center text-muted" style="padding:24px 0;">
                                             <i class="feather icon-upload-cloud" style="font-size:40px;display:block;margin-bottom:10px;"></i>
                                             <span>Drag & drop PDF here, or</span>
                                          </div>
                                          <div class="banner-recommended-size">Accepted format: PDF</div>
                                          <input type="file" name="brochure_file" id="brochure" style="display: none;" accept=".pdf">
                                          <div class="banner-upload-actions">
                                             <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('brochure').click();">
                                                <i class="feather icon-upload"></i> Choose File
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="form-group mb-0">
                                       <label>Current Brochure</label>
                                       <div class="text-center p-3 border rounded" style="background:#f8f9fa;">
                                          <i class="feather icon-file-text text-danger" style="font-size:48px;"></i>
                                          <div class="small font-weight-bold mt-2" style="word-break:break-all;"><?php echo str_replace("uploads/", "", $b['brochure']); ?></div>
                                          <small class="text-muted">5 MB</small>
                                          <a href="<?php echo $b['brochure']; ?>" target="_blank" class="btn btn-outline-secondary btn-sm btn-block mt-2" title="Download"><i class="feather icon-download"></i> Download</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card mb-30">
                           <div class="card-header">Brochure Seo Meta Tags</div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="commonSection">
                                       <label>Meta Title</label>
                                       <textarea name="metaTitle" id="metaTitle" class="form-control" placeholder="Enter Meta Title"><?php echo $b['meta_title']; ?></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="commonSection">
                                       <label>Meta Keyword</label>
                                       <textarea name="keyword" id="metaKeyword" class="form-control" placeholder="Enter Meta Keyword"><?php echo $b['meta_keyword']; ?></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="commonSection">
                                       <label>Meta Description</label>
                                       <textarea name="desc" id="metaDescription" class="form-control" placeholder="Enter Meta Description"><?php echo $b['meta_desc']; ?></textarea>
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
</div>
<!---->
<?php include_once('common/footer.php'); ?>

<script type="text/javascript">
   $(document).ready(function() {
      $(".br-menu-link11").click(function(){
         alert('sss');
         $(".br-menu-sub").toggleClass('show')
      });

      $('#logo_file').on('change', function(){
         var input = this;
         if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
               $('#logo_preview').attr('src', e.target.result);
               $('#logo_banner_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
         }
      });

      $('#fav_file').on('change', function(){
         var input = this;
         if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
               $('#favicon_preview').attr('src', e.target.result);
               $('#favicon_banner_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
         }
      });
   });

   function resetLogo()
   {
      document.getElementById('logo_file').value = "";
      var defaultSrc = "images/default-profile.png";
      document.getElementById('logo_preview').src = defaultSrc;
      document.getElementById('logo_banner_preview').src = defaultSrc;
   }

   function resetFavicon()
   {
      document.getElementById('fav_file').value = "";
      var defaultSrc = "images/default-profile.png";
      document.getElementById('favicon_preview').src = defaultSrc;
      document.getElementById('favicon_banner_preview').src = defaultSrc;
   }
</script>