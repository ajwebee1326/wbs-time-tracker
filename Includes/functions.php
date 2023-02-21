<?php

function checkAuth(){

    if(!isset($_SESSION['email'])){
        header('location:login.php');
        exit;
    }
}

function is_admin(){
    if($_SESSION['emp_role'] == '1'){
        return true;
    }
    return false;
}

function is_manager(){
    if($_SESSION['emp_role'] == '4'){
        return true;
    }
    return false;
}

function is_employee(){
    if($_SESSION['emp_role'] == '3'){
        return true;
    }
    return false;
}

function is_hr(){
    if($_SESSION['emp_role'] == '2'){
        return true;
    }
    return false;
}


?>