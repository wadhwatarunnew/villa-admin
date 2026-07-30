<?php


if (isset($_POST['update'])){
	
	$page = "Update";
	$title = $_POST['title'];
	$url = $_POST['url'];
	$imageUrl = $_POST['image'];
	
	$myFile=$_FILES['myFile']['name'];
	

	$path="uploads/pageimages/youtube/";
	$path_original="uploads/pageimages/youtube/";

	
	if(!$imageUrl){
		
		if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
		{
			$FileExists = true;
			header( "refresh:2; url=youtube-inner-page.php" );
		}
		else
		{
			
			move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
			$path=$path_original.$myFile;
			include "db.php";
			
			mysqli_query($con,"insert into youtube_video (title,youtube_url,local_path) values ('$title','$url','$path') ");
			
        	//header("location:youtube-inner-page.php");
			header( "refresh:2; url=youtube-inner-page.php" ); 
		}
	}else{
		
		include "db.php";
		
		mysqli_query($con,"insert into youtube_video (title,youtube_url,image) values ('$title','$url','$imageUrl') ");
		
    	//header("location:youtube-inner-page.php");
		header( "refresh:2; url=youtube-inner-page.php" ); 
		
	}
	
	
};


?>

<?php $PageTitle = "Villatent: Youtube Inner Page"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				
				<form action ="" enctype="multipart/form-data" method="post">
					
					<div class="page-body">
						
						<div class="row">
							<div class="col-sm-12">
								<?php include "alert-insert.php"; ?>
								<div class="listing-page-head">
									<div class="listing-title-wrap">
										<h1>Add Video</h1>
										<div class="listing-breadcrumb">
											<span>Home</span><span class="crumb-sep">&gt;</span><span>Videos</span><span class="crumb-sep">&gt;</span><span>Add Video</span>
										</div>
									</div>
									<div class="listing-cta">
										<a href="youtube-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to Videos</a>
										<input type="submit" class="btn btn-success btn-sm" name="update" id="btnn" value="Save Video">
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="card mb-30">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="commonSection">
													<label>Video Title</label>
													<input class="form-control" type="text" name="title" required id="title" placeholder="Enter Heading">
												</div>
											</div>
											<div class="col-sm-12">
												<div class="commonSection">
													<label>YouTube URL</label>
													<input class="form-control" type="text" name="url" required id="url" placeholder="Enter Heading">
												</div>
											</div>
											
											<div class="col-sm-12">
												<div class="commonSection">
													<label>Image Type</label>
													<div class="radio-inline-group">
    <label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();"  checked="">Image URL</label>
    <label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();"  >Select New Image</label>
</div>
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
												<input type="file" name="myFile" id="myFile" class="form-control"><br>
												<button type="button" class="btn btn-sm btn-danger" onclick="rese();">Reset Image</button>
												<br>
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
			</div>
			
			<script>
				
				$(document).ready(function() {
					
					document.getElementById("btnn").disabled = true;
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
	<?php include_once('common/footer.php'); ?>