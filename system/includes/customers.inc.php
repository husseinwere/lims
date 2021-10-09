<?php
    require "dbh.inc.php";

    $sql = "SELECT * FROM customers";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "
            <div class='content-table'>
                <div class='table-row head'>
                    <div class='rq'>Customer</div>
                    <div class='ph'>Contact</div>
                    <div class='dposted'>Address</div>
                </div>
        ";

        while($row = mysqli_fetch_assoc($result)){
            $customer_id = $row['customer_id'];
            $name = $row['company_name'];
            $address = $row['address'];
            $phone = $row['phone'];
            $email = $row['email'];

            $edit = 'edit-customer.php?c=' . $customer_id;
            echo "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$name</div>
                        <button class='link'><a href='$edit'>Edit</a></button>
                        <button class='link del' id='d$customer_id'>Delete</button>
                    </div>
                    <div class='ph'>
                        $phone
                        <span class='thethorn'>$email</span>
                    </div>
                    <div class='dposted'>$address</div>
                </div>
                <script>
                    $('#d$customer_id').click(()=>{
                        if(window.confirm('Permanently delete this customer?')){
                            $('#d$customer_id').html('<img src=img/35.gif class=button-loader>')
                            $.ajax({
                                type: 'POST',
                                url: 'includes/delete-customer.inc.php',
                                data: {customer_id: $customer_id}, 
                                success: (data)=>{
                                    data = JSON.parse(data)
                                    if(data.message == 'success'){
                                        toastr.success('Customer deleted successfully')
                                        $('#customers').load('includes/customers.inc.php')
                                    }
                                }
                            })
                        }
                    })
                </script>
            ";
        }

        echo "</div>";
    }
    else {
        echo "<div class='info'>There are no customers to display. <a href='add-customer.php'>Add</a> now.</div>";
    }
?>