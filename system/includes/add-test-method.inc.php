<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require 'dbh.inc.php';

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $acronym = mysqli_real_escape_string($conn, $_POST['acronym']);
        $lab = mysqli_real_escape_string($conn, $_POST['lab']);
        
        $sql = "SELECT * FROM test_methods WHERE acronym = '$acronym'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            echo json_encode(array(
                'message' => 'acronymexists'
            ));
        }
        else {
            $sql = "INSERT INTO test_methods(acronym, name, lab)
                                VALUES('$acronym', '$name', '$lab')";
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