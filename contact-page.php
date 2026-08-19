<?php
	error_reporting(0);
	include "db.php";
	include_once "common/header.php";
	$PageTitle = "Villatent: Contact Page";

	$query2 = mysqli_query($con, "SELECT * FROM contact_seo");
	$d = mysqli_fetch_assoc($query2);

	$query3 = mysqli_query($con, "SELECT * FROM contact_content");
	$b = mysqli_fetch_assoc($query3);

	$contactCards = [];
	$cardsQuery = mysqli_query($con, "SELECT id, title, icon, line_one, line_two, note, sort_order FROM contact_cards WHERE status = 1 ORDER BY sort_order ASC, id ASC");

	if ($cardsQuery)
	{
	    while ($cardRow = mysqli_fetch_assoc($cardsQuery))
	    {
	        $contactCards[] = $cardRow;
	    }
	}

	if (isset($_POST["update"]))
	{
	    $page = "Update";
	    $metaTitle = $_POST["metaTitle"];
	    $keyword = $_POST["keyword"];
	    $disc = $_POST["disc"];
	    $title = mysqli_real_escape_string($con, $_POST["title"]);
	    $editor1 = mysqli_real_escape_string($con, $_POST["editor1"]);
	    $imageUrl = $_POST["image"];
	    $ImagePath = $_POST['banner_image'];
	    $myFile = $_FILES["myFile"]["name"];

	    $path = "uploads/pageimages/contact/";
	    $path_original = "uploads/pageimages/contact/";

	    if ($metaTitle != "" && $keyword != "" && $disc != "")
	    {
	        mysqli_query($con, "UPDATE contact_seo SET title='$metaTitle', keyword='$keyword', discription='$disc'");
	    }

	    $contactCardsData = isset($_POST['contactCardsData']) ? trim($_POST['contactCardsData']) : '[]';
	    $contactCards = json_decode($contactCardsData, true);
	    if (!is_array($contactCards))
	    {
		    $contactCards = [];
		}

	    if (!$imageUrl)
	    {
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
	        )
	        {
	            $FileExists = true;
	            $_SESSION['BannerColor'] = "background-color:#FF0000;";
	            $_SESSION['Message'] = "Selected image already exists!";
	            echo "<script>window.location.href='contact-page.php';</script>";
	            exit;
	        }
	        else
	        {
				if(isset($_FILES['myFile']['name']) && $_FILES['myFile']['name'] != '')
				{
		            move_uploaded_file($_FILES["myFile"]["tmp_name"], $path . $myFile);
		            $ImagePath = $path_original . $myFile;
		        }

	            mysqli_query($con, "UPDATE contact_content SET title='$title', content='$editor1', image='', local_path='$ImagePath'");
	        	
	        	saveContactCards($con, $contactCards);
	    		$_SESSION['BannerColor'] = "background-color:#4BB543;";
		        $_SESSION['Message'] = "Updated Successfully!";
		        echo "<script>window.location.href='contact-page.php';</script>";
		        exit;
	        }
	    }
	    else
	    {
	        mysqli_query($con, "UPDATE contact_content SET title='$title',content='$editor1', image='$imageUrl', local_path=''");
	        
	        saveContactCards($con, $contactCards);
    		$_SESSION['BannerColor'] = "background-color:#4BB543;";
	        $_SESSION['Message'] = "Updated Successfully!";
	        echo "<script>window.location.href='contact-page.php';</script>";
	        exit;
	    }
	}

	function saveContactCards($con, $contactCards)
	{
	    $existingIds = [];
	    $existingQuery = mysqli_query($con, "SELECT id FROM contact_cards");

	    if ($existingQuery)
	    {
	        while ($row = mysqli_fetch_assoc($existingQuery)) {
	            $existingIds[] = (int)$row['id'];
	        }
	    }

	    $submittedIds = [];
	    foreach ($contactCards as $index => $card)
	    {
	        $id = isset($card['id']) ? (int)$card['id'] : 0;
	        $title = isset($card['title']) ? trim($card['title']) : '';
	        $icon = isset($card['icon']) ? trim($card['icon']) : 'call';
	        $lineOne = isset($card['line_one']) ? trim($card['line_one']) : '';
	        $lineTwo = isset($card['line_two']) ? trim($card['line_two']) : '';
	        $note = isset($card['note']) ? trim($card['note']) : '';
	        $sortOrder = $index + 1;

	        if ($title === '')
	        {
	            continue;
	        }

	        if ($icon === '')
	        {
	            $icon = 'call';
	        }

	        if ($id > 0 && in_array($id, $existingIds, true))
	        {
	            $stmt = mysqli_prepare($con, "UPDATE contact_cards SET title = ?, icon = ?, line_one = ?, line_two = ?, note = ?, sort_order = ?, status = 1 WHERE id = ? LIMIT 1");

	            mysqli_stmt_bind_param($stmt, "sssssii", $title, $icon, $lineOne, $lineTwo, $note, $sortOrder, $id);
	            mysqli_stmt_execute($stmt);
	            mysqli_stmt_close($stmt);
	            $submittedIds[] = $id;
	        }
	        else
	        {
	            $stmt = mysqli_prepare($con, "INSERT INTO contact_cards (title, icon, line_one, line_two, note, sort_order, status) VALUES (?, ?, ?, ?, ?, ?, 1)");
	            mysqli_stmt_bind_param($stmt, "sssssi", $title, $icon, $lineOne, $lineTwo, $note, $sortOrder);
	            mysqli_stmt_execute($stmt);
	            mysqli_stmt_close($stmt);
	        }
	    }

	    if (!empty($existingIds))
	    {
	        foreach ($existingIds as $existingId)
	        {
	            if (!in_array(
	                $existingId,
	                $submittedIds,
	                true
	            ))
	            {
					$stmt = mysqli_prepare($con, "DELETE FROM contact_cards WHERE id = ? LIMIT 1" );
	                mysqli_stmt_bind_param($stmt, "i", $existingId );
	                mysqli_stmt_execute($stmt);
	                mysqli_stmt_close($stmt);
	            }
	        }
	    }
	}
