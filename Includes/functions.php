<?php

function checkAuth(){

    if(!isset($_SESSION['email'])){
        header('location:login.php');
        exit;
    }
}


?>