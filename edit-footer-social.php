<?php 
   error_reporting(0);
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Edit Social Media";

   $id = $_GET['id'];
   $quer = mysqli_query($con, "SELECT * FROM footer_follow_us WHERE id=$id");
   $q1 = mysqli_fetch_assoc($quer);

   if (isset($_POST['sub']))
   {
   	$page = "Update";	
   	$name = $_POST['name'];
   	$icon = $_POST['icon'];
   	$link = $_POST['link'];
   	
   	mysqli_query($con, "UPDATE footer_follow_us SET name='$name', icon='$icon', link='$link' WHERE id=$id");
   	
   	$_SESSION['BannerColor'] = "background-color:#4BB543;";
      $_SESSION['Message'] = "Updated Successfully!";
      echo "<script>window.location.href='edit-footer-social.php?id=$id';</script>";
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
                              <h1>Edit Social Media</h1>
                              <div class="listing-breadcrumb">
                                 <span>Home</span><span class="crumb-sep">&gt;</span><span>Social Medias</span><span class="crumb-sep">&gt;</span><span>Edit Social Media</span>
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
                                       <input type="text" class="form-control" name="name" value="<?php echo $q1['name']; ?>" placeholder="Social Media Name"/>
                                    </div>
                                 </div>

                                 <div class="col-sm-6">
                                    <div class="commonSection">
                                       <label>Icon</label>
                                       <select name="icon" class="form-control">
                                          <option value="">--Select Icon--</option>
                                          <option value="icofont-facebook" <?php echo ($q1['icon'] == 'icofont-facebook') ? 'selected' : ''; ?>>Facebook</option>
                                          <option value="icofont-instagram" <?php echo ($q1['icon'] == 'icofont-instagram') ? 'selected' : ''; ?>>Instagram</option>
                                          <option value="icofont-linkedin" <?php echo ($q1['icon'] == 'icofont-linkedin') ? 'selected' : ''; ?>>Linkedin</option>
                                          <option value="icofont-pinterest" <?php echo ($q1['icon'] == 'icofont-pinterest') ? 'selected' : ''; ?>>Pinterest</option>
                                          <option value="icofont-skype" <?php echo ($q1['icon'] == 'icofont-skype') ? 'selected' : ''; ?>>Skype</option>
                                          <option value="icofont-twitter" <?php echo ($q1['icon'] == 'icofont-twitter') ? 'selected' : ''; ?>>Twitter</option>
                                          <option value="icofont-whatsapp" <?php echo ($q1['icon'] == 'icofont-whatsapp') ? 'selected' : ''; ?>>Whatsapp</option>
                                          <option value="icofont-yahoo" <?php echo ($q1['icon'] == 'icofont-yahoo') ? 'selected' : ''; ?>>Yahoo</option>
                                          <option value="icofont-youtube" <?php echo ($q1['icon'] == 'icofont-youtube') ? 'selected' : ''; ?>>Youtube</option>
                                       </select>
                                    </div>
                                    <a href="https://icofont.com/icons" target="_blank"><b>More Icons</b></a>
                                 </div>

                                 <div class="col-sm-12">
                                    <div class="commonSection">
                                       <label>Link</label>
                                       <input type="text" class="form-control" name="link" value="<?php echo $q1['link']; ?>"placeholder="Enter Link"/>
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