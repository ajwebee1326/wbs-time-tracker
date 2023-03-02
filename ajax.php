<?php 
include 'includes/functions.php';
include 'includes/DB.php';
session_start();
if(!isset($_SESSION['email'])){
    exit;
}

$msg = false;
$db = new DB();
// add task
if(isset($_POST['action']) && $_POST['action']=='create_task'){
    $client_name = $_POST['client_name'];
    $description = $_POST['description'];
    $hours = $_POST['hours'];
    $minutes = $_POST['minutes'];
    $emp_id = $_SESSION['emp_id'];

    $sql = "INSERT INTO `tbl_task`(`emp_id`,`client_name`, `description`, `hours`, `minutes`) VALUES ('$emp_id','$client_name','$description','$hours','$minutes')";
    if($db->insert($sql)){
        $task = $db->query("SELECT * FROM tbl_task WHERE id='".$db->last_insert_id."'");
        $task = mysqli_fetch_assoc($task);

       $tr = '<tr id="task_'.$db->last_insert_id.'">
                    <td>'.$db->last_insert_id.'</td>
                    <td>'.$client_name.'</td>
                    <td>'.$description.'</td>
                    <td>'.$hours.'</td>
                    <td>'.$minutes.'</td>
                    <td>
                        <button class="btn btn-secondary view_task"><span class="fa fa-eye"></span></button>
                        <button class="btn btn-primary edit_task" data-task='. json_encode($task,true) .' ><span class="fa fa-pencil"></span></button>
                        <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_task('.$db->last_insert_id.')"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>';
        $return_array =  array(
            'code'=>1,
            'message'=>'Task Created',
            'html'=>$tr
        );
        }else{
            $return_array =  array(
                'code'=>0,
                'message'=>'Something went wrong'
            );
        }
        echo json_encode($return_array);exit;
    }

// update task
if(isset($_POST['action']) && $_POST['action']=='update_task'){
    $id = $_POST['id'];
    $client_name = $_POST['client_name'];
    $description = $_POST['description'];
    $hours = $_POST['hours'];
    $minutes = $_POST['minutes'];
    $emp_id = $_SESSION['emp_id'];
    $task = $db->query("SELECT * FROM tbl_task WHERE id='".$id."'");
    $task = mysqli_fetch_assoc($task);

    $sql = "UPDATE `tbl_task` SET `client_name`='$client_name',`description`='$description',`hours`='$hours',`minutes`='$minutes' WHERE id='$id'";
    if($db->update($sql)){
        $tr = '<tr id="task_'.$id.'">
                    <td>'.$id.'</td>
                    <td>'.$client_name.'</td>
                    <td>'.$description.'</td>
                    <td>'.$hours.'</td>
                    <td>'.$minutes.'</td>
                    <td>
                        <button class="btn btn-secondary view_task"><span class="fa fa-eye"></span></button>
                        <button class="btn btn-primary edit_task" data-task='. json_encode($task,true) .' ><span class="fa fa-pencil"></span></button>
                        <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_task('.$id.')"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>';
        $return_array =  array(
            'code'=>1,
            'message'=>'Task Updated',
            'html'=>$tr
        );
    }
    else{
        $return_array =  array(
            'code'=>0,
            'message'=>'Something went wrong'
        );
    }
    echo json_encode($return_array);exit;
}
        

// delete task

if(isset($_POST['id']) &&  $_POST['action'] == 'delete_task' ){
   
    $id = $_POST['id'];
    $sql= "DELETE FROM `tbl_task` WHERE id='$id'";

    if($db->delete($sql)){
        $return_array =  array(
            'code'=>1,
            'message'=>'Deleted Successfully'
        );
        
    }else{
        $return_array =  array(
            'code'=>0,
            'message'=>'Something went wrong'
        );
    }

    echo json_encode($return_array);exit;
    
}

