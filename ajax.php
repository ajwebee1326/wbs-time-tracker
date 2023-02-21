<?php 

include 'includes/header.php';
include 'includes/functions.php';
include 'includes/DB.php';

checkAuth();
$msg = false;
$db = new DB();

if(isset($_POST['projectname'])){

   
    $id   = $_POST['hidden_task_id'];

    echo $id;
    exit;
    $projectname = $_POST['eproject_name'];
    $description = $_POST['edescription'];
    $start_date = $_POST['estart_date'];
    $end_date = $_POST['eend_date'];
    $notes = $_POST['enotes'];

    $sql= "UPDATE `tbl_task` SET `project_name`='$projectname',`description`='$description',`start_date`='$start_date',`end_date`='$end_date',`notes`='$notes' WHERE id=$id";

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