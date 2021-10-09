<?php
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require 'dbh.inc.php';

        date_default_timezone_set ('Africa/Nairobi');
        $date = date("Y-m-d");

        $table = "
            <table id='CUSTOMERS_$date' class='dataTable'>
                <tr>
                    <th>$date</th>
                </tr>
                <tr>
                    <th>NAME</th>
                    <th>CATEGORY</th>
                    <th>PHONE</th>
                    <th>EMAIL</th>
                    <th>ADDRESS</th>
                </tr>
        ";

        $sql = "SELECT * FROM customers";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $company_name = $row['company_name'];
            $category = $row['customer_category'];
            $phone = $row['phone'];
            $email = $row['email'];
            $address = $row['address'];

            $table .= "
                <tr>
                    <td>$company_name</td>
                    <td>$category</td>
                    <td>$phone</td>
                    <td>$email</td>
                    <td>$address</td>
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