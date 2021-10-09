<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require 'dbh.inc.php';

        $customer_id = $_GET['c'];

        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $customer_category = mysqli_real_escape_string($conn, $_POST['customer_category']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
        $group_name = mysqli_real_escape_string($conn, $_POST['group_name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        
        $sql = "SELECT * FROM customers WHERE customer_id = '$customer_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $name = $row['company_name'];
        if($name != $company_name) {
            $sql = "SELECT * FROM customers WHERE company_name = '$company_name'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                echo json_encode(array(
                    'message' => 'customerexists'
                ));
                exit();
            }
        }
        $sql = "UPDATE customers SET company_name = '$company_name', customer_type = '$type', customer_category = '$customer_category', description = '$description',
                                     address = '$address', alt_address = '$address2', phone = '$phone', email = '$email' WHERE customer_id = '$customer_id'";
        if(mysqli_query($conn, $sql)){
            echo json_encode(array(
                'message' => 'success'
            ));
        }
        else {
            echo json_encode(array(
                'message' => 'wrongpassword'
            ));
        }
    }
?>