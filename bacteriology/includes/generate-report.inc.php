<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    // include autoloader
    require_once '../../dompdf/autoload.inc.php';


    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"){
        require 'dbh.inc.php';

        $project_code = $_GET['p'];
        $folio = mysqli_real_escape_string($conn, $_POST['folio']);
        $rebody = mysqli_real_escape_string($conn, $_POST['rebody']);
        $labs = mysqli_real_escape_string($conn, $_POST['labs']);
        $method_descriptions = mysqli_real_escape_string($conn, $_POST['method_descriptions']);
        $observations = mysqli_real_escape_string($conn, $_POST['observations']);
        $invoice = mysqli_real_escape_string($conn, $_POST['invoice']);
        $charges = mysqli_real_escape_string($conn, $_POST['charges']);
        $analysed_by = mysqli_real_escape_string($conn, $_POST['analysed_by']);
        
        $sql = "SELECT * FROM projects WHERE project_code = '$project_code'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $sql = "UPDATE projects SET folio = '$folio', 
                                        rebody = '$rebody', 
                                        labs = '$labs', 
                                        method_descriptions = '$method_descriptions', 
                                        observations = '$observations', 
                                        invoice = '$invoice', 
                                        analysed_by = '$analysed_by', 
                                        amount_charged = '$charges', 
                                        status = 'complete' 
                                    WHERE project_code = '$project_code'";
            if(mysqli_query($conn, $sql)){
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
                $method_descriptions = explode(',', $method_descriptions);
                $labs = explode(',', $labs);
                for($i=0; $i<count($labs); $i++){
                    $labm = $labs[$i];
                    $methodm = $method_descriptions[$i];
                    $methodDescription .= "<h5 class='underline'>$labm</h5><p>$methodm</p>";
                }

                $analysed = "";
                $analysed_by = explode(',', $analysed_by);
                for($i=0; $i<count($analysed_by); $i++){
                    $analyser = $analysed_by[$i];

                    if($i == 0){
                        $analysed .= "
                            <div>
                                <div><b>Analysed By:</b><br>$analyser<br><div class='signature'>.........................</div></div>
                                <div><b>Confirmed By:</b><br>George Ngundo<br><div class='signature'>.........................</div></div>
                            </div>
                        ";
                    }
                    else {
                        $analysed .= "
                            <div>
                                <div><br>$analyser<br><div class='signature'>.........................</div></div>
                            </div>
                        ";
                    }
                }

                $image = '../img/fav-logo.png';

                // Read image path, convert to base64 encoding
                $imageData = base64_encode(file_get_contents($image));

                // Format the image SRC:  data:{mime};base64,{data};
                $src = 'data:'.mime_content_type($image).';base64,'.$imageData;

                $report = "
                    <style>
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
                            color: #555;
                        }
                        .contract-info.down > div {
                            margin-top: 30px;
                            margin-bottom: 25px;
                        }
                    </style>
                    <div class='main-content'>
                        <div id='contract-review'>
                            <div class='header'>
                                <img src='$src'>
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
                                        <div><b>Our Ref:</b> $project_code</div>
                                        <div class='date'><b>Date: $date</b></div>
                                    </div>
                                    <div>
                                        <div><b>Folio No:</b> $folio</div>
                                    </div>
                                    <div>
                                        <div><b>Client Name:</b> $name</div>
                                    </div>
                                    <div>
                                        <div><b>Address:</b> $address</div>
                                    </div>
                                    <div>
                                        <div><b>Telephone:</b> $phone</div>
                                    </div>
                                    <div>
                                        <div><b>Sampling date:</b> $date_sampled</div>
                                    </div>
                                    <div>
                                        <div><b>Date received:</b> $date_received</div>
                                    </div>
                                    <div>
                                        <div><b>Sampler:</b> $sampler</div>
                                    </div>
                                    <div>
                                        <div><b>Date of test completion:</b> $date</div>
                                    </div>
                                    <div>
                                        <div><b>Sample condition:</b> $sample_condition</div>
                                    </div>
                                </div>
                                <strong><h4 class='underline'>RE: LABORATORY TEST FOR PLANT SAMPLES</h4></strong>
                                <p>$rebody</p>
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
                                <p>$observations</p>
                                <div class='contract-info'>
                                    <div>
                                        <div><b>Charges: KSH $charges</b></div>
                                    </div>
                                    <div>
                                        <div><b>Invoice No: $invoice</b></div>
                                    </div>
                                </div>
                                <div class='contract-info down'>
                                    $analysed
                                    
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
                    </div>
                ";

                $filename = uniqid() . ".pdf";

                // instantiate and use the dompdf class
                $dompdf = new Dompdf();
                $options = $dompdf->getOptions();
                $options->setDefaultFont('Courier');
                $dompdf->setOptions($options);

                $dompdf->loadHtml($report);

                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'portrait');

                // Render the HTML as PDF
                $dompdf->render();

                // Output the generated PDF to Browser
                //$dompdf->stream("contract_review".rand(10,1000).".pdf", array("Attachment" => true));
                $output = $dompdf->output();
                file_put_contents("../crf/" . $filename, $output);
                echo json_encode(array(
                    'message' => 'success',
                    'url' => $filename
                ));
            }
            else {
                echo json_encode(array(
                    'message' => 'error'
                ));
            }
        }
        else {
            echo json_encode(array(
                'message' => 'error-2'
            ));
        }
    }
?>