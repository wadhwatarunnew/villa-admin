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

            <form action="session.php" method="post">
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