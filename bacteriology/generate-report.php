<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT | Generate Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/generate-report.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/png" href="img/fav-logo.png"/>
</head>
<body>
    <div id="nav">
        <a href='home.php'><img src="img/kephis-logo.png" alt="" class="logo"></a>
        <div class="menu">
            <button class="link"><a href="includes/logout.inc.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></button>
        </div>
    </div>
    <div id="nav-rep"></div>
    <div id="content">
        <div id="sidebar">
            <div class="sidebar-menu">
                <a href="home.php"><button><i class="fa fa-home" aria-hidden="true"></i>Home</button></a>
                <a href="projects.php"><button><i class="fa fa-files-o" aria-hidden="true"></i>Projects</button></a>
                <a href="test-methods.php"><button><i class="fa fa-flask" aria-hidden="true"></i>Test Methods</button></a>
                <a href="add-test-method.php"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Test Method</button></a>
                <a href="users.php"><button><i class="fa fa-users" aria-hidden="true"></i>Users</button></a>
            </div>
        </div>
        <div id="sidebar-rep"></div>
        <div id="main">
            <div class="page-title">
                <h2>Generate Report</h2>
            </div>
            <?php
                require "includes/dbh.inc.php";

                if(!isset($_GET['p']) || empty($_GET['p'])){
                    header("location: projects.php");
                    exit();
                }

                $project_code = $_GET['p'];

                $sql = "SELECT * FROM lab_tests WHERE project_code = '$project_code' AND results = ''";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    $sql = "SELECT * FROM lab_tests WHERE project_code = '$project_code'";
                    $result = mysqli_query($conn, $sql);
                    $incomplete = "
                        <div class='notice error'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i>All test results must be input before generating the report.</div>
                        <div class='main-content'>
                            <div class='content-table'>
                                <div class='table-row head'>
                                    <div class='rq'>Sample</div>
                                    <div class='ph'>Test Method</div>
                                    <div class='dposted'>Results</div>
                                </div>
                    ";
                    while($row = mysqli_fetch_assoc($result)){
                        $sample_code = $row['sample_code'];
                        $test_method = $row['test_method'];
                        $lab = $row['lab'];
                        $results = $row['results'];
                        if(!$results){
                            $results = "<span style='color: red'><i>Not recorded</i></span>";
                        }

                        $incomplete .= "
                            <div class='table-row'>
                                <div class='rq'>
                                    <div class='name'>$sample_code</div>
                                    <span class='thethorn'>$lab</span>
                                </div>
                                <div class='ph'>
                                    $test_method
                                </div>
                                <div class='dposted'>$results</div>
                            </div>
                        ";
                    }
                    $incomplete .= "</div></div>";
                    echo $incomplete;
                }
                else {
                    $sql = "SELECT * FROM projects WHERE project_code = '$project_code'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $customer_id = $row['customer_id'];

                    $date = date('d/m/Y');

                    //customer details
                    $sql = "SELECT * FROM customers WHERE customer_id = '$customer_id'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['company_name'];
                    $phone = $row['phone'];
                    $address = $row['address'];

                    //samples and lab tests
                    $labsPresent = [];
                    $sql = "SELECT * FROM bacteriology_samples WHERE project_code = '$project_code'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        array_push($labsPresent, "Bacteriology");
                        $tests_done = "";
                        while($row = mysqli_fetch_assoc($result)){
                            $sample_code = $row['sample_code'];
                            $ref_no = $row['ref_no'];
                            $lab = $row['lab'];
                            $sample_type = $row['sample_type'];
                            $sample_variety = $row['sample_variety'];
                            $sample_condition = $row['sample_condition'];
                            $date_received = $row['date_received'];
                            $date_sampled = $row['date_sampled'];
                            $sampler = $row['sampler'];
                            $sample_origin = $row['sample_origin'];

                            $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                            $resultl = mysqli_query($conn, $sql);
                            while($rowl = mysqli_fetch_assoc($resultl)){
                                $test_done = $rowl['test_method'];
                                $results = $rowl['results'];

                                $tests_done .= "
                                    <tr>
                                        <td>$sample_code</td>
                                        <td>$ref_no</td>
                                        <td>$sample_type</td>
                                        <td>$sample_variety</td>
                                        <td>$sample_origin</td>
                                        <td>$test_done</td>
                                        <td>$results</td>
                                    </tr>
                                ";
                            }
                        }
                    }

                    $sql = "SELECT * FROM entomology_samples WHERE project_code = '$project_code'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        array_push($labsPresent, "Entomology");
                        while($row = mysqli_fetch_assoc($result)){
                            $sample_code = $row['sample_code'];
                            $ref_no = $row['ref_no'];
                            $lab = $row['lab'];
                            $sample_type = $row['sample_type'];
                            $sample_variety = $row['sample_variety'];
                            $sample_condition = $row['sample_condition'];
                            $date_received = $row['date_received'];
                            $date_sampled = $row['date_sampled'];
                            $sampler = $row['sampler'];
                            $sample_origin = $row['sample_origin'];

                            $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                            $resultl = mysqli_query($conn, $sql);
                            while($rowl = mysqli_fetch_assoc($resultl)){
                                $test_done = $rowl['test_method'];
                                $results = $rowl['results'];

                                $tests_done .= "
                                    <tr>
                                        <td>$sample_code</td>
                                        <td>$ref_no</td>
                                        <td>$sample_type</td>
                                        <td>$sample_variety</td>
                                        <td>$sample_origin</td>
                                        <td>$test_done</td>
                                        <td>$results</td>
                                    </tr>
                                ";
                            }
                        }
                    }

                    $sql = "SELECT * FROM molecular_samples WHERE project_code = '$project_code'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        array_push($labsPresent, "Molecular");
                        while($row = mysqli_fetch_assoc($result)){
                            $sample_code = $row['sample_code'];
                            $ref_no = $row['ref_no'];
                            $lab = $row['lab'];
                            $sample_type = $row['sample_type'];
                            $sample_variety = $row['sample_variety'];
                            $sample_condition = $row['sample_condition'];
                            $date_received = $row['date_received'];
                            $date_sampled = $row['date_sampled'];
                            $sampler = $row['sampler'];
                            $sample_origin = $row['sample_origin'];

                            $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                            $resultl = mysqli_query($conn, $sql);
                            while($rowl = mysqli_fetch_assoc($resultl)){
                                $test_done = $rowl['test_method'];
                                $results = $rowl['results'];

                                $tests_done .= "
                                    <tr>
                                        <td>$sample_code</td>
                                        <td>$ref_no</td>
                                        <td>$sample_type</td>
                                        <td>$sample_variety</td>
                                        <td>$sample_origin</td>
                                        <td>$test_done</td>
                                        <td>$results</td>
                                    </tr>
                                ";
                            }
                        }
                    }

                    $sql = "SELECT * FROM mycology_samples WHERE project_code = '$project_code'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        array_push($labsPresent, "Mycology");
                        while($row = mysqli_fetch_assoc($result)){
                            $sample_code = $row['sample_code'];
                            $ref_no = $row['ref_no'];
                            $lab = $row['lab'];
                            $sample_type = $row['sample_type'];
                            $sample_variety = $row['sample_variety'];
                            $sample_condition = $row['sample_condition'];
                            $date_received = $row['date_received'];
                            $date_sampled = $row['date_sampled'];
                            $sampler = $row['sampler'];
                            $sample_origin = $row['sample_origin'];

                            $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                            $resultl = mysqli_query($conn, $sql);
                            while($rowl = mysqli_fetch_assoc($resultl)){
                                $test_done = $rowl['test_method'];
                                $results = $rowl['results'];

                                $tests_done .= "
                                    <tr>
                                        <td>$sample_code</td>
                                        <td>$ref_no</td>
                                        <td>$sample_type</td>
                                        <td>$sample_variety</td>
                                        <td>$sample_origin</td>
                                        <td>$test_done</td>
                                        <td>$results</td>
                                    </tr>
                                ";
                            }
                        }
                    }

                    $sql = "SELECT * FROM nematology_samples WHERE project_code = '$project_code'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        array_push($labsPresent, "Nematology");
                        while($row = mysqli_fetch_assoc($result)){
                            $sample_code = $row['sample_code'];
                            $ref_no = $row['ref_no'];
                            $lab = $row['lab'];
                            $sample_type = $row['sample_type'];
                            $sample_variety = $row['sample_variety'];
                            $sample_condition = $row['sample_condition'];
                            $date_received = $row['date_received'];
                            $date_sampled = $row['date_sampled'];
                            $sampler = $row['sampler'];
                            $sample_origin = $row['sample_origin'];

                            $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                            $resultl = mysqli_query($conn, $sql);
                            while($rowl = mysqli_fetch_assoc($resultl)){
                                $test_done = $rowl['test_method'];
                                $results = $rowl['results'];

                                $tests_done .= "
                                    <tr>
                                        <td>$sample_code</td>
                                        <td>$ref_no</td>
                                        <td>$sample_type</td>
                                        <td>$sample_variety</td>
                                        <td>$sample_origin</td>
                                        <td>$test_done</td>
                                        <td>$results</td>
                                    </tr>
                                ";
                            }
                        }
                    }

                    $sql = "SELECT * FROM tissue_culture_samples WHERE project_code = '$project_code'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        array_push($labsPresent, "Tissue Culture");
                        while($row = mysqli_fetch_assoc($result)){
                            $sample_code = $row['sample_code'];
                            $ref_no = $row['ref_no'];
                            $lab = $row['lab'];
                            $sample_type = $row['sample_type'];
                            $sample_variety = $row['sample_variety'];
                            $sample_condition = $row['sample_condition'];
                            $date_received = $row['date_received'];
                            $date_sampled = $row['date_sampled'];
                            $sampler = $row['sampler'];
                            $sample_origin = $row['sample_origin'];

                            $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                            $resultl = mysqli_query($conn, $sql);
                            while($rowl = mysqli_fetch_assoc($resultl)){
                                $test_done = $rowl['test_method'];
                                $results = $rowl['results'];

                                $tests_done .= "
                                    <tr>
                                        <td>$sample_code</td>
                                        <td>$ref_no</td>
                                        <td>$sample_type</td>
                                        <td>$sample_variety</td>
                                        <td>$sample_origin</td>
                                        <td>$test_done</td>
                                        <td>$results</td>
                                    </tr>
                                ";
                            }
                        }
                    }

                    $sql = "SELECT * FROM virology_samples WHERE project_code = '$project_code'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        array_push($labsPresent, "Virology");
                        while($row = mysqli_fetch_assoc($result)){
                            $sample_code = $row['sample_code'];
                            $ref_no = $row['ref_no'];
                            $lab = $row['lab'];
                            $sample_type = $row['sample_type'];
                            $sample_variety = $row['sample_variety'];
                            $sample_condition = $row['sample_condition'];
                            $date_received = $row['date_received'];
                            $date_sampled = $row['date_sampled'];
                            $sampler = $row['sampler'];
                            $sample_origin = $row['sample_origin'];

                            $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                            $resultl = mysqli_query($conn, $sql);
                            while($rowl = mysqli_fetch_assoc($resultl)){
                                $test_done = $rowl['test_method'];
                                $results = $rowl['results'];

                                $tests_done .= "
                                    <tr>
                                        <td>$sample_code</td>
                                        <td>$ref_no</td>
                                        <td>$sample_type</td>
                                        <td>$sample_variety</td>
                                        <td>$sample_origin</td>
                                        <td>$test_done</td>
                                        <td>$results</td>
                                    </tr>
                                ";
                            }
                        }
                    }

                    $methodDescription = "";
                    for($i=0; $i<count($labsPresent); $i++){
                        $labm = $labsPresent[$i];
                        $methodDescription .= "<h5>$labm</h5><textarea id='l$i' style='width: 100%; height: 150px'></textarea>";
                    }
                    $labsPresent = implode(',', $labsPresent);

                    echo "
                        <style>
                            #contract-review {
                                width: 768px;
                                margin: 100px auto;
                                font-family: 'Times New Roman';
                            }
                            #contract-review > .header {
                                text-align: center;
                                border-bottom: 1px solid black;
                            }
                            #contract-review > .header img {
                                width: 80px;
                            }
                            .body .header {
                                text-align: center;
                            }
                            .body .contract-info {
                                width: 100%;
                            }
                            .body .contract-info > div {
                                margin-bottom: 7px;
                            }
                            .body .contract-info > div div{
                                display: inline-block;
                                width: 49%;
                            }
                            table {
                                margin: 20px 0;
                                width: 100%;
                            }
                            table, th, td {
                                font-size: 12px;
                                border: 1px solid black;
                                border-spacing: 0;
                            }
                            th, td {
                                padding: 5px 7px;
                            }
                            .body ul {
                                padding: 0 15px;
                            }
                            .body ul li {
                                font-size: 13px;
                                font-weight: 600;
                            }
                            h5 span {
                                font-style: italic;
                                font-weight: 400;
                            }
                            .date {
                                text-align: right;
                            }
                            .underline {
                                text-decoration: underline;
                            }
                            .signature {
                                margin-top: 30px;
                            }
                            .end {
                                margin-top: 75px;
                                text-align: center;
                            }
                            .contract-info.down > div {
                                margin-top: 30px;
                                margin-bottom: 25px;
                            }
                        </style>
                        <div class='main-content'>
                            <form id='generatereport'>
                                <div id='contract-review'>
                                    <div class='header'>
                                        <img src='img/fav-logo.png' alt=''>
                                        <h2>KENYA PLANT HEALTH INSPECTORATE SERVICE (KEPHIS)</h2>
                                        <h5>P.O Box 49421-00100 Nairobi. Tel. 020-3597204/5, 0722-209505/0734-330017 Fax: 020-3536176, Email: pqs@kephis.org</h5>
                                    </div>
                                    <div class='body'>
                                        <div class='header'>
                                            <h3>PLANT QUARANTINE AND BIO-SECURITY STATION - MUGUGA</h3>
                                            <strong><h3 class='underline'>PEST DIAGNOSIS REPORT</h3></strong>
                                        </div>
                                        <div class='contract-info'>
                                            <div>
                                                <div><b>Our Ref:</b> <div class='input-box'><input type='text' value='$project_code' disabled></div></div>
                                                <div class='date'><b>Date: $date</b></div>
                                            </div>
                                            <input type='hidden' id='labsPresent' value='$labsPresent'>
                                            <div>
                                                <div><b>Folio No:</b> <div class='input-box'><input type='text' id='folio'></div></div>
                                            </div>
                                            <div>
                                                <div><b>Client Name:</b> <div class='input-box'><input type='text' value='$name' disabled></div></div>
                                            </div>
                                            <div>
                                                <div><b>Address:</b> <div class='input-box'><input type='text' value='$address' disabled></div></div>
                                            </div>
                                            <div>
                                                <div><b>Telephone:</b> <div class='input-box'><input type='text' value='$phone' disabled></div></div>
                                            </div>
                                            <div>
                                                <div><b>Sampling date:</b> <div class='input-box'><input type='text' value='$date_sampled' disabled></div></div>
                                            </div>
                                            <div>
                                                <div><b>Date received:</b> <div class='input-box'><input type='text' value='$date_received' disabled></div></div>
                                            </div>
                                            <div>
                                                <div><b>Sampler:</b> <div class='input-box'><input type='text' value='$sampler' disabled></div></div>
                                            </div>
                                            <div>
                                                <div><b>Date of test completion:</b> <div class='input-box'><input type='text' value='$date' disabled></div></div>
                                            </div>
                                            <div>
                                                <div><b>Sample condition:</b> <div class='input-box'><input type='text' value='$sample_condition' disabled></div></div>
                                            </div>
                                        </div>
                                        <strong><h3 class='underline'>RE: LABORATORY TEST FOR PLANT SAMPLES</h3></strong>
                                        <textarea style='width: 100%; height: 150px' id='rebody'></textarea>
                                        <h4 class='subtitle'>Method(s)</h4>
                                        $methodDescription
                                        <div class='table'>
                                            <table>
                                                <tr>
                                                    <th>Sample Code</th>
                                                    <th>Lot No</th>
                                                    <th>Sample Type</th>
                                                    <th>Sample Variety</th>
                                                    <th>Sample Origin</th>
                                                    <th>Test Done</th>
                                                    <th>Result</th>
                                                </tr>
                                                $tests_done
                                            </table>
                                        </div>
                                        <h4 class='subtitle'>Observation/Recommendations</h4>
                                        <textarea style='width: 100%; height: 100px' id='observations'></textarea>
                                        <div class='contract-info'>
                                            <div>
                                                <div><b>Charges: KSH <div class='input-box'><input type='text' id='charges'></div></b></div>
                                            </div>
                                            <div>
                                                <div><b>Invoice No: <div class='input-box'><input type='text' id='invoice'></div></b></div>
                                            </div>
                                        </div>
                                        <div class='contract-info down'>
                                            <div>
                                                <div><b>Analysed By:</b><br><textarea id='analysed_by' style='width: 250px; height: 70px' placeholder='Separate individuals with a comma (,)'></textarea></div>
                                                <div style='text-align: right'><b>Confirmed By:</b><br>George Ngundo<br><div class='signature'>.........................</div></div>
                                            </div>
                                            <div>
                                                <div>Florence Munguti<br><div class='signature'>.........................</div><br><span>Officer In Charge</span></div>
                                            </div>
                                        </div>
                                        <h4 class='underline'>PLANT QUARANTINE AND SECURITY STATION</h4>
                                        <p>cc: Managing Director</p>
                                        <div class='end'>
                                            <h5>----------------------------------- END OF REPORT -----------------------------------</h5>
                                            <h5>NB: These test results relate only to the test samples submitted</h5>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class='mega-btn'>
                            <div id='errors' style='margin: 15px 0; color: red; font-size: 12px'></div>
                            <button class='apply' id='generatereportbtn'>GENERATE REPORT</button>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>
</body>
</html>
<?php endif; ?>
<?php
    if(!isset($_SESSION['pqsuser']) || $_SESSION['designation'] != "Bacteriology") {
        header('location: ../login.php');
    }
?>