?>

<style type="text/css">
	.contact-cards-grid {
	    display: flex;
	    flex-wrap: wrap;
	    gap: 20px;
	    align-items: flex-start;
	}

	.contact-info-card {
	    flex: 0 0 280px;
	    width: 280px;
	    min-height: 220px;
	    padding: 20px;
	    box-sizing: border-box;
	}

	#contactCardModal .contact-card-modal-header {
	    display: flex !important;
	    align-items: center !important;
	    justify-content: space-between !important;

	    width: 100%;
	    min-height: 58px;

	    margin: 0;
	    padding: 0 22px !important;

	    background: #fff;
	    border-bottom: 1px solid #e9ecef;
	    box-sizing: border-box;
	}

	/* =========================================================
	   Contact Icon Picker
	========================================================= */

	.contact-icon-field {
	    display: flex;
	    align-items: center;
	    gap: 12px;
	}

	.contact-icon-selected {
	    width: 48px;
	    height: 40px;
	    flex: 0 0 48px;

	    display: flex;
	    align-items: center;
	    justify-content: center;

	    background: #f7f8fa;
	    border: 1px solid #dfe3e8;
	    border-radius: 6px;

	    color: #555;
	}

	.contact-icon-selected .material-icons {
	    font-size: 21px;
	}

	.contact-icon-input-wrap {
	    position: relative;
	    display: flex;
	    align-items: center;
	    gap: 8px;
	    flex: 1;
	}

	.contact-icon-input-wrap .form-control {
	    flex: 1;
	}

	.contact-icon-picker-btn {
	    height: 40px;
	    padding: 0 12px;

	    display: inline-flex;
	    align-items: center;
	    justify-content: center;
	    gap: 5px;

	    border: 1px solid #dfe3e8;
	    border-radius: 6px;

	    background: #fff;
	    color: #555;

	    font-size: 12px;
	    white-space: nowrap;

	    cursor: pointer;
	    transition: all .2s ease;
	}

	.contact-icon-picker-btn:hover {
	    border-color: #28a745;
	    color: #28a745;
	    background: #f7fff9;
	}

	.contact-icon-picker-btn .material-icons {
	    font-size: 17px;
	}


	/* Picker */

	.contact-icon-picker {
	    display: none;

	    margin-top: 10px;

	    border: 1px solid #e1e5e9;
	    border-radius: 8px;

	    background: #fff;

	    box-shadow: 0 8px 25px rgba(0,0,0,.08);

	    overflow: hidden;
	}


	/* Search */

	.contact-icon-search {
	    position: relative;
	    padding: 10px;
	    border-bottom: 1px solid #eeeeee;
	}

	.contact-icon-search > .material-icons {
	    position: absolute;
	    left: 20px;
	    top: 50%;

	    transform: translateY(-50%);

	    color: #9aa1a8;
	    font-size: 18px;
	}

	.contact-icon-search input {
	    width: 100%;
	    height: 36px;

	    padding: 7px 10px 7px 35px;

	    border: 1px solid #dfe3e8;
	    border-radius: 5px;

	    outline: none;

	    font-size: 12px;
	}

	.contact-icon-search input:focus {
	    border-color: #28a745;
	}


	/* Icon list */

	.contact-icon-list {
	    display: grid;
	    grid-template-columns: repeat(6, 1fr);

	    max-height: 220px;

	    padding: 10px;

	    overflow-y: auto;
	}


	/* Individual icon */

	.contact-icon-option {
	    height: 55px;

	    display: flex;
	    flex-direction: column;
	    align-items: center;
	    justify-content: center;

	    gap: 3px;

	    border: 1px solid transparent;
	    border-radius: 6px;

	    background: transparent;
	    color: #555;

	    cursor: pointer;

	    transition: all .15s ease;
	}

	.contact-icon-option:hover {
	    background: #f0faf3;
	    border-color: #ccebd4;
	    color: #28a745;
	}

	.contact-icon-option .material-icons {
	    font-size: 21px;
	}

	.contact-icon-option span:last-child {
	    max-width: 70px;

	    overflow: hidden;

	    text-overflow: ellipsis;
	    white-space: nowrap;

	    font-size: 9px;
	    color: #9299a0;
	}


	/* No results */

	.contact-icon-no-results {
	    grid-column: 1 / -1;

	    padding: 25px 10px;

	    text-align: center;

	    color: #999;
	    font-size: 12px;
	}


	/* Mobile */

	@media (max-width: 575px) {

	    .contact-icon-field {
	        align-items: flex-start;
	    }

	    .contact-icon-input-wrap {
	        flex-direction: column;
	        align-items: stretch;
	    }

	    .contact-icon-picker-btn {
	        width: 100%;
	    }

	    .contact-icon-list {
	        grid-template-columns: repeat(4, 1fr);
	    }

	}

	@media (max-width: 767px) {
	    .contact-info-card {
	        flex: 0 0 100%;
	        width: 100%;
	    }
	}
