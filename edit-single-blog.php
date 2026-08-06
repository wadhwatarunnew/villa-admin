<?php 
	error_reporting(0);
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Blog Page";

	$id=$_GET['id'];
	$FileExists = false;	

	$query3 = mysqli_query($con,"SELECT * FROM blog_inner_content WHERE id=$id");										
	$b = mysqli_fetch_assoc($query3);

	if (isset($_POST['update']))
	{
		$page = "Update";
		$metaTitle = $_POST['metaTitle'];
		$keyword   = $_POST['keyword'];
		$disc 	  = $_POST['disc'];
		$title 	  = $_POST['title'];
		$date 	  = $_POST['date'];
		$editor1   = $_POST['editor1'];
		$imageUrl  = $_POST['image'];
		$myFile    = $_FILES['myFile']['name'];
		
		$path="uploads/pageimages/blogs/single/";
		$path_original="uploads/pageimages/blogs/single/";
		
		if(!$imageUrl)
		{
			if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
	    	{
	    	   $FileExists = true;
            $_SESSION['BannerColor'] = "background-color:#FF0000;";
            $_SESSION['Message'] = "Selected image already exists!";
            echo "<script>window.location.href='edit-single-blog.php?id=$id';</script>";
            exit;
	    	}
	    	else
	    	{ 	
	        	move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
	        	$path=$path_original.$myFile;
		
	        	mysqli_query($con,"UPDATE blog_inner_content SET title='$title', date='$date', content='$editor1', image='', local_path='$path', metatitle='$metaTitle', keyword='$keyword', discription='$disc' WHERE id=$id");
	        	
	        	$_SESSION['BannerColor'] = "background-color:#4BB543;";
	         $_SESSION['Message'] = "Updated Successfully!";
	         echo "<script>window.location.href='edit-single-blog.php?id=$id';</script>";
	         exit;
	    	}
		
		}
		else
		{	
	    	mysqli_query($con, "UPDATE blog_inner_content SET title='$title', date='$date', content='$editor1', image='$imageUrl', metatitle='$metaTitle', keyword='$keyword', discription='$disc' WHERE id=$id");

	    	$_SESSION['BannerColor'] = "background-color:#4BB543;";
         $_SESSION['Message'] = "Updated Successfully!";
         echo "<script>window.location.href='edit-single-blog.php?id=$id';</script>";
         exit;
	   }
	}
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <form action ="" enctype="multipart/form-data" method="post">
	         <div class="page-wrapper">
	            <div class="row">
                     <div class="col-sm-12">
                        <div class="listing-page-head">
                           <div class="listing-title-wrap">
                              <h1>Edit Blog</h1>
                              <div class="listing-breadcrumb">
                                 <span>Home</span><span class="crumb-sep">&gt;</span><span>Blogs</span><span class="crumb-sep">&gt;</span><span>Edit Blog</span>
                              </div>
                           </div>

                           <div class="listing-cta">
                              <a href="blog-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to Blogs</a>
										<button type="submit" class="btn btn-success btn-sm" name="update"><i class="feather icon-save"></i> Save Blog</button>
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
	                     <div class="card mb-30">
	                        <div class="card-header">Seo Meta Tags</div>
	                        <div class="card-body">
	                           <div class="row">
	                              <div class="col-sm-4">
	                                 <div class="commonSection">
	               					 		<label>Meta Title</label>
	                                    <textarea name="metaTitle" id="metaTitle" class="form-control"  placeholder="Enter Meta Title"><?php echo $b['metatitle']; ?></textarea>
	                                 </div>
	                              </div>

	                              <div class="col-sm-4">
	                                 <div class="commonSection">
	                                    <label>Meta Keyword</label>
	                                    <textarea name="keyword" id="metaTitle" class="form-control"  placeholder="Enter Keyword"><?php echo $b['keyword']; ?></textarea>
	                                 </div>
	                              </div>

	                              <div class="col-sm-4">
	                                 <div class="commonSection">
	                                    <label>Meta Description</label>
	                                     <textarea name="disc" id="metaTitle" class="form-control"  placeholder="Enter Description"><?php echo $b['discription']; ?></textarea>
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
	                        <div class="card-header">Manage Blog Content Inner
						  				<p class="float-end" style="color:red">* Note for Image Type - Please select only one from options. Both empty and both full are not valid.</p>
						  			</div>

	                        <div class="card-body">
	                           <div class="row">
							 				<div class="col-sm-8">
	                                 <div class="commonSection">
	                                    <label>Title</label>
	                                    <input class="form-control" type="text" name="title" required id="title" value="<?php echo $b['title']; ?>" placeholder="Enter Heading">
	                                 </div>
	                              </div>

	                              <div class="col-sm-4">
	                                 <div class="commonSection">
	                                    <label>Date</label>
	                                    <input class="form-control" type="date" name="date" required id="date" value="<?php echo $b['date']; ?>" placeholder="Enter Heading">
	                                 </div>
	                              </div>
								
								 			<div class="col-sm-12">
	                                 <div class="commonSection">
	                                    <label>Content</label>
	                                    <textarea name="editor1" id="editor1" rows="10" cols="80" required><?php echo $b['content']; ?></textarea>
	                                 </div>
	                              </div>
	                             
	                              <div class="col-sm-12">
	                                 <div class="commonSection">
	                                    <label>Image Type</label>
													<div class="radio-inline-group" style="display: inline !important;">
														<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();" <?php echo ($b['image'] != '') ? 'checked' : ''; ?>>Image URL</label>
														<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" <?php echo ($b['local_path'] != '') ?'checked' : ''; ?>>Select New Image</label>
													</div>
	                                 </div>
	                              </div>
										
											<div class="col-sm-12" id="image_url">
	                                 <div class="commonSection">
	                                    <label>Image URL</label>
	                                    <input class="form-control" type="text" name="image" id="image" value="<?php echo $b['image']; ?>" placeholder="Enter url">
	                                 </div>
	                              </div>
										</div>
									</div>
								  
								  	<div class="row" id="select_image1">
										<div class="col-sm-6">
	                              <div class="commonSection"> 
	                                 <label>Image</label>
	                                 <img src="<?php echo $b['image']; ?>" class="img-thumbnail" id="imgPreview" >
	                              </div>
	                           </div>

								  		<div class="col-sm-6">
	                              <div class="commonSection">
	                                 <label>Select Image</label>
	                                    <input type="file" name="myFile" id="myFile" class="form-control"><br>
									  				<button type="button" class="btn btn-sm btn-danger" onclick="res();">Reset Image</button>
	                              	</div>
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

