<?php
    require "dbh.inc.php";

    $sql = "SELECT * FROM projects WHERE status = 'complete' ORDER BY project_id DESC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "
            <div class='content-table'>
                <div class='table-row head'>
                    <div class='rq'>Order No.</div>
                    <div class='ph'>Client</div>
                    <div class='dposted'>Created on</div>
                </div>
        ";

        while($row = mysqli_fetch_assoc($result)){
            $project_code = $row['project_code'];
            $customer_id = $row['customer_id'];
            $created = $row['created'];

            $sql = "SELECT * FROM customers WHERE customer_id = '$customer_id'";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $cname = $row2['company_name'];

            $view = 'complete-project.php?p=' . $project_code;
            echo "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$project_code</div>
                        <button class='link'><a href='$view'>View project</a></button>
                    </div>
                    <div class='ph'>
                        $cname
                    </div>
                    <div class='dposted'>$created</div>
                </div>
            ";
        }

        echo "</div>";
    }
    else {
        echo "<div class='info'>There are no projects to display.</div>";
    }
?>