</style>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<form action ="" enctype="multipart/form-data" method="post" id="contactContentForm">
					<input type="hidden" name="contactCardsData" id="contactCardsData" value="">
					<div class="page-body">
						<div class="listing-page-head">
							<div class="listing-title-wrap">
								<h1>Contact Page</h1>
								<div class="listing-breadcrumb">
									<span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Pages</span><span class="crumb-sep">&gt;</span><span>Contact</span>
								</div>
							</div>

							<div class="listing-cta">
								<a href="index.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
								<input type="submit" class="btn btn-success btn-sm" id="btnn" name="update" value="Save" form="contactContentForm">
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
							<div class="col-lg-4 col-md-12">
								<div class="card mb-30">
									<div class="card-header">Seo Meta Tags</div>
									<div class="card-body">
										<form action="" method="post">
											<div class="commonSection">
												<label>Meta Title</label>
												<textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Meta Title"><?php echo $d['title']; ?></textarea>
											</div>
											<div class="commonSection">
												<label>Meta Keyword</label>
												<textarea name="keyword" id="metaKeyword" class="form-control" required placeholder="Enter Keyword"><?php echo $d['keyword']; ?></textarea>
											</div>
											<div class="commonSection">
												<label>Meta Description</label>
												<textarea name="disc" id="metaDescription" class="form-control" required placeholder="Enter Description"><?php echo $d['discription']; ?></textarea>
											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="col-lg-8 col-md-12">
								<div class="row">
									<div class="col-lg-6 col-md-12">
										<div class="card mb-30">
											<div class="card-header">Form Image <span class="required">*</span></div>
											<div class="card-body">
												<div class="banner-image-upload">
													<?php
														$middlePreviewImage = "images/default-profile.png";
														if (!empty($b['local_path'])) {
															$middlePreviewImage = $b['local_path'];
														} elseif (!empty($b['image'])) {
															$middlePreviewImage = $b['image'];
														}
													?>
													<img src="<?php echo $middlePreviewImage; ?>" class="banner-image-preview" id="imgPreview" alt="Banner Image" onerror="this.src='images/default-profile.png';">
													<div class="banner-recommended-size">Recommended size: 1920x800px</div>

													<div class="radio-inline-group" style="margin-top: 12px;">
														<label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();" <?php echo ($b['image'] != '') ? 'checked' : ''; ?>>Image URL</label>
														<label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" <?php echo ($b['local_path'] != '') ? 'checked' : ''; ?>>Select Image</label>
													</div>
													<div id="image_url" style="margin-top: 12px; display: <?php echo ($b['image'] != '') ? 'block' : 'none'; ?>;">
														<input class="form-control banner-form-control" type="text" name="image" id="image" value="<?php echo $b['image']; ?>" placeholder="Enter image URL">
													</div>
													<div id="select_image1" style="display: none; margin-top: 12px; display: <?php echo ($b['local_path'] != '') ? 'block' : 'none'; ?>">
														<input type="hidden" name="banner_image" value="<?php echo $b['local_path']; ?>">
														<input type="file" name="myFile" id="myFile" style="display: none;" accept="image/*">
														<div class="banner-upload-actions">
															<button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile').click();">
																<i class="feather icon-upload"></i> Change Image
															</button>
															<!-- <button type="button" class="btn btn-sm btn-danger" onclick="res();">Reset Image</button> -->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-md-12">
										<div class="card mb-30">
											<div class="card-header">Contact Content</div>
											<div class="card-body">
												<div class="commonSection">
													<label>Title</label>
													<input class="form-control" type="text" name="title" id="title" required value="<?php echo $b['title']; ?>" placeholder="Enter Heading">
												</div>
												<div class="commonSection">
													<label>Content</label>
													<textarea name="editor1" id="editor1" rows="10" cols="80" required><?php echo $b['content']; ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

		                <div class="card mb-30">
		                    <div class="card-header">Contact Information Cards
		                         <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#contactCardModal"><i class="feather icon-plus"></i> Add Card</button>
		                    </div>
		                    <div class="card-body">
		                        <p class="listing-info-text" style="margin-top:0; margin-bottom:12px;">These details will be shown in the contact detail section.</p>
		                        <div class="contact-cards-grid" id="contactCardsGrid">
								    <?php if (!empty($contactCards)) { ?>
									    <?php foreach ($contactCards as $card) { ?>
									        <div
									            class="contact-info-card"
									            data-card-id="<?php echo (int)$card['id']; ?>"
									            data-title="<?php echo htmlspecialchars($card['title'], ENT_QUOTES); ?>"
									            data-icon="<?php echo htmlspecialchars($card['icon'], ENT_QUOTES); ?>"
									            data-line-one="<?php echo htmlspecialchars($card['line_one'], ENT_QUOTES); ?>"
									            data-line-two="<?php echo htmlspecialchars($card['line_two'], ENT_QUOTES); ?>"
									            data-note="<?php echo htmlspecialchars($card['note'], ENT_QUOTES); ?>"
									        >
									            <div class="contact-card-actions-row">
									                <div class="contact-card-actions">
									                    <button
									                        type="button"
									                        class="btn btn-link p-0 edit-contact-card-btn"
									                        title="Edit Card"
									                    >
									                        <i class="material-icons">edit</i>
									                    </button>

									                    <button
									                        type="button"
									                        class="btn btn-link p-0 delete-contact-card-btn"
									                        title="Delete Card"
									                    >
									                        <i class="material-icons">delete</i>
									                    </button>
									                </div>
									            </div>

									            <div class="contact-card-icon-wrap">
									                <span class="material-icons card-icon-name">
									                    <?php echo htmlspecialchars($card['icon']); ?>
									                </span>
									            </div>

									            <h3 class="card-title">
									                <?php echo htmlspecialchars($card['title']); ?>
									            </h3>

									            <?php if (!empty($card['line_one'])) { ?>
									                <p class="contact-card-line">
									                    <?php echo htmlspecialchars($card['line_one']); ?>
									                </p>
									            <?php } ?>

									            <?php if (!empty($card['line_two'])) { ?>
									                <p class="contact-card-line">
									                    <?php echo htmlspecialchars($card['line_two']); ?>
									                </p>
									            <?php } ?>

									            <?php if (!empty($card['note'])) { ?>
									                <p class="contact-card-note">
									                    <?php echo nl2br(htmlspecialchars($card['note'])); ?>
									                </p>
									            <?php } ?>
									        </div>
									    <?php } ?>
									<?php } else { ?>
									    <div class="contact-cards-empty" id="contactCardsEmpty">
									        No contact information cards added yet.
									    </div>
									<?php } ?>
								</div>
		                    </div>
		                </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="contactCardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-title contact-card-modal-header">
	            <h5 id="contactCardModalTitle">
				    Add Card
				</h5>
				<input type="hidden" id="contactCardId" value="">
			</div>

            <div class="modal-body">
                <div class="commonSection">
                    <label>Card Title</label>
                    <input type="text" class="form-control" id="cardTitleInput" placeholder="CALL US">
                </div>
                <div class="commonSection">
                    <label>Icon</label>
                    <div class="contact-icon-field">
				        <div class="contact-icon-selected">
				            <span class="material-icons" id="cardIconPreview">call</span>
				        </div>

				        <div class="contact-icon-input-wrap">
				            <input type="text" class="form-control" id="cardIconInput" value="call" placeholder="Search or enter icon name..." autocomplete="off">
				            <button type="button" class="contact-icon-picker-btn" id="openContactIconPicker">
				                <i class="material-icons">apps</i>
				                Choose Icon
				            </button>
				        </div>

				    </div>

				    <div class="contact-icon-picker" id="contactIconPicker">
				        <div class="contact-icon-search">
				            <i class="material-icons">search</i>
				            <input type="text" id="contactIconSearch" placeholder="Search icons..." autocomplete="off">
				        </div>
				        <div class="contact-icon-list" id="contactIconList"></div>
				    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="commonSection">
                            <label>Line One</label>
                            <input type="text" class="form-control" id="cardLineOneInput" placeholder="+91 9813627021">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="commonSection">
                            <label>Line Two</label>
                            <input type="text" class="form-control" id="cardLineTwoInput" placeholder="+91 9817707021">
                        </div>
                    </div>
                </div>
                <div class="commonSection mb-0">
                    <label>Description / Note</label>
                    <textarea class="form-control" rows="3" id="cardNoteInput" placeholder="Mon - Sat: 9:30 AM - 6:30 PM"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="saveContactCard">Add Card</button>
            </div>
        </div>
    </div>
