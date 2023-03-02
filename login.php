<?php
session_start();
include 'config.php';
include 'includes/DB.php';
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
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->
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
                           
                            <div class="form-title">
                                <h4>Employee Login</h4>
                            </div>
                            <div class="form-input">
                                <a href="<?php echo $google_client->createAuthUrl()?>" class="btn btn-danger btn-block btn-lg w-100 mt-3">Login With Google</a>
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