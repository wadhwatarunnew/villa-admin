<?php 
   include "db.php";
   $PageTitle = "Villatent: Add Social Media";
   include_once('common/header.php');

   if (isset($_POST['sub']))
   {
   	$page = "Update";
   	$name = $_POST['name'];
   	$icon = $_POST['icon'];
   	$link = $_POST['link'];

      $CheckDuplicate = mysqli_query($con, "SELECT * FROM footer_follow_us WHERE name='$name'");
      if(mysqli_num_rows($CheckDuplicate) > 0)
      {
         $_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "Social Media already exists!";
         echo "<script>window.location.href='socialmedialist-inner.php';</script>";
         exit;
      }
   	
   	mysqli_query($con, "INSERT INTO footer_follow_us (name, icon, link) VALUES ('$name', '$icon', '$link') ");
   	
   	$_SESSION['BannerColor'] = "background-color:#4BB543;";
      $_SESSION['Message'] = "Added Successfully!";
      echo "<script>window.location.href='socialmedialist-inner.php';</script>";
      exit;
   }
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <form action ="" method="post">
               <div class="page-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="listing-page-head">
                           <div class="listing-title-wrap">
                              <h1>Add Social Media</h1>
                              <div class="listing-breadcrumb">
                                 <span>Home</span><span class="crumb-sep">&gt;</span><span>Social Medias</span><span class="crumb-sep">&gt;</span><span>Add Social Media</span>
                              </div>
                           </div>

                           <div class="listing-cta">
                              <a href="socialmedialist.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to Social Medias</a>
                              <button type="submit" class="btn btn-success btn-sm" name="sub"><i class="feather icon-save"></i> Save Social Media</button>
                           </div>
                        </div>
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
                     <div class="col-sm-12">
                        <div class="card mb-30">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <div class="commonSection">
                                       <label>Name</label>
                                       <input type="text" class="form-control" name="name" placeholder="Social Media Name"/ required>
                                    </div>
                                 </div>

                                 <div class="col-sm-6">
                                    <div class="commonSection">
                                       <label>Icon</label>
                                       <select name="icon" class="form-control" required>
                                          <option value="">--Select Icon--</option>
                                          <option value="icofont-facebook">Facebook</option>
                                          <option value="icofont-instagram">Instagram</option>
                                          <option value="icofont-linkedin">Linkedin</option>
                                          <option value="icofont-pinterest">Pinterest</option>
                                          <option value="icofont-skype">Skype</option>
                                          <option value="icofont-twitter">Twitter</option>
                                          <option value="icofont-whatsapp">Whatsapp</option>
                                          <option value="icofont-yahoo">Yahoo</option>
                                          <option value="icofont-youtube">Youtube</option>
                                       </select>
                                    </div>
                                    <a href="https://icofont.com/icons" target="_blank"><b>More Icons</b></a>
                                 </div>

                                 <div class="col-sm-12">
                                    <div class="commonSection">
                                       <label>Link</label>
                                       <input type="text" class="form-control" name="link" placeholder="Enter Link"/ required>
                                    </div>
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
<?php include_once('common/footer.php'); ?>