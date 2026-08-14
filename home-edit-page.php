<?php 

$PageTitle = "Villatent: Home Edit Page";
include "db.php";

$query4= mysqli_query($con,"select * from home_top_section");

$b=mysqli_fetch_assoc($query4);

$query= mysqli_query($con,"select * from home_middle_section");

$a=mysqli_fetch_assoc($query);

$query1= mysqli_query($con,"select * from home_bottom_section");

$c=mysqli_fetch_assoc($query1);

$query2= mysqli_query($con,"select * from home_seo_meta_data");

$d=mysqli_fetch_assoc($query2);	


if (isset($_POST['update-submit'])){
	
	$page = "Update";
	$toptitle = $_POST['toptitle'];
	$editor1 = $_POST['editor1'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE home_top_section SET title='$toptitle',content='$editor1' ");
	
	//header("location:home-edit-page.php");
	header( "refresh:2; url=home-edit-page.php" );
};

if (isset($_POST['update'])){
	
	$page = "Update";
	$toptitle1 = $_POST['toptitle1'];
	$editor2 = $_POST['editor2'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE home_middle_section SET title='$toptitle1',content='$editor2' ");
	
	//header("location:home-edit-page.php");
	header( "refresh:2; url=home-edit-page.php" );
};

if (isset($_POST['update_image'])){
	$page = "Update";
	
	$myFile=$_FILES['myFile']['name'];
	

	$path="uploads/pageimages/";
	$path_original="uploads/pageimages/";
	
	if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
	{
    $FileExists = true;
    header( "refresh:2; url=home-edit-page.php" );
 }
 else
 {
    move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
    $path=$path_original.$myFile;
    include "db.php";

    mysqli_query($con,"UPDATE home_middle_section SET bg_image='$path' ");

    	//header("location:home-edit-page.php");
    header( "refresh:2; url=home-edit-page.php" );
 }
};

if (isset($_POST['update1'])){
	
	$page = "Update";
	$toptitle2 = $_POST['toptitle2'];
	$editor3 = $_POST['editor3'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE home_bottom_section SET title='$toptitle2',content='$editor3' ");
	
	//header("location:home-edit-page.php");
	header( "refresh:2; url=home-edit-page.php" );
};

if (isset($_POST['update_seo'])){
	$page = "Update";
	
	$metaTitle = $_POST['metaTitle'];
	$keyword = $_POST['keyword'];
	$disc = $_POST['disc'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE home_seo_meta_data SET title='$metaTitle',keyword='$keyword',discription='$disc' ");
	
	//header("location:home-edit-page.php");
	header( "refresh:2; url=home-edit-page.php" );
};

?>


<?php include_once('common/header.php'); ?>
<!---->
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
            <div class="listing-page-head">
              <div class="listing-title-wrap">
                <h1>Home Edit Page</h1>
                <div class="listing-breadcrumb">
                  <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Pages</span><span class="crumb-sep">&gt;</span><span>Home Edit</span>
                </div>
              </div>
              <div class="listing-cta">
                <a href="dashboard.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
                <input type="submit" class="btn btn-success btn-sm" name="update-submit" value="Save" form="homeAboutForm">
              </div>
            </div>
               <div class="row">
                  <div class="col-sm-12">
                     <?php include "alert-update.php";  ?>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-4 col-md-12">
                     <div class="card mb-30">
                        <div class="card-header">Seo Meta Data</div>
                        <div class="card-body">
                           <form action ="" method="post">
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
                              <input type="submit" class="btn btn-success btn-lg" name="update_seo" value="Save">
                           </form>
                        </div>
                     </div>
                  </div>

                    <div class="col-lg-8 col-md-12">
                     <div class="card mb-30">
                        <div class="card-header">About Page</div>
                        <div class="card-body">
                           <form action ="" method="post" id="homeAboutForm">
                              <div class="commonSection">
                                 <label>Title</label>
                                 <input class="form-control" type="text" name="toptitle" id="toptitle" value="<?php echo $b['title']; ?>" placeholder="Enter Heading">
                              </div>
                              <div class="commonSection">
                                 <label>Content</label>
                                 <textarea name="editor1" id="editor1" rows="10" cols="80"><?php echo $b['content']; ?></textarea>
                                 <script type="text/javascript">
                                    CKEDITOR.editorConfig = function (config) {
                                       config.language = 'es';
                                       config.uiColor = '#F7B42C';
                                       config.height = 300;
                                       config.toolbarCanCollapse = true;

                                    };
                                    CKEDITOR.replace('editor1');
                                 </script>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>


               <!-- <div class="row">
                  <div class="col-sm-12">
                     <div class="card mb-30">
                        <div class="card-header">Home Middle Section</div>
                        <div class="card-body">
                           <div class="row">
                              <form action ="" method="post">
                                 <div class="col-sm-12">
                                    <div class="commonSection">
                                       <label>Title</label>
                                       <input class="form-control" type="text" name="toptitle1" id="toptitle1" value="<?php echo $a['title']; ?>" placeholder="Enter Heading">
                                    </div>
                                 </div>
                                 <div class="col-sm-12">
                                    <div class="commonSection">
                                       <label>Content</label>
                                       <textarea name="editor2" id="editor2" rows="10" cols="80"><?php echo $a['content']; ?></textarea>
                                       <script>
                                          CKEDITOR.editorConfig = function (config) {
                                             config.language = 'es';
                                             config.uiColor = '#F7B42C';
                                             config.height = 300;
                                             config.toolbarCanCollapse = true;

                                          };
                                          CKEDITOR.replace('editor2');
                                       </script>
                                    </div>

                                 </div>
                                <div class="col-sm-12">
                                 <input type="submit" class="btn btn-success btn-lg" name="update" value="Save">
                                 </div>
                              </form>
                           </div>
                          
                           <div class="row">
                              <form action ="" enctype="multipart/form-data" method="post">
                                 <div class="col-sm-6">
                                    <div class="commonSection"> 
                                       <label>Background Image</label>
                                       <img src="<?php echo $a['bg_image']; ?>" class="img-thumbnail" id="imgPreview" >
                                    </div>
                                 </div>


                                 <div class="col-sm-6">
                                    <div class="commonSection">
                                       <label>Select Image</label>
                                       <form action="/action_page.php">
                                          <input type="file" name="myFile" class="form-control"><br><br>
                                          </form>
                                       </div>
                                    </div>
                                      <div class="col-sm-12">
                                    <input type="submit" class="btn btn-success btn-lg" name="update_image" value="Save">
                                    </div>
                                 </form>
                              </div>

                           </div>

                        </div>
                     </div>
                  </div>
               </div> -->
                  <!-- <div class="row">
                     <div class="col-sm-12">
                        <div class="card mb-30">
                           <div class="card-header">Home Bottom Section</div>
                           <div class="card-body">
                              <div class="row">
                                 <form action ="" method="post">
                                    <div class="col-sm-12">
                                       <div class="commonSection">
                                          <label>Title</label>
                                          <input class="form-control" type="text" name="toptitle2" id="toptitle2" value="<?php echo $c['title']; ?>" placeholder="Enter Heading">
                                       </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <div class="commonSection">
                                          <label>Content</label>
                                          <textarea name="editor3" id="editor3" rows="10" cols="80"><?php echo $c['content']; ?></textarea>
                                          <script>
                                             CKEDITOR.editorConfig = function (config) {
                                                config.language = 'es';
                                                config.uiColor = '#F7B42C';
                                                config.height = 300;
                                                config.toolbarCanCollapse = true;

                                             };
                                             CKEDITOR.replace('editor3');
                                          </script>
                                       </div>
                                       
                                       <input type="submit" class="btn btn-success btn-lg" name="update1" value="Save">
                                      
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> -->
               <!-- <div class="row">
                  <div class="col-sm-2">
                     <div class="commonSection">
                        <input type="submit" class="btn btn-success btn-lg" name="update-submit" value="Submit">
                     </div>
                  </div>
               </div> -->
            </div>
         </div>
      </div>
   </div>
</div>
<!---->
<?php include_once('common/footer.php'); ?>