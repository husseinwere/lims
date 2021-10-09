<?php
    require "dbh.inc.php";

    $sql = "SELECT * FROM projects WHERE status = 'incomplete' ORDER BY created DESC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "
            <div class='content-table'>
                <div class='table-row head'>
                    <div class='rq'>Order No.</div>
                    <div class='ph'>Client</div>
                    <div class='dposted'>Received on</div>
                </div>
        ";

        while($row = mysqli_fetch_assoc($result)){
            $project_code = $row['project_code'];
            $customer_id = $row['customer_id'];
            $created = DateTime::createFromFormat ( "Y-m-d H:i:s", $row["created"] );
            $created = $created->format('l jS F Y');

            $sql = "SELECT * FROM customers WHERE customer_id = '$customer_id'";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $cname = $row2['company_name'];

            $view = 'project.php?p=' . $project_code;
            echo "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$project_code</div>
                        <button class='link'><a href='$view'>View project</a></button>
                        <button class='link' id='c$project_code' style='color: green'>Mark as complete</button>
                    </div>
                    <div class='ph'>
                        $cname
                    </div>
                    <div class='dposted'>$created</div>
                </div>
                <script>
                    $('#c$project_code').click(()=>{
                        if(window.confirm('Mark project as completed?')){
                            $('#c$project_code').html('<img src=img/35.gif class=button-loader>')
                            $.ajax({
                                type: 'GET',
                                url: 'includes/mark-complete.inc.php?p=$project_code',
                                success: (data)=>{
                                    data = JSON.parse(data)
                                    if(data.message == 'success'){
                                        toastr.success('Project marked as completed')
                                        $('#c$project_code').html('Export database')
                                        location.reload()
                                    }
                                    else {
                                        toastr.error('Error. Please try again')
                                        $('#c$project_code').html('Export database')
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
        echo "<div class='info'>There are no projects to display.</div>";
    }
?>