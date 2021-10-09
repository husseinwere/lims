<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    require 'dbh.inc.php';

    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = '$password' WHERE username = '$username'";
            if(mysqli_query($conn, $sql)){
                echo json_encode(array(
                    'message' => 'success'
                ));
            }
            else {
                echo json_encode(array(
                    'message' => 'error'
                ));
            }
        }
        else {
            echo json_encode(array(
                'message' => 'nouser'
            ));
        }
    }
?>