<?php 
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Gallery Edit Page";

   $query4 = mysqli_query($con,"SELECT * FROM gallery_top_section");
   $b = mysqli_fetch_assoc($query4);	

   if (isset($_POST['update-submit']))
   {
   	$page      = "Update";
      $metaTitle = $_POST['metaTitle'];
      $keyword   = $_POST['keyword'];
      $disc      = $_POST['disc'];
   	$toptitle  = mysqli_real_escape_string($con, $_POST['toptitle']);
   	$editor1   = mysqli_real_escape_string($con, $_POST['editor1']);
   	
      mysqli_query($con, "UPDATE gallery_top_section SET meta_title='$metaTitle', meta_keyword='$keyword', meta_desc='$disc', title='$toptitle', content='$editor1'");

      $_SESSION['BannerColor'] = "background-color:#4BB543;";
      $_SESSION['Message'] = "Updated Successfully!";
      echo "<script>window.location.href='gallery-edit-page.php';</script>";
      exit;
   }
?>

<!---->
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body"> 
               <form action="" enctype="multipart/form-data" method="post" id="homeAboutForm">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Gallery Edit Page</h1>
                        <div class="listing-breadcrumb">
                           <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Pages</span><span class="crumb-sep">&gt;</span><span>Gallery Edit</span>
                        </div>
                     </div>

                     <div class="listing-cta">
                        <a href="index.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
                        <input type="submit" class="btn btn-success btn-sm" name="update-submit" value="Save" form="homeAboutForm">
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
                     <div class="col-lg-6 col-md-12">
                        <div class="card mb-30">
                           <div class="card-header">Seo Meta Data</div>
                           <div class="card-body">
                              <div class="commonSection">
                                 <label>Meta Title</label>
                                 <textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Meta Title"><?php echo $b['meta_title']; ?></textarea>
                              </div>

                              <div class="commonSection">
                                 <label>Meta Keyword</label>
                                 <textarea name="keyword" id="metaKeyword" class="form-control" required placeholder="Enter Keyword"><?php echo $b['meta_keyword']; ?></textarea>
                              </div>

                              <div class="commonSection">
                                 <label>Meta Description</label>
                                 <textarea name="disc" id="metaDescription" class="form-control" required placeholder="Enter Description"><?php echo $b['meta_desc']; ?></textarea>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6 col-md-12">
                        <div class="row">
                           <div class="col-lg-12 col-md-12">
                              <div class="card mb-30">
                                 <div class="card-header">Gallery Page</div>
                                 <div class="card-body">
                                    <div class="commonSection">
                                       <label>Heading</label>
                                       <textarea name="toptitle" id="toptitle" rows="10" cols="80"><?php echo $b['title']; ?></textarea>
                                       <script type="text/javascript">
                                          CKEDITOR.editorConfig = function (config) {
                                             config.language = 'es';
                                             config.uiColor = '#F7B42C';
                                             config.height = 300;
                                             config.toolbarCanCollapse = true;

                                          };
                                          CKEDITOR.replace('toptitle');
                                       </script>
                                    </div>

                                    <div class="commonSection">
                                       <label>Description</label>
                                       <textarea name="editor1" id="editor1" rows="10" cols="80"><?php echo $b['content']; ?></textarea>
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
   CKEDITOR.editorConfig = function (config) {
      config.language = 'es';
      config.uiColor = '#F7B42C';
      config.height = 300;
      config.toolbarCanCollapse = true;

   };
   CKEDITOR.replace('editor1');
</script>