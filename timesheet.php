<?php

include 'includes/header.php';
include 'includes/functions.php';
include 'includes/DB.php';

checkAuth();
$msg = false;
$db = new DB();

$emp_id = $_SESSION['emp_id'];
$filter = false;

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
                    <div class="page-title-box">

                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-sm-0 font-size-18">Task List</h4>

                            </div>
                            <?php if ($msg) : ?>
                                <div class="text-center mb-3">
                                    <?php echo $msg; ?>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-6    ">
                                <div class="d-flex gap-3">

                                    <!-- <a href="?filter="><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == '' ? 'disabled' : '' ?>><b>All</b></button></a> -->
                                    <a href="?filter=day"><button type="button" class="btn btn-primary" <?php echo
                                                                                                        isset($_GET['filter']) && $_GET['filter'] == 'day' ? 'disabled' : ''
                                                                                                        ?>><b>Today</b></button></a>
                                    <!-- <a href="?filter=week"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'week' ? 'disabled' : '' ?>><b>Last Week</b></button></a>
                                 <a href="?filter=month"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'month' ? 'disabled' : '' ?>><b>Last Month</b></button></a> -->

                                    <!-- ////Date range  -->
                                    <form action="" method="" class="d-flex justify-content-between gap-3">
                                        <input type="text" id="from" name="from"  required class="form-control" placeholder="From Date" autocomplete="off">
                                        <input type="text" id="to" name="to" required class="form-control" placeholder="To Date" autocomplete="off">
                                        <button type="submit" class="btn btn-primary">Filter </button>
                                    </form>
                                <button class="btn btn-primary download">Download</button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <!-- end row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">

                                <div id="add_task_message" class="alert alert-dismissable d-none">
                                    <div class="message"></div>
                                </div>
                                <form action="" method="POST" id="task_form">
                                    <div>
                                        <label for="">Client Name</label>
                                        <input type="text" name="client_name" required id="client_name" class="form-control" placeholder="Client Name"  autocomplete="off">
                                    </div>
                                    <div class=" mt-2">
                                        <label for="">Task Description</label>
                                        <!-- <input type="text" name="description" id="description" class="form-control" placeholder="Description" -->
                                        <textarea name="description" id="description" required class="form-control" placeholder="Description"  autocomplete="off" ></textarea>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="mt-2">
                                            <label for="">Hours</label>
                                            <input type="number" name="hours" id="hours" required   class="form-control" placeholder="Hours" maxlength="1">
                                        </div>
                                        <div class=" mt-2">
                                            <label for="">Minutes</label>
                                            <input type="number" name="minutes" id="minutes" required class="form-control" placeholder="Minutes" maxlength="2">
                                        </div>
                                    </div>
                                    <input type="hidden" name="action" id="action" value="create_task">
                                    <input type="hidden" name="task_id" id="task_id" value="">
                                    <div class=" mt-3">
                                        <button class="btn btn-primary action_btn w-100 pt-3 pb-3">Add</button>
                                    </div>
                                </form>
                            </div>
                            <div class="production-hours mt-2">
                                <?php

                                if (isset($_GET['filter']) && $_GET['filter'] != "" && $_GET['filter'] != null) {
                                    $filter_req = strtoupper($_GET['filter']);
                                    $filter = "`date_created` > DATE_SUB(NOW(), INTERVAL 1 $filter_req)";
                                }

                                if (isset($_GET['from']) && ($_GET['from'] != "") && ($_GET['from'] != null) && isset($_GET['to']) && ($_GET['to'] != null) && ($_GET['to'] != "")) {
                                    $from = $_GET['from'];
                                    $to = $_GET['to'];

                                    $filter = "date_created >= '$from' AND date_created <= '$to'";
                                } else {
                                    $msg = 'Please select the date range';
                                }

                                if ($filter) {


                                    $sql = "SELECT SUM(hours) as hours, SUM(minutes) as mm FROM `tbl_task` WHERE emp_id = $emp_id AND $filter";
                    
                                    $production_hours = $db->select($sql);
                                    $prhours = mysqli_fetch_array($production_hours);
                                } else {
                                    $sql = "SELECT SUM(hours) as hours, SUM(minutes) as mm FROM `tbl_task` WHERE emp_id = $emp_id AND date_created >= CURRENT_DATE AND date_created < CURRENT_DATE + INTERVAL 1 DAY";
                                    $production_hours = $db->select($sql);
                                    $prhours = mysqli_fetch_array($production_hours);
                                }


                                $prhours['hours'] = floor($prhours['hours'] + ($prhours['mm'] / 60));
                                $prhours['mm'] = $prhours['mm'] % 60;

                                ?>

                                <h5 class="text-center">Production Hours-
                                    <?php echo $prhours['hours']; ?> hrs
                                    <?php echo $prhours['mm'] ?> minutes
                                </h5>

                            </div>



                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <table id="emp_timesheet" class="table table-bordered dt-responsive w-100">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Project Name</th>
                                            <th>Description</th>
                                            <th>Hours</th>
                                            <th>Minutes</th>
                                            <th class="noExl">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $filter = false;
                                        $emp_id = $_SESSION['emp_id'];

                                        if (isset($_GET['filter']) && $_GET['filter'] != "" && $_GET['filter'] != null) {
                                            $filter_req = strtoupper($_GET['filter']);
                                            $filter = "`date_created` > DATE_SUB(NOW(), INTERVAL 1 $filter_req)";
                                            //$filter =  "`date_created` >= CURRENT_DATE AND date_created < CURRENT_DATE + INTERVAL 1 $filter_req";

                                        }

                                        if (isset($_GET['from']) && ($_GET['from'] != "") && ($_GET['from'] != null) && isset($_GET['to']) && ($_GET['to'] != null) && ($_GET['to'] != "")) {
                                            $from = $_GET['from'];
                                            $to = $_GET['to'];

                                            $filter = "date_created >= '$from' AND date_created <= '$to'";
                                        } else {
                                            $msg = 'Please select the date range';
                                        }

                                        $curr_date =   date("Y-m-d");
                                        if ($filter) {
                                            $sql = "SELECT * FROM tbl_task  WHERE  emp_id = $emp_id AND $filter";
                                        } else {
                                            $sql = "SELECT * FROM tbl_task  WHERE  emp_id = $emp_id AND date_created >= CURRENT_DATE AND date_created < CURRENT_DATE + INTERVAL 1 DAY";
                                        }
                                        $tasks = $db->select($sql);
                                        if ($tasks) :
                                            foreach ($tasks as $task) { ?>
                                                <tr id="task_<?php echo $task['id'] ?>">

                                                    <?php $taskid = $task['id'] ?>
                                                    <!-- <td>
                                                <?php echo $taskid  ?>
                                            </td> -->
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
                                                    <td>
                                                        <button class="btn btn-secondary view_task" data-task='<?php echo json_encode($task); ?>'><span class="fa fa-eye"></span></button>
                                                        <button class="btn btn-primary edit_task" data-task='<?php echo json_encode($task); ?>'><span class="fa fa-pencil"></span></button>
                                                        <button class="btn btn-danger" onclick="delete_task(<?php echo $task['id'] ?>)"><span class="fa fa-trash"></span> </button>
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
            <!-- container-fluid -->
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="task_description_modal" tabindex="-1" role="dialog" aria-labelledby="task_description_modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="task_description_modal_title">Task Description</h5>
                </div>
                <div class="modal-body">
                    <div class="task_desc"> </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <?php include 'includes/footer.php'; ?>


    <script>
        $(document).ready(function() {
            $('#emp_timesheet').DataTable();
        });

        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true
        });

        $('#from').datepicker();
        $('#to').datepicker();

        $("#task_form").submit(function(e) {
            e.preventDefault();
            let client_name = $('#client_name').val();
            let description = $('#description').val();
            let hours = $('#hours').val();
            let minutes = $('#minutes').val();
            let action = $('#action').val();
            let id = $('#task_id').val();
            $.post('ajax.php', {
                client_name,
                description,
                hours,
                minutes,
                action,
                id
            }, function(data) {
                data = JSON.parse(data);
                if (data.code == 1) {
                    if (action == 'create_task') {
                        $('#emp_timesheet tbody').append(data.html);
                        console.log(data.html);
                        toastr.success('Task added successfully');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    } else {
                        toastr.success('Task updated successfully');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                        $('#task_' + id).replaceWith(data.html);
                        $(".action_btn").html("Add");
                    }
                    $('#task_form')[0].reset();
                    $('#action').val('create_task');
                    $('#task_id').val('');
                } else {
                    alert('Something went wrong');
                }
            })
        });

        function delete_task(id) {
            let action = 'delete_task';
            $.post('ajax.php', {
                id,
                action
            }, function(data) {
                data = JSON.parse(data);
                if (data.code == 1) {
                    toastr.error('Task deleted successfully')
                    $('#task_' + id).hide('slow');
                } else {
                    alert('Something went wrong');
                }
            })
        }


        $(document).on('click', '.edit_task', function(e) {
            e.preventDefault();
            let task = $(this).data('task');
            $('#client_name').val(task.client_name);
            $('#description').val(task.description);
            $('#hours').val(task.hours);
            $('#minutes').val(task.minutes);
            $('#action').val('update_task');
            $('#task_id').val(task.id);
            $('#action').html('update_task');
            $(".action_btn").html("Update");
        });

        $(document).on('click', '.view_task', function(e) {
            e.preventDefault();
            let task = $(this).data('task');
            $('#task_description_modal').modal('show');
            $('.task_desc').html(task.description);
        });

        $(".download").click(function() {
            $("#emp_timesheet").table2excel({
                exclude:".noExl",
                name:"Worksheet Name",
                filename:"SomeFile",
                fileext:".xls"
            });

        });

      
    </script>