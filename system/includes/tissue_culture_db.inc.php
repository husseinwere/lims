<?php
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require 'dbh.inc.php';

        date_default_timezone_set ('Africa/Nairobi');
        $date = date("Y-m-d");

        $table = "
            <table id='TISSUE-CULTURE_$date' class='dataTable'>
                <tr>
                    <th>$date</th>
                </tr>
                <tr>
                    <th><b>LAB ORDER NO</b></th>
                    <th>SAMPLE CODE</th>
                    <th>LABORATORY</th>
                    <th>LOT NO</th>
                    <th>CLIENT</th>
                    <th>ADDITIONAL INFO</th>
                    <th>SAMPLE TYPE</th>
                    <th>SAMPLE ORIGIN</th>
                    <th>SAMPLE VARIETY</th>
                    <th>TEST METHOD</th>
                    <th>SAMPLED BY</th>
                    <th>RECEIVED BY</th>
                    <th>DATE RECEIVED</th>
                    <th>CATEGORY</th>
                    <th>INVOICE</th>
                    <th>CHARGES</th>
                    <th>RECEIPT</th>
                </tr>
        ";

        $sql = "SELECT * FROM lab_tests WHERE lab = 'Tissue Culture'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $project_code = $row['project_code'];
            $sample_code = $row['sample_code'];
            $lab = $row['lab'];
            $test_method = $row['test_method'];

            $sql = "SELECT * FROM projects WHERE project_code = '$project_code'";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $amount_charged = $row2['amount_charged'];
            $receipt_no = $row2['receipt_no'];
            $invoice = $row2['invoice'];
            $customer_id = $row2['customer_id'];

            $sql = "SELECT * FROM customers WHERE customer_id = '$customer_id'";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $customer = $row2['company_name'];

            $sql = "SELECT * FROM tissue_culture_samples WHERE sample_code = '$sample_code'";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $ref_no = isset($row2['ref_no']) ? $row2['ref_no'] : 0;
            $sample_type = isset($row2['sample_type']) ? $row2['sample_type'] : 0;
            $sample_variety = isset($row2['sample_variety']) ? $row2['sample_variety'] : 0;
            $sample_origin = isset($row2['sample_origin']) ? $row2['sample_origin'] : 0;
            $date_received = isset($row2['date_received']) ? $row2['date_received'] : 0;
            $received_by = isset($row2['received_by']) ? $row2['received_by'] : 0;
            $sampler = isset($row2['sampler']) ? $row2['sampler'] : 0;
            $sample_description = isset($row2['sample_description']) ? $row2['sample_description'] : 0;
            $additional_info = isset($row2['additional_info']) ? $row2['additional_info'] : 0;

            $table .= "
                <tr>
                    <td>$project_code</td>
                    <td>$sample_code</td>
                    <td>$lab</td>
                    <td>$ref_no</td>
                    <td>$customer</td>
                    <td>$additional_info</td>
                    <td>$sample_type</td>
                    <td>$sample_origin</td>
                    <td>$sample_variety</td>
                    <td>$test_method</td>
                    <td>$sampler</td>
                    <td>$received_by</td>
                    <td>$date_received</td>
                    <td>$sample_description</td>
                    <td>$invoice</td>
                    <td>$amount_charged</td>
                    <td>$receipt_no</td>
                </tr>
            ";
        }

        $table .= "</table>";

        echo json_encode(array(
            'message' => 'success',
            'data' => $table
        ));
    }
?>