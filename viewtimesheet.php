<?php


session_start();
include 'includes/header.php';
include 'includes/DB.php';

$msg = false;
$db = new DB();


if(isset($_GET['action'])&& $_GET['action']=='view' && !empty($_GET['id'])) {

    $id = $_GET['id'];

   
    $sql = "SELECT * FROM `tbl_task` WHERE id = $id " ;

    $tasks = $db->select($sql);
      

}else{
    $msg = 'Invalid Request';
}

?> 

 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <?php include 'includes/sidebar.php'; ?>
        <!-- Sidebar -->
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <form action="" method="POST" id="task_add_form">
            <div class="mb-3">
                <label for="project_name" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="project_name" name="project_name" value="<?php $tasks['project_name']?>">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date & Time</label>
                <input class="form-control" type="datetime-local" value="2023-08-19T10:00:00" id="start_date" name="start_date">
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">End Date & Time</label>
                <input  class="form-control" type="datetime-local" value="2023-08-19T19:00:00" id="end_date" name="end_date">
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Notes</label>
                <textarea id="notes" name="notes" type="text" class="form-control"></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" onclick="task_form_validate()"  name ="add_task" class="btn btn-primary">Add Task</button>
            </div>
</form>
    </div>
    <div class="col-md-2"></div>
</div>


                            
<div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        </div>
                    </div>
                </div>
               
            </div> 
            <!-- container-fluid -->
        </div>
                <!-- End Page-content -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="text-center"></div>
                </div>
            </div>
        </div>
</div>



<?php
include 'includes/footer.php';
?>



