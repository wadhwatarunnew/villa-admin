<?php
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Home New Slider";

	if (isset($_POST['addSlide']))
	{
		$banner_subtitle	= $_POST['banner_subtitle'];
		$banner_title 		= $_POST['banner_title'];
		$banner_description = $_POST['banner_description'];
		$button_text 		= $_POST['button_text'];
		$button_url 		= $_POST['button_url'];
		$order 				= $_POST['order'];
		$status 			= $_POST['status'];
		$imageUrl 			= $_POST['image'];	
		$myFile 			= $_FILES['myFile']['name'];

		$path 			= "uploads/pageimages/slider/";
		$path_original  = "uploads/pageimages/slider/";
      	
	    $CheckDuplicate = mysqli_query($con, "SELECT * FROM home_slider WHERE title='$banner_title'");
	    if(mysqli_num_rows($CheckDuplicate) > 0)
	    {
	        $_SESSION['BannerColor'] = "background-color:#FF0000;";
	        $_SESSION['Message'] = "Slide already exists!";
	        echo "<script>window.location.href='add-home-slider.php';</script>";
	        exit;
	    }
		
		if(!$imageUrl)
		{
			if($myFile != '' &&
				(file_exists("uploads/pageimages/".$myFile) ||
				file_exists("uploads/pageimages/addgallery/".$myFile) ||
				file_exists("uploads/pageimages/addgallery/project/".$myFile) ||
				file_exists("uploads/pageimages/addgallery/resort/".$myFile) ||
				file_exists("uploads/pageimages/blogs/".$myFile) ||
				file_exists("uploads/pageimages/blogs/single/".$myFile)  ||
				file_exists("uploads/pageimages/contact/".$myFile) ||
				file_exists("uploads/pageimages/nav/".$myFile) ||
				file_exists("uploads/pageimages/nav/category/".$myFile) ||
				file_exists("uploads/pageimages/nav/types/".$myFile) ||
				file_exists("uploads/pageimages/project/".$myFile) ||
				file_exists("uploads/pageimages/project/category/".$myFile) ||
				file_exists("uploads/pageimages/project/types/".$myFile) ||
				file_exists("uploads/pageimages/resort/".$myFile) ||
				file_exists("uploads/pageimages/resort/category/".$myFile) ||
				file_exists("uploads/pageimages/resort/types/".$myFile) ||
				file_exists("uploads/pageimages/slider/".$myFile) ||
				file_exists("uploads/pageimages/youtube/".$myFile)))
			{
				$FileExists = true;
	            $_SESSION['BannerColor'] = "background-color:#FF0000;";
	            $_SESSION['Message'] = "Selected image already exists!";
	            echo "<script>window.location.href='add-home-slider.php';</script>";
	            exit;
			}
			else
			{
				move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
				$path=$path_original.$myFile;

				mysqli_query($con, "INSERT INTO home_slider (title, subtitle, description, btn_txt, btn_url, order_number, local_path, status) values ('$banner_title', '$banner_subtitle', '$banner_description', '$button_text', '$button_url', '$order', '$path', '$status') ");
                
	            $_SESSION['BannerColor'] = "background-color:#4BB543;";
	            $_SESSION['Message'] = "Added Successfully!";
	            echo "<script>window.location.href='add-home-slider.php';</script>";
	            exit;
			}
		}
		else
		{
			mysqli_query($con, "INSERT INTO home_slider (title, subtitle, description, btn_txt, btn_url, order_number, image, status) VALUES ('$banner_title', '$banner_subtitle', '$banner_description', '$button_text', '$button_url', '$order','$imageUrl', '$status')");
                
            $_SESSION['BannerColor'] = "background-color:#4BB543;";
            $_SESSION['Message'] = "Added Successfully!";
            echo "<script>window.location.href='add-home-slider.php';</script>";
            exit;
		}
	};
