<?php
   include "db.php";
   $PageTitle = "Header";
   include_once('common/header.php');
   include_once('common/sidebar.php');

   $FileExists = false;
   $query4 = mysqli_query($con,"SELECT * FROM logo");											
   $b = mysqli_fetch_assoc($query4);

   if (isset($_POST['subfav']))
   {	
   	$myFiless = $_FILES['myFiless']['name'];

   	$paths = "uploads/logo/";
   	$path_originals = "uploads/logo/";

   	if($myFiless != '' && file_exists("uploads/logo/".$myFiless))
   	{
   	   $FileExists = true;
         $_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "Selected image already exists!";
         echo "<script>window.location.href='header.php';</script>";
         exit;
   	}
   	else
   	{
       	move_uploaded_file($_FILES['myFiless']['tmp_name'],$paths.$myFiless) ;
       	$pathss = $path_originals.$myFiless;
       	
       	mysqli_query($con, "UPDATE logo SET favicon='$pathss' ");
       	$_SESSION['BannerColor'] = "background-color:#4BB543;";
         $_SESSION['Message'] = "Updated Successfully!";
         echo "<script>window.location.href='header.php';</script>";
         exit;
   	}
   };

   if (isset($_POST['sub']))
   {	
   	$myFile=$_FILES['myFile']['name'];
   
   	$path="uploads/logo/";
   	$path_original="uploads/logo/";

   	if($myFile != '' && file_exists("uploads/logo/".$myFile))
   	{
   	   $FileExists = true;

         $_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "Selected image already exists!";
         echo "<script>window.location.href='header.php';</script>";
         exit;
   	}
   	else
   	{
   	   move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
       	$path=$path_original.$myFile;
       	
       	mysqli_query($con, "UPDATE logo SET path='$path' ");
       	
       	$_SESSION['BannerColor'] = "background-color:#4BB543;";
         $_SESSION['Message'] = "Updated Successfully!";
         echo "<script>window.location.href='header.php';</script>";
         exit;
   	}
   };

   if (isset($_POST['sub1']))
   {	
   	$name   = $_POST['name'];
   	$link   = $_POST['link'];
   	$name1  = $_POST['name1'];
   	$link1  = $_POST['link1'];
   	$name2  = $_POST['name2'];
   	$link2  = $_POST['link2'];
   	$name3  = $_POST['name3'];
   	$link3  = $_POST['link3'];
   	$name4  = $_POST['name4'];
   	$link4  = $_POST['link4'];
   	$name5  = $_POST['name5'];
   	$link5  = $_POST['link5'];
   	$name6  = $_POST['name6'];
   	$link6  = $_POST['link6'];
   	
   	mysqli_query($con,"UPDATE header_nav SET name_one='$name', link_one='$link', name_two='$name1', link_two='$link1', name_three='$name2', link_three='$link2', name_four='$name3', link_four='$link3', name_five='$name4', link_five='$link4', name_six='$name5', link_six='$link5', name_seven='$name6', link_seven='$link6'");
   	
   	$_SESSION['BannerColor'] = "background-color:#4BB543;";
      $_SESSION['Message'] = "Updated Successfully!";
      echo "<script>window.location.href='header.php';</script>";
      exit;
   };
?>

