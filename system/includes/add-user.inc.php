<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require 'dbh.inc.php';

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $designation = mysqli_real_escape_string($conn, $_POST['designation']);
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            echo json_encode(array(
                'message' => 'userexists'
            ));
        }
        else {
            $sql = "INSERT INTO users(firstname, lastname, username, email, designation, password)
                                VALUES('$firstname', '$lastname', '$username', '$email', '$designation', '$password')";
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
    }
?>