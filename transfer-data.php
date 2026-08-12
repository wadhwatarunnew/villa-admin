<?php
	error_reporting(0);
	include "db.php";
	include_once('common/header.php');
	$PageTitle = "Villatent: Gallery";

	if (isset($_POST['sub']))
	{	
		$checked_arr = $_POST['check'];
		$count = count($checked_arr);

		if($count>10)
		{	
			$_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "You can only select 10 photos!";
         echo "<script>window.location.href='transfer-data.php';</script>";
         exit;
		}
		else
		{
			$types = $_POST['state22'];
			$category = $_POST['category22'];
			
			if($_POST['city22'] && $_POST['city22'] != '')
			{
				$title = $_POST['city22'];    
			}
			else
			{
				$title = $_POST['category22'];
			}

			$query40 = mysqli_query($con,"SELECT * FROM add_gallery WHERE title='$title' ");
			$counti = 1;
			$countRow = mysqli_num_rows($query40);

			if($countRow == 0)
			{	
				$page = "Update";	
				$path1= $_POST['check'][0];
				$path3=$_POST['check'][1];
				$path5=$_POST['check'][2];
				$path7=$_POST['check'][3];
				$path9=$_POST['check'][4];
				$path11=$_POST['check'][5];
				$path13=$_POST['check'][6];
				$path15=$_POST['check'][7];
				$path17=$_POST['check'][8];
				$path19=$_POST['check'][9];

				mysqli_query($con,"INSERT INTO add_gallery (types, title, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, dateTime) VALUES ('$types', '$title', '$path1', '$path3', '$path5', '$path7', '$path9', '$path11', '$path13', '$path15', '$path17', '$path19', NOW())");
				
				$_SESSION['BannerColor'] = "background-color:#4BB543;";
            $_SESSION['Message'] = "Transferred Successfully!";
            echo "<script>window.location.href='transfer-data.php';</script>";
            exit;
			}
			else
			{	
				while($ee=mysqli_fetch_assoc($query40))
				{	
					$pic1 = $ee['p1'];
					
					if(!$pic1)
					{	
						$filter1 = "none";	
					}
					else
					{						
						$filter1 = preg_replace('/\d/', '', substr(strrchr($pic1, "/"), 1) );		
					}

					$pic2 = $ee['p2'];
					if(!$pic2)
					{
						$filter2 = "none";	
					}
					else
					{	
						$filter2 = preg_replace('/\d/', '', substr(strrchr($pic2, "/"), 1) );	
					}
					
					$pic3 = $ee['p3'];
					if(!$pic3)
					{	
						$filter3 = "none";	
					}
					else
					{	
						$filter3 = preg_replace('/\d/', '', substr(strrchr($pic3, "/"), 1) );
					}

					$pic4 = $ee['p4'];
					if(!$pic4)
					{	
						$filter4 = "none";	
					}
					else
					{
						$filter4 = preg_replace('/\d/', '', substr(strrchr($pic4, "/"), 1) );	
					}
					
					$pic5 = $ee['p5'];
					if(!$pic5)
					{	
						$filter5 = "none";	
					}
					else
					{	
						$filter5 = preg_replace('/\d/', '', substr(strrchr($pic5, "/"), 1) );
					}
					
					$pic6 = $ee['p6'];
					if(!$pic6)
					{	
						$filter6 = "none";	
					}
					else
					{
						$filter6 = preg_replace('/\d/', '', substr(strrchr($pic6, "/"), 1) );
					}
					
					$pic7 = $ee['p7'];
					if(!$pic7)
					{	
						$filter7 = "none";	
					}
					else
					{	
						$filter7 = preg_replace('/\d/', '', substr(strrchr($pic7, "/"), 1) );
					}
					
					$pic8 = $ee['p8'];
					if(!$pic8)
					{	
						$filter8 = "none";	
					}
					else
					{	
						$filter8 = preg_replace('/\d/', '', substr(strrchr($pic8, "/"), 1) );
					}
					
					$pic9 = $ee['p9'];
					if(!$pic9)
					{	
						$filter9 = "none";	
					}
					else
					{
						$filter9 = preg_replace('/\d/', '', substr(strrchr($pic9, "/"), 1) );
					}
					
					$pic10 = $ee['p10'];
					if(!$pic10)
					{	
						$filter10 = "none";	
					}
					else
					{
						$filter10 = preg_replace('/\d/', '', substr(strrchr($pic10, "/"), 1) );
					}
					
					$dic = $_POST['check'][0];
					$pf = preg_replace('/\d/', '', substr(strrchr($dic, "/"), 1) );
					
					$dic1 = $_POST['check'][1];
					$pf1 = preg_replace('/\d/', '', substr(strrchr($dic1, "/"), 1) );
					
					$dic2 = $_POST['check'][2];
					$pf2 = preg_replace('/\d/', '', substr(strrchr($dic2, "/"), 1) );
					
					$dic3 = $_POST['check'][3];
					$pf3 = preg_replace('/\d/', '', substr(strrchr($dic3, "/"), 1) );
					
					$dic4 = $_POST['check'][4];
					$pf4 = preg_replace('/\d/', '', substr(strrchr($dic4, "/"), 1) );
					
					$dic5 = $_POST['check'][5];
					$pf5 = preg_replace('/\d/', '', substr(strrchr($dic5, "/"), 1) );
					
					$dic6 = $_POST['check'][6];
					$pf6 = preg_replace('/\d/', '', substr(strrchr($dic6, "/"), 1) );
					
					$dic7 = $_POST['check'][7];
					$pf7 = preg_replace('/\d/', '', substr(strrchr($dic7, "/"), 1) );
					
					$dic8 = $_POST['check'][8];
					$pf8 = preg_replace('/\d/', '', substr(strrchr($dic8, "/"), 1) );
					
					$dic9 = $_POST['check'][9];
					$pf9 = preg_replace('/\d/', '', substr(strrchr($dic9, "/"), 1) );
					
					if($pf == $filter1 || $pf == $filter2 || $pf == $filter3 || $pf == $filter4 || $pf == $filter5 || $pf == $filter6 || $pf == $filter7 || $pf == $filter8 || $pf == $filter9 || $pf == $filter10
						
						||	$pf1 == $filter1 || $pf1 == $filter2 || $pf1 == $filter3 || $pf1 == $filter4 || $pf1 == $filter5 || $pf1 == $filter6 || $pf1 == $filter7 || $pf1 == $filter8 || $pf1 == $filter9 || $pf1 == $filter10
						
						||	$pf2 == $filter1 || $pf2 == $filter2 || $pf2 == $filter3 || $pf2 == $filter4 || $pf2 == $filter5 || $pf2 == $filter6 || $pf2 == $filter7 || $pf2 == $filter8 || $pf2 == $filter9 || $pf2 == $filter10
						
						||	$pf3 == $filter1 || $pf3 == $filter2 || $pf3 == $filter3 || $pf3 == $filter4 || $pf3 == $filter5 || $pf3 == $filter6 || $pf3 == $filter7 || $pf3 == $filter8 || $pf3 == $filter9 || $pf3 == $filter10
						
						||	$pf4 == $filter1 || $pf4 == $filter2 || $pf4 == $filter3 || $pf4 == $filter4 || $pf4 == $filter5 || $pf4 == $filter6 || $pf4 == $filter7 || $pf4 == $filter8 || $pf4 == $filter9 || $pf4 == $filter10
						
						||	$pf5 == $filter1 || $pf5 == $filter2 || $pf5 == $filter3 || $pf5 == $filter4 || $pf5 == $filter5 || $pf5 == $filter6 || $pf5 == $filter7 || $pf5 == $filter8 || $pf5 == $filter9 || $pf5 == $filter10
						
						||	$pf6 == $filter1 || $pf6 == $filter2 || $pf6 == $filter3 || $pf6 == $filter4 || $pf6 == $filter5 || $pf6 == $filter6 || $pf6 == $filter7 || $pf6 == $filter8 || $pf6 == $filter9 || $pf6 == $filter10
						
						||	$pf7 == $filter1 || $pf7 == $filter2 || $pf7 == $filter3 || $pf7 == $filter4 || $pf7 == $filter5 || $pf7 == $filter6 || $pf7 == $filter7 || $pf7 == $filter8 || $pf7 == $filter9 || $pf7 == $filter10
						
						||	$pf8 == $filter1 || $pf8 == $filter2 || $pf8 == $filter3 || $pf8 == $filter4 || $pf8 == $filter5 || $pf8 == $filter6 || $pf8 == $filter7 || $pf8 == $filter8 || $pf8 == $filter9 || $pf8 == $filter10
						
						||	$pf9 == $filter1 || $pf9 == $filter2 || $pf9 == $filter3 || $pf9 == $filter4 || $pf9 == $filter5 || $pf9 == $filter6 || $pf9 == $filter7 || $pf9 == $filter8 || $pf9 == $filter9 || $pf9 == $filter10)
					{
						$_SESSION['BannerColor'] = "background-color:#FF0000;";
		            $_SESSION['Message'] = "Photo Already in Gallery.Please select again!";
		            echo "<script>window.location.href='update-gallery.php';</script>";
		            exit;
					}
					else
					{
						if($counti == $countRow)
						{	
							$page = "Update";
							$path1 = $_POST['check'][0];
							$path3 = $_POST['check'][1];
							$path5 = $_POST['check'][2];
							$path7 = $_POST['check'][3];
							$path9 = $_POST['check'][4];
							$path11 = $_POST['check'][5];
							$path13 = $_POST['check'][6];
							$path15 = $_POST['check'][7];
							$path17 = $_POST['check'][8];
							$path19 = $_POST['check'][9];

							mysqli_query($con,"INSERT INTO add_gallery (types, title, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, dateTime) VALUES ('$types', '$title', '$path1', '$path3', '$path5', '$path7', '$path9', '$path11', '$path13', '$path15', '$path17', '$path19', NOW())");
							
							$_SESSION['BannerColor'] = "background-color:#4BB543;";
			            $_SESSION['Message'] = "Transferred Successfully!";
			            echo "<script>window.location.href='transfer-data.php';</script>";
			            exit;
						}
						else
						{
							$counti++;
							continue;
						}
					}
				}
			}
		}
	}
