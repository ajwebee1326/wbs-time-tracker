<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

include 'includes/header.php';
include 'includes/functions.php';
include 'includes/DB.php';

if (!is_admin()) {
    exit;
}

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
                <div class="col-md-6">
                    <h4 class="mb-sm-0 font-size-18">Task List</h4>
                </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            
                                <a href="?id=<?php echo $emp_id ?>&filter=day"><button type="button" class="btn btn-primary"
                                        <?php echo isset($_GET['filter']) && $_GET['filter']=='day' ? 'disabled' : ''
                                        ?>><b>Today</b></button></a>
                               
                            <form action="" class="d-flex justify-content-between gap-3">
                                    <input type="text" id="from" name="from" required class="form-control" placeholder="From Date"
                                        autocomplete="off">
                                    <input type="text" id="to" name="to" required class="form-control" placeholder="To Date"
                                        autocomplete="off">
                                    <input type="hidden" name="id" id="id" value="<?php echo $emp_id; ?>">
                                    <button type="submit" class="btn btn-primary">Filter </button>
                            </form>
                            <button class="btn btn-primary download">Download</button>
                        </div>
                    </div>



            </div>
        </div>
    </div>
      
    <div class="row">
        <?php
            $filter = false;

            if (isset($_GET['filter']) && $_GET['filter'] != '' && $_GET['filter'] != NULL) {
                $filter_request = strtoupper($_GET['filter']);
                $filter = " date_created >= CURRENT_DATE AND date_created < CURRENT_DATE + INTERVAL 1 DAY";
            }

            if (isset($_GET['from']) && $_GET['from'] != '' && $_GET['from'] != null && isset($_GET['to']) && $_GET['to'] != '' && $_GET['to'] != null) {
                $from = $_GET['from'];
                $to = $_GET['to'];
                $filter = " date_created >= '$from' AND date_created <= '$to'";
            } else {
                $msg = 'Please select the date range';
            }

            if ($filter) {

                $tasks = "SELECT * FROM `tbl_task` WHERE `emp_id` = '$emp_id' AND $filter";
            } else {
                $tasks = "SELECT * FROM `tbl_task` WHERE `emp_id` = '$emp_id' AND date_created >= CURRENT_DATE AND date_created < CURRENT_DATE + INTERVAL 1 DAY";
            }

            $tasks = $db->query($tasks); ?>
            
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="task_message" class="alert alert-dismissable d-none">
                                <div class="message"></div>
                            </div>
                            <table id="emp_view_report" class="table table-bordered dt-responsive w-100">
                                <thead>
                                    <tr>
                                        <!-- <th>S.No</th> -->
                                        <th>Date</th>
                                        <th>Project Name</th>
                                        <th>Description</th>
                                        <th>Hours</th>
                                        <th>Minutes</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($tasks) :
                                            while ($task = $tasks->fetch_assoc()) {
                                        ?>


                                    <tr>


                                        <td>
                                            <?php echo $task['date_created'] ?>
                                        </td>
                                        <td>
                                            <?php echo $task['client_name']  ?>
                                        </td>
                                        <td>
                                            <?php echo $task['description']  ?>
                                        </td>
                                        <td>
                                            <?php echo $task['hours']  ?>
                                        </td>
                                        <td>
                                            <?php echo $task['minutes']  ?>
                                        </td>

                                    </tr>

                                    <?php  }
                                        endif;  ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            
    </div>
</div>

<?php
$employee = $db->query("SELECT * FROM `tbl_employee` WHERE `id` = '$emp_id'");
$employee = $employee->fetch_assoc();
?>

<?php
include 'includes/footer.php';
?>


<script>
    $(document).ready(function () {
        $('#emp_view_report').DataTable();

        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true
        });

        $('#from').datepicker();
        $('#to').datepicker();

    });

    $(".download").click(function () {
        $("#emp_view_report").table2excel({
            exclude: ".noExl",
            name: "Worksheet Name",
            filename: "<?php echo $employee['emp_name']; echo ' '; if(isset($_GET['from'])){ echo $_GET['from']; echo 'to';  echo $_GET['to'];  }  ?>",
            fileext: ".xlsx"
        });

    });
</script>