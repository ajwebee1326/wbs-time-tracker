<?php
session_start();
include 'includes/DB.php';
$msg = false;
$db = new DB();
if (isset($_POST['email'])) {
   
    $email = $db->santize($_POST['email']);
    $password = $db->santize($_POST['password']);

   
    $sql = "SELECT * FROM tbl_employee WHERE emp_email = '$email' AND emp_pwd = '$password'";
   
       
    if ($db->select($sql)) {

        
        $_SESSION['email']= $email; 
        
        if(isset($_SESSION['email'])){
            header("location: index.php");
        }else {
                header("location: login.php");
             }
    } else {
        $msg = "Invalid email or password";
    }
}
?> 

<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />    
        <title>Login | Task Tracker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
         <!--  Style Css -->
         <link rel="stylesheet" href="assets/css/style.css">
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>
    <body>
      <section class="login-form mt-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <form method="post" action="">
                            <div class="admin-login">
                            <?php if ($msg) : ?>    
                                <?php echo $msg; ?>
                                <?php endif; ?>
                                <div class="form-title">
                                    <h4>Employee Login</h4>
                                </div>
                               
                                <div class="form-input">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                                <div class="form-input">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" value="12345">
                                </div>
                                <div class="form-input">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg w-100">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>   
      </section> 
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
           <!--- google recaptcha---->
        <script src='https://www.google.com/recaptcha/api.js'></script>        
    </body>  
</html> 

           

