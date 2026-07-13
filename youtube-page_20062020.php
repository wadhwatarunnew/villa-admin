<?php 

include "db.php";

$query2= mysqli_query($con,"select * from youtube_seo_meta_data");
											
$d=mysqli_fetch_assoc($query2);	

$query3= mysqli_query($con,"select * from youtube_content");
											
$e=mysqli_fetch_assoc($query3);	

if (isset($_POST['update_seo'])){
	$page = "Update";
	
	$metaTitle = $_POST['metaTitle'];
	$keyword = $_POST['keyword'];
	$disc = $_POST['disc'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE youtube_seo_meta_data SET title='$metaTitle',keyword='$keyword',discription='$disc' ");
	
	//header("location:youtube-page.php");
	header( "refresh:2; url=youtube-page.php" ); 
};


if (isset($_POST['update'])){
	
	$page = "Update";
	$title = $_POST['title'];
	$editor1 = $_POST['editor1'];
	$imageUrl = $_POST['image'];
	
	$myFile=rand(1111,9999).$_FILES['myFile']['name'];
	

	$path="uploads/pageimages/youtube/";
	$path_original="uploads/pageimages/youtube/";
	
	move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
	$path=$path_original.$myFile;
	
	//echo $path;
	
	if(!$imageUrl){
		
	include "db.php";
	
	mysqli_query($con,"update youtube_content SET title='$title',content='$editor1',image='',local_path='$path'");
		
	//mysqli_query($con,"INSERT INTO home_slider (local_path) VALUES ('$path') where id=$id");
	
	//header("location:youtube-page.php");
	header( "refresh:2; url=youtube-page.php" );
	
	
	}else{
		
		
	include "db.php";
	
	mysqli_query($con,"update youtube_content SET title='$title',content='$editor1',image='$imageUrl' ");
	//header("location:youtube-page.php");
		header( "refresh:2; url=youtube-page.php" );
	
		
	};
	
	

};

if (isset($_POST['update1'])){
	$page = "Update";
	
	$title1 = $_POST['title1'];
	$editor2 = $_POST['editor2'];
	$imageUrl1 = $_POST['image1'];
	
	$myFile1=rand(1111,9999).$_FILES['myFile1']['name'];
	

	$path2="uploads/pageimages/youtube/";
	$path_original2="uploads/pageimages/youtube/";
	
	move_uploaded_file($_FILES['myFile1']['tmp_name'],$path2.$myFile1) ;
	$path1=$path_original2.$myFile1;
	move_uploaded_file($_FILES['myFile1']['tmp_name'],$path2.$myFile1) ;
	$path1=$path_original2.$myFile
	//echo $path;
	
	if(!$imageUrl1){
	
	include "db.php";
	
	
	if(!$_FILES['myFile1']['name']){
		
		mysqli_query($con,"update youtube_content SET title='$title1',content='$editor2' ");
		
		//header("location:youtube-page.php");
		header( "refresh:2; url=youtube-page.php" );
	}else{
		
		mysqli_query($con,"update youtube_content SET title='$title1',content='$editor2',local_path='$path1' ");
	
	//header("location:youtube-page.php");
		header( "refresh:2; url=youtube-page.php" );
		
	}
	
	
	
	
	}else{
		
		
	include "db.php";
	
	mysqli_query($con,"update youtube_content SET title='$title1',content='$editor2',image='$imageUrl1',local_path='' ");
		
	//mysqli_query($con,"INSERT INTO home_slider (local_path) VALUES ('$path') where id=$id");
	
	//header("location:youtube-page.php");
		header( "refresh:2; url=youtube-page.php" );
	};
	
	
};

?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Villatent: Youtube Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css"/>
      <link rel="stylesheet" href="css/feather.css"/>
      <link rel="stylesheet" href="css/font-awesome.min.css"/>
	  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
	  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <body>
      <!---->
      <?php include_once('common/header.php'); ?>
      <!--sidebar-->
      <?php include_once('common/sidebar.php'); ?>
      <!---->
      <div class="pcoded-content">
         <div class="pcoded-inner-content">
            <div class="main-body">
               <div class="page-wrapper">
                  <div class="page-body">
                     <div class="row">
                        <div class="col-sm-12">
						<?php include "alert-update.php";  ?>
                           <div class="card mb-30">
                              <div class="card-header">Seo Meta Tags</div>
                              <div class="card-body">
                                 <form action ="" method="post">
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <div class="commonSection">
                     					 <label>Meta Title</label>
                                          <textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Meta Title"><?php echo $d['title']; ?></textarea>
                                       </div>
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="commonSection">
                                          <label>Meta Keyword</label>
                                          <textarea name="keyword" id="metaTitle" class="form-control" required placeholder="Enter Keyword"><?php echo $d['keyword']; ?></textarea>
                                       </div>
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="commonSection">
                                          <label>Meta Description</label>
                                           <textarea name="disc" id="metaTitle" class="form-control" required placeholder="Enter Description"><?php echo $d['discription']; ?></textarea>
                                       </div>
                                    </div>
									<input type="submit" class="btn btn-success btn-lg" name="update_seo" value="Save">
                                 </div>
								 </form>
                              </div>
                           </div>
                        </div>
                     </div>
					 
					 
					  <form action ="" enctype="multipart/form-data" method="post">
                     <div class="row ">
                        <div class="col-sm-12">
                           <div class="card mb-30">
                              <div class="card-header">Manage Youtube Content Section
							  <p class="float-end" style="color:red">* Note for Image Type - Please select only one from options. Both empty and both full are not valid.</p>
							  </div>
                              <div class="card-body">
							  
                                 <div class="row">
								  
								  
								   <?php 
										  
										  if(!$e['local_path']){
										  
										  ?>
								  
                                    <div class="col-sm-12">
                                       <div class="commonSection">
                                          <label>Title</label>
                                          <input class="form-control" type="text" name="title" required id="title" value="<?php echo $e['title']; ?>" placeholder="Enter Heading">
                                       </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <div class="commonSection">
                                          <label>Content</label>
                                          <textarea name="editor1" id="editor1" rows="10" cols="80" required><?php echo $e['content']; ?></textarea>
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
                                    </div>
									
									
										  <?php  }else{ ?>
										  
										  <div class="col-sm-12">
                                       <div class="commonSection">
                                          <label>Title</label>
                                          <input class="form-control" type="text" name="title1" id="title1" required value="<?php echo $e['title']; ?>" placeholder="Enter Heading">
                                       </div>
                                    </div>
                                    <div class="col-sm-12">
                                       <div class="commonSection">
                                          <label>Content</label>
                                          <textarea name="editor2" id="editor2" rows="10" cols="80" required><?php echo $e['content']; ?></textarea>
                                         <script type="text/javascript">
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
										  
										  <?php  }  ?>
                                    <div class="col-sm-12">
                                       <div class="commonSection">
                                          <label>Image Type</label>
                                           <?php 
										  
										  if(!$e['local_path']){
										  
										  ?>
										  
										  <input id="id_radio1" type="radio" name="img" onclick="show1();"  checked="">Image URL
                                          <input id="id_radio2" type="radio" name="img" onclick="show2();" >Select New Image
										  
										  <?php  }else{  ?>
										  
										  <input id="id_radio1" type="radio" name="img" onclick="show3();"  >Image URL
                                          <input id="id_radio2" type="radio" name="img" onclick="show4();"  checked="">Select New Image
										  
										  <?php  }  ?>
                                       </div>
                                    </div>
									
									<?php
									
									if(!$e['local_path']){
										
										
										?>
										<div class="col-sm-12" id="image_url">
                                       <div class="commonSection">
                                          <label>Image URL</label>
                                          <input class="form-control" type="text" name="image" id="image" value="<?php echo $e['image']; ?>" placeholder="Enter url">
                                       </div>
                                    </div>
										
										 </div>
								 
								  
								
                              </div>
							  
							  <div id="select_image1">
									<div class="col-sm-6">
                                       <div class="commonSection"> 
                                          <label>Image</label>
                                            <img src="<?php echo $e['local_path']; ?>" class="img-thumbnail" id="imgPreview" >
                                       </div>
                                    </div>
							  <div class="col-sm-6">
                                       <div class="commonSection">
                                          <label>Select Image</label>
                                          <!--<form action="/action_page.php">-->
                                             Select files: <input type="file" name="myFile" id="myFile" class="form-control"><br>
											  <button type="button" class="btn btn-sm btn-danger" onclick="res();">Reset Image</button>
                                          <!--</form>-->
										   
                                       </div>
									   
									  
                                    </div>
									
									<script>
									
									function res(){
										console.log("lhariom");
						document.getElementById('myFile').value= "";
						
						
						var p = document.getElementById("image").value;
						
						if(p){
							
							document.getElementById("btnn").disabled = false;
							
						}else{
							
							document.getElementById("btnn").disabled = true;
							
						}
									
						
									}
									
									</script>
									
									</div>
										
									<?php	
										
									}else{
									
									?>
									
									
									<div class="col-sm-12" id="image_url1">
                                       <div class="commonSection">
                                          <label>Image URL</label>
                                          <input class="form-control" type="text" name="image1" id="image1" value="<?php echo $e['image']; ?>" placeholder="Enter url">
                                       </div>
                                    </div>
									
									<div id="select_image">
									<div class="col-sm-6">
                                       <div class="commonSection"> 
                                          <label>Image</label>
                                            <img src="<?php echo $e['local_path']; ?>" class="img-thumbnail" id="imgPreview" >
                                       </div>
                                    </div>
							  <div class="col-sm-6">
                                       <div class="commonSection">
                                          <label>Select Image</label>
                                          <!--<form action="/action_page.php">-->
                                             Select files: <input type="file" name="myFile1" id="myFile1" class="form-control"><br>
											<button type="button" class="btn btn-sm btn-danger" onclick="res1();">Reset Image</button>
                                          <!--</form>-->
                                       </div>
                                    </div>
									<script>
									
									function res1(){
										console.log("lhariom");
						document.getElementById('myFile1').value= "";
						
						
						var p1 = document.getElementById("image1").value;
						
						if(p1){
							
							document.getElementById("btnn1").disabled = false;
							
						}else{
							
							document.getElementById("btnn1").disabled = true;
							
						}
									
						
									}
									
									</script>
									</div>
									
									<?php  }  ?>
									
                                    
                                
							  
                           </div>
                        </div>
                     </div>
 
 <?php
 if(!$e['local_path']){
		?>			
					
					
                     <div class="row">
                        <div class="col-sm-2">
                           <div class="commonSection">
                              <input type="submit" class="btn btn-success btn-lg" id="btnn" name="update" value="Save">
                           </div>
                        </div>
                     </div>
					 
 <?php  }else{ ?>
 
 <div class="row">
                        <div class="col-sm-2">
                           <div class="commonSection">
                              <input type="submit" class="btn btn-success btn-lg" id="btnn1" name="update1" value="Save">
                           </div>
                        </div>
                     </div>
 
 <?php } ?>
					 
					 
					 
					 
                  </div>
				  
				  <script>
				  
				    //document.getElementById("btnn").disabled = true;
					
					
					
					$(document).ready(function() {
						
					
						
						var x = document.getElementById("myFile").value;
						
						var x1 = document.getElementById("image").value;
						
						
						
						console.log("x",x,x1);
						
						
						
						if(x1 && x){
							
							document.getElementById("btnn").disabled = true;
							
						}else if(!x1 && !x){
							
							document.getElementById("btnn").disabled = true;
							
						}else{
							
							document.getElementById("btnn").disabled = false;
							
							
						}
						
					
					$('#image').keyup(function() {
						var dInput = this.value;
						console.log("L",dInput); 
						
						var x = document.getElementById("myFile").value;
						
						
						
						console.log("x",x);
						
						
						
						if(dInput && x){
							
							document.getElementById("btnn").disabled = true;
							
						}else if(!dInput && !x){
							
							document.getElementById("btnn").disabled = true;
							
						}else{
							
							document.getElementById("btnn").disabled = false;
							
							
						}
						
					});
					
					document.getElementById('myFile').onchange = function () {
					
							var pInput = this.value;
						console.log("L1",pInput); 
						
						var y = document.getElementById("image").value;
						
						
						
						console.log("y",y);
						
						
						
						if(pInput && y){
							
							document.getElementById("btnn").disabled = true;
							
						}else if(!pInput && !x){
							
							document.getElementById("btnn").disabled = true;
							
						}else{
							
							document.getElementById("btnn").disabled = false;
							
							
						}
						
							
					
						};	
					
					
					
					
						
					
					
					
					});
					
					
					
				  </script>
				  
				  <script>
				  
				    //document.getElementById("btnn").disabled = true;
					
					
					
					$(document).ready(function() {
						
					
						
						var f = document.getElementById("myFile1").value;
						
						var f1 = document.getElementById("image1").value;
						
						
						
						console.log("x3",f,f1);
						
						
						
						if(f1 && f){
							
							document.getElementById("btnn1").disabled = true;
							
						}else if(!f1 && !f){
							
							document.getElementById("btnn1").disabled = false;
							
						}else{
							
							document.getElementById("btnn1").disabled = false;
							
							
						}
						
					
					
					
					
					$('#image1').keyup(function() {
						var dInput1 = this.value;
						console.log("L",dInput1); 
						
						var x2 = document.getElementById("myFile1").value;
						
						
						
						console.log("x2",x2);
						
						
						
						if(dInput1 && x2){
							
							document.getElementById("btnn1").disabled = true;
							
						}else if(!dInput1 && !x2){
							
							document.getElementById("btnn1").disabled = true;
							
						}else{
							
							document.getElementById("btnn1").disabled = false;
							
							
						}
						
					});
					
					document.getElementById('myFile1').onchange = function () {
					
							var pInput1 = this.value;
						console.log("L1",pInput1); 
						
						var y1 = document.getElementById("image1").value;
						
						
						
						console.log("y1",y1);
						
						
						
						if(pInput1 && y1){
							
							document.getElementById("btnn1").disabled = true;
							
						}else if(!pInput1 && !y1){
							
							document.getElementById("btnn1").disabled = true;
							
						}else{
							
							document.getElementById("btnn1").disabled = false;
							
							
						}
						
							
					
						};	
					
						
					
					
					
					});
					
					
					
				  </script>
				  
				  <script>
									document.getElementById('select_image1').style.display = 'none';
									function show2(){
										
										document.getElementById('image_url').style.display = 'none';
  document.getElementById('select_image1').style.display = 'block';
  
  
}

function show1(){
  document.getElementById('select_image1').style.display = 'none';
  
  document.getElementById('image_url').style.display = 'block';
}
									
									</script>
									
									 <script>
									document.getElementById('image_url1').style.display = 'none';
									function show3(){
										
										document.getElementById('image_url1').style.display = 'block';
  document.getElementById('select_image').style.display = 'none';
  
  
}

function show4(){
  document.getElementById('select_image').style.display = 'block';
  
  document.getElementById('image_url1').style.display = 'none';
}
									
									</script>
					 
					 </form>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!---->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <!---->
   </body>
</html>