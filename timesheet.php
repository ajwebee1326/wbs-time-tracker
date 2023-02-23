<?php 

include 'includes/header.php';
include 'includes/functions.php';
include 'includes/DB.php';

checkAuth();
$msg = false;
$db = new DB();
if((isset($_POST['project_name']))&&(!empty($_POST['project_name']))){

    $emp_id = $_SESSION['emp_id'];
    $project_name = $db->santize($_POST['project_name']);
    $description  = $db->santize($_POST['description']);
    $start_date = $db->santize($_POST['start_date']);
    $end_date =  $db->santize($_POST['end_date']);
    $notes = $db->santize($_POST['notes']);

    $sql= "INSERT INTO `tbl_task`(`emp_id`,`project_name`, `description`, `start_date`, `end_date`, `notes`)
     VALUES ('$emp_id','$project_name','$description','$start_date','$end_date','$notes')";

    if($db->insert($sql)){
        $msg = "Task Added successfully ";
    }else{
        $mg = "Something went wrong ";
    }

}

// To delete the task from database

// if(isset($_GET['action'])&& $_GET['action']=='delete' && !empty($_GET['id'])) {

//     $id = $_GET['id'];
//     $sql = "DELETE FROM `tbl_task` WHERE id = $id " ;

//     if($db->delete($sql)){

//         $msg = "Task removed successfully";
//         header('Location: timesheet.php');
//     }else{
//         $msg = "Something went wrong";
//     }

