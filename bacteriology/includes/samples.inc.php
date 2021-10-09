<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"){
        require "dbh.inc.php";

        $project = $_GET['p'];
        $lab = $_SESSION['designation'];

        $samplesPresent = false;
        $table = "
            <div class='content-table'>
                <div class='table-row head'>
                    <div class='rq'>Sample</div>
                    <div class='ph'>Test Method</div>
                    <div class='dposted'>Results</div>
                </div>
        ";

        $sql = "SELECT * FROM lab_tests WHERE project_code = '$project' AND lab = '$lab'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $samplesPresent = true;
            while($row = mysqli_fetch_assoc($result)){
                $test_id = $row['test_id'];
                $sample_code = $row['sample_code'];
                $test_method = $row['test_method'];
                $results = $row['results'];

                $labc = 'bacteriology_samples';

                $sql = "SELECT * FROM " . $labc . " WHERE sample_code = '$sample_code'";
                $result2 = mysqli_query($conn, $sql);
                $row2 = mysqli_fetch_assoc($result2);
                $sample_id = $row2['sample_id'];

                $view = 'sample.php?s=' . $sample_id . '&l=' . $labc;
                $record = 'record-results.php?t=' . $test_id;

                $table .= "
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>$sample_code</div>
                            <button class='link'><a href='$view'>Sample details</a></button>
                            <button class='link'><a href='$record'>Record results</a></button>
                        </div>
                        <div class='ph'>
                            $test_method
                        </div>
                        <div class='dposted'>$results</div>
                    </div>
                ";
            }
        }

        

        $table .= "</div>";

        if($samplesPresent){
            echo $table;
        }
        else {
            echo "<div class='info'>There are no samples received for this project.</div>";
        }
    }
?>