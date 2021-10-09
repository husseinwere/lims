<?php
    session_start();
    
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require "dbh.inc.php";

        $project_code = $_GET['p'];

        $sql = "DELETE FROM lab_tests WHERE project_code = '$project_code'";
        if(mysqli_query($conn, $sql)){
            $sql = "DELETE FROM projects WHERE project_code = '$project_code'";
            if(mysqli_query($conn, $sql)){
                echo json_encode(array(
                    'message' => 'success'
                ));
            }
        }
        else {
            echo json_encode(array(
                'message' => 'error'
            ));
        }
    }
?>