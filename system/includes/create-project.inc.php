<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require 'dbh.inc.php';

        $created_by = $_SESSION['pqsuser'];
        $customer = mysqli_real_escape_string($conn, $_POST['customer']);
        $amount_charged = mysqli_real_escape_string($conn, $_POST['amount_charged']);
        $receipt_no = mysqli_real_escape_string($conn, $_POST['receipt_no']);
        $sample_amount = mysqli_real_escape_string($conn, $_POST['sample_amount']);
        $report_format = mysqli_real_escape_string($conn, $_POST['report_format']);
        $results_dispatch = mysqli_real_escape_string($conn, $_POST['results_dispatch']);
        
        if(empty($customer) || $customer == "--SELECT--"){
            echo json_encode(array(
                'message' => 'nocustomer'
            ));
        }
        else {
            $sql = "SELECT * FROM projects ORDER BY created DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $project_id = $row['project_id'] + 1;

            $month = date('m');
            $month = (int)$month;
            $months = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
            $m = $months[$month-1];

            $length = 3;
            $id = substr(str_repeat(0, $length).$project_id, - $length);
            $order_no = "PQS-" . date("Y") . "-" .$m . "-" . $id;
            
            $sql = "INSERT INTO projects(project_id, project_code, customer_id, sample_amount, report_format, results_dispatch, amount_charged, receipt_no, created_by)
                                VALUES('$project_id', '$order_no', '$customer', '$sample_amount', '$report_format', '$results_dispatch', '$amount_charged', '$receipt_no', '$created_by')";
            if(mysqli_query($conn, $sql)){
                echo json_encode(array(
                    'message' => 'success',
                    'id' => $order_no
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