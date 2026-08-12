<?php
	error_reporting(0);
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Navigation Bar";

	if (isset($_POST['sub']))
	{
		$page = "Update";
		$name = $_POST['name'];
		$link = $_POST['link'];
		$position = $_POST['position'];
		$myfiles = fopen("../$link", "w");
		$metaTitle = $_POST['metaTitle'];
		$keyword = $_POST['keyword'];
		$disc = $_POST['disc'];
		$title = $_POST['title'];
		$editor1 = $_POST['editor1'];
		$imageUrl = $_POST['image'];
		$myFile=$_FILES['myFile']['name'];

		$path="uploads/pageimages/nav/";
		$path_original="uploads/pageimages/nav/";
		
		if(!$imageUrl)
		{	
		   if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
	    	{
	    	   $FileExists = true;
	         $_SESSION['BannerColor'] = "background-color:#FF0000;";
	         $_SESSION['Message'] = "Selected image already exists!";
	         echo "<script>window.location.href='add-nav-page';</script>";
	         exit;
	    	}
	    	else
	    	{
				move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
	        	$path=$path_original.$myFile;
	        	mysqli_query($con,"INSERT INTO add_nav (name, link, position, metatitle, keyword, discription, title, content, local_path) VALUES ('$name', '$link', '$position', '$metaTitle', '$keyword', '$disc', '$title', '$editor1', '$path') ");
	        	
	        	$_SESSION['BannerColor'] = "background-color:#4BB543;";
		      $_SESSION['Message'] = "Added Successfully!";
		      echo "<script>window.location.href='add-nav-page.php';</script>";
		      exit;
	    	}
		}
		else
		{
			mysqli_query($con,"INSERT INTO add_nav (name, link, position, metatitle, keyword, discription, title, content, image) VALUES ('$name', '$link', '$position', '$metaTitle', '$keyword', '$disc', '$title', '$editor1', '$imageUrl') ");
	    	
	    	$_SESSION['BannerColor'] = "background-color:#4BB543;";
	      $_SESSION['Message'] = "Added Successfully!";
	      echo "<script>window.location.href='add-nav-page.php';</script>";
	      exit;
		}
	}
?>
  
<!---->
<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
   		<div class="page-wrapper">
      		<div class="page-body">
					<?php
						$SubHeaderTitle = 'Navigation';
						$SubHeaderBackUrl = 'nav-listing.php';
						$SubHeaderBackLabel = 'Back to List';
						include_once('common/subheader.php');
					?>

					<?php if (!empty($_SESSION['Message'])) {
	                 echo "<div class='alert' id='mydiv' style='" . $_SESSION['BannerColor'] . "'>"
	                           . "<p style='color:white;'>" . htmlspecialchars($_SESSION['Message']) . "</p>"
	                           . "</div>";

	                 unset($_SESSION['Message']);
	                 unset($_SESSION['BannerColor']);
	             } ?>
		  			<form action ="" enctype="multipart/form-data" method="post">
	   				<div class="row">
					 		<div class="col-sm-12">
                        <div class="card mb-30">
									<div class="card-header">Navigation Details</div>
										<div class="card-body">
											<div class="row">
												<div class="col-sm-12">
			                              <div class="commonSection"> 
							 							<label>Name</label>
							 							<input class="form-control" type="text" name="name" id="name" placeholder="Enter page name">
							 						</div>
												</div>

												<div class="col-sm-12">
			                              <div class="commonSection"> 
							 							<label>Link</label>
							 							<input class="form-control" type="text" name="link" id="link" placeholder="Enter page link">
							 						</div>
												</div>

												<div class="col-sm-12">
			                              <div class="commonSection"> 
							 							<label>Position</label>
							 							<select class="form-control" name="position">
							 								<option value="">--Select--</option>
							 								<option value="header">Header</option>
							 								<option value="footer">Footer</option>
							 							</select>
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
	                    		<div class="card-header">Seo Meta Tags</div>
	                    		<div class="card-body">
	                       		<div class="row">
                                 <div class="col-sm-4">
                                    <div class="commonSection">
                  					 		<label>Meta Title</label>
                                    	<textarea name="metaTitle" id="metaTitle" class="form-control" required  placeholder="Enter Meta Title"></textarea>
                                    </div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="commonSection">
                                    	<label>Meta Keyword</label>
                                    	<textarea name="keyword" id="metaTitle" class="form-control" required placeholder="Enter Keyword"></textarea>
                                 	</div>
                                 </div>

                                 <div class="col-sm-4">
                                    <div class="commonSection">
                                    	<label>Meta Description</label>
                                     	<textarea name="disc" id="metaTitle" class="form-control" required placeholder="Enter Description"></textarea>
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
               				<div class="card-header">Manage Page Content</div>
               				<div class="card-body">
                  				<div class="row">
                                 <div class="col-sm-12">
                                 	<div class="commonSection">
                                    	<label>Title</label>
                                    	<input class="form-control" type="text" required name="title" id="title" placeholder="Enter Heading">
                                 	</div>
                                 </div>
                                    
                                 <div class="col-sm-12">
                                 	<div class="commonSection">
                                    	<label>Content</label>
                                    	<textarea name="editor1" id="editor1"  rows="10" cols="80" required></textarea>
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

                                 <div class="col-sm-12">
                                 	<div class="commonSection">
                                    	<label>Image Type</label>
													<div class="radio-inline-group">
														<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();" checked="">Image URL</label>
														<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();">Select New Image</label>
													</div>
                                    </div>
                                 </div>

                                 <div class="col-sm-12" id="image_url" >
                                 	<div class="commonSection">
                                    	<label>Image URL</label>
                                    	<input class="form-control" type="text" name="image" id="image" placeholder="Enter url">
                                 	</div>
                                 </div>

											<div class="col-sm-12" id="select_image" style="display: none;">
												<div class="commonSection">
													<label>Select Image</label>
													<input type="file" name="myFile" id="myFile" class="form-control"><br>
													<button type="button" class="btn btn-sm btn-danger" onclick="rese();">Reset Image</button><br>
												</div>
											</div>
                     			</div>
                  			</div>
						
								 	<script>
										function rese()
										{
											console.log("lhariom");
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
               			</div>
            			</div>
         			</div>

         			<div class="row">
                     <div class="col-sm-2">
                     	<div class="commonSection">
                        	<input type="submit" class="btn btn-success btn-lg" id="btnn" name="sub" value="Submit">
                     	</div>
                     </div>
         			</div>
		  
					  	<script>
							document.getElementById("btnn").disabled = true;
							$(document).ready(function() {
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
							
								document.getElementById('myFile').onchange = function () {
									var pInput = this.value;
									var y = document.getElementById("image").value;
									
									if(pInput && y)
									{
										document.getElementById("btnn").disabled = true;
									}
									else if(!pInput && !x)
									{
										document.getElementById("btnn").disabled = true;
									}
									else
									{
										document.getElementById("btnn").disabled = false;
									}
								};
							});
									
							function show2()
							{
									document.getElementById('select_image').style.display = 'block';
									document.getElementById('image_url').style.display = 'none';
							}

							function show1()
							{
							  	document.getElementById('select_image').style.display = 'none';
							  	document.getElementById('image_url').style.display = 'block';
							}
						</script>
			 		</form>
      		</div>
   		</div>
		</div>
	</div>
</div>
<!---->

<?php include_once('common/footer.php'); ?>

<script type="text/javascript">
	$(document).ready(function()
	{
	    $('#mydiv').delay(3000).hide(0);
	});
</script> 