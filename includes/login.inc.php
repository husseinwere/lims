<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    require 'dbh.inc.php';

    $username = $_POST['username'];
    $designation = $_POST['designation'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 0) {
        echo json_encode(array(
            'message' => 'nouser'
        ));
    }
    else {
        $row = mysqli_fetch_assoc($result);

        if($row['designation'] != $designation){
            echo json_encode(array(
                'message' => 'wrongdesignation'
            ));
        }
        else{
            $passwordCheck = password_verify($password, $row['password']);
            if($passwordCheck)
            {
                session_start();
                $_SESSION['pqsuser'] = $row['username'];
                $_SESSION['designation'] = $row['designation'];

                echo json_encode(array(
                    'message' => 'success'
                ));
            }
            else {
                echo json_encode(array(
                    'message' => 'wrongpassword'
                ));
            }
        }
    }
?>