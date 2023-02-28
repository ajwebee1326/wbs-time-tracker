
<?php

include('config.php');

include 'includes/DB.php';

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);

        $data = $google_service->userinfo->get();

        $email = $data['email'];

        $db = new DB();

        $sql = "SELECT * FROM tbl_employee WHERE emp_email = '$email'";

        $result = $db->query($sql);

        if (mysqli_num_rows($result) > 0) {

            session_start();

            $employee = mysqli_fetch_assoc($result);

            $_SESSION['emp_id'] = $employee['id'];
            $_SESSION['name'] = $employee['emp_name'];
            $_SESSION['designation'] = $employee['emp_designation'];
            $_SESSION['email'] = $employee['emp_email'];
            $_SESSION['mobile'] = $employee['emp_mob'];
            $_SESSION['dept'] = $employee['emp_dept'];
            $_SESSION['rm'] = $employee['emp_rm'];
            $_SESSION['emp_role'] = $employee['emp_role'];

            header('Location: index.php');
        }else{
            echo "Unauthorized Login";
        }
    }
}
