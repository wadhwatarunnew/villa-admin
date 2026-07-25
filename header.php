<?php

include "db.php";
$FileExists = false;
$query4= mysqli_query($con,"select * from logo");
											
$b=mysqli_fetch_assoc($query4);

if (isset($_POST['subfav'])){
	
	
	$myFiless=$_FILES['myFiless']['name'];
	

	$paths="uploads/logo/";
	$path_originals="uploads/logo/";
	if($myFiless != '' && file_exists("uploads/logo/".$myFiless))
	{
	    $FileExists = true;
	    header( "refresh:2; url=header.php" );
	}
	else
	{
    	move_uploaded_file($_FILES['myFiless']['tmp_name'],$paths.$myFiless) ;
    	$pathss=$path_originals.$myFiless;
    	include "db.php";
    	
    	mysqli_query($con,"UPDATE logo SET favicon='$pathss' ");
    	
    	header("location:header.php");
	}
};

if (isset($_POST['sub'])){
	
	
	$myFile=$_FILES['myFile']['name'];
	

	$path="uploads/logo/";
	$path_original="uploads/logo/";
	if($myFile != '' && file_exists("uploads/logo/".$myFile))
	{
	    $FileExists = true;
	    header( "refresh:2; url=header.php" );
	}
	else
	{
	    move_uploaded_file($_FILES['myFile']['tmp_name'],$path.$myFile) ;
    	$path=$path_original.$myFile;
    	include "db.php";
    	
    	mysqli_query($con,"UPDATE logo SET path='$path' ");
    	
    	header("location:header.php");
	}
	
};

