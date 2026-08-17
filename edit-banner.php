<?php
    error_reporting(0);
    include "db.php";
    include_once "common/header.php";
    $PageTitle = "Villatent: Edit New Home Banner";

    $id = $_GET["id"];
    $query4 = mysqli_query($con, "SELECT * FROM top_banner WHERE id=$id");
    $b = mysqli_fetch_assoc($query4);
    if (isset($_POST["update"]))
    {
        $page               = "Update";
        $page_name       	= $_POST['page_name'];
        $banner_title       = mysqli_real_escape_string($con, $_POST['banner_title']);
        $banner_subtitle    = mysqli_real_escape_string($con, $_POST['banner_subtitle']);
        $banner_description = mysqli_real_escape_string($con, $_POST['banner_description']);
        $button_text        = $_POST['button_text'];
        $button_url         = $_POST['button_url'];
        $order              = $_POST['order'];
        $status             = $_POST['status'];
        $imageUrl           = $_POST["image"];
        $myFile             = $_FILES["myFile"]["name"];

        $path = "uploads/pageimages/";
        $path_original = "uploads/pageimages/";

        if (!$imageUrl)
        {
            if (
                $myFile != "" &&
                (file_exists("uploads/pageimages/" . $myFile) ||
                    file_exists("uploads/pageimages/addgallery/" . $myFile) ||
                    file_exists("uploads/pageimages/addgallery/project/" . $myFile) ||
                    file_exists("uploads/pageimages/addgallery/resort/" . $myFile) ||
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
            )
            {
                $FileExists = true;
                $_SESSION['BannerColor'] = "background-color:#FF0000;";
                $_SESSION['Message'] = "Selected image already exists!";
                echo "<script>window.location.href='edit-banner.php?id=$id';</script>";
                exit;
            }
            else
            {
                if(isset($_FILES["myFile"]["name"]) && $_FILES["myFile"]["name"] != '')
                {
                    move_uploaded_file($_FILES["myFile"]["tmp_name"], $path . $myFile);
                    $path = $path_original . $myFile;

                    mysqli_query($con, "UPDATE top_banner SET page='$page_name', title='$banner_title', subtitle='$banner_subtitle', description='$banner_description', btn_txt='$button_text', btn_url='$button_url', order_number='$order', image='', local_path='$path', status='$status' WHERE id=$id");
                }
                else
                {
                    mysqli_query($con, "UPDATE top_banner SET page='$page_name', title='$banner_title', subtitle='$banner_subtitle', description='$banner_description', btn_txt='$button_text', btn_url='$button_url', order_number='$order', status='$status' WHERE id=$id");
                }
                
                $_SESSION['BannerColor'] = "background-color:#4BB543;";
                $_SESSION['Message'] = "Updated Successfully!";
                echo "<script>window.location.href='edit-banner.php?id=$id';</script>";
                exit;
            }
        }
        else
        {
            mysqli_query($con, "UPDATE top_banner SET page='$page_name', title='$banner_title', subtitle='$banner_subtitle', description='$banner_description', btn_txt='$button_text', btn_url='$button_url', order_number='$order' ,image='$imageUrl', local_path='', status='$status' WHERE id=$id");

            $_SESSION['BannerColor'] = "background-color:#4BB543;";
            $_SESSION['Message'] = "Updated Successfully!";
            echo "<script>window.location.href='edit-banner.php?id=$id';</script>";
            exit;
        }
    }
?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<form action ="edit-banner.php?id=<?php echo $id; ?>" enctype="multipart/form-data" method="post" >
					<div class="page-body">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Edit Home Slider</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Home Slider</span><span class="crumb-sep">&gt;</span><span>Edit</span>
								</div>
							</div>

							<div class="listing-cta">
								<a href="banner-listing.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
                                <button type="submit" class="btn btn-success btn-sm" id="btnn" name="update"><i class="feather icon-save"></i> Save Banner</button>
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
        					<div class="col-lg-4 col-md-6 mb-20">
        						<div class="card">
        							<div class="card-body">
                                        <div class="form-group mb-20">
                                            <label class="banner-form-label">Select Page <span class="required">*</span></label>
                                            <select class="form-control banner-form-control" name="page_name" id="page_name">
                                                <option value="" selected>Select Page</option>
                                                <option value="Home" <?php echo ($b["page"] == 'Home') ? 'selected' : ''; ?>>Home</option>
                                                <option value="About Us" <?php echo ($b["page"] == 'About Us') ? 'selected' : ''; ?>>About Us</option>
                                                <option value="Resort Tent" <?php echo ($b["page"] == 'Resort Tent') ? 'selected' : ''; ?>>Resort Tent</option>
                                                <option value="Projects" <?php echo ($b["page"] == 'Projects') ? 'selected' : ''; ?>>Projects</option>
                                                <option value="Gallery" <?php echo ($b["page"] == 'Gallery') ? 'selected' : ''; ?>>Gallery</option>
                                                <option value="Blogs" <?php echo ($b["page"] == 'Blogs') ? 'selected' : ''; ?>>Blogs</option>
                                                <option value="Contact Us" <?php echo ($b["page"] == 'Contact Us') ? 'selected' : ''; ?>>Contact Us</option>    
                                                <option value="Brochure" <?php echo ($b["page"] == 'Brochure') ? 'selected' : ''; ?>>Brochure</option>
                                                <option value="Quote" <?php echo ($b["page"] == 'Quote') ? 'selected' : ''; ?>>Quote</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-20">
                							<label class="banner-form-label">Banner Sub Title <span class="required">*</span></label>
                							<input class="form-control banner-form-control" type="text" name="banner_subtitle" id="banner_subtitle" required placeholder="Enter banner sub title" value="<?php echo $b["subtitle"]; ?>">
                						</div>

                						<div class="form-group mb-20">
                							<label class="banner-form-label">Banner Title <span class="required">*</span></label>
                							<input class="form-control" type="text" name="banner_title" id="banner_title" required value="<?php echo $b["title"]; ?>" placeholder="Enter Image Title">
                						</div>

                						<div class="form-group mb-20">
                							<label class="banner-form-label">Description <span class="required">*</span></label>
                							<textarea class="form-control banner-form-control" name="banner_description" id="banner_description" rows="5" maxlength="150" required placeholder="Enter description"><?php echo $b["description"]; ?></textarea>
                							<div class="banner-char-counter"><span id="char_count">0</span>/150</div>
                						</div>

                						<div class="form-group mb-20">
                							<label class="banner-form-label">Button Text</label>
                							<input class="form-control banner-form-control" type="text" name="button_text" id="button_text" placeholder="Enter button text" value="<?php echo $b["btn_txt"]; ?>">
                						</div>

                						<div class="form-group">
                							<label class="banner-form-label">Button URL</label>
                							<input class="form-control banner-form-control" type="text" name="button_url" id="button_url" placeholder="Enter button URL" value="<?php echo $b["btn_url"]; ?>">
                						</div>
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
                                                     <label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();"  checked>Image URL</label>
                                                     <label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" >Select New Image</label>
                                                 	</div>
                                           		<?php } else { ?>
                                           			<div class="radio-inline-group">
                                                     	<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show3();"  >Image URL</label>
                                                     	<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show4();"  checked>Select New Image</label>
                                                 	</div>
                                           		<?php }

 							                    if (!$b["local_path"]) { ?>
                                                    <div id="image_url" style="margin-top: 12px;">
                                               		   <input class="form-control" type="text" name="image" id="image" value="<?php echo $b["image"]; ?>" placeholder="Enter url">
                                           		    </div>
                                        	       
                                                 	<img src="<?php echo $b["image"]; ?>" class="img-thumbnail" id="imgPreview" >
                                             		<div id="select_image1" style="display: none; margin-top: 12px;"> 
                                                        <div class="commonSection">
                                                            <input type="file" name="myFile" id="myFile" class="form-control"><br>
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="res1();">Reset Image</button>
                                                        </div>
                                             		</div>
                                             	<?php } else { ?>
                                             		<div id="image_url1" style="display: none; margin-top: 12px;">
                                             			<input class="form-control" type="text" name="image" id="image" value="<?php echo $b["image"]; ?>" placeholder="Enter url">
                                             		</div>

                                             		<img src="<?php echo $b["local_path"]; ?>" class="img-thumbnail" id="imgPreview">
                                             		<div id="select_image"  style="margin-top: 12px;"> 
                                                 		<div class="commonSection">
                                                 		    <input type="file" name="myFile" id="myFile" class="form-control"><br>
                                                 			<button type="button" class="btn btn-sm btn-danger" onclick="res1();">Reset Image</button>
                                                 		</div>
                                             		</div>
                                             	<?php } ?>
                                            </div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-md-6 mb-20">
								<div class="card">
									<div class="card-body">
										<div class="form-group mb-20">
                                        	<label class="banner-form-label">Status <span class="required">*</span></label>
                                        	<select class="form-control banner-form-control" name="status" id="status">
                                                <option value="Published" <?php echo ($b["status"] == 'Published') ? 'selected' : ''; ?>>Published</option>
                                                <option value="Draft" <?php echo ($b["status"] == 'Draft') ? 'selected' : ''; ?>>Draft</option>
                                        	</select>
                                    	</div>

                                    	<div class="form-group">
                                        	<label class="banner-form-label">Order No.</label>
                                        	<input class="form-control" type="text" name="order" id="order" required value="<?php echo $b["order_number"]; ?>" placeholder="Enter Order No.">
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
<!---->
<?php include_once "common/footer.php"; ?>

