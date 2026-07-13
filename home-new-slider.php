<?php
error_reporting(0);

$message = $_GET['message'];
//include "db.php";


//$query4= mysqli_query($con,"select * from home_slider");

//$b=mysqli_fetch_assoc($query4);

if (isset($_POST['update'])){
	
	$page = "Update";
	$title = $_POST['title'];
	$order = $_POST['order'];
	$imageUrl = $_POST['image'];
	
	$myFile=$_FILES['myFile']['name'];
	

	$path="uploads/pageimages/slider/";
	$path_original="uploads/pageimages/slider/";
	
	
	if(!$imageUrl){
		if($myFile != '' && (file_exists("uploads/pageimages/".$myFile) || file_exists("uploads/pageimages/addgallery/".$myFile) || file_exists("uploads/pageimages/addgallery/project/".$myFile) || file_exists("uploads/pageimages/addgallery/resort/".$myFile) || file_exists("uploads/pageimages/blogs/".$myFile) || file_exists("uploads/pageimages/blogs/single/".$myFile)  || file_exists("uploads/pageimages/contact/".$myFile) || file_exists("uploads/pageimages/nav/".$myFile) || file_exists("uploads/pageimages/nav/category/".$myFile) || file_exists("uploads/pageimages/nav/types/".$myFile) || file_exists("uploads/pageimages/project/".$myFile) || file_exists("uploads/pageimages/project/category/".$myFile) || file_exists("uploads/pageimages/project/types/".$myFile) || file_exists("uploads/pageimages/resort/".$myFile) || file_exists("uploads/pageimages/resort/category/".$myFile) || file_exists("uploads/pageimages/resort/types/".$myFile) || file_exists("uploads/pageimages/slider/".$myFile) || file_exists("uploads/pageimages/youtube/".$myFile)))
		{
			$FileExists = true;
			header( "refresh:2; url=home-new-slider.php" );
		}
		else
		{

			move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
			$path=$path_original.$myFile;

			include "db.php";

			mysqli_query($con,"insert into home_slider (title,order_number,local_path) values ('$title','$order','$path') ");

        	//header("location:home-new-slider.php");
			header( "refresh:2; url=home-new-slider.php" );
		}
	}else{
		
		include "db.php";

		mysqli_query($con,"insert into home_slider (title,order_number,image) values ('$title','$order','$imageUrl') ");

    	//header("location:home-new-slider.php");
		header( "refresh:2; url=home-new-slider.php" ); 
		
	}
	
	
};
?>

<?php $PageTitle = "Villatent: Home New Slider"; ?>
<?php include_once('common/header.php'); ?>
<!--sidebar-->
<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<form action ="" enctype="multipart/form-data" method="post">
					<div class="page-body">

						<div class="row">
							<div class="col-sm-12">
								<?php include "alert-insert.php";  ?>
								<div class="card mb-30">
									<div class="card-header">Add New Slider&nbsp;<a href="home-slider.php"  class="btn btn-sm btn-primary">Back</a></div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-6">
												<div class="commonSection">
													<label>Image Title</label>
													<input class="form-control" type="text" name="title" id="title" required placeholder="Enter Image Title">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="commonSection">
													<label>Order No.</label>
													<input class="form-control" type="text" name="order" id="order" required placeholder="Enter Order No.">
												</div>
											</div>
                                    <!-- <div class="col-sm-6">
                                       <div class="commonSection">
                                          <label>Image Category</label>
                                          <input class="form-control" type="text" name="toptitle" id="toptitle" placeholder="Enter Image Category">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="commonSection">
                                          <label>Image Type</label>
                                          <input class="form-control" type="text" name="toptitle" id="toptitle" placeholder="Enter Heading">
                                       </div>
                                    </div> -->

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

                        <div class="row">
                        	<div class="col-sm-2">
                        		<div class="commonSection">
                        			<input type="submit" class="btn btn-success btn-lg" id="btnn" name="update" value="Submit">
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
      <!---->
      <?php include_once('common/footer.php'); ?>