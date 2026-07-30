<?php

include "db.php";
$FileExists = false;
$query2= mysqli_query($con,"select * from resort_seo");

$d=mysqli_fetch_assoc($query2);	

$query= mysqli_query($con,"select * from resort_content");

$e=mysqli_fetch_assoc($query);	


if (isset($_POST['update_seo'])){
	
	$page = "Update";
	$metaTitle = $_POST['metaTitle'];
	$keyword = $_POST['keyword'];
	$disc = $_POST['disc'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE resort_seo SET title='$metaTitle',keyword='$keyword',discription='$disc' ");
	
	//header("location:add-project.php");
	header( "refresh:2; url=add-project.php" );
};

if (isset($_POST['update'])){
	
	$page = "Update";
	$title = $_POST['title'];
	$editor1 = $_POST['editor1'];
	$imageUrl = $_POST['image'];
	
	$myFile=$_FILES['myFile']['name'];
	

	$path="uploads/pageimages/resort/";
	$path_original="uploads/pageimages/resort/";
	
	
	
	//echo $path;
	
	if(!$imageUrl){
		if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
		{
			$FileExists = true;
			header( "refresh:2; url=add-project.php" );
		}
		else
		{
			move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
			$path=$path_original.$myFile;
			include "db.php";

			mysqli_query($con,"update resort_content SET title='$title',content='$editor1',image='',local_path='$path'");

        	//mysqli_query($con,"INSERT INTO home_slider (local_path) VALUES ('$path') where id=$id");

        	//header("location:add-project.php");
			header( "refresh:2; url=add-project.php" );
		}

	}else{
		
		
		include "db.php";

		mysqli_query($con,"update resort_content SET title='$title',content='$editor1',image='$imageUrl' ");
    	//header("location:add-project.php");
		header( "refresh:2; url=add-project.php" );

		
	};
	
	

};

if (isset($_POST['update1'])){
	
	$page = "Update";
	$title1 = $_POST['title1'];
	$editor2 = $_POST['editor2'];
	$imageUrl1 = $_POST['image1'];
	
	$myFile1=$_FILES['myFile1']['name'];
	

	$path2="uploads/pageimages/resort/";
	$path_original2="uploads/pageimages/resort/";

	
	
	//echo $path;
	
	if(!$imageUrl1){

		if($myFile1 != '' && (file_exists("uploads/pageimages/".$myFile1) || file_exists("uploads/pageimages/addgallery/".$myFile1) || file_exists("uploads/pageimages/addgallery/project/".$myFile1) || file_exists("uploads/pageimages/addgallery/resort/".$myFile1) || file_exists("uploads/pageimages/blogs/".$myFile1) || file_exists("uploads/pageimages/blogs/single/".$myFile1)  || file_exists("uploads/pageimages/contact/".$myFile1) || file_exists("uploads/pageimages/nav/".$myFile1) || file_exists("uploads/pageimages/nav/category/".$myFile1) || file_exists("uploads/pageimages/nav/types/".$myFile1) || file_exists("uploads/pageimages/project/".$myFile1) || file_exists("uploads/pageimages/project/category/".$myFile1) || file_exists("uploads/pageimages/project/types/".$myFile1) || file_exists("uploads/pageimages/resort/".$myFile1) || file_exists("uploads/pageimages/resort/category/".$myFile1) || file_exists("uploads/pageimages/resort/types/".$myFile1) || file_exists("uploads/pageimages/slider/".$myFile1) || file_exists("uploads/pageimages/youtube/".$myFile1)))
		{
			$FileExists = true;
			header( "refresh:2; url=add-project.php" );
		}
		else
		{
			include "db.php";

			move_uploaded_file($_FILES['myFile1']['tmp_name'],$path2.$myFile1) ;
			$path1=$path_original2.$myFile1;

			if(!$_FILES['myFile1']['name']){

				mysqli_query($con,"update resort_content SET title='$title1',content='$editor2' ");

        		//header("location:add-project.php");
				header( "refresh:2; url=add-project.php" );
			}else{

				mysqli_query($con,"update resort_content SET title='$title1',content='$editor2',local_path='$path1' ");

        	//header("location:add-project.php");
				header( "refresh:2; url=add-project.php" );

			}
		}

	}else{
		
		
		include "db.php";

		mysqli_query($con,"update resort_content SET title='$title1',content='$editor2',image='$imageUrl1',local_path='' ");

    	//mysqli_query($con,"INSERT INTO home_slider (local_path) VALUES ('$path') where id=$id");

    	//header("location:add-project.php");
		header( "refresh:2; url=add-project.php" );
	};
	
	
};

?>

<?php $PageTitle = "Villatent: Resorts"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">

					<form action ="" method="post">

						<div class="row">
							<div class="col-sm-12">
								<?php include "alert-update.php" ?>
								<div class="card mb-30">
									<div class="card-header">Seo Meta Tags</div>
									<div class="card-body">
										<form action ="" method="post">
											<div class="row">
												<div class="col-sm-4">
													<div class="commonSection">
														<label>Meta Title</label>
														<textarea name="metaTitle" id="metaTitle" class="form-control"  placeholder="Enter Meta Title"><?php echo $d['title']; ?></textarea>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="commonSection">
														<label>Meta Keyword</label>
														<textarea name="keyword" id="metaKeyword" class="form-control"  placeholder="Enter Meta Keyword"><?php echo $d['keyword']; ?></textarea>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="commonSection">
														<label>Meta Description</label>
														<textarea name="disc" id="metaDescription" class="form-control"  placeholder="Enter Meta Description"><?php echo $d['discription']; ?></textarea>
													</div>
												</div>
												 <div class="col-sm-12">
												<input type="submit" class="btn btn-success btn-lg" name="update_seo" value="Save">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>


						<form action ="" enctype="multipart/form-data" method="post" >

							<div class="row">
								<div class="col-sm-12">
									<div class="card">
										<div class="card-header">Manage About Page</div>
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
															<textarea name="editor1" id="editor1"  rows="10" cols="80" required><?php echo $e['content']; ?></textarea>
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
															<textarea name="editor2" id="editor2"  rows="10" cols="80" required><?php echo $e['content']; ?></textarea>
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

																<div class="radio-inline-group">
    <label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();"  checked="">Image URL</label>
    <label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" >Select New Image</label>
</div>

															<?php  }else{  ?>

																<div class="radio-inline-group">
    <label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show3();"  >Image URL</label>
    <label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show4();"  checked="">Select New Image</label>
</div>

															<?php  }  ?>


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

												<div class="row" id="select_image1">
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
																<input type="file" name="myFile" id="myFile" class="form-control"><br>
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

													<div class="row" id="select_image">
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
																	<input type="file" name="myFile1" id="myFile1" class="form-control"><br>
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

									</div>

									<?php
									if(!$e['local_path']){
										?>			


										<div class="row">
											<div class="col-sm-12 mt-3">
												
													<input type="submit" class="btn btn-success btn-lg"  id="btnn" name="update" value="Save">
											
											</div>
										</div>

									<?php  }else{ ?>

										<div class="row">
											<div class="col-sm-12 mt-3">
											
													<input type="submit" class="btn btn-success btn-lg"  id="btnn1" name="update1" value="Save">
											
											</div>
										</div>

									<?php } ?>






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
				<?php include_once('common/footer.php'); ?>