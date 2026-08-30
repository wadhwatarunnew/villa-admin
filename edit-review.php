<?php
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Reviews";

   $id = $_GET['id'];
   $quer = mysqli_query($con,"SELECT * from home_testimonials WHERE id=$id");
   $q1 = mysqli_fetch_assoc($quer);

   if (isset($_POST['submit']))
   {
   	$page    = "Update";
      $fname   = mysqli_real_escape_string($con, $_POST['fname']);
      $desig   = mysqli_real_escape_string($con, $_POST['desig']);
      $rating  = mysqli_real_escape_string($con, $_POST['rating']);
      $editor1 = mysqli_real_escape_string($con, $_POST['editor1']);
      $myFile  = $_FILES['myFile']['name'];

   	$path = "uploads/review/";
   	$path_original = "uploads/review/";

      if($myFile != '' )
      {
      	if((file_exists("uploads/pageimages/".$myFile) ||
            file_exists("uploads/pageimages/addgallery/".$myFile) ||
            file_exists("uploads/pageimages/addgallery/project/".$myFile) ||
            file_exists("uploads/pageimages/addgallery/resort/".$myFile) ||
            file_exists("uploads/pageimages/blogs/".$myFile) ||
            file_exists("uploads/pageimages/blogs/single/".$myFile) ||
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
            echo "<script>window.location.href='edit-review.php?id=$id';</script>";
            exit;
         }
         else
         {
            move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
            $path=$path_original.$myFile;
            
            mysqli_query($con,"UPDATE home_testimonials SET name='$fname', designation='$desig', rating='$rating', discription='$editor1', image='$path' WHERE id=$id");

            $_SESSION['BannerColor'] = "background-color:#4BB543;";
            $_SESSION['Message'] = "Updated Successfully!";
            echo "<script>window.location.href='edit-review.php?id=$id';</script>";
            exit;
         }
      }
      else
      {
         mysqli_query($con,"UPDATE home_testimonials SET name='$fname', designation='$desig', rating='$rating', discription='$editor1' WHERE id=$id");
         $_SESSION['BannerColor'] = "background-color:#4BB543;";
         $_SESSION['Message'] = "Updated Successfully!";
         echo "<script>window.location.href='edit-review.php?id=$id';</script>";
         exit;
      }
   };
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <form action ="" method="post" id="editReviewForm">
               <div class="page-body">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Edit Review</h1>
                        <div class="listing-breadcrumb">
                           <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Reviews</span><span class="crumb-sep">&gt;</span><span>Edit</span>
                        </div>
                     </div>

                     <div class="listing-cta">
                        <a href="review-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
                        <input type="submit" class="btn btn-success btn-sm" name="submit" value="Save" form="editReviewForm">
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
                           <div class="card-header">Manage Reviews</div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-sm-4">
                                    <div class="commonSection">
                                       <label>Author Name</label>
                                       <input type="text" name="fname" class="form-control" value="<?php echo $q1['name']; ?>" placeholder="Author Name"/>
                                    </div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="commonSection">
                                       <label>Author Designation</label>
                                       <input type="text" name="desig" class="form-control" value="<?php echo $q1['designation']; ?>" placeholder="Author Designation"/>
                                    </div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="commonSection">
                                       <label>Review Rating</label>
                                       <input type="text" name="rating" class="form-control" value="<?php echo $q1['rating']; ?>" placeholder="Review Rating"/>
                                    </div>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="commonSection">
                                       <label>Author Description</label>
                                       <textarea name="editor1" id="editor1" rows="10" cols="80"><?php echo $q1['discription']; ?></textarea>
                                    </div>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-sm-4">
                                    <div class="commonSection">
                                       <label>Review Image </label>
                                       <img src="<?php echo $q1['image']; ?>" class="img-thumbnail" id="imgPreview" >
                                    </div>
                                 </div>

                                 <div class="col-sm-8">
                                    <div class="commonSection">
                                       <label>Select Review Image</label>
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