<!---->
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="listing-page-head">
                        <div class="listing-title-wrap">
                           <h1>Header Settings</h1>
                           <div class="listing-breadcrumb">
                              <span>Home</span><span class="crumb-sep">&gt;</span><span>Header</span>
                           </div>
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
                  <div class="col-sm-6">
                     <form action="" enctype="multipart/form-data" method="post">
                        <div class="card mb-20">
                           <div class="card-header">Upload Logo</div>
                           <div class="card-body">
                              <div class="row align-items-center">
                                 <div class="col-sm-8">
                                    <div class="form-group mb-0">
                                       <div class="banner-image-upload" style="min-height:180px;">
                                          <img src="<?php echo $b['path']; ?>" class="banner-image-preview" id="logo_banner_preview" alt="Logo" style="height:180px;object-fit:contain;" onerror="this.src='images/default-profile.png';">
                                          <div class="banner-recommended-size">Recommended size: 200x60px</div>
                                          <input type="file" name="myFile" id="myFile" style="display: none;" accept="image/*">
                                          <div class="banner-upload-actions">
                                             <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile').click();">
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

                                 <div class="col-sm-12 mt-3">
                                    <input type="submit" class="btn btn-success btn-lg" name="sub" value="Save Logo">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>

                  <div class="col-sm-6">
                     <form action="" enctype="multipart/form-data" method="post">
                        <div class="card mb-20">
                           <div class="card-header">Upload Favicon</div>
                           <div class="card-body">
                              <div class="row align-items-center">
                                 <div class="col-sm-8">
                                    <div class="form-group mb-0">
                                       <div class="banner-image-upload" style="min-height:180px;">
                                          <img src="<?php echo $b['favicon']; ?>" class="banner-image-preview" id="favicon_banner_preview" alt="Favicon" style="height:180px;object-fit:contain;" onerror="this.src='images/default-profile.png';">
                                          <div class="banner-recommended-size">Recommended size: 64x64px</div>
                                          <input type="file" name="myFiless" id="myFiless" style="display: none;" accept="image/*">
                                          <div class="banner-upload-actions">
                                             <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFiless').click();">
                                                <i class="feather icon-upload"></i> Change Image
                                             </button>
                                             <button type="button" class="btn btn-sm btn-danger" onclick="resetFavicon();">Reset Image</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="form-group mb-0">
                                       <img src="<?php echo $b['favicon']; ?>" alt="Favicon Preview" id="favicon_preview" class="img-thumbnail" style="width:64px;height:64px;object-fit:contain;border-radius:6px;background:var(--color-bg-soft);" onerror="this.src='images/default-profile.png';">
                                    </div>
                                 </div>

                                 <div class="col-sm-12 mt-3">
                                    <input type="submit" class="btn btn-success btn-lg" name="subfav" value="Save Favicon">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>

               <div class="row">
                  <div class="col-sm-6">
                     <form action="" enctype="multipart/form-data" method="post">
                        <div class="card mb-20">
                           <div class="card-header">Download Brochure</div>
                           <div class="card-body">
                              <div class="row align-items-center">
                                 <div class="col-sm-8">
                                    <div class="form-group mb-0">
                                       <div class="banner-image-upload" style="min-height:180px;">
                                          <div class="text-center text-muted" style="padding:24px 0;">
                                             <i class="feather icon-upload-cloud" style="font-size:40px;display:block;margin-bottom:10px;"></i>
                                             <span>Drag & drop PDF here, or</span>
                                          </div>
                                          <div class="banner-recommended-size">Accepted format: PDF</div>
                                          <input type="file" name="brochure" id="brochure" style="display: none;" accept=".pdf">
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
                                          <div class="small font-weight-bold mt-2" style="word-break:break-all;">The-Villa-Tent-Profile-2026.pdf</div>
                                          <small class="text-muted">2.45 MB</small>
                                          <a href="#" class="btn btn-outline-secondary btn-sm btn-block mt-2" title="Download"><i class="feather icon-download"></i> Download</a>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-12 mt-3">
                                    <input type="submit" class="btn btn-success btn-lg" name="save_brochure" value="Save Brochure">
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
   </div>
</div>
<!---->

<script type="text/javascript">
   $(document).ready(function() {
      $(".br-menu-link11").click(function(){
         alert('sss');
         $(".br-menu-sub").toggleClass('show')
      });

      $('#myFile').on('change', function(){
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

      $('#myFiless').on('change', function(){
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
      document.getElementById('myFile').value = "";
      var defaultSrc = "images/default-profile.png";
      document.getElementById('logo_preview').src = defaultSrc;
      document.getElementById('logo_banner_preview').src = defaultSrc;
   }

   function resetFavicon()
   {
      document.getElementById('myFiless').value = "";
      var defaultSrc = "images/default-profile.png";
      document.getElementById('favicon_preview').src = defaultSrc;
      document.getElementById('favicon_banner_preview').src = defaultSrc;
   }
</script>