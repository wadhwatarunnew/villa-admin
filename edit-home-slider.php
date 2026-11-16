<?php
    error_reporting(0);
    include "db.php";
    include_once "common/header.php";
    $PageTitle = "Villatent: Home New Slider";

    $id = $_GET["id"];
    $query4 = mysqli_query($con, "SELECT * FROM home_slider WHERE id=$id");
    $b = mysqli_fetch_assoc($query4);

    if (isset($_POST["update"]))
    {
        $page       = "Update";
        $banner_title       = $_POST['banner_title'];
        $banner_subtitle    = $_POST['banner_subtitle'];
        $banner_description = $_POST['banner_description'];
        $button_text        = $_POST['button_text'];
        $button_url         = $_POST['button_url'];
        $order              = $_POST['order'];
        $status             = $_POST['status'];
        $imageUrl           = $_POST["image"];
        $myFile             = $_FILES["myFile"]["name"];

        $path = "uploads/pageimages/slider/";
        $path_original = "uploads/pageimages/slider/";

        if ($_FILES['myFile']['name'] != '')
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
                echo "<script>window.location.href='edit-home-slider.php?id=$id';</script>";
                exit;
            }
            else
            {
                move_uploaded_file($_FILES["myFile"]["tmp_name"], $path . $myFile);
                $path = $path_original . $myFile;

                mysqli_query($con, "UPDATE home_slider SET title='$banner_title', subtitle='$banner_subtitle', description='$banner_description', btn_txt='$button_text', btn_url='$button_url', order_number='$order', image='', local_path='$path', status='$status' WHERE id=$id");
                
                $_SESSION['BannerColor'] = "background-color:#4BB543;";
                $_SESSION['Message'] = "Updated Successfully!";
                echo "<script>window.location.href='edit-home-slider.php?id=$id';</script>";
                exit;
            }
        }
        else
        {
            mysqli_query($con, "UPDATE home_slider SET title='$banner_title', subtitle='$banner_subtitle', description='$banner_description', btn_txt='$button_text', btn_url='$button_url', order_number='$order' ,image='$imageUrl', local_path='', status='$status' WHERE id=$id");
                
            $_SESSION['BannerColor'] = "background-color:#4BB543;";
            $_SESSION['Message'] = "Updated Successfully!";
            echo "<script>window.location.href='edit-home-slider.php?id=$id';</script>";
            exit;
        }
    }
?>

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
                                <button type="submit" class="btn btn-success btn-sm" name="update"><i class="feather icon-save"></i> Save</button>
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

                                                <div class="radio-inline-group">
                                                    <label>
                                                        <input type="radio" name="img" value="url"
                                                            onclick="showImageURL()"
                                                            <?php echo empty($b["local_path"]) ? 'checked' : ''; ?>>
                                                        Image URL
                                                    </label>

                                                    <label>
                                                        <input type="radio" name="img" value="upload"
                                                            onclick="showImageUpload()"
                                                            <?php echo !empty($b["local_path"]) ? 'checked' : ''; ?>>
                                                        Select New Image
                                                    </label>
                                                </div>

                                                <!-- Image URL -->
                                                <div id="image_url" style="display:<?php echo empty($b["local_path"]) ? 'block' : 'none'; ?>; margin-top:12px;">

                                                    <input type="text"
                                                           class="form-control"
                                                           name="image"
                                                           id="image"
                                                           value="<?php echo htmlspecialchars($b["image"] ?? '', ENT_QUOTES); ?>"
                                                           placeholder="Enter image URL">

                                                </div>

                                                <!-- Image Upload -->
                                                <div id="select_image" style="display:<?php echo !empty($b["local_path"]) ? 'block' : 'none'; ?>; margin-top:12px;">

                                                    <input type="file"
                                                           name="myFile"
                                                           id="myFile"
                                                           class="form-control"
                                                           accept="image/*">

                                                    <br>

                                                    <img
                                                        src="<?php echo !empty($b["local_path"]) ? htmlspecialchars($b["local_path"], ENT_QUOTES) : ''; ?>"
                                                        id="imgPreview"
                                                        class="img-thumbnail"
                                                        style="max-width:100%; max-height:250px; <?php echo empty($b["local_path"]) ? 'display:none;' : ''; ?>"
                                                        alt="Banner Preview">

                                                    <br><br>

                                                    <button type="button" class="btn btn-sm btn-danger" onclick="resetImage()">
                                                        Reset Image
                                                    </button>

                                                </div>
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
                                                <option value="published" <?php echo ($b["status"] == 'published') ? 'selected' : ''; ?>>Published</option>
                                                <option value="draft" <?php echo ($b["status"] == 'draft') ? 'selected' : ''; ?>>Draft</option>
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
    function showImageURL() {
        document.getElementById("image_url").style.display = "block";
        document.getElementById("select_image").style.display = "none";
    }

    function showImageUpload() {
        document.getElementById("image_url").style.display = "none";
        document.getElementById("select_image").style.display = "block";
    }

    const fileInput = document.getElementById("myFile");
    const preview = document.getElementById("imgPreview");

    fileInput.addEventListener("change", function () {

        const file = this.files[0];
        if (file) {

            if (!file.type.startsWith("image/")) {
                alert("Please select a valid image!");
                this.value = "";
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };

            reader.readAsDataURL(file);
        }
    });

    function resetImage() {
        document.getElementById("myFile").value = "";
        document.getElementById("imgPreview").src = "";
        document.getElementById("imgPreview").style.display = "none";
    }
</script>