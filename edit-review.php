<?php 

error_reporting(0);
$id = $_GET['id'];
include "db.php";


$quer= mysqli_query($con,"select * from home_testimonials where id=$id");

$q1=mysqli_fetch_assoc($quer);


if (isset($_POST['subm'])){
	$page = "Update";
	
	$fname = $_POST['fname'];
	$desig = $_POST['desig'];
	$rating = $_POST['rating'];
	$editor1 = $_POST['editor1'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE home_testimonials SET name='$fname',designation='$desig',rating='$rating',discription='$editor1' where id=$id");
	
	//header("location:edit-review.php?id=$id");
	header( "refresh:2; url=edit-review.php?id=$id" );
};

if (isset($_POST['submi'])){
	$page = "Update";
	$myFile=$_FILES['myFile']['name'];
	

	$path="uploads/review/";
	$path_original="uploads/review/";

	if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
	{
    $FileExists = true;
    header( "refresh:2; url=edit-review.php?id=$id" ); 
 }
 else
 {
    include "db.php";
    
    move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
    $path=$path_original.$myFile;
    
    mysqli_query($con,"UPDATE home_testimonials SET image='$path' where id=$id");
    
    	//header("location:edit-review.php?id=$id");
    header( "refresh:2; url=edit-review.php?id=$id" );
 }
};



?>

<?php $PageTitle = "Villatent: Reviews"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
           <form action ="" method="post">
            <div class="page-body">

               <div class="row">
                  
                
                  <div class="col-sm-12">
                     <?php include "alert-update.php";  ?>
                     <div class="card">
                        <div class="card-header">Manage Reviews &nbsp;<a href="review-list-page.php" class="btn btn-sm btn-primary">Back</a></div>
                        
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
                                    <script>
                                       CKEDITOR.editorConfig = function (config) {
                                          config.language = 'es';
                                          config.uiColor = '#F7B42C';
                                          config.height = 300;
                                          config.toolbarCanCollapse = true;
                                          
                                       };
                                       CKEDITOR.replace('editor1');
                                    </script>
                                 </div>
                              </div>
                           </div>
                           
                           
                        </div>
                     </div>
                  </div>
                  
                  
               </div>
               <div class="row">
                  <div class="col-sm-2">
                     <div class="commonSection">
                        <input type="submit" class="btn btn-success btn-lg" name="subm" value="Save">
                     </div>
                  </div>
               </div>
            </div>
         </form>
         
         <form action ="" enctype="multipart/form-data" method="post">
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
         <div class="row">
            <div class="col-sm-2">
               <div class="commonSection">
                  <input type="submit" class="btn btn-success btn-lg" name="submi" value="Save Image">
               </div>
            </div>
         </div>
      </form>
      
      
   </div>
</div>
</div>
</div>
<?php include_once('common/footer.php'); ?>