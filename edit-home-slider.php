<?php
error_reporting(0);
$id = $_GET["id"];
include "db.php";

$query4 = mysqli_query($con, "select * from home_slider where id=$id");

$b = mysqli_fetch_assoc($query4);

if (isset($_POST["update"])) {
    $page = "Update";
    $title = $_POST["title"];
    $order = $_POST["order"];
    $imageUrl = $_POST["image"];

    $myFile = $_FILES["myFile"]["name"];

    $path = "uploads/pageimages/slider/";
    $path_original = "uploads/pageimages/slider/";

    //echo $path;

    if (!$imageUrl) {
        if (
            $myFile != "" &&
            (file_exists("uploads/pageimages/" . $myFile) ||
                file_exists("uploads/pageimages/addgallery/" . $myFile) ||
                file_exists(
                    "uploads/pageimages/addgallery/project/" . $myFile
                ) ||
                file_exists(
                    "uploads/pageimages/addgallery/resort/" . $myFile
                ) ||
                file_exists("uploads/pageimages/blogs/" . $myFile) ||
                file_exists("uploads/pageimages/blogs/single/" . $myFile) ||
                file_exists("uploads/pageimages/contact/" . $myFile) ||
                file_exists("uploads/pageimages/nav/" . $myFile) ||
                file_exists("uploads/pageimages/nav/category/" . $myFile) ||
                file_exists("uploads/pageimages/nav/types/" . $myFile) ||
                file_exists("uploads/pageimages/project/" . $myFile) ||
                file_exists("uploads/pageimages/project/category/" . $myFile) ||
                file_exists("uploads/pageimages/project/types/" . $myFile) ||
                file_exists("uploads/pageimages/resort/" . $myFile) ||
                file_exists("uploads/pageimages/resort/category/" . $myFile) ||
                file_exists("uploads/pageimages/resort/types/" . $myFile) ||
                file_exists("uploads/pageimages/slider/" . $myFile) ||
                file_exists("uploads/pageimages/youtube/" . $myFile))
        ) {
            $FileExists = true;
            header("refresh:2; url=edit-home-slider.php?id=$id");
        } else {
            include "db.php";

            move_uploaded_file($_FILES["myFile"]["tmp_name"], $path . $myFile);
            $path = $path_original . $myFile;

            mysqli_query(
                $con,
                "update home_slider SET title='$title',order_number='$order',image='',local_path='$path' where id=$id"
            );

            //mysqli_query($con,"INSERT INTO home_slider (local_path) VALUES ('$path') where id=$id");

            //header("location:edit-home-slider.php?id=$id");
            header("refresh:2; url=edit-home-slider.php?id=$id");
        }
    } else {
        include "db.php";

        mysqli_query(
            $con,
            "update home_slider SET title='$title',order_number='$order',image='$imageUrl' where id=$id"
        );
        //header("location:edit-home-slider.php?id=$id");
        header("refresh:2; url=edit-home-slider.php?id=$id");
    }
}

if (isset($_POST["update1"])) {
    $page = "Update";
    $title1 = $_POST["title1"];
    $order1 = $_POST["order1"];
    $imageUrl1 = $_POST["image1"];

    $myFile1 = $_FILES["myFile1"]["name"];

    $path2 = "uploads/pageimages/slider/";
    $path_original2 = "uploads/pageimages/slider/";

    //echo $path;

    if (!$imageUrl1) {
        if (
            $myFile1 != "" &&
            (file_exists("uploads/pageimages/" . $myFile1) ||
                file_exists("uploads/pageimages/addgallery/" . $myFile1) ||
                file_exists(
                    "uploads/pageimages/addgallery/project/" . $myFile1
                ) ||
                file_exists(
                    "uploads/pageimages/addgallery/resort/" . $myFile1
                ) ||
                file_exists("uploads/pageimages/blogs/" . $myFile1) ||
                file_exists("uploads/pageimages/blogs/single/" . $myFile1) ||
                file_exists("uploads/pageimages/contact/" . $myFile1) ||
                file_exists("uploads/pageimages/nav/" . $myFile1) ||
                file_exists("uploads/pageimages/nav/category/" . $myFile1) ||
                file_exists("uploads/pageimages/nav/types/" . $myFile1) ||
                file_exists("uploads/pageimages/project/" . $myFile1) ||
                file_exists(
                    "uploads/pageimages/project/category/" . $myFile1
                ) ||
                file_exists("uploads/pageimages/project/types/" . $myFile1) ||
                file_exists("uploads/pageimages/resort/" . $myFile1) ||
                file_exists("uploads/pageimages/resort/category/" . $myFile1) ||
                file_exists("uploads/pageimages/resort/types/" . $myFile1) ||
                file_exists("uploads/pageimages/slider/" . $myFile1) ||
                file_exists("uploads/pageimages/youtube/" . $myFile1))
        ) {
            $FileExists = true;
            header("refresh:2; url=edit-home-slider.php?id=$id");
        } else {
            include "db.php";

            move_uploaded_file(
                $_FILES["myFile1"]["tmp_name"],
                $path2 . $myFile1
            );
            $path1 = $path_original2 . $myFile1;

            if (!$_FILES["myFile1"]["name"]) {
                mysqli_query(
                    $con,
                    "update home_slider SET title='$title1',order_number='$order1' where id=$id"
                );

                //header("location:edit-home-slider.php?id=$id");
                header("refresh:2; url=edit-home-slider.php?id=$id");
            } else {
                mysqli_query(
                    $con,
                    "update home_slider SET title='$title1',order_number='$order1',local_path='$path1' where id=$id"
                );

                //header("location:edit-home-slider.php?id=$id");
                header("refresh:2; url=edit-home-slider.php?id=$id");
            }
        }
    } else {
        include "db.php";

        mysqli_query(
            $con,
            "update home_slider SET title='$title1',order_number='$order1',image='$imageUrl1',local_path='' where id=$id"
        );

        //mysqli_query($con,"INSERT INTO home_slider (local_path) VALUES ('$path') where id=$id");

        //header("location:edit-home-slider.php?id=$id");
        header("refresh:2; url=edit-home-slider.php?id=$id");
    }
}
?>

