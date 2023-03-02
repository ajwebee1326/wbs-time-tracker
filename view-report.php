<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

include 'includes/header.php';
include 'includes/functions.php';
include 'includes/DB.php';

if(!is_admin()){
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
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Task List</h4>
                        <div class="col-6 text-center">
                        <a href="?id=<?php echo $emp_id ?>&filter"><button type="button" class="btn btn-primary"><b>All</b></button></a>
                            <a href="?id=<?php echo $emp_id ?>&filter=day"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'day' ? 'disabled' : '' ?>><b>Today</b></button></a>
                            <!-- <a href="?id=<?php echo $emp_id ?>&filter=week"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'week' ? 'disabled' : '' ?>><b>Last Week</b></button></a>
                            <a href="?id=<?php echo $emp_id ?>&filter=month"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'month' ? 'disabled' : '' ?>><b>Last Month</b></button></a> -->
                        </div>
                        <?php if ($msg) : ?>
                            <div class="text-center mb-3"><?php echo $msg; ?></div>
                        <?php endif; ?>
                        <div class="col-md-6 mx-auto mt-3 text-center">
                            <form action="" class="d-flex justify-content-between gap-3" >
                                <input type="text" id="from" name="from" class="form-control" placeholder="From Date" autocomplete="off">
                                <input type="text" id="to" name="to" class= "form-control" placeholder ="To Date" autocomplete="off">
                                <input type="hidden" name="id" id="id" value="<?php echo $emp_id; ?>">
                                <button type="submit" class="btn btn-primary">Filter </button>
                            </form>
                        </div>
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
            $filter = false;

            if(isset($_GET['filter'])&& $_GET['filter'] !='' && $_GET['filter'] != NULL){
                $filter_request = strtoupper($_GET['filter']);
                $filter = "`date_created` > DATE_SUB(NOW(), INTERVAL 1 $filter_req)";
                
            }

 
            if(isset($_GET['from'])&& $_GET['from'] != '' && $_GET['from'] != null && isset($_GET['to']) && $_GET['to'] !='' && $_GET['to'] !=null){
                $from = $_GET['from'];
                $to = $_GET['to'];
               
                $filter = " date_created >= '$from' AND date_created <= '$to'";
            }else{
                $msg = 'Please select the date range';
            }

            
            if($filter){
            
                $tasks = "SELECT * FROM `tbl_task` WHERE `emp_id` = '$emp_id' AND $filter";

            }else{
                $tasks = "SELECT * FROM `tbl_task` WHERE `emp_id` = '$emp_id' AND date_created >= CURRENT_DATE AND date_created < CURRENT_DATE + INTERVAL 1 DAY";
          
            }
           
                $tasks = $db->query($tasks); ?>
                

               
                                <div class="col-md-8">
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
                                        <?php if($tasks):
                while($task = $tasks->fetch_assoc()){
            ?>

                                       
                                                <tr>

                                                    
                                                    <td><?php echo $task['date_created'] ?></td>
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
                <!-- <div class="col-xl-3 col-sm-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="mx-auto mb-4">
                                <h4><?php echo $task['client_name'];?></h4>
                            </div>
                            <h6><?php echo $task['description']?></h6>
                            <b>Hours : </b><?php echo $task['hours'];?>
                            <br>
                            <b>Minutes: </b><?php echo $task['minutes'];?>
                            <br>
                            <br>
                            <br>
                            <?php
                                
                                $work_start_time = Carbon::parse($task['date_created']);
                                $work_end_time = Carbon::parse($task['date_created']);
                                $office_start_time = Carbon::parse('10:00 AM');
                                $office_end_time = Carbon::parse('07:00 PM');
                                $office_start = $work_start_time->max($office_start_time);
                                $office_end = $work_end_time->min($office_end_time);
                                $hours_worked = $office_start->diffInHours($office_end);
                                // echo "Hours worked during office hours: <b>{$hours_worked} hours</b>";
                            ?>
                        </div>
                       
                    </div>
                </div> -->


            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>


<script>

$(document).ready(function() {
    $('#emp_view_report').DataTable();

    $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true
        });

        $('#from').datepicker();
        $('#to').datepicker();

});
               
</script>