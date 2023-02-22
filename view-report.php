<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

include 'includes/header.php';
include 'includes/functions.php';
include 'includes/DB.php';

checkAuth();
$msg = false;
$db = new DB();

$emp_id = $_GET['id'];

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
                        <h4 class="mb-sm-0 font-size-18">Task List</h4>
                        <div class="col-6 text-center">
                            <a href="?filter=day"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'day' ? 'disabled' : '' ?>><b>Today</b></button></a>
                            <a href="?filter=week"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'week' ? 'disabled' : '' ?>><b>Last Week</b></button></a>
                            <a href="?filter=month"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'month' ? 'disabled' : '' ?>><b>Last Month</b></button></a>
                        </div>
                        <div class="col-2 text-center">
                            Total Hours : 12 Hours
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Task List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
            <?php
                $tasks = "SELECT * FROM `tbl_task` WHERE `emp_id` = '$emp_id'";
                $tasks = $db->query($tasks);
                $i = 1;
                while($task = $tasks->fetch_assoc()){
            ?>
                <div class="col-xl-3 col-sm-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="mx-auto mb-4">
                                <h4><?php echo $task['project_name'];?></h4>
                            </div>
                            <h6><?php echo $task['description']?></h6>
                            <b>Note : </b><?php echo $task['notes'];?>
                            <br>
                            <b>Start Time : </b><?php echo $task['start_date'];?>
                            <br>
                            <b>End Time : </b><?php echo $task['end_date'];?>
                            <br>
                            <br>
                            <?php
                                
                                $work_start_time = Carbon::parse($task['start_date']);
                                $work_end_time = Carbon::parse($task['end_date']);
                                $office_start_time = Carbon::parse('10:00 AM');
                                $office_end_time = Carbon::parse('07:00 PM');
                                $office_start = $work_start_time->max($office_start_time);
                                $office_end = $work_end_time->min($office_end_time);
                                $hours_worked = $office_start->diffInHours($office_end);
                                echo "Hours worked during office hours: <b>{$hours_worked} hours</b>";
                            ?>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <div class="contact-links d-flex font-size-20">
                                <div class="flex-fill">
                                    <a href="http://localhost/wbs/webeesite/slide/edit/1"><i class="bx bx-edit"></i></a>
                                </div>
                                <div class="flex-fill">
                                    <a href="http://localhost/wbs/webeesite/slide/delete/1"><i class="bx bx-trash-alt "></i></a>
                                </div>
                                <div class="flex-fill" title="Status">
                                    <a href="http://localhost/wbs/webeesite/slide/change_status/1/0"><button class="btn btn-danger btn-sm">Deactivate</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>


<script>
    $('#emp_timesheet').DataTable();
</script>