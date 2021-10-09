<?php
    session_start();
    //SELECT DISTINCT PROJECT FROM LAB TESTS. THEN SELECT THE PROJECTS FROM PROJECTS
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"){
        require "dbh.inc.php";
        $lab = $_SESSION['designation'];

        $projectsPresent = false;
        $table = "
            <div class='content-table'>
                <div class='table-row head'>
                    <div class='rq'>Order No.</div>
                    <div class='ph'>Client</div>
                    <div class='dposted'>Tests</div>
                </div>
        ";
        $sql = "SELECT DISTINCT project_code FROM lab_tests WHERE lab = '$lab'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $projectsPresent = true;
            $project_code = $row['project_code'];

            $sql = "SELECT * FROM projects WHERE project_code = '$project_code'";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $customer_id = $row2['customer_id'];
            $status = $row2['status'];

            $sql = "SELECT * FROM lab_tests WHERE project_code = '$project_code' AND lab = '$lab'";
            $result2 = mysqli_query($conn, $sql);
            $tests = mysqli_num_rows($result2);

            $sql = "SELECT * FROM customers WHERE customer_id = '$customer_id'";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $cname = isset($row2['company_name']) ? $row2['company_name'] : 0;

            $view = 'project.php?p=' . $project_code;
            if($status == 'incomplete'){
                $table .= "
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>$project_code</div>
                            <button class='link'><a href='$view'>View project</a></button>
                        </div>
                        <div class='ph'>
                            $cname
                        </div>
                        <div class='dposted'>$tests</div>
                    </div>
                ";
            }
        }

        $table .= "</div>";

        if($projectsPresent){
            echo $table;
        }
        else {
            echo "<div class='info'>There are no projects to display.</div>";
        }
    }
?>