<?php 

error_reporting(0);
$id = $_GET['id'];
include "db.php";


$quer= mysqli_query($con,"select * from footer_follow_us where id=$id");

$q1=mysqli_fetch_assoc($quer);


if (isset($_POST['sub'])){
	$page = "Update";
	
	$name = $_POST['name'];
	$icon = $_POST['icon'];
	$link = $_POST['link'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE footer_follow_us SET name='$name',icon='$icon',link='$link' where id=$id");
	
	//header("location:edit-footer-social.php?id=$id");
	header( "refresh:2; url=edit-footer-social.php?id=$id" );
};



?>

<?php $PageTitle = "Villatent: Reviews"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <form action ="" method="post">
               
               <div class="page-body">
              <div class="listing-page-head">
               <div class="listing-title-wrap">
                  <h1>Edit Social Media</h1>
                  <div class="listing-breadcrumb">
                     <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Footer</span><span class="crumb-sep">&gt;</span><span>Edit Social</span>
                  </div>
               </div>
               <div class="listing-cta">
                  <a href="socialmedialist.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
                  <input type="submit" class="btn btn-success btn-sm" name="sub" value="Save">
               </div>
              </div>

                  <div class="row">
                     <div class="col-sm-12">
                        <?php include "alert-update.php";  ?>
                        <div class="card mb-30">
                           <div class="card-header">Add Social Medias</div>
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
                                          <option value=""><?php echo $q1['icon']; ?></option>
                                          <option value="icofont-twitter">icofont-twitter</option>
                                          <option value="icofont-skype">icofont-skype</option>
                                          <option value="icofont-pinterest">icofont-pinterest</option>
                                          <option value="icofont-youtube">icofont-youtube</option>
                                          <option value="icofont-facebook">icofont-facebook</option>
                                          <option value="icofont-instagram">icofont-instagram</option>
                                          <option value="icofont-whatsapp">icofont-whatsapp</option>
                                          <option value="icofont-yahoo">icofont-yahoo</option>
                                          <option value="icofont-skype">icofont-skype</option>
                                          <option value="icofont-linkedin">icofont-linkedin</option>
                                          
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