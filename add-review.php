<?php 
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Reviews";

   $quer= mysqli_query($con,"SELECT * FROM home_testimonials");
   $q1=mysqli_fetch_assoc($quer);

   if (isset($_POST['submit']))
   {
   	$page    = "Update";	
   	$fname   = $_POST['fname'];
   	$desig   = $_POST['desig'];
   	$rating  = $_POST['rating'];
   	$editor1 = $_POST['editor1'];
   	$myFile  = $_FILES['myFile']['name'];

   	$path="uploads/review/";
   	$path_original="uploads/review/";
   	
   	if($myFile != '' && 
         (file_exists("uploads/pageimages/".$myFile) ||
            file_exists("uploads/pageimages/addgallery/".$myFile) ||
            file_exists("uploads/pageimages/addgallery/project/".$myFile) ||
            file_exists("uploads/pageimages/addgallery/resort/".$myFile) ||
            file_exists("uploads/pageimages/blogs/".$myFile) ||
            file_exists("uploads/pageimages/blogs/single/".$myFile)  ||
            file_exists("uploads/pageimages/contact/".$myFile) ||
            file_exists("uploads/pageimages/nav/".$myFile) ||
            file_exists("uploads/pageimages/nav/category/".$myFile) ||
            file_exists("uploads/pageimages/nav/types/".$myFile) ||
            file_exists("uploads/pageimages/project/".$myFile) ||
            file_exists("uploads/pageimages/project/category/".$myFile) ||
            file_exists("uploads/pageimages/project/types/".$myFile) ||
            file_exists("uploads/pageimages/resort/".$myFile) ||
            file_exists("uploads/pageimages/resort/category/".$myFile) ||
            file_exists("uploads/pageimages/resort/types/".$myFile) ||
            file_exists("uploads/pageimages/slider/".$myFile) ||
            file_exists("uploads/pageimages/youtube/".$myFile)))
   	{
         $FileExists = true;
         $_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "Selected image already exists!";
         echo "<script>window.location.href='add-review.php';</script>";
         exit;
      }
      else
      {
         move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
         $path=$path_original.$myFile;

         mysqli_query($con,"INSERT INTO home_testimonials (name,designation,rating,discription,image) VALUES ('$fname','$desig','$rating','$editor1','$path') ");

         $_SESSION['BannerColor'] = "background-color:#4BB543;";
         $_SESSION['Message'] = "Added Successfully!";
         echo "<script>window.location.href='add-review.php';</script>";
         exit;
      }
   };
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <form action ="" enctype="multipart/form-data" method="post">
               <div class="page-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="listing-page-head">
                           <div class="listing-title-wrap">
                              <h1>Add Review</h1>
                              <div class="listing-breadcrumb">
                                 <span>Home</span><span class="crumb-sep">&gt;</span><span>Reviews</span><span class="crumb-sep">&gt;</span><span>Add Review</span>
                              </div>
                           </div>

                           <div class="listing-cta">
                              <a href="review-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to Reviews</a>
                              <button type="submit" class="btn btn-success btn-sm" name="submit"><i class="feather icon-save"></i> Save Review</button>
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
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-sm-4">
                                    <div class="commonSection">
                                       <label>Author Name</label>
                                       <input type="text" name="fname" class="form-control" placeholder="Author Name"/ required>
                                    </div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="commonSection">
                                       <label>Author Designation</label>
                                       <input type="text" name="desig" class="form-control" placeholder="Author Designation"/ required>
                                    </div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="commonSection">
                                       <label>Review Rating</label>
                                       <input type="text" name="rating" class="form-control" placeholder="Review Rating"/ required>
                                    </div>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="commonSection">
                                       <label>Author Description</label>
                                       <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
                                       
                                    </div>
                                 </div>

                                 <div class="col-sm-8">
                                    <div class="commonSection">
                                       <label>Select Image</label>
                                       <input type="file" class="form-control" name="myFile" id="myFile">
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

<script>
   CKEDITOR.editorConfig = function (config) {
      config.language = 'es';
      config.uiColor = '#F7B42C';
      config.height = 300;
      config.toolbarCanCollapse = true;

   };
   CKEDITOR.replace('editor1');
</script>