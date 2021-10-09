<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require 'dbh.inc.php';

        $user = $_SESSION['pqsuser'];
        $project = mysqli_real_escape_string($conn, $_POST['project']);
        $ref_no = mysqli_real_escape_string($conn, $_POST['ref_no']);
        $sampled_by = mysqli_real_escape_string($conn, $_POST['sampled_by']);
        $date_sampled = mysqli_real_escape_string($conn, $_POST['date_sampled']);
        $date_received = mysqli_real_escape_string($conn, $_POST['date_received']);
        $sample_type = mysqli_real_escape_string($conn, $_POST['sample_type']);
        $sample_variety = mysqli_real_escape_string($conn, $_POST['sample_variety']);
        $sample_origin = mysqli_real_escape_string($conn, $_POST['sample_origin']);
        $sample_description = mysqli_real_escape_string($conn, $_POST['sample_description']);
        $sample_size = mysqli_real_escape_string($conn, $_POST['sample_size']);
        $sample_condition = mysqli_real_escape_string($conn, $_POST['sample_condition']);
        $part_submitted = mysqli_real_escape_string($conn, $_POST['part_submitted']);
        $sampling_bag = mysqli_real_escape_string($conn, $_POST['sampling_bag']);
        $additional_info = mysqli_real_escape_string($conn, $_POST['additional_info']);
        $test_methods = mysqli_real_escape_string($conn, $_POST['test_methods']);

        if(empty($ref_no) || empty($test_methods)){
            echo json_encode(array(
                'message' => 'emptyfields'
            ));
        }
        else {
            $test_methods = explode(',', $test_methods);

            for($i=0; $i<count($test_methods); $i++){
                $test_method = $test_methods[$i];

                $sql = "SELECT * FROM test_methods WHERE acronym = '$test_method'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $test_method = $row['name'];
                $lab = $row['lab'];

                if($lab == "Mycology"){
                    $lab_table = "mycology_samples";
                }
                else if($lab == "Entomology"){
                    $lab_table = "entomology_samples";
                }
                else if($lab == "Nematology"){
                    $lab_table = "nematology_samples";
                }
                else if($lab == "Bacteriology"){
                    $lab_table = "bacteriology_samples";
                }
                else if($lab == "Virology"){
                    $lab_table = "virology_samples";
                }
                else if($lab == "Tissue Culture"){
                    $lab_table = "tissue_culture_samples";
                }
                else if($lab == "Molecular"){
                    $lab_table = "molecular_samples";
                }

                //INSERT SAMPLE IN SAMPLES TABLE
                $sql = "SELECT * FROM " . $lab_table . " WHERE ref_no = '$ref_no' AND project_code = '$project'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) == 0) {
                    //if error occurs check if all sample tables are consistent
                    $sql = "INSERT INTO " . $lab_table . "(ref_no, project_code, sampler, date_sampled, date_received, sample_type, sample_variety, sample_origin, sample_description, sample_size, sample_condition, part_submitted, sampling_bag, additional_info, received_by)
                                        VALUES('$ref_no', '$project', '$sampled_by', '$date_sampled', '$date_received', '$sample_type', '$sample_variety', '$sample_origin', '$sample_description', '$sample_size', '$sample_condition', '$part_submitted', '$sampling_bag', '$additional_info', '$user')";
                    if(mysqli_query($conn, $sql)){
                        //add sample_code
                        $sql = "SELECT * FROM " . $lab_table . " WHERE ref_no = '$ref_no' ORDER BY sample_id DESC";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $sid = $row['sample_id'];
                        
                        $length = 4;
                        $id = substr(str_repeat(0, $length).$sid, - $length);

                        $sql = "SELECT * FROM laboratories WHERE name = '$lab'";
                        $result2 = mysqli_query($conn, $sql);
                        $row2 = mysqli_fetch_assoc($result2);
                        $lab_id = $row2['lab_id'];

                        $scode = $lab_id . "-" . date('Y')[2] . date('Y')[3] . $id;

                        $sql = "UPDATE " . $lab_table . " SET sample_code = '$scode' WHERE ref_no = '$ref_no'";
                        if(mysqli_query($conn, $sql)){
                            //add test to lab_tests
                            $sql = "INSERT INTO lab_tests(project_code, sample_code, lab, test_method) VALUES('$project', '$scode', '$lab', '$test_method')";
                            if(!mysqli_query($conn, $sql)){
                                echo json_encode(array(
                                    'message' => 'error-test'
                                ));
                            }
                        }
                    }
                    else {
                        echo json_encode(array(
                            'message' => 'error-sample'
                        ));
                    }
                }
                else {
                    //add test to lab_tests
                    $row = mysqli_fetch_assoc($result);
                    $scode = $row['sample_code'];
                    $sql = "SELECT * FROM lab_tests WHERE sample_code = '$scode' AND test_method = '$test_method'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) == 0){
                        $sql = "INSERT INTO lab_tests(project_code, sample_code, lab, test_method) VALUES('$project', '$scode', '$lab', '$test_method')";
                        if(!mysqli_query($conn, $sql)){
                            echo json_encode(array(
                                'message' => 'error-test'
                            ));
                        }
                    }
                }
            }
            echo json_encode(array(
                'message' => 'success'
            ));
        }
    }
?>