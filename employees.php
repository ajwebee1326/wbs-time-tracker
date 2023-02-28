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
                        <!-- <div class="col-4 text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><b>+ Add New Project</b></button>
                                </div> -->
                                <form action="" method="" class="d-flex justify-content-between gap-3">
                                    <input type="text" id="from" name="from" class="form-control"
                                        placeholder="From Date" autocomplete="off">
                                    <input type="text" id="to" name="to" class="form-control" placeholder="To Date" autocomplete="off">
                                    <button type="submit" class="btn btn-primary">Filter </button>
                                </form>

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
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Email</th>
                                        <th>Today Hours</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                            $emp_id = $_SESSION['emp_id'];
                                            $sql= "SELECT * FROM tbl_employee";
                                           
                                            $employees = $db->select($sql);
                                           
                                            $sr_no =1; 
                                            if($employees):
                                            foreach ($employees as $employee) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $sr_no  ?>
                                        </td>
                                        <td>
                                            <?php echo $employee['emp_name']  ?>
                                        </td>
                                        <td>
                                            <?php echo $employee['emp_designation']  ?>
                                        </td>
                                        <td>
                                            <?php echo $employee['emp_email']  ?>
                                        </td>
                                        <td>
                                            <?php
                                                        $emp_id = $employee['id'];
                                                        

                                            $sql= "SELECT SUM(hours) as hours, SUM(minutes) as mm FROM `tbl_task` WHERE emp_id = $emp_id "; 
                                            $production_hours = $db->select($sql);
                                            $prhours = mysqli_fetch_array($production_hours);  ?>



                                            <h5>
                                                <?php echo $prhours['hours'];?> hrs
                                                <?php echo $prhours['mm'] ?> minutes
                                            </h5>

                                        </td>
                                        <td>
                                            <a href="view-report.php?id=<?php echo $employee['id']?>&action=view"><button
                                                    class="btn btn-warning">View</button></a>
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
    $('#emp_timesheet').DataTable();

    
    $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true
        });

        $('#from').datepicker();
        $('#to').datepicker();

</script>