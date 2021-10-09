<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require 'dbh.inc.php';

        $sql = "SELECT * FROM customers";
        $result = mysqli_query($conn, $sql);

        $customers = "<option value='0' selected>--SELECT--</option>";
        while($row = mysqli_fetch_assoc($result)){
            $company_name = $row['company_name'];
            $customer_id = $row['customer_id'];

            $customers .= "<option value='$customer_id'>$company_name</option>";
        }

        echo json_encode(array(
            'message' => 'success',
            'customers' => $customers
        ));
    }
?>