<?php $PageTitle = "Villatent: Home New Slider"; ?>
<?php include_once "common/header.php"; ?>
<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<form action ="" enctype="multipart/form-data" method="post" >
					<div class="page-body">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Edit Home Slider</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Home Slider</span><span class="crumb-sep">&gt;</span><span>Edit</span>
								</div>
							</div>
							<div class="listing-cta">
								<a href="home-slider.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<input type="submit" class="btn btn-success btn-sm" id="btnn" name="update" value="Save Banner">
							</div>
						</div>
						<?php include "alert-update.php"; ?>
                        <div class="row">
							<div class="col-lg-4 col-md-6 mb-20">
								<div class="card">
									<div class="card-body">
<?php if (!$b["local_path"]) { ?>


                                        <div class="form-group mb-20">
											<label class="banner-form-label">Banner Sub Title <span class="required">*</span></label>
											<input class="form-control banner-form-control" type="text" name="title" id="title" required placeholder="Enter banner sub title">
										</div>
												<div class="form-group mb-20">
														<label class="banner-form-label">Banner Title <span class="required">*</span></label>
														<input class="form-control" type="text" name="title" id="title" required value="<?php echo $b[
                  "title"
              ]; ?>" placeholder="Enter Image Title">
													</div>
													<div class="form-group mb-20">
											<label class="banner-form-label">Description <span class="required">*</span></label>
											<textarea class="form-control banner-form-control" name="banner_description" id="banner_description" rows="5" maxlength="150" required placeholder="Enter description"></textarea>
											<div class="banner-char-counter"><span id="char_count">0</span>/150</div>
										</div>
										<div class="form-group mb-20">
											<label class="banner-form-label">Button Text</label>
											<input class="form-control banner-form-control" type="text" name="button_text" id="button_text" placeholder="Enter button text">
										</div>

										<div class="form-group">
											<label class="banner-form-label">Button URL</label>
											<input class="form-control banner-form-control" type="text" name="button_url" id="button_url" placeholder="Enter button URL">
										</div>
												
												<!-- <div class="col-sm-6">
													<div class="commonSection">
														<label>Order No.</label>
														<input class="form-control" type="text" name="order" id="order" required value="<?php echo $b[
                  "order_number"
              ]; ?>" placeholder="Enter Order No.">
													</div>
												</div> -->

											<?php } else { ?>

											<div class="form-group mb-20">
											<label class="banner-form-label">Banner Sub Title <span class="required">*</span></label>
											<input class="form-control banner-form-control" type="text" name="title" id="title" required placeholder="Enter banner sub title">
										</div>
												<div class="form-group mb-20">
														<label class="banner-form-label">Banner Title <span class="required">*</span></label>
														<input class="form-control" type="text" name="title1" id="title1" required value="<?php echo $b[
                  "title"
              ]; ?>" placeholder="Enter Image Title">
													
												</div>
												<div class="form-group mb-20">
											<label class="banner-form-label">Description <span class="required">*</span></label>
											<textarea class="form-control banner-form-control" name="banner_description" id="banner_description" rows="5" maxlength="150" required placeholder="Enter description"></textarea>
											<div class="banner-char-counter"><span id="char_count">0</span>/150</div>
										</div>
										<div class="form-group mb-20">
											<label class="banner-form-label">Button Text</label>
											<input class="form-control banner-form-control" type="text" name="button_text" id="button_text" placeholder="Enter button text">
										</div>

										<div class="form-group">
											<label class="banner-form-label">Button URL</label>
											<input class="form-control banner-form-control" type="text" name="button_url" id="button_url" placeholder="Enter button URL">
										</div>
												
												<!-- <div class="col-sm-6">
													<div class="commonSection">
														<label>Order No.</label>
														<input class="form-control" type="text" name="order1" id="order1" required value="<?php echo $b[
                  "order_number"
              ]; ?>" placeholder="Enter Order No.">
													</div>
												</div> -->

											<?php } ?>
									</div>
								</div>
							</div>
								<div class="col-lg-4 col-md-6 mb-20">
								<div class="card">
									<div class="card-body">
                                        <div class="form-group">
											<label class="banner-form-label">Banner Image <span class="required">*</span></label>
                                   <div class="banner-image-upload">
											<?php if (!$b["local_path"]) { ?>

                                    			<div class="radio-inline-group">
    <label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();"  checked="">Image URL</label>
    <label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" >Select New Image</label>
</div>

                                    		<?php } else { ?>

                                    			<div class="radio-inline-group">
    <label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show3();"  >Image URL</label>
    <label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show4();"  checked="">Select New Image</label>
</div>

                                    		<?php } ?>

                                                <!---->

							<?php if (!$b["local_path"]) { ?>

                                    	
                                    		<div id="image_url" style="margin-top: 12px;">
                                    		
                                    			<input class="form-control" type="text" name="image" id="image" value="<?php echo $b[
                                           "image"
                                       ]; ?>" placeholder="Enter url">
                                    		</div>
                                    	

                              </div>
									</div>

                                 
                                 	
                                 		<div id="select_image1" style="display: none; margin-top: 12px;"> 
                                 		
                                 			<img src="<?php echo $b[
                                        "local_path"
                                    ]; ?>" class="img-thumbnail" id="imgPreview" >
                                 		
                                 	</div>


                                 	
                                 		<div class="commonSection">
                                 			
                                 			<!--<form action="/action_page.php">-->
                                 				<input type="file" name="myFile" id="myFile" class="form-control"><br>
                                 				<button type="button" class="btn btn-sm btn-danger" onclick="res();">Reset Image</button>
                                 				<!--</form>-->

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

                                

                                 	<?php } else { ?>


                                 
                                 		<div id="image_url1" style="margin-top: 12px;">
                                 			
                                 			<input class="form-control" type="text" name="image1" id="image1" value="<?php echo $b[
                                        "image"
                                    ]; ?>" placeholder="Enter url">
                                 		</div>
                                 	

                                 
                                 		
                                 			<div id="select_image"  style="display: none; margin-top: 12px;"> 
                                 				
                                 				<img src="<?php echo $b[
                                         "local_path"
                                     ]; ?>" class="img-thumbnail" id="imgPreview" >
                                 		
                                 		</div>
                                 		
                                 			<div class="commonSection">
                                 			
                                 				<!--<form action="/action_page.php">-->
                                 					<input type="file" name="myFile1" id="myFile1" class="form-control"><br>
                                 					<button type="button" class="btn btn-sm btn-danger" onclick="res1();">Reset Image</button>
                                 					<!--</form>-->
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


                                 	

                                 	<?php } ?>


										   <!---->

										</div>
									</div>	
									</div
							</div>
								</div>
							</div>
								<div class="col-lg-4 col-md-6 mb-20">
								<div class="card">
									<div class="card-body">
										<?php if (!$b["local_path"]) { ?>
                                        <div class="form-group mb-20">
											<label class="banner-form-label">Status <span class="required">*</span></label>
											<select class="form-control banner-form-control" name="status" id="status">
												<option value="published" selected>Published</option>
												<option value="draft">Draft</option>
											</select>
										</div>

										<div class="form-group">
											<<label class="banner-form-label">Order No.</label>
											<input class="form-control" type="text" name="order" id="order" required value="<?php echo $b[
                  "order_number"
              ]; ?>" placeholder="Enter Order No.">
										</div>
										<?php } else { ?>

                                  <div class="form-group">
									<label class="banner-form-label">Order No.</label>
											<input class="form-control" type="text" name="order1" id="order1" required value="<?php echo $b[
                  "order_number"
              ]; ?>" placeholder="Enter Order No.">
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>









                           <?php if (!$b["local_path"]) { ?>			


                           	<div class="row">
                           		<div class="col-sm-2">
                           			<div class="commonSection">
                           				<input type="submit" class="btn btn-success btn-lg"  id="btnn" name="update" value="Save">
                           			</div>
                           		</div>
                           	</div>

                           <?php } else { ?>

                           	<div class="row">
                           		<div class="col-sm-2">
                           			<div class="commonSection">
                           				<input type="submit" class="btn btn-success btn-lg"  id="btnn1" name="update1" value="Save">
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
<!---->
<?php include_once "common/footer.php"; ?>