if (isset($_POST['sub1'])){
	
	
	$name = $_POST['name'];
	$link = $_POST['link'];
	$name1 = $_POST['name1'];
	$link1 = $_POST['link1'];
	$name2 = $_POST['name2'];
	$link2 = $_POST['link2'];
	$name3 = $_POST['name3'];
	$link3 = $_POST['link3'];
	
	$name4 = $_POST['name4'];
	$link4 = $_POST['link4'];
	
	$name5 = $_POST['name5'];
	$link5 = $_POST['link5'];
	
	$name6 = $_POST['name6'];
	$link6 = $_POST['link6'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE header_nav SET name_one='$name',link_one='$link',name_two='$name1',link_two='$link1',name_three='$name2',link_three='$link2',name_four='$name3',link_four='$link3',name_five='$name4',link_five='$link4',name_six='$name5',link_six='$link5',name_seven='$name6',link_seven='$link6' ");
	
	header("location:header.php");
	
};

?>

      <!---->
      <?php $PageTitle = "Header"; ?>
      <?php include_once('common/header.php'); ?>
      <!--sidebar-->
      <?php include_once('common/sidebar.php'); ?>
      <!---->
      <!---->
      <div class="pcoded-content">
         <div class="pcoded-inner-content">
            <div class="main-body">
               <div class="page-wrapper">
                  <div class="page-body">
                     <div class="row">
                        <div class="col-sm-12">
                            <?php include "alert-update.php";  ?>
                           <div class="card mb-30 app-card">
                              <div class="card-header">
                                Upload Logo
                              </div>
							  <form action ="" enctype="multipart/form-data" method="post">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <div class="profileImage">
                                          <img src="<?php echo $b['path']; ?>" alt="image" title="profileImage">   
                                       </div>
                                    </div>
                                    <div class="col-sm-7 ms-auto">
                                       <div class="row">
                                          <div class="col-sm-6">
                                           <div class="profileInfo">
                                         <label>Upload Logo</label>
                                          <div id="mybutton">
                                             <input type="file" id="myFile" name="myFile" class="form-control">
                         
                                          </div>
                                       </div>
                                             
                                          </div>
                                          
                                       </div>
                                    </div>
									 
                                 </div>
								 <input type="submit" class="btn btn-success btn-lg" name="sub" value="Save">
                              </div>
							  
							  </form>
							  
                           </div>
                        </div>
                     </div>
					 
					 
					 <div class="row">
                        <div class="col-sm-12">
                           <div class="card mb-30 app-card">
                              <div class="card-header">
                                Upload Favicon
                              </div>
							  <form action ="" enctype="multipart/form-data" method="post">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <div class="profileImage">
                                          <img src="<?php echo $b['favicon']; ?>" alt="image" title="profileImage">   
                                       </div>
                                    </div>
                                    <div class="col-sm-7 ms-auto">
                                       <div class="row">
                                          <div class="col-sm-6">
                                           <div class="profileInfo">
                                         <label>Upload Logo</label>
                                          <div id="mybutton">
                                             <input type="file" id="myFiless" name="myFiless" class="form-control">
                         
                                          </div>
                                       </div>
                                             
                                          </div>
                                          
                                       </div>
                                    </div>
									 
                                 </div>
								 <input type="submit" class="btn btn-success btn-lg" name="subfav" value="Save">
                              </div>
							  
							  </form>
							  
                           </div>
                        </div>
                     </div>
					 
					 <?php
						
						include "db.php";
						
						$query18= mysqli_query($con,"select * from header_nav");
											
						$b18=mysqli_fetch_assoc($query18);
						
						?>
					 
					 <div class="row">
                        <div class="col-sm-12">
                           <div class="card mb-30 app-card">
                              <div class="card-header">
                                Header Navigation
                              </div>
							  <form action ="" method="post">
                              <div class="card-body">
                                 <div class="row">
                                    
                                    <div class="col-sm-12">
                                       <div class="commonSection">
                                         <label>Name & Links </label> 
										 Name : <input class="form-control" type="text" name="name" id="name" value="<?php echo $b18['name_one']; ?>" placeholder="Enter Quick Links"><br>
                                         Link : <input class="form-control" type="text" name="link" id="link" value="<?php echo $b18['link_one']; ?>" placeholder="Enter Quick Links"><br>
										 
										 Name : <input class="form-control" type="text" name="name1" id="name1" value="<?php echo $b18['name_two']; ?>" placeholder="Enter Quick Links"><br>
                                         link : <input class="form-control" type="text" name="link1" id="link1" value="<?php echo $b18['link_two']; ?>" placeholder="Enter Quick Links"><br>
										 
										 Name : <input class="form-control" type="text" name="name2" id="name2" value="<?php echo $b18['name_three']; ?>" placeholder="Enter Quick Links"><br>
                                         Link : <input class="form-control" type="text" name="link2" id="link2" value="<?php echo $b18['link_three']; ?>" placeholder="Enter Quick Links"><br>
										 
										 Name : <input class="form-control" type="text" name="name3" id="name3" value="<?php echo $b18['name_four']; ?>" placeholder="Enter Quick Links"><br>
                                         Link : <input class="form-control" type="text" name="link3" id="link3" value="<?php echo $b18['link_four']; ?>" placeholder="Enter Quick Links"><br>
										 
										 Name : <input class="form-control" type="text" name="name4" id="name4" value="<?php echo $b18['name_five']; ?>" placeholder="Enter Quick Links"><br>
                                         Link : <input class="form-control" type="text" name="link4" id="link4" value="<?php echo $b18['link_five']; ?>" placeholder="Enter Quick Links"><br>
										 
										 Name : <input class="form-control" type="text" name="name5" id="name5" value="<?php echo $b18['name_six']; ?>" placeholder="Enter Quick Links"><br>
                                         Link : <input class="form-control" type="text" name="link5" id="link5" value="<?php echo $b18['link_six']; ?>" placeholder="Enter Quick Links"><br>
										 
										 Name : <input class="form-control" type="text" name="name6" id="name6" value="<?php echo $b18['name_seven']; ?>" placeholder="Enter Quick Links"><br>
                                         Link : <input class="form-control" type="text" name="link6" id="link6" value="<?php echo $b18['link_seven']; ?>" placeholder="Enter Quick Links"><br>
										 
                                       </div>
                                    </div>
								
                                 </div>
								 <input type="submit" class="btn btn-success btn-lg" name="sub1" value="Save">
                              </div>
							  
							  </form>
							  
                           </div>
                        </div>
                     </div>
					 
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!---->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript">
         $(document).ready(function(){
         $(".br-menu-link11").click(function(){
         alert('sss');
         $(".br-menu-sub").toggleClass('show')
         });
         });
         
      </script> 
      <!---->
   </body>
</html>