<?php
    session_start();
    
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"){
        require "dbh.inc.php";

        $acronym = $_POST['acronym'];

        $sql = "DELETE FROM test_methods WHERE acronym = '$acronym'";
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