</div>

<?php include_once "common/footer.php"; ?>

<script>
	$(document).ready(function () {
		var contactIcons = ['call','phone','phone_in_talk','phone_callback','email','mail','location_on','location_city','place','home','business','language','public','person','people','group','support_agent','contact_support','headset_mic','chat','chat_bubble','message','schedule','access_time','calendar_month','event','directions','map','map_pin','near_me','navigation','send','alternate_email','link','web','wifi','fax','print','info','help','help_outline','warning','error','check_circle','verified','star','favorite','bookmark','notifications','campaign','forum','work','apartment','store','local_phone','local_post_office','local_shipping','local_offer','account_circle','admin_panel_settings','security','lock','key','edit','delete','add','remove','settings','more_vert','menu','arrow_forward','arrow_back','check','close','whatsapp'];

		function renderContactIcons(searchValue)
		{
		    var search = (searchValue || '').toLowerCase().trim();
		    var filteredIcons = contactIcons.filter(function (icon) {
		        return icon.toLowerCase().indexOf(search) !== -1;
		    });

		    var html = '';
		    if (!filteredIcons.length)
		    {
		        html =
		            '<div class="contact-icon-no-results">' +
		            'No icons found' +
		            '</div>';
		    }
		    else
		    {
		        filteredIcons.forEach(function (icon) {
		            html +=
		                '<button type="button" ' +
		                'class="contact-icon-option" ' +
		                'data-icon="' + icon + '">' +

		                    '<span class="material-icons">' +
		                        icon +
		                    '</span>' +

		                    '<span>' +
		                        icon +
		                    '</span>' +

		                '</button>';
		        });
		    }
		    $('#contactIconList').html(html);
		}

		$('#openContactIconPicker').on('click', function () {
		    var picker = $('#contactIconPicker');
		    if (picker.is(':visible')) {

		        picker.slideUp(150);

		    } else {
		        renderContactIcons(
		            $('#contactIconInput').val()
		        );

		        picker.slideDown(150);
		        setTimeout(function () {
		            $('#contactIconSearch').focus();
		        }, 100);
		    }
		});

		$('#contactIconSearch').on('input', function () {
		    renderContactIcons(
		        $(this).val()
		    );
		});

		$(document).on(
		    'click',
		    '.contact-icon-option',
		    function () {
		        var icon = $(this).attr('data-icon');
		        $('#cardIconInput').val(icon);
		        $('#cardIconPreview').text(icon);
		        $('#contactIconPicker').slideUp(150);
		        $('#contactIconSearch').val('');
		    }
		);

		$('#cardIconInput').on('input', function () {
		    var icon = $(this).val().trim();
		    if (!icon) {
		        icon = 'call';
		    }
		    $('#cardIconPreview').text(icon);
		});
	});

	(function() {
		var fileInput = document.getElementById('myFile');
		var filePreview = document.getElementById('imgPreview');
		if (!fileInput || !filePreview) {
			return;
		}

		fileInput.addEventListener('change', function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					filePreview.src = e.target.result;
				};
				reader.readAsDataURL(this.files[0]);
			}
		});

	})();

	CKEDITOR.editorConfig = function (config) {
		config.language = 'es';
		config.uiColor = '#F7B42C';
		config.height = 300;
		config.toolbarCanCollapse = true;
		
	};
	CKEDITOR.replace('editor1');

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

	function res()
	{
		document.getElementById('myFile').value= "";
	}

	/*
	|--------------------------------------------------------------------------
	| Contact Information Cards
	|--------------------------------------------------------------------------
	*/

	$(document).ready(function () {
	    var temporaryCardId = -1;

	    $('#cardIconInput').on('input', function () {

	        var icon = $(this).val().trim();
	        if (!icon) {
	            icon = 'call';
	        }

	        $('#cardIconPreview').text(icon);
	    });

	    function resetContactCardModal() {
	        $('#contactCardId').val('');
	        $('#cardTitleInput').val('');
	        $('#cardIconInput').val('call');
	        $('#cardIconPreview').text('call');
	        $('#cardLineOneInput').val('');
	        $('#cardLineTwoInput').val('');
	        $('#cardNoteInput').val('');
	        $('#contactCardModalTitle').text('Add Card');
	        $('#saveContactCard').text('Add Card');
	    }

	    $('[data-bs-target="#contactCardModal"]').on('click', function () {
	        resetContactCardModal();
	    });

	    function escapeHtml(value) {
	        if (value === null || value === undefined) {
	            return '';
	        }

	        return $('<div>')
	            .text(value)
	            .html();
	    }

	    function buildContactCard(card) {
	        var lineOneHtml = '';
	        var lineTwoHtml = '';
	        var noteHtml = '';

	        if (card.line_one) {
	            lineOneHtml =
	                '<p class="contact-card-line">' +
	                escapeHtml(card.line_one) +
	                '</p>';
	        }

	        if (card.line_two) {
	            lineTwoHtml =
	                '<p class="contact-card-line">' +
	                escapeHtml(card.line_two) +
	                '</p>';
	        }

	        if (card.note) {
	            var note = escapeHtml(card.note)
	                .replace(/\r?\n/g, '<br>');

	            noteHtml =
	                '<p class="contact-card-note">' +
	                note +
	                '</p>';
	        }

	        return `
	            <div
	                class="contact-info-card"
	                data-card-id="${escapeHtml(card.id)}"
	                data-title="${escapeHtml(card.title)}"
	                data-icon="${escapeHtml(card.icon)}"
	                data-line-one="${escapeHtml(card.line_one)}"
	                data-line-two="${escapeHtml(card.line_two)}"
	                data-note="${escapeHtml(card.note)}"
	            >
	                <div class="contact-card-actions-row">

	                    <div class="contact-card-actions">

	                        <button
	                            type="button"
	                            class="btn btn-link p-0 edit-contact-card-btn"
	                            title="Edit Card"
	                        >
	                            <i class="material-icons">edit</i>
	                        </button>

	                        <button
	                            type="button"
	                            class="btn btn-link p-0 delete-contact-card-btn"
	                            title="Delete Card"
	                        >
	                            <i class="material-icons">delete</i>
	                        </button>

	                    </div>

	                </div>

	                <div class="contact-card-icon-wrap">

	                    <span class="material-icons card-icon-name">
	                        ${escapeHtml(card.icon || 'call')}
	                    </span>

	                </div>

	                <h3 class="card-title">
	                    ${escapeHtml(card.title)}
	                </h3>

	                ${lineOneHtml}

	                ${lineTwoHtml}

	                ${noteHtml}

	            </div>
	        `;
	    }

	    $('#saveContactCard').on('click', function () {
	        var id = $('#contactCardId').val();
	        var title = $('#cardTitleInput').val().trim();
	        var icon = $('#cardIconInput').val().trim();
	        var lineOne = $('#cardLineOneInput').val().trim();
	        var lineTwo = $('#cardLineTwoInput').val().trim();
	        var note = $('#cardNoteInput').val().trim();

	        if (!title) {
	            alert('Please enter Card Title.');
	            $('#cardTitleInput').focus();
	            return;
	        }

	        if (!icon) {
	            icon = 'call';
	        }

	        var card = {
	            id: id ? id : temporaryCardId--,
	            title: title,
	            icon: icon,
	            line_one: lineOne,
	            line_two: lineTwo,
	            note: note
	        };

	        if (id) {
	            var existingCard = $(
	                '.contact-info-card[data-card-id="' +
	                id +
	                '"]'
	            );

	            existingCard.replaceWith(
	                buildContactCard(card)
	            );
	        }
	        else {
	            $('#contactCardsEmpty').remove();
	            $('#contactCardsGrid').append(
	                buildContactCard(card)
	            );
	        }

	        $('#contactCardModal').modal('hide');
	    });

	    $(document).on(
	        'click',
	        '.edit-contact-card-btn',
	        function () {
	            var card = $(this).closest('.contact-info-card');
	            var cardId = card.attr('data-card-id');
	            var title = card.attr('data-title') || '';
	            var icon = card.attr('data-icon') || 'call';
	            var lineOne = card.attr('data-line-one') || '';
	            var lineTwo = card.attr('data-line-two') || '';
	            var note = card.attr('data-note') || '';

	            $('#contactCardId').val(cardId);
	            $('#cardTitleInput').val(title);
	            $('#cardIconInput').val(icon);
	            $('#cardIconPreview').text(icon);
	            $('#cardLineOneInput').val(lineOne);
	            $('#cardLineTwoInput').val(lineTwo);
	            $('#cardNoteInput').val(note);

	            $('#contactCardModalTitle').text(
	                'Edit Card'
	            );

	            $('#saveContactCard').text(
	                'Update Card'
	            );

	            $('#contactCardModal').modal('show');
	        }
	    );

	    $(document).on(
	        'click',
	        '.delete-contact-card-btn',
	        function () {
	            var button = $(this);
	            var card = button.closest(
	                '.contact-info-card'
	            );

	            if (
	                !confirm(
	                    'Are you sure you want to delete this contact card?'
	                )
	            ) {
	              return;
	            }

	            card.remove();

	            if (
	                $('#contactCardsGrid .contact-info-card')
	                    .length === 0
	            ) {
	                $('#contactCardsGrid').html(
	                    '<div class="contact-cards-empty" id="contactCardsEmpty">' +
	                    'No contact information cards added yet.' +
	                    '</div>'
	                );
	            }
	        }
	    );

	    $('#contactCardModal').on(
	        'hidden.bs.modal',
	        function () {
	            resetContactCardModal();
	        }
	    );

	    $('#contactContentForm').on(
	        'submit',
	        function () {
	            var cards = [];
	            $('#contactCardsGrid .contact-info-card').each(function (index) {
                    var card = $(this);
                    cards.push({
                        id: card.attr('data-card-id'),
                        title: card.attr('data-title') || '',
                        icon: card.attr('data-icon') || 'call',
                        line_one: card.attr('data-line-one') || '',
                        line_two: card.attr('data-line-two') || '',
                        note: card.attr('data-note') || '',
                        sort_order: index + 1
                    });
                });

	            $('#contactCardsData').val(
	                JSON.stringify(cards)
	            );
	        }
	    );
	});
</script>