?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<form action="" enctype="multipart/form-data" method="post">
					<div class="page-body">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Add Home Slider</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Home Slider</span><span class="crumb-sep">&gt;</span><span>Add New</span>
								</div>
							</div>

							<div class="listing-cta">
								<a href="home-slider.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<button type="submit" class="btn btn-success btn-sm" name="addSlide"><i class="feather icon-save"></i> Save</button>
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
											<input class="form-control banner-form-control" type="text" name="banner_subtitle" id="title" required placeholder="Enter banner sub title">
										</div>

										<div class="form-group mb-20">
											<label class="banner-form-label">Banner Title <span class="required">*</span></label>
											<input class="form-control banner-form-control" type="text" name="banner_title" id="banner_title" required placeholder="Enter banner title">
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
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-md-6 mb-20">
								<div class="card">
								    <div class="card-body">
								        <div class="form-group">
								            <label class="banner-form-label">
								                Banner Image <span class="required">*</span>
								            </label>

								            <div class="banner-image-upload">
								                <img src="uploads/pageimages/slider/Ultra-Luxury-Ganesha-Resort-Tent.jpg" class="banner-image-preview" id="banner_image_preview" alt="Banner Image">
								                <div class="banner-recommended-size">Recommended size: 1920x800px</div>
								                <div class="radio-inline-group">
								                    <label for="id_radio1">
								                        <input id="id_radio1" type="radio" name="img" value="url" onclick="show1();" checked>
								                        Image URL
								                    </label>

								                    <label for="id_radio2">
								                        <input id="id_radio2" type="radio" name="img" value="upload" onclick="show2();">
								                        Select Image
								                    </label>
								                </div>

								                <!-- Image URL -->
								                <div id="image_url" style="margin-top:12px;">
								                    <input class="form-control banner-form-control" type="url" name="image" id="image" placeholder="Enter image URL">
								                </div>

								                <!-- Image Upload -->
								                <div id="select_image" style="display:none; margin-top:12px;">
								                    <input type="file" name="myFile" id="myFile" style="display:none;" accept="image/jpeg,image/png,image/webp,image/gif">
								                    <div class="banner-upload-actions">
								                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile').click();">
								                            <i class="feather icon-upload"></i>
								                            Change Image
								                        </button>

								                        <button type="button" class="btn btn-sm btn-danger" onclick="resetImage();">
								                            Reset Image
								                        </button>
								                    </div>
								                    <div id="selected_image_name" style="margin-top:10px;"></div>
								                </div>
								            </div>
								        </div>
								    </div>
								</div>
							</div>

							<div class="col-lg-4 col-md-12 mb-20">
								<div class="card mb-20">
									<div class="card-body">
										<div class="form-group mb-20">
											<label class="banner-form-label">Status <span class="required">*</span></label>
											<select class="form-control banner-form-control" name="status" id="status">
												<option value="published" selected>Published</option>
												<option value="draft">Draft</option>
											</select>
										</div>

										<div class="form-group">
											<label class="banner-form-label">Sort Order</label>
											<input class="form-control banner-form-control" type="number" name="order" id="order" placeholder="Enter sort order" value="1" min="0">
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-body">
										<div class="banner-section-heading">Preview</div>
										<div class="banner-preview-card">
											<img src="uploads/pageimages/slider/Ultra-Luxury-Ganesha-Resort-Tent.jpg" id="preview_bg_image" alt="Preview Background">
											<div class="banner-preview-content">
												<div class="banner-preview-sub-title" id="preview_sub_title">Banner Sub Title</div>
												<div class="banner-preview-title" id="preview_title">Banner Title</div>
												<div class="banner-preview-desc" id="preview_description">Description goes here</div>
												<a href="javascript:void(0);" class="banner-preview-btn" id="preview_button">Button Text</a>
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
<!---->
<?php include_once('common/footer.php'); ?>

<script>
	function show1() {
	    document.getElementById('select_image').style.display = 'none';
	    document.getElementById('image_url').style.display = 'block';
	    document.getElementById('myFile').value = "";
	    document.getElementById('selected_image_name').innerHTML = "";
	    const url = document.getElementById('image').value;
	    if (url) {
	        updateBannerImage(url);
	    }
	}

	function show2() {
	    document.getElementById('select_image').style.display = 'block';
	    document.getElementById('image_url').style.display = 'none';
	}

	const imageInput = document.getElementById('myFile');
	imageInput.addEventListener('change', function () {
	    const file = this.files[0];

	    if (!file) {
	        return;
	    }

	    if (!file.type.startsWith('image/')) {
	        alert('Please select a valid image.');

	        this.value = "";
	        return;
	    }

	    const reader = new FileReader();
	    reader.onload = function (e) {

	        updateBannerImage(e.target.result);

	        document.getElementById('selected_image_name').innerHTML =
	            '<span style="color:green;">Selected: ' +
	            file.name +
	            '</span>';
	    };

	    reader.readAsDataURL(file);

	});

	// Image URL live preview
	document.getElementById('image').addEventListener('input', function () {
	    if (document.getElementById('id_radio1').checked) {
	        if (this.value.trim() !== "") {
	            updateBannerImage(this.value.trim());
	        }
	    }
	});

	// Update both image previews
	function updateBannerImage(imageSrc) {
	    document.getElementById('banner_image_preview').src = imageSrc;
	    document.getElementById('preview_bg_image').src = imageSrc;
	}

	// Reset image
	function resetImage() {
	    document.getElementById('myFile').value = "";
	    document.getElementById('selected_image_name').innerHTML = "";
	    document.getElementById('banner_image_preview').src =
	        "uploads/pageimages/slider/Ultra-Luxury-Ganesha-Resort-Tent.jpg";
	    document.getElementById('preview_bg_image').src =
	        "uploads/pageimages/slider/Ultra-Luxury-Ganesha-Resort-Tent.jpg";
	}


	// Live banner content preview
	document.getElementById('title').addEventListener('input', function () {
	    document.getElementById('preview_sub_title').innerText =
	        this.value || 'Banner Sub Title';
	});

	document.getElementById('banner_title').addEventListener('input', function () {
	    document.getElementById('preview_title').innerText =
	        this.value || 'Banner Title';
	});

	document.getElementById('banner_description').addEventListener('input', function () {
	    document.getElementById('preview_description').innerText =
	        this.value || 'Description goes here';
	});

	document.getElementById('button_text').addEventListener('input', function () {
	    document.getElementById('preview_button').innerText =
	        this.value || 'Button Text';
	});

	document.getElementById('button_url').addEventListener('input', function () {
	    const button = document.getElementById('preview_button');
	    button.href = this.value || 'javascript:void(0);';
	});

</script>