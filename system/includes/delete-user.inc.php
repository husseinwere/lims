<?php
    session_start();
    
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require "dbh.inc.php";

        $username = $_POST['username'];

        $sql = "DELETE FROM users WHERE username = '$username'";
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
?>