<script>
    // $(document).ready(function() {
    //     var x = document.getElementById("myFile").value;
    //     var x1 = document.getElementById("image").value;

    //     if(x1 && x)
    //     {
    //         document.getElementById("btnn").disabled = true;
    //     }
    //     else if(!x1 && !x)
    //     {
    //         document.getElementById("btnn").disabled = true;

    //     }
    //     else
    //     {
    //         document.getElementById("btnn").disabled = false;
    //     }


    //     $('#image').keyup(function() {
    //         var dInput = this.value;
    //         var x = document.getElementById("myFile").value;

    //         if(dInput && x)
    //         {
    //             document.getElementById("btnn").disabled = true;

    //         }
    //         else if(!dInput && !x)
    //         {
    //             document.getElementById("btnn").disabled = true;
    //         }
    //         else
    //         {
    //             document.getElementById("btnn").disabled = false;
    //         }
    //     });

    //     document.getElementById('myFile').onchange = function () {
    //         var pInput = this.value;
    //         var y = document.getElementById("image").value;

    //         if(pInput && y)
    //         {
    //             document.getElementById("btnn").disabled = true;
    //         }
    //         else if(!pInput && !x)
    //         {
    //             document.getElementById("btnn").disabled = true;
    //         }
    //         else
    //         {
    //             document.getElementById("btnn").disabled = false;
    //         }
    //     };
    // });

    // $(document).ready(function() {
    //     var f = document.getElementById("myFile1").value;
    //     var f1 = document.getElementById("image1").value;

    //     if(f1 && f)
    //     {
    //         document.getElementById("btnn1").disabled = true;
    //     }
    //     else if(!f1 && !f)
    //     {
    //         document.getElementById("btnn1").disabled = false;
    //     }
    //     else
    //     {
    //         document.getElementById("btnn1").disabled = false;
    //     }

    //     $('#image1').keyup(function() {
    //         var dInput1 = this.value;
    //         var x2 = document.getElementById("myFile1").value;

    //         if(dInput1 && x2)
    //         {
    //             document.getElementById("btnn1").disabled = true;
    //         }
    //         else if(!dInput1 && !x2)
    //         {
    //             document.getElementById("btnn1").disabled = true;
    //         }
    //         else
    //         {
    //             document.getElementById("btnn1").disabled = false;
    //         }
    //     });

    //     document.getElementById('myFile1').onchange = function () {
    //         var pInput1 = this.value;
    //         var y1 = document.getElementById("image1").value;

    //         if(pInput1 && y1)
    //         {
    //             document.getElementById("btnn1").disabled = true;
    //         }
    //         else if(!pInput1 && !y1)
    //         {
    //             document.getElementById("btnn1").disabled = true;
    //         }
    //         else
    //         {
    //             document.getElementById("btnn1").disabled = false;
    //         }
    //     };
    // });

    document.getElementById('select_image1').style.display = 'none';
    function show2()
    {
        document.getElementById('image_url').style.display = 'none';
        document.getElementById('select_image1').style.display = 'block';
    }

    function show1()
    {
        document.getElementById('select_image1').style.display = 'none';
        document.getElementById('image_url').style.display = 'block';
    }

    document.getElementById('image_url1').style.display = 'none';
    function show3()
    {
        document.getElementById('image_url1').style.display = 'block';
        document.getElementById('select_image').style.display = 'none';
    }

    function show4()
    {
        document.getElementById('select_image').style.display = 'block';
        document.getElementById('image_url1').style.display = 'none';
    }

    function res1()
    {
        document.getElementById('myFile1').value= "";
        var p1 = document.getElementById("image1").value;

        if(p1)
        {
            document.getElementById("btnn1").disabled = false;
        }
        else
        {
            document.getElementById("btnn1").disabled = true;
        }
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