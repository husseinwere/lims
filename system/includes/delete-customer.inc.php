<?php
    session_start();
    
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require "dbh.inc.php";

        $customer_id = $_POST['customer_id'];

        $sql = "DELETE FROM customers WHERE customer_id = '$customer_id'";
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