<script type="text/javascript">
	CKEDITOR.editorConfig = function (config) {
	   config.language = 'es';
	   config.uiColor = '#F7B42C';
	   config.height = 300;
	   config.toolbarCanCollapse = true; 
   };
   CKEDITOR.replace('editor1');

   $(document).ready(function() {
		var x = document.getElementById("myFile").value;
		var x1 = document.getElementById("image").value;
		
		if(x1 && x)
		{
			document.getElementById("btnn").disabled = true;	
		}
		else if(!x1 && !x)
		{
			document.getElementById("btnn").disabled = true;	
		}
		else
		{
			document.getElementById("btnn").disabled = false;
		}
		
		$('#image').keyup(function() {
			var dInput = this.value;
			var x = document.getElementById("myFile").value;

			if(dInput && x)
			{	
				document.getElementById("btnn").disabled = true;	
			}
			else if(!dInput && !x)
			{	
				document.getElementById("btnn").disabled = true;	
			}
			else
			{	
				document.getElementById("btnn").disabled = false;				
			}
		});
		
		document.getElementById('myFile').onchange = function ()
		{
			var pInput = this.value;
			document.getElementById("image").value = "";
			var y = document.getElementById("image").value;
			
			if(!pInput && !y)
			{	
				document.getElementById("btnn").disabled = true;	
			}
			else
			{	
				document.getElementById("btnn").disabled = false;
			}
		}
	});

	document.getElementById('select_image1').style.display = 'none';
	function show1()
	{
      document.getElementById('select_image1').style.display = 'none';    
      document.getElementById('image_url').style.display = 'block';
   }

	function show2()
	{				
	   document.getElementById('image_url').style.display = 'none';
      document.getElementById('select_image1').style.display = 'block';
	}

	function res()
	{
		document.getElementById('myFile').value= "";
		var p = document.getElementById("image").value;
		
		if(p)
		{	
			document.getElementById("btnn").disabled = false;
		}
		else
		{	
			document.getElementById("btnn").disabled = true;	
		}
	}
</script>