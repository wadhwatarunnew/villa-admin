<?php 

include "db.php";
$FileExists = false;
$query2= mysqli_query($con,"select * from blog_inner_seo_meta_data");
											
$d=mysqli_fetch_assoc($query2);	

$query3= mysqli_query($con,"select * from blog_inner_content");
											
$e=mysqli_fetch_assoc($query3);	

//if (isset($_POST['update_seo'])){
	
	
	
	
	//include "db.php";
	
	//mysqli_query($con,"insert into blog_inner_content (metatitle,keyword,discription) values ('$metaTitle','$keyword','$disc') ");
	
	//header("location:blog-inner-page.php");
//};

if (isset($_POST['sub'])){
	$page = "Update";
	$metaTitle = $_POST['metaTitle'];
	$keyword = $_POST['keyword'];
	$disc = $_POST['disc'];
	
	
	$title = $_POST['title'];
	$date = $_POST['date'];
	$editor1 = $_POST['editor1'];
	
	$imageUrl = $_POST['image'];
	
	$myFile=$_FILES['myFile']['name'];
	

	$path="uploads/pageimages/blogs/single/";
	$path_original="uploads/pageimages/blogs/single/";

	
	if(!$imageUrl){
		
	    if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
    	{
    	    $FileExists = true;
    	    header( "refresh:2; url=blog-inner-page.php" );
    	}
    	else
    	{
		
        	move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
        	$path=$path_original.$myFile;
        	include "db.php";
        	
        	mysqli_query($con,"insert into blog_inner_content (metatitle,keyword,discription,title,date,content,local_path) values ('$metaTitle','$keyword','$disc','$title','$date','$editor1','$path') ");
    	
    	    //header("location:blog-inner-page.php");
    		header( "refresh:2; url=blog-inner-page.php" );
    	}
	}else{
		
		include "db.php";
	
	mysqli_query($con,"insert into blog_inner_content (metatitle,keyword,discription,title,date,content,image) values ('$metaTitle','$keyword','$disc','$title','$date','$editor1','$imageUrl') ");
	
	//header("location:blog-inner-page.php");
		header( "refresh:2; url=blog-inner-page.php" );
		
	}
	
	
};



?>

<?php $PageTitle = "Villatent: Blog Page"; ?>
<?php include_once('common/header.php'); ?>
      <div class="pcoded-content">
         <div class="pcoded-inner-content">
            <div class="main-body">
               <div class="page-wrapper">
                  <div class="page-body">
				  
				  <form action ="" enctype="multipart/form-data" method="post">
				  
                     <div class="row">
                        <div class="col-sm-12">
						<?php include "alert-insert.php" ?>
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
									<!--<input type="submit" class="btn btn-success btn-lg" name="update_seo" value="Save">-->
                                 </div>
								 
                              </div>
                           </div>
                        </div>
                     </div>
					 
					  
					 
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="card mb-30">
                              <div class="card-header">Manage Blog Content Inner</div>
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-sm-8">
                                       <div class="commonSection">
                                          <label>Title</label>
                                          <input class="form-control" type="text" required name="title" id="title" placeholder="Enter Heading">
                                       </div>
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="commonSection">
                                          <label>Date</label>
                                          <input class="form-control" type="date" required name="date" id="toptitle" placeholder="Enter Heading">
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
                                          <input id="id_radio1" type="radio" name="img" onclick="show1();"  checked="">Image URL
                                          <input id="id_radio2" type="radio" name="img" onclick="show2();"  >Select New Image
                                       </div>
                                    </div>
                                    <div class="col-sm-12" id="image_url" >
                                       <div class="commonSection">
                                          <label>Image URL</label>
                                          <input class="form-control" type="text" name="image" id="image" placeholder="Enter url">
                                       </div>
                                    </div>
                                 </div>
								 
								  
								
                              </div>
							  <div class="col-sm-12" id="select_image" style="display: none;">
                                       <div class="commonSection">
                                          <label>Select Image</label>
                                          <!--<form action="/action_page.php">-->
                                             Select files: <input type="file" name="myFile" id="myFile" class="form-control"><br>
											 
											 <button type="button" class="btn btn-sm btn-danger" onclick="rese();">Reset Image</button><br>
                                          <!--</form>-->
                                       </div>
                                    </div>
									
									 <script>
									
									function rese(){
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
                        </div>
                     </div>
 
                     <div class="row">
                        <div class="col-sm-2">
                           <div class="commonSection">
                              <input type="submit" class="btn btn-success btn-lg" id="btnn" name="sub" value="Submit">
                           </div>
                        </div>
                     </div>
                  </div>
				  
				  <script>
				  
				    document.getElementById("btnn").disabled = true;
					
					$(document).ready(function() {
						
						
					 $('#image').keyup(function() {
						var dInput = this.value;
						console.log("L",dInput); 
						
						var x = document.getElementById("myFile").value;
						
						//var y = document.getElementById("image").value;
						
						console.log("x",x);
						
						//console.log("dInput",dInput);
						
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
						
						//var y = document.getElementById("image").value;
						
						console.log("y",y);
						
						//console.log("dInput",dInput);
						
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
									
									function show2(){
  document.getElementById('select_image').style.display = 'block';
  
  document.getElementById('image_url').style.display = 'none';
}

function show1(){
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
<?php include_once('common/footer.php'); ?>