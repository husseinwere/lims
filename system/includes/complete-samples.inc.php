<?php
    require "dbh.inc.php";

    $project = $_GET['p'];

    $samplesPresent = false;
    $table = "";
    $table .= "
        <div class='content-table'>
            <div class='table-row head'>
                <div class='rq'>Sample</div>
                <div class='ph'>Lot no.</div>
                <div class='dposted'>Lab</div>
            </div>
    ";

    $sql = "SELECT * FROM bacteriology_samples WHERE project_code = '$project'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $samplesPresent = true;
        while($row = mysqli_fetch_assoc($result)){
            $sample_id = $row['sample_id'];
            $sample_code = $row['sample_code'];
            $ref_no = $row['ref_no'];
            $lab = $row['lab'];

            if($lab == "Mycology"){
                $labc = "mycology_samples";
            }
            else if($lab == "Entomology"){
                $labc = "entomology_samples";
            }
            else if($lab == "Nematology"){
                $labc = "nematology_samples";
            }
            else if($lab == "Bacteriology"){
                $labc = "bacteriology_samples";
            }
            else if($lab == "Virology"){
                $labc = "virology_samples";
            }
            else if($lab == "Tissue Culture"){
                $labc = "tissue_culture_samples";
            }

            $view = 'complete-sample.php?s=' . $sample_id . '&l=' . $labc;
            $table .= "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$sample_code</div>
                        <button class='link'><a href='$view'>View sample</a></button>
                    </div>
                    <div class='ph'>
                        $ref_no
                    </div>
                    <div class='dposted'>$lab</div>
                </div>
            ";
        }
    }

    $sql = "SELECT * FROM entomology_samples WHERE project_code = '$project'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $samplesPresent = true;
        while($row = mysqli_fetch_assoc($result)){
            $sample_id = $row['sample_id'];
            $sample_code = $row['sample_code'];
            $ref_no = $row['ref_no'];
            $lab = $row['lab'];

            if($lab == "Mycology"){
                $labc = "mycology_samples";
            }
            else if($lab == "Entomology"){
                $labc = "entomology_samples";
            }
            else if($lab == "Nematology"){
                $labc = "nematology_samples";
            }
            else if($lab == "Bacteriology"){
                $labc = "bacteriology_samples";
            }
            else if($lab == "Virology"){
                $labc = "virology_samples";
            }
            else if($lab == "Tissue Culture"){
                $labc = "tissue_culture_samples";
            }

            $view = 'complete-sample.php?s=' . $sample_id . '&l=' . $labc;
            $table .= "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$sample_code</div>
                        <button class='link'><a href='$view'>View sample</a></button>
                    </div>
                    <div class='ph'>
                        $ref_no
                    </div>
                    <div class='dposted'>$lab</div>
                </div>
            ";
        }
    }

    $sql = "SELECT * FROM molecular_samples WHERE project_code = '$project'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $samplesPresent = true;
        while($row = mysqli_fetch_assoc($result)){
            $sample_id = $row['sample_id'];
            $sample_code = $row['sample_code'];
            $ref_no = $row['ref_no'];
            $lab = $row['lab'];

            if($lab == "Mycology"){
                $labc = "mycology_samples";
            }
            else if($lab == "Entomology"){
                $labc = "entomology_samples";
            }
            else if($lab == "Nematology"){
                $labc = "nematology_samples";
            }
            else if($lab == "Bacteriology"){
                $labc = "bacteriology_samples";
            }
            else if($lab == "Virology"){
                $labc = "virology_samples";
            }
            else if($lab == "Tissue Culture"){
                $labc = "tissue_culture_samples";
            }
            else if($lab == "Molecular"){
                $labc = "molecular_samples";
            }

            $view = 'complete-sample.php?s=' . $sample_id . '&l=' . $labc;
            $table .= "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$sample_code</div>
                        <button class='link'><a href='$view'>View sample</a></button>
                    </div>
                    <div class='ph'>
                        $ref_no
                    </div>
                    <div class='dposted'>$lab</div>
                </div>
            ";
        }
    }

    $sql = "SELECT * FROM mycology_samples WHERE project_code = '$project'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $samplesPresent = true;
        while($row = mysqli_fetch_assoc($result)){
            $sample_id = $row['sample_id'];
            $sample_code = $row['sample_code'];
            $ref_no = $row['ref_no'];
            $lab = $row['lab'];

            if($lab == "Mycology"){
                $labc = "mycology_samples";
            }
            else if($lab == "Entomology"){
                $labc = "entomology_samples";
            }
            else if($lab == "Nematology"){
                $labc = "nematology_samples";
            }
            else if($lab == "Bacteriology"){
                $labc = "bacteriology_samples";
            }
            else if($lab == "Virology"){
                $labc = "virology_samples";
            }
            else if($lab == "Tissue Culture"){
                $labc = "tissue_culture_samples";
            }

            $view = 'complete-sample.php?s=' . $sample_id . '&l=' . $labc;
            $table .= "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$sample_code</div>
                        <button class='link'><a href='$view'>View sample</a></button>
                    </div>
                    <div class='ph'>
                        $ref_no
                    </div>
                    <div class='dposted'>$lab</div>
                </div>
            ";
        }
    }

    $sql = "SELECT * FROM nematology_samples WHERE project_code = '$project'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $samplesPresent = true;
        while($row = mysqli_fetch_assoc($result)){
            $sample_id = $row['sample_id'];
            $sample_code = $row['sample_code'];
            $ref_no = $row['ref_no'];
            $lab = $row['lab'];

            if($lab == "Mycology"){
                $labc = "mycology_samples";
            }
            else if($lab == "Entomology"){
                $labc = "entomology_samples";
            }
            else if($lab == "Nematology"){
                $labc = "nematology_samples";
            }
            else if($lab == "Bacteriology"){
                $labc = "bacteriology_samples";
            }
            else if($lab == "Virology"){
                $labc = "virology_samples";
            }
            else if($lab == "Tissue Culture"){
                $labc = "tissue_culture_samples";
            }

            $view = 'complete-sample.php?s=' . $sample_id . '&l=' . $labc;
            $table .= "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$sample_code</div>
                        <button class='link'><a href='$view'>View sample</a></button>
                    </div>
                    <div class='ph'>
                        $ref_no
                    </div>
                    <div class='dposted'>$lab</div>
                </div>
            ";
        }
    }

    $sql = "SELECT * FROM tissue_culture_samples WHERE project_code = '$project'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $samplesPresent = true;
        while($row = mysqli_fetch_assoc($result)){
            $sample_id = $row['sample_id'];
            $sample_code = $row['sample_code'];
            $ref_no = $row['ref_no'];
            $lab = $row['lab'];

            if($lab == "Mycology"){
                $labc = "mycology_samples";
            }
            else if($lab == "Entomology"){
                $labc = "entomology_samples";
            }
            else if($lab == "Nematology"){
                $labc = "nematology_samples";
            }
            else if($lab == "Bacteriology"){
                $labc = "bacteriology_samples";
            }
            else if($lab == "Virology"){
                $labc = "virology_samples";
            }
            else if($lab == "Tissue Culture"){
                $labc = "tissue_culture_samples";
            }

            $view = 'complete-sample.php?s=' . $sample_id . '&l=' . $labc;
            $table .= "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$sample_code</div>
                        <button class='link'><a href='$view'>View sample</a></button>
                    </div>
                    <div class='ph'>
                        $ref_no
                    </div>
                    <div class='dposted'>$lab</div>
                </div>
            ";
        }
    }

    $sql = "SELECT * FROM virology_samples WHERE project_code = '$project'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $samplesPresent = true;
        while($row = mysqli_fetch_assoc($result)){
            $sample_id = $row['sample_id'];
            $sample_code = $row['sample_code'];
            $ref_no = $row['ref_no'];
            $lab = $row['lab'];

            if($lab == "Mycology"){
                $labc = "mycology_samples";
            }
            else if($lab == "Entomology"){
                $labc = "entomology_samples";
            }
            else if($lab == "Nematology"){
                $labc = "nematology_samples";
            }
            else if($lab == "Bacteriology"){
                $labc = "bacteriology_samples";
            }
            else if($lab == "Virology"){
                $labc = "virology_samples";
            }
            else if($lab == "Tissue Culture"){
                $labc = "tissue_culture_samples";
            }

            $view = 'complete-sample.php?s=' . $sample_id . '&l=' . $labc;
            $table .= "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$sample_code</div>
                        <button class='link'><a href='$view'>View sample</a></button>
                    </div>
                    <div class='ph'>
                        $ref_no
                    </div>
                    <div class='dposted'>$lab</div>
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
?>