?>

<style>
   #galcs {
      max-width: 100%;
   }
</style>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
              	<div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Transfer Gallery Photos</h1>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Gallery</span><span class="crumb-sep">&gt;</span><span>Transfer</span>
                     </div>
                 	</div>

                  <div class="listing-cta">
                     <a href="add-gallery.php" class="btn btn-outline-primary btn-sm"><i class="feather icon-plus"></i> Add</a>
                     <a href="update-gallery.php" class="btn btn-outline-secondary btn-sm"><i class="feather icon-edit"></i> Update</a>
                     <a href="delete-gallery.php" class="btn btn-outline-danger btn-sm"><i class="feather icon-trash-2"></i> Delete</a>
                  </div>
              	</div>

               <?php if (!empty($_SESSION['Message'])) {
                  echo "<div class='alert' id='mydiv' style='" . $_SESSION['BannerColor'] . "'>"
                           . "<p style='color:white;'>" . htmlspecialchars($_SESSION['Message']) . "</p>"
                           . "</div>";

                  unset($_SESSION['Message']);
                  unset($_SESSION['BannerColor']);
               } ?>
              	<div class="card mb-30">
                  <div class="card-header">Transfer Photos</div>
                  <div class="card-body">
                     <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                           <div class="col-lg-6 col-md-12">
                              <div class="commonSection">
                                 <label>Gallery Type <span class="required">*</span></label>
                                 <select name="state" class="form-control country input" required>
                                    <option value="">--Select--</option>
                                    <option value="Resort Tents">Resort Tents</option>
                                    <option value="Projects">Projects</option>
                                 </select>
                              </div>

                              <div id="categories" class="mb-20"></div>
                              <div id="response" class="mb-20"></div>
                              <div id="response1"></div>
                           </div>
                         </div>
                     </form>
                  </div>
              	</div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
	var limit = 3;
    $(document).ready(function() {
    	$('input.single-checkbox').on('change', function(evt) {
			if($(this).find('.single-checkbox:checked').length >= limit)
			{
				this.checked = false;
			}
		});

        $("select.country").change(function() {
            var selectedCountry = $(".country option:selected").val();
            $.ajax({
                type: "POST",
                url: "getSelectedCategoryTransfer.php",
                data: {
                    country: selectedCountry
                }
            }).done(function(data) {
                $("#categories").html('');
                $("#response").html('');
                $("#response1").html('');
                $("#categories").html(data);
            });
        });
    });
</script>

<?php include_once('common/footer.php'); ?>