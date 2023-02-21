<?php 

include 'includes/header.php';
include 'includes/functions.php';
include 'includes/DB.php';

checkAuth();
$msg = false;
$db = new DB();

?>


    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <?php include 'includes/sidebar.php'; ?>
            <!-- Sidebar -->
        </div>
    </div>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Employees</h4>
                                <div class="col-4 text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><b>+ Add New Project</b></button>
                                </div>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">Employees List</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="emp_timesheet" class="table table-bordered dt-responsive w-100">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Project Name</th>
                                            <th>Description</th>
                                            <th>Start Date & time</th>
                                            <th>End Date & time</th>
                                            <th>Notes</th>
                                            <th>Actions</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 

                                            $emp_id = $_SESSION['emp_id'];
                                            $sql= "SELECT * FROM tbl_employee ";
                                            $employee = $db->select($sql);
                                            $sr_no =1; 
                                            if($tasks):
                                            foreach ($tasks as $task) { ?>
                                            <tr>

                                            <?php $taskid = $task['id'] ?>
                                                <td> <?php echo $sr_no  ?> </td>
                                                <td> <?php echo $task['project_name']  ?> </td>
                                                <td> <?php echo $task['description']  ?> </td>
                                                <td> <?php echo $task['start_date']  ?> </td>
                                                <td> <?php echo $task['end_date']  ?> </td>
                                                <td> <?php echo $task['notes']  ?> </td>
                                                <td>
                                                    <a  href="viewtimesheet.php?id=<?php echo $task['id']?>&action=view"><button class="btn btn-warning">View</button></a>
                                                    <button class="btn btn-primary edit_task" data-task='<?php echo json_encode($task);?>'>Edit</button>
                                                    <a onclick="return confirm('Do you want to delete this task')" href="timesheet.php?id=<?php echo $task['id']?>&action=delete"><button class="btn btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
                                           <?php $sr_no ++; } endif;  ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> 
            <!-- container-fluid -->
        </div>
    </div>

<?php
include 'includes/footer.php';
?>


<script>

</script>