// }else{
//     $msg = 'Invalid Request';
// }

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
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><b>+ Add New Project</b>
                                </button>
                                
                                <a href="?filter="><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == '' ? 'disabled' : '' ?>><b>All</b></button></a>
                                <a href="?filter=day"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'day' ? 'disabled' : '' ?>><b>Today</b></button></a>
                                <a href="?filter=week"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'week' ? 'disabled' : '' ?>><b>Last Week</b></button></a>
                                <a href="?filter=month"><button type="button" class="btn btn-primary" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'month' ? 'disabled' : '' ?>><b>Last Month</b></button></a>

                                <!-- ////Date range  -->
                            
                            </div>
                            <?php if ($msg) : ?>
                                 <div class="text-center mb-3"><?php echo $msg; ?></div>
                            <?php endif; ?>
                            <div class="col-md-6 mx-auto mt-3 text-center">
                                    <form action="" method="" class="d-flex justify-content-between gap-3" >
                                    
                                    <input type="text" id="from" name="from" class="form-control" placeholder="From Date">
                                    <input type="text" id="to" name="to" class= "form-control" placeholder ="To Date">
                                    <!-- <input type ="submit" id="filterdaterange" name="filterdaterange" class=" btn btn-primary" value="Filter"> -->
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
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <div id="task_message" class="alert alert-dismissable d-none">
                            <div class="message"></div>
                         </div>
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
                                $filter = false;

                                $emp_id = $_SESSION['emp_id'];

                                if(isset($_GET['filter']) && $_GET['filter'] != "" && $_GET['filter'] != null){
                                    $filter_req = strtoupper($_GET['filter']);
                                    $filter = "`start_date` > DATE_SUB(NOW(), INTERVAL 1 $filter_req)";
                                }

                               

                                if(isset($_GET['from']) && ($_GET['from'] != "") && ($_GET['from'] != null) && isset($_GET['to']) && ($_GET['to'] != null) && ($_GET['to'] !="")){
                                    $from = $_GET['from'];
                                   
                                   

                                    $to = $_GET['to'];                                   
                                    $filter = "start_date >= '$from' AND start_date <= '$to'";
                                }else{
                                    $msg = 'Please select the date range';  
                                }

                                if($filter){
                                    $sql= "SELECT * FROM tbl_task  WHERE  emp_id = $emp_id AND $filter" ;
                                }else{
                                    $sql= "SELECT * FROM tbl_task  WHERE  emp_id = $emp_id" ;
                                }
                                $tasks = $db->select($sql);
                                $sr_no =1; 
                                if($tasks):
                                foreach ($tasks as $task) { ?>
                                    <tr id="task_<?php echo $task['id']?>">

                                        <?php $taskid = $task['id'] ?>
                                        <td><?php echo $sr_no  ?></td>
                                        <td><?php echo $task['project_name']  ?></td>
                                        <td><?php echo $task['description']  ?></td>
                                        <td><?php echo $task['start_date']  ?></td>
                                        <td><?php echo $task['end_date']  ?></td>
                                        <td><?php echo $task['notes']  ?></td>
                                        <td>
                                            <button class="btn btn-secondary view_task"
                                                data-task='<?php echo json_encode($task);?>'>View</button>
                                            <button class="btn btn-primary edit_task" 
                                                data-task='<?php echo json_encode($task);?>'>Edit</button>
                                                <button class="btn btn-danger" onclick="delete_task(<?php echo $task['id']?>)">Delete</button>
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
    <!-- End Page-content -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="text-center"></div>
            </div>
        </div>
    </div>
</div>



<!-- Modal for add new project -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Task Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="task_add_form">
                    <div class="mb-3">
                        <label for="project_name" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="project_name" name="project_name">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date & Time</label>
                        <input class="form-control" type="datetime-local" value="2023-08-19T10:00:00" id="start_date"
                            name="start_date">
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date & Time</label>
                        <input class="form-control" type="datetime-local" value="2023-08-19T19:00:00" id="end_date"
                            name="end_date">
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Notes</label>
                        <textarea id="notes" name="notes" type="text" class="form-control"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" onclick="task_form_validate()" name="add_task" class="btn btn-primary">Add
                            Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View task -->

<div class="modal fade" id="exampleviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Task Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="task_view_form">
                    <div class="mb-3">
                        <label for="project_name" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="vproject_name" name="vproject_name">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="vdescription" name="vdescription">
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date & Time</label>
                        <input class="form-control" type="text" id="vstart_date" name="vstart_date">
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date & Time</label>
                        <input class="form-control" type="text" id="vend_date" name="vend_date">
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Notes</label>
                        <textarea id="vnotes" name="vnotes" type="text" class="form-control"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- 
////////////////Update modal//////////// -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Task Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="task_update_form">
                        <div class="mb-3">
                            <label for="project_name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="eproject_name" name="eproject_name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="edescription" name="edescription">
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date & Time</label>
                            <input class="form-control" type="datetime-local" value="2023-08-19T10:00:00"
                                id="estart_date" name="estart_date">
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date & Time</label>
                            <input class="form-control" type="datetime-local" value="2023-08-19T19:00:00" id="eend_date"
                                name="eend_date">
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Notes</label>
                            <textarea id="enotes" name="enotes" type="text" class="form-control"></textarea>
                        </div>

                        <div class="modal-footer">
                            <input type="hidden" id="hidden_task_id" name="hidden_task_id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" onclick="update_task_form_validate()" name="update_task"
                                id="update_task" class="btn btn-primary">Update Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



        <?php
include 'includes/footer.php';
?>


        <script>
            $(document).ready(function () {

                $.datepicker.setDefaults({
                    dateFormat: 'yy-mm-dd',
                    showButtonPanel: true
                });

                $('#from').datepicker();
                $('#to').datepicker();
               

            $('#emp_timesheet').DataTable();

                $(".view_task").click(function () {
                    let task = $(this).attr('data-task');
                    task = JSON.parse(task);
                    console.log(task.notes);

                    $("#vproject_name").val(task.project_name);
                    $("#vdescription").val(task.description);
                    $("#vstart_date").val(task.start_date);
                    $("#vend_date").val(task.end_date);
                    $("#vnotes").val(task.notes);
                    $("#exampleviewModal").modal('show');
                });

                $(".edit_task").click(function () {
                    let task = $(this).attr('data-task');
                    task = JSON.parse(task);
                    console.log(task);
                    $('#hidden_task_id').val(task.id);
                    $("#eproject_name").val(task.project_name);
                    $("#edescription").val(task.description);
                    $("#estart_date").val(task.start_date);
                    $("#eend_date").val(task.end_date);
                    $("#enotes").val(task.notes);
                    $("#editmodal").modal('show');
                });

            });

            $('#task_update_form').submit(function (e) {
                e.preventDefault();
                var id = $('#hidden_task_id').val();
                var project_name = $('#eproject_name').val();
                var description = $('#edescription').val();
                var start_date = $('#estart_date').val();
                var end_date = $('#eend_date').val();
                var notes = $('#enotes').val();
                let action =  'update_task';

                $.post('ajax.php',{id,project_name,description,start_date,end_date,notes,action},function(data){
                    data = JSON.parse(data);
                    if(data.code==1){
                        $('#task_message').removeClass('alert-danger d-none').addClass('alert-success');
                        $('#task_message .message').html(data.message);
                        
                        location.reload();
                    }else{
                    $('#edit_brand_msg').removeClass('alert-success d-none').addClass('alert-danger');
                    $('#edit_brand_msg .message').html(data.message);
                    }
                })
            });

            function task_form_validate() {
                $('#task_add_form').validate({

                    rules: {
                        project_name: {
                            required: true,
                        },
                        description: {
                            required: true,
                            maxlength: 200
                        },
                        start_date: {
                            required: true,
                        },
                        end_date: {
                            required: true,
                        },
                        notes: {
                            required: true
                        }
                    },
                    messages: {
                        project_name: {
                            required: "Please enter the project name"
                        },
                        description: {
                            required: "Please describe your task",
                            maxlength: "Words limit exceed"
                        },
                        start_date: {
                            required: "Please select the date & time"
                        },
                        end_date: {
                            required: "Please select the date & time"
                        },
                        notes: {
                            required: "This field is mandatory"
                        }
                    }
                });
            }

            function update_task_form_validate() {
                $('#task_update_form').validate({

                    rules: {
                        eproject_name: {
                            required: true,
                        },
                        edescription: {
                            required: true,
                            maxlength: 200
                        },
                        estart_date: {
                            required: true,
                        },
                        eend_date: {
                            required: true,
                        },
                        enotes: {
                            required: true
                        }
                    },
                    messages: {
                        eproject_name: {
                            required: "Please enter the project name"
                        },
                        edescription: {
                            required: "Please describe your task",
                            maxlength: "Words limit exceed"
                        },
                        estart_date: {
                            required: "Please select the date & time"
                        },
                        eend_date: {
                            required: "Please select the date & time"
                        },
                        enotes: {
                            required: "This field is mandatory"
                        }
                    }
                });
            }

            function delete_task(id){
                let action = 'delete_task';
                $.post('ajax.php',{id,action},function(data){
                    data = JSON.parse(data);
                    if(data.code==1){
                        $('#task_'+id).hide('slow');
                        $('#task_message').removeClass('alert-danger d-none').addClass('alert-success');
                        $('#task_message .message').html(data.message);
                       

                    }else{
                        $('#task_message').removeClass('alert-success d-none').addClass('alert-danger');
                        $('#task_message .message').html(data.message);
                    }
                })
            }

           
        </script>