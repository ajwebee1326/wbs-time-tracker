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

if(isset($_GET['action'])&& $_GET['action']=='delete' && !empty($_GET['id'])) {

    $id = $_GET['id'];
    $sql = "DELETE FROM `tbl_task` WHERE id = $id " ;

    if($db->delete($sql)){

        $msg = "Task removed successfully";
        header('Location: timesheet.php');
    }else{
        $msg = "Something went wrong";
    }

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
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST" id="task_form">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Client Name</label>
                                    <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Client Name">
                                </div>
                                <div class="col-3">
                                    <label for="">Task Description</label>
                                    <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                                </div>
                                <div class="col-3">
                                    <label for="">Hours</label>
                                    <input type="number" name="hours" id="hours" class="form-control" placeholder="Hours">
                                </div>
                                <div class="col-3">
                                    <label for="">Minutes</label>
                                    <input type="number" name="minutes" id="minutes" class="form-control" placeholder="Minutes">
                                </div>
                                <input type="hidden" name="action" id="action" value="create_task">
                                <input type="hidden" name="task_id" id="task_id" value="">
                                <div class="col-3 mt-3">
                                    <button class="btn btn-primary action_btn">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

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
                                        <th>Hours</th>
                                        <th>Minutes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                $filter = false;

                                $emp_id = $_SESSION['emp_id'];

                                if(isset($_GET['filter']) && $_GET['filter'] != '' && $_GET['filter'] != null){
                                    $filter_req = strtoupper($_GET['filter']);
                                    $filter = "`date_created` > DATE_SUB(NOW(), INTERVAL 1 $filter_req)";
                                }

                                if(isset($_GET['from']) && $_GET['from'] != '' && $_GET['from'] != null && isset($_GET['to']) && $_GET['to'] != null && $_GET['to']!=""){
                                    $from = $_GET['from'];
                                    $to = $_GET['to'];
                                    $filter = "date_created >= '$from' AND date_created <= '$to'";
                                }

                                if($filter){
                                    $sql= "SELECT * FROM tbl_task  WHERE  emp_id = $emp_id AND $filter" ;
                                }else{
                                    $sql= "SELECT * FROM tbl_task  WHERE  emp_id = $emp_id" ;
                                }
                                $tasks = $db->select($sql);
                                if($tasks):
                                foreach ($tasks as $task) { ?>
                                    <tr id="task_<?php echo $task['id']?>">

                                        <?php $taskid = $task['id'] ?>
                                        <td>
                                            <?php echo $taskid  ?>
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
                                        <td>
                                            <button class="btn btn-secondary view_task">View</button>
                                            <button class="btn btn-primary edit_task" data-task='<?php echo json_encode($task);?>'>Edit</button>
                                            <button class="btn btn-danger" onclick="delete_task(<?php echo $task['id']?>)">Delete</button>
                                        </td>
                                    </tr>

                                    <?php  } endif;  ?>
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


<?php include 'includes/footer.php'; ?>


<script>
    $(document).ready(function () {
        $('#emp_timesheet').DataTable();
    });

    $("#task_form").submit(function(e){
        e.preventDefault();
        let client_name = $('#client_name').val();
        let description = $('#description').val();
        let hours = $('#hours').val();
        let minutes = $('#minutes').val();
        let action = $('#action').val();
        let id = $('#task_id').val();
        $.post('ajax.php',{client_name,description,hours,minutes,action,id},function(data){
            data = JSON.parse(data);
            if(data.code==1){
                if(action=='create_task'){
                    $('#emp_timesheet tbody').append(data.html);
                    console.log(data.html);
                }else{
                    $('#task_'+id).replaceWith(data.html);
                    $(".action_btn").html("Add");
                }
                $('#task_form')[0].reset();
                $('#action').val('create_task');
                $('#task_id').val('');
            }else{
                alert('Something went wrong');
            }
        })
    });
        
    function delete_task(id){
        let action = 'delete_task';
        $.post('ajax.php',{id,action},function(data){
            data = JSON.parse(data);
            if(data.code==1){
                $('#task_'+id).hide('slow');
            }else{
                alert('Something went wrong');
            }
        })
    }


    $(document).on('click','.edit_task',function(e){
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

</script>