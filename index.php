<?php 

session_start();

include 'includes/header.php';
include 'includes/functions.php';

checkAuth();

?>
    

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <?php include 'includes/sidebar.php'; ?>
            <!-- Sidebar -->
        </div>
    </div>
    
<?php
include 'includes/footer.php';
?>