<?php
   session_start();
   include "db.php";
   date_default_timezone_set('Asia/Kolkata');

   if(isset($_POST['sub']))
   {
      $e = $_REQUEST['user'];
      $p = $_REQUEST['pass'];

      if(!empty($_POST["remember"]))
      {
         setcookie ("username",$e,time()+ 3600);
         setcookie ("password",$p,time()+ 3600);
      }
      else
      {
         setcookie("username","");
         setcookie("password","");
         //echo "Cookies Not Set";
      }
      
      $qu = mysqli_query($con,"SELECT * FROM login WHERE user='$e'");
      if(mysqli_num_rows($qu))
      {
         $h = mysqli_fetch_assoc($qu);
         if($h['password'] && password_verify($p, $h['password']))
         {
            $_SESSION['u']= $e ;
            $_SESSION['loggedin'] = true;

            $query2= mysqli_query($con,"select * from profile_info");
            $d=mysqli_fetch_assoc($query2);

            $CurrentDate = date('Y-m-d H:i:s');
            $Datetime1 = new DateTime($d['lastlogin']);
            $Datetime2 = new DateTime($CurrentDate);
            $Difference = $Datetime1->diff($Datetime2);
            $LoginBefore = '';

            $Days = ($Difference->d > 0) ? $Difference->d.' '.(($Difference->d > 1) ? 'Days ' : 'Day ') : '';
            $Hours = ($Days != '') ? (($Difference->h > 0) ? $Difference->h.' '.(($Difference->h > 1) ? 'Hours ' : 'Hour ') : '0 Hour ') : (($Difference->h > 0) ? $Difference->h.' '.(($Difference->h > 1) ? 'Hours ' : 'Hour ') : '');
            $Minute = ($Difference->i > 0) ? $Difference->i.' '.(($Difference->i > 1) ? 'Minutes' : 'Minute') : '';

            $LoginBefore = $Days.$Hours.$Minute;

            if($Days!='' || $Hours!='' || $Minute!='')
            {
               $_SESSION['lastlogin'] = $LoginBefore.' ago ('.date('d-m-Y h:i A', strtotime($d['lastlogin'])).')';
            }
            else
            {
               $_SESSION['lastlogin'] = date('Y-m-d h:i A', strtotime($d['lastlogin']));
            }

            mysqli_query($con,"UPDATE profile_info SET lastlogin='$CurrentDate' where id=".$d['id']);
            header("location:index.php");
         }
         else
         {
            $_SESSION['BannerColor'] = "background-color:#FF0000;";
            $_SESSION['Message'] = "Please enter the correct username and password.";
            echo "<script>window.location.href='login.php';</script>";
            exit;
         }
      }
      else
      {
         $_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "No account found with this email.";
         echo "<script>window.location.href='login.php';</script>";
         exit;
      }
   }
?>

<!doctype html>
<html lang="en">
<head>
   <title>Villatent: Login</title>
   <?php include_once('common/head-assets.php'); ?>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   <link rel="stylesheet" href="css/login.css">
</head>
<body>
   <main class="login-shell">
      <section class="brand-panel">
         <div class="brand-center">
            <div class="brand-text">CURATED LUXURY</div>
            <p class="brand-sub">Luxury glamping solutions for resorts, hotels, events and private villas across India and beyond.</p>
         </div>

         <div class="benefits">
            <div class="benefit">
               <i class="fa-regular fa-gem"></i>
               <div class="benefit-title">Premium Quality</div>
               <div class="benefit-text">Finest materials and craftsmanship</div>
            </div>

            <div class="benefit">
               <i class="fa-solid fa-tents"></i>
               <div class="benefit-title">Custom Solutions</div>
               <div class="benefit-text">Bespoke tents for every unique requirement</div>
            </div>

            <div class="benefit">
               <i class="fa-solid fa-globe"></i>
               <div class="benefit-title">Global Experience</div>
               <div class="benefit-text">Delivering luxury worldwide</div>
            </div>
         </div>
      </section>

      <section class="form-panel">
         <div class="login-card">
            <div class="card-logo">
               <img src="images/thevillatent-logo.png" alt="The Villa Tent Logo">
            </div>

            <div class="welcome">
               <h1>Welcome Back</h1>
               <p>Sign in to access The Villa Tent Admin Dashboard</p>
            </div>

            <?php if (!empty($_SESSION['Message'])) {
               echo "<div class='alert' id='mydiv' style='" . $_SESSION['BannerColor'] . "'>"
                        . "<p style='color:white;'>" . htmlspecialchars($_SESSION['Message']) . "</p>"
                        . "</div>";

               unset($_SESSION['Message']);
               unset($_SESSION['BannerColor']);
            } ?>
            <form action="" method="post">
               <div class="field">
                  <label for="user">Email Address</label>
                  <div class="field-wrap">
                     <i class="fa-regular fa-envelope"></i>
                     <input id="user" type="text" name="user" placeholder="Enter your email address" value="<?php if(isset($_COOKIE['username'])) { echo htmlspecialchars($_COOKIE['username'], ENT_QUOTES, 'UTF-8'); } ?>">
                  </div>
               </div>

               <div class="field">
                  <label for="pass">Password</label>
                  <div class="field-wrap">
                     <i class="fa-solid fa-lock"></i>
                     <input id="pass" type="password" name="pass" placeholder="Enter your password" value="<?php if(isset($_COOKIE['password'])) { echo htmlspecialchars($_COOKIE['password'], ENT_QUOTES, 'UTF-8'); } ?>">
                     <button class="toggle-btn" type="button" onclick="togglePassword()" aria-label="Toggle password visibility">
                        <i class="fa-regular fa-eye"></i>
                     </button>
                  </div>
               </div>

               <div class="row-meta">
                  <label class="remember" for="remember">
                     <input id="remember" type="checkbox" name="remember">
                     <span>Remember Me</span>
                  </label>
                  <a class="forgot" href="#">Forgot Password?</a>
               </div>

               <button class="submit-btn" type="submit" name="sub">
                  Login <i class="fa-solid fa-arrow-right"></i>
               </button>
            </form>
         </div>
      </section>
   </main>

   <script>
      function togglePassword() {
         var passwordInput = document.getElementById('pass');
         passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
      }
   </script>
</body>
</html>
<?php include_once('common/footer.php'); ?>