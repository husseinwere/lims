<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"){
        require 'dbh.inc.php';

        $test_id = $_GET['t'];
        $results = mysqli_real_escape_string($conn, $_POST['results']);
        $lab = $_SESSION['designation'];
        $user = $_SESSION['pqsuser'];
        
        $sql = "SELECT * FROM lab_tests WHERE test_id = '$test_id' AND lab = '$lab'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $project_code = $row['project_code'];

            $sql = "UPDATE lab_tests SET results = '$results', recorded_by = '$user' WHERE test_id = '$test_id'";
            if(mysqli_query($conn, $sql)){
                echo json_encode(array(
                    'message' => 'success',
                    'project' => $project_code
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
                'message' => 'error-2'
            ));
        }
    }
?>