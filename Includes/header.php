<?php 
session_start();
?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />    
        <title>Dashboard | Time Sheet</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
         <!--  Style Css -->
         <link rel="stylesheet" href="assets/css/style.css">
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />


        <!--jqyer date picker --> 
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">


        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <!-- toastr css -->
        <link rel="stylesheet" href="assets/libs/toastr/toastr.min.css">



    </head>

    <body data-sidebar="dark" data-layout-mode="light">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            <!--- Top Header ----->          
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="" class="logo logo-dark">
                                <!-- <span class="logo-sm">
                                   
                                </span>
                                <span class="logo-lg">
                                    
                                </span> -->
                            </a>

                            <a href="" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="https://webeesocial.ca/wp-content/uploads/2022/12/logowhite2.png" alt="" height="40">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <h4 class="m-auto">
                        <p class="mb-0 text-center">Welcome, 
                        <?php echo $_SESSION['name']?>
                        <br>
                        <?php echo date('d-m-Y'); ?>
                        </p>
                    </h4>
                    <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class='bx bx-cog' ></i>
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry"></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item text-danger" href="logout.php"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                    </div>
                </div>
            </header>

           

           