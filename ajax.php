<?php 
include 'includes/functions.php';
include 'includes/DB.php';
session_start();
if(!isset($_SESSION['email'])){
    exit;
}

$msg = false;
$db = new DB();

if(isset($_POST['project_name']) &&  $_POST['action'] == 'update_task' ){
   
    $id = $_POST['id'];
    $projectname = $_POST['project_name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $notes = $_POST['notes'];

    $sql= "UPDATE `tbl_task` SET `project_name`='$projectname',`description`='$description',`start_date`='$start_date',`end_date`='$end_date',`notes`='$notes' WHERE id='$id'";

    if($db->update($sql)){
        $return_array =  array(
            'code'=>1,
            'message'=>'Updated'
        );
        
    }else{
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
            'message'=>'Deleted'
        );
        
    }else{
        $return_array =  array(
            'code'=>0,
            'message'=>'Something went wrong'
        );
    }

    echo json_encode($return_array);exit;
    
}