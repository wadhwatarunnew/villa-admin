<?php
    include "db.php";
    session_start();

    $query2= mysqli_query($con,"select * from profile_info");
    $d=mysqli_fetch_assoc($query2);	

    $query222= mysqli_query($con,"select * from login");
    $d2=mysqli_fetch_assoc($query222);

    if (isset($_FILES) && !empty($_FILES))
    {
        $path = "uploads/profile/";
        $path_original = "uploads/profile/".$_FILES['file']['name'];   
        $response = array();

        if(move_uploaded_file($_FILES['file']['tmp_name'], $path_original))
        {
            if($d['image'] != '')
            {
                unlink($path.$d['image']);
            }

            mysqli_query($con,"UPDATE profile_info SET image='".$_FILES['file']['name']."' where id=".$d['id']);
            $d['image'] = $_FILES['file']['name'];

            $response['status'] = true;
            $response['message'] =  "Image uploaded successfully."; 
            $response['image'] =  $path_original; 
        }
        else
        {

           $response['status'] = false;
           $response['message'] =  "Sorry, image not uploaded, please try again!"; 
           $response['image'] =  ""; 

        } 
        echo json_encode($response); die;
    }

    if (isset($_POST['upuser']))
    {        	
    	$username = $_POST['username'];
    	mysqli_query($con,"UPDATE login SET user='$username' ");
    	header("location:index.php");
    };	

    if (isset($_POST['update']))
    {
    	$fname = $_POST['fname'];
    	$lname = $_POST['lname'];
    	$dob = $_POST['dob'];
    	$email = $_POST['email'];

    	mysqli_query($con,"UPDATE profile_info SET fname='$fname',lname='$lname',dob='$dob',email='$email' ");
    	header("location:index.php");
    };

    if (isset($_POST['update1']))
    {
        $opwd = $_POST['opwd'];
        $npwd = $_POST['npwd'];
        $cpwd = $_POST['cpwd'];

        $qu = mysqli_query($con,"SELECT * FROM login");
        $h = mysqli_fetch_assoc($qu);
        if($h['password'] && password_verify($opwd, $h['password']))
        {
           $hashed_password = password_hash($cpwd, PASSWORD_BCRYPT);
           mysqli_query($con,"UPDATE login SET password='$hashed_password'");
           header("location:index.php");
       }
       else
       { ?>
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
                        <div class="col-sm-12">
                            <div class="card mb-30">
                                <div class="card-header">
                                    Profile Information 
                                    <div class="editIcon"><i class="fa fa-pencil"></i></div>
                                </div>

                                <div class="card-body">
                                    <form action ="" method="post">
                                        <div class="col-sm-12"> <div id='message'></div></div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="profileImage">
                                                        <img src="<?php echo ($d['image'] != '') ? "uploads/profile/".$d['image'] : 'images/profileimage.jpg'; ?>" alt="image" title="profileImage"  id="profileImage">   
                                                    </div>

                                                    <div class="profileDesc">
                                                        <h2><b>User Name:</b> <span><?php echo $d['fname'].' '.$d['lname']; ?></span></h2>
                                                        <p><b>Last Logged in:</b> <span><?php echo $_SESSION['lastlogin']; ?></span></p>
                                                        <div id="mybutton">
                                                            <input type="file" id="myfile" name="upload">
                                                            <a href="#">Change Photo</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-7 ms-auto">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="profileForm">
                                                                <label>First Name</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="fname" value="<?php echo $d['fname']; ?>" placeholder="First Name">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="profileForm">
                                                                <label>Last Name</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-user" aria-hidden="true"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="lname" value="<?php echo $d['lname']; ?>" placeholder="Last Name">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="profileForm">
                                                                <label>Date of Birth </label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon3"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                                    </div>
                                                                    <input type="date" class="form-control" name="dob" value="<?php echo $d['dob']; ?>" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="profileForm">
                                                                <label>Email</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="email" value="<?php echo $d['email']; ?>" placeholder="abc@gmail.com">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="machineForm rgt">
                                                                <input type="submit" class="btn btn-success btn-lg" name="update" value="SAVE">
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

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card mb-30">
                                <div class="card-header">
                                    Change UserName:
                                </div>

                                <form action ="" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                           <div class="col-sm-7">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p><u>Current Username</u> : <b><?php echo $d2['user']; ?></b></p>
                                                        <div class="profileForm">
                                                            <label>Enter Username:</label>
                                                            <input type="text" class="form-control" name="username" required placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="profileForm rgt">
                                                    <input type="submit" class="btn btn-success btn-lg" name="upuser" value="UPDATE">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card mb-30">
                                <div class="card-header">
                                    Change Password
                                </div>

                                <form action ="" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="thumbImage">
                                                    <img src="images/lockimage.png" alt="image" title="lock">	  
                                                </div>
                                            </div>

                                            <div class="col-sm-7">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="profileForm">
                                                            <label>Old Password</label>
                                                            <input type="text" class="form-control" name="opwd" placeholder="Old Password">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="profileForm">
                                                            <label>New Password</label>
                                                            <input type="text" class="form-control" id="start" name="npwd" placeholder="New Password">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="profileForm">
                                                            <label>Confirm Password</label>
                                                            <input type="text" class="form-control" id="end" name="cpwd" placeholder="Confirm Password">
                                                        </div>
                                                        <div id="d" class="profileForm" style="color:red">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="profileForm rgt">
                                                            <input type="submit" id="Button" class="btn btn-success btn-lg" name="update1" value="UPDATE">
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
            </div>
        </div>
    </div>
</div>
<!---->
<?php include_once('common/footer.php'); ?>

<script>
//$(document).ready(function(){
    document.getElementById("Button").disabled = true;
    $("#end").keyup(function() {
        var v = $("#start").val();
        var e = $("#end").val();

        if (v == e)
        {
            document.getElementById('d').innerHTML = "Match Password";
            document.getElementById("d").style.color = "green";
            document.getElementById("Button").disabled = false;
        }
        else
        {
            document.getElementById('d').innerHTML = "Not Match";
            //document.getElementById('d').innerHTML = "Not Match";
        }
    });
//});              
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".br-menu-link11").click(function() {
            alert('sss');
            $(".br-menu-sub").toggleClass('show')
        });

       $('#myfile').change(function() {
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