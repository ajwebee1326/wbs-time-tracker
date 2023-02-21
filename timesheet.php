<?php 

session_start();

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
                                <div class="col-4 text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><b>+ Add New Project</b></button>
                                </div>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">Data Tables</li>
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
                                        $sql= "SELECT * FROM tbl_task  WHERE  emp_id = $emp_id" ;
                                            $tasks = $db->select($sql);

                                            $sr_no =1; 
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
                                                <a onclick=""><button class="btn btn-primary edit_btn">Edit</button></a>
                                                    <a onclick="return confirm('Do you want to delete this task')" href="timesheet.php?id=<?php echo $task['id']?>&action=delete"><button class="btn btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
                                               
                                           <?php $sr_no ++; }  ?>
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
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
  </div>
</div>

<?php
include 'includes/footer.php';
?>


<script>
    $(document).ready(function() {
        $('#emp_timesheet').DataTable();



        $(document).on('click', ".edit_btn", function(){
   
            $('#editmodal').modal('show');

        });


    });

    
    


   


    function task_form_validate(){ 
        $('#task_add_form').validate({

            rules: {
                project_name:{
                    required: true,
                },
                description:{
                    required: true,
                    maxlength: 200
                },
                start_date:{
                    required: true,
                },
                end_date:{
                    required: true,
                },
                notes:{
                    required: true
                }
            },
            messages:{
                project_name:{
                    required: "Please enter the project name"
                },
                description:{
                    required: "Please describe your task",
                    maxlength: "Words limit exceed"
                },
                start_date:{
                    required: "Please select the date & time"
                },
                end_date:{
                    required: "Please select the date & time"
                },
                notes:{
                    required: "This field is mandatory"
                }
            }
        });
    }



</script>