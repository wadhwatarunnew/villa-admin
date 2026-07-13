
<?php	 

include "db.php";
session_start();

$query2= mysqli_query($con,"select * from profile_info");

$d=mysqli_fetch_assoc($query2);	

$query222= mysqli_query($con,"select * from login");

$d2=mysqli_fetch_assoc($query222);

if (isset($_FILES) && !empty($_FILES)) {
  $path = "uploads/profile/";

  $path_original = "uploads/profile/".$_FILES['file']['name'];   

  $response = array();

  if(move_uploaded_file($_FILES['file']['tmp_name'], $path_original)) {

    if($d['image'] != '') {
      unlink($path.$d['image']);
   }

   mysqli_query($con,"UPDATE profile_info SET image='".$_FILES['file']['name']."' where id=".$d['id']);
   $d['image'] = $_FILES['file']['name'];

   $response['status'] = true;
   $response['message'] =  "Image uploaded successfully."; 
   $response['image'] =  $path_original; 

} else{  

 $response['status'] = false;
 $response['message'] =  "Sorry, image not uploaded, please try again!"; 
 $response['image'] =  ""; 

} 

echo json_encode($response); die;
}

if (isset($_POST['upuser'])){
	
	
	$username = $_POST['username'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE login SET user='$username' ");
	
	header("location:index.php");
};	

if (isset($_POST['update'])){
	
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$dob = $_POST['dob'];
	$email = $_POST['email'];
	
	include "db.php";
	
	mysqli_query($con,"UPDATE profile_info SET fname='$fname',lname='$lname',dob='$dob',email='$email' ");
	
	header("location:index.php");
};

if (isset($_POST['update1'])){
	
	
	$opwd = $_POST['opwd'];
	$npwd = $_POST['npwd'];
	$cpwd = $_POST['cpwd'];
	
	include "db.php";
	
	$qu= mysqli_query($con,"select * from login");

	$h=mysqli_fetch_assoc($qu);
	
	if($opwd==$h['password']){

     mysqli_query($con,"UPDATE login SET password='$cpwd' ");

     header("location:index.php");

  }else{ ?>

     <script>

        alert("Wrong Old Password");
     </script>


     <?php	

  }
};

?>

<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="row">
                 <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
                      <div class="card card-raised widget-flat text-primary">
                                        <div class="card-body">
                                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Ultra Luxury Resort Tent</h5>
                                            <h3 class="mt-3 mb-3">36,254</h3>
                                            
                                        </div> 
                                    </div> 
                                </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
                   <div class="card card-raised widget-flat text-success">
                                        <div class="card-body">
                                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Luxury Resort Tent</h5>
                                            <h3 class="mt-3 mb-3">36,254</h3>
                                            
                                        </div> 
                                    </div> 
                                </div>
                                 <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
                      <div class="card card-raised widget-flat text-info">
                                        <div class="card-body">
                                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Indian Resort Tent</h5>
                                            <h3 class="mt-3 mb-3">36,254</h3>
                                            
                                        </div> 
                                    </div> 
                                </div>
                                 <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
                    <div class="card card-raised widget-flat text-warning">
                                        <div class="card-body">
                                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Camping Tents</h5>
                                            <h3 class="mt-3 mb-3">36,254</h3>
                                            
                                        </div> 
                                    </div> 
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                     <div class="card card-raised widget-flat text-muted">
                                        <div class="card-body">
                                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Projects</h5>
                                            <h3 class="mt-3 mb-3">36,254</h3>
                                            
                                        </div> 
                                    </div> 
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                      <div class="card card-raised widget-flat text-secondary">
                                        <div class="card-body">
                                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">International Projects</h5>
                                            <h3 class="mt-3 mb-3">36,254</h3>
                                            
                                        </div> 
                                    </div> 
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                     <div class="card card-raised widget-flat text-dark">
                                        <div class="card-body">
                                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">National Projects</h5>
                                            <h3 class="mt-3 mb-3">36,254</h3>
                                            
                                        </div> 
                                    </div> 
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card card-raised widget-flat text-info">
                                        <div class="card-body">
                                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Blogs</h5>
                                            <h3 class="mt-3 mb-3">36,254</h3>
                                            
                                        </div> 
                                    </div> 
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="card card-raised widget-flat text-info">
                                        <div class="card-body">
                                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Youtube Videos</h5>
                                            <h3 class="mt-3 mb-3">36,254</h3>
                                            
                                        </div> 
                                    </div> 
                                </div>
                 
                 
               </div>

               
            </div>
         </div>
      </div>
   </div>
</div>
<!---->
<?php include_once('common/footer.php'); ?>
<script type="text/javascript">
   $(document).ready(function(){
     $(".br-menu-link11").click(function(){
        alert('sss');
        $(".br-menu-sub").toggleClass('show')
     });

     $('#myfile').change(function(){
        var file_data = $('#myfile').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        $.ajax({
          url: "index.php",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
            var result = JSON.parse(data);
            var $messageDiv = $('#message')
            $messageDiv.hide().html(result.message);
            if(result.status) {
              $("#profileImage").attr("src",result.image);
              $messageDiv.show();
              $messageDiv.addClass('alert alert-success').fadeIn(1500);
           } else {
              $messageDiv.show();
              $messageDiv.addClass('alert alert-danger').fadeIn(1500);
           }
           setTimeout(function(){
              $messageDiv.fadeOut(1500);
           }, 3000);
        }
     });
     });
  });

</script>