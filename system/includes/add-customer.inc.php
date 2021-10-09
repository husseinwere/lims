<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require 'dbh.inc.php';

        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $customer_category = mysqli_real_escape_string($conn, $_POST['customer_category']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        
        $sql = "SELECT * FROM customers WHERE company_name = '$company_name'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            echo json_encode(array(
                'message' => 'customerexists'
            ));
        }
        else {
            $sql = "INSERT INTO customers(company_name, customer_type, customer_category, description, address, alt_address, phone, email)
                                VALUES('$company_name', '$type', '$customer_category', '$description', '$address', '$address2', '$phone', '$email')";
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