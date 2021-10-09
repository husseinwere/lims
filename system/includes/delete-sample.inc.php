<?php
    session_start();
    
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require "dbh.inc.php";

        $sample = $_GET['s'];
        $lab = $_GET['l'];

        $sql = "SELECT * FROM " . $lab . " WHERE sample_id = '$sample'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $sample_code = $row['sample_code'];

            $sql = "DELETE FROM lab_tests WHERE sample_code = '$sample_code'";
            if(mysqli_query($conn, $sql)){
                $sql = "DELETE FROM " . $lab . " WHERE sample_id = '$sample'";
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
                    'message' => 'error'
                ));
            }
        }
    }
?>