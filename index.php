 <?php
  session_start();
  header("Cache-Control: no-cache, must-revalidate");
  include('config/config.php');
  if (isset($_POST['login'])) {
    $login_permission = $_POST['login_permission'];
    $login_username = $_POST['login_username'];
    $login_pass = sha1(md5($_POST['login_pass'])); //double encrypt to increase security
    $stmt = $mysqli->prepare("SELECT login_permission, login_username, login_pass, login_id FROM libroshop_login WHERE login_permission=? AND login_username =? AND login_pass =?"); //sql to log in user
    $stmt->bind_param('iss', $login_permission, $login_username, $login_pass); //bind fetched parameters 
    $stmt->execute(); //execute bind
    $stmt->bind_result($login_permission, $login_username, $login_pass, $login_id); //bind result 
    $rs = $stmt->fetch();
    $_SESSION['login_id'] = $login_id;
    if ($rs && $login_permission == '1') { //if its sucessfull 
      // print("Login berhasil!");
      header("location:admin_dashboard.php");
    } else {
      $err = "Incorrect Authentication Credentials";

      // Menampilkan SweetAlert dengan pesan kesalahan
      echo '<script>
        setTimeout(function() {
            swal("Failed", "' . $err . '", "error");
        }, 100);
    </script>';
    }
  }

  require_once('partials/_head.php');
  ?>

 <body>
   <main>
     <div class="container">
       <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
         <div class="container">
           <div class="row justify-content-center">
             <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
               <div class="d-flex justify-content-center py-4">
                 <a href="index.html" class="logo d-flex align-items-center w-auto">
                   <img src="assets/img/logo.png" alt="" />
                   <span class="d-none d-lg-block">NiceAdmin</span>
                 </a>
               </div>
               <!-- End Logo -->

               <div class="card mb-3">
                 <div class="card-body">
                   <div class="pt-4 pb-2">
                     <h5 class="card-title text-center pb-0 fs-4">
                       Login to Your Account
                     </h5>
                     <p class="text-center small">
                       Enter your username & password to login
                     </p>
                   </div>

                   <form class="row g-3 needs-validation" method="POST" novalidate>
                     <div class="col-12">
                       <label for="yourUsername" class="form-label">Username</label>
                       <div class="input-group has-validation">
                         <span class="input-group-text" id="inputGroupPrepend">@</span>
                         <input type="text" name="login_username" class="form-control" id="yourUsername" required />
                         <div class="invalid-feedback">
                           Please enter your username.
                         </div>
                       </div>
                     </div>

                     <div class="col-12">
                       <label for="yourPassword" class="form-label">Password</label>
                       <input type="password" name="login_pass" class="form-control" id="yourPassword" required />
                       <div class="invalid-feedback">
                         Please enter your password!
                       </div>
                       <input id="" name="login_permission" value="1" type="text" style="display:none" class="form-control" placeholder="Password">
                     </div>
                     <div class="col-12">
                       <button class="btn btn-primary w-100" name="login" type="submit" value="">Login</button>
                     </div>
                     <div class="col-12">
                       <p class="small mb-0">
                         Don't have account?
                         <a href="pages-register.html">Create an account</a>
                       </p>
                     </div>
                   </form>
                 </div>
               </div>

               <div class="credits">
                 Designed by
                 <a href="https://bootstrapmade.com/">BootstrapMade</a>
               </div>
             </div>
           </div>
         </div>
       </section>
     </div>
   </main>
   <!-- End #main -->

   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   <!-- Vendor JS Files -->
   <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
   <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="assets/vendor/chart.js/chart.umd.js"></script>
   <script src="assets/vendor/echarts/echarts.min.js"></script>
   <script src="assets/vendor/quill/quill.min.js"></script>
   <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
   <script src="assets/vendor/tinymce/tinymce.min.js"></script>
   <script src="assets/vendor/php-email-form/validate.js"></script>

   <!-- Template Main JS File -->
   <script src="assets/js/main.js"></script>
   <?php require_once('partials/_scripts.php'); ?>
 </body>

 </html>