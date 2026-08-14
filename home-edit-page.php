<?php 
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Home Edit Page";

   $query4 = mysqli_query($con,"SELECT * FROM home_top_section");
   $b = mysqli_fetch_assoc($query4);

   $query2 = mysqli_query($con,"SELECT * FROM home_seo_meta_data");
   $d = mysqli_fetch_assoc($query2);	

   if (isset($_POST['update-submit']))
   {	
   	$page      = "Update";
      $metaTitle = $_POST['metaTitle'];
      $keyword   = $_POST['keyword'];
      $disc      = $_POST['disc'];
   	$toptitle  = $_POST['toptitle'];
   	$editor1   = $_POST['editor1'];
   	
   	if($metaTitle != '' && $keyword != '' && $disc != '')
      {
         mysqli_query($con, "UPDATE home_seo_meta_data SET title='$metaTitle', keyword='$keyword', discription='$disc' ");
      }
   	
   	mysqli_query($con, "UPDATE home_top_section SET title='$toptitle', content='$editor1'");
   	
   	$_SESSION['BannerColor'] = "background-color:#4BB543;";
      $_SESSION['Message'] = "Updated Successfully!";
      echo "<script>window.location.href='home-edit-page.php';</script>";
      exit;
   }
?>

<!---->
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body"> 
               <form action="" method="post" id="homeAboutForm">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Home Edit Page</h1>
                        <div class="listing-breadcrumb">
                           <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Pages</span><span class="crumb-sep">&gt;</span><span>Home Edit</span>
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
                     <div class="col-lg-4 col-md-12">
                        <div class="card mb-30">
                           <div class="card-header">Seo Meta Data</div>
                           <div class="card-body">
                              <div class="commonSection">
                                 <label>Meta Title</label>
                                 <textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Meta Title"><?php echo $d['title']; ?></textarea>
                              </div>

                              <div class="commonSection">
                                 <label>Meta Keyword</label>
                                 <textarea name="keyword" id="metaKeyword" class="form-control" required placeholder="Enter Keyword"><?php echo $d['keyword']; ?></textarea>
                              </div>

                              <div class="commonSection">
                                 <label>Meta Description</label>
                                 <textarea name="disc" id="metaDescription" class="form-control" required placeholder="Enter Description"><?php echo $d['discription']; ?></textarea>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-8 col-md-12">
                        <div class="card mb-30">
                           <div class="card-header">About Page</div>
                           <div class="card-body">
                              <div class="commonSection">
                                 <label>Title</label>
                                 <input class="form-control" type="text" name="toptitle" id="toptitle" value="<?php echo $b['title']; ?>" placeholder="Enter Heading">
                              </div>

                              <div class="commonSection">
                                 <label>Content</label>
                                 <textarea name="editor1" id="editor1" rows="10" cols="80"><?php echo $b['content']; ?></textarea>
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