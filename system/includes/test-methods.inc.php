<?php
    require "dbh.inc.php";

    $sql = "SELECT * FROM test_methods ORDER BY lab";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "
            <div class='content-table'>
                <div class='table-row head'>
                    <div class='rq'>Name</div>
                    <div class='ph'>Lab</div>
                </div>
        ";

        while($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $acronym = $row['acronym'];
            $lab = $row['lab'];

            echo "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$name</div>
                        <span class='thethorn'>$acronym</span>
                        <button class='link del' id='d$acronym'>Delete</button>
                    </div>
                    <div class='ph'>
                        $lab
                    </div>
                </div>
                <script>
                    $('#d$acronym').click(()=>{
                        if(window.confirm('Permanently delete this test method?')){
                            $('#d$acronym').html('<img src=img/35.gif class=button-loader>')
                            $.ajax({
                                type: 'POST',
                                url: 'includes/delete-test-method.inc.php',
                                data: {acronym: '$acronym'}, 
                                success: (data)=>{
                                    data = JSON.parse(data)
                                    if(data.message == 'success'){
                                        toastr.success('Test method deleted successfully')
                                        $('#test-methods').load('includes/test-methods.inc.php')
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
        echo "<div class='info'>There are no test methods to display. <a href='add-test-method.php'>Add</a> now.</div>";
    }
?>