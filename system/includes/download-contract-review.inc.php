<?php
    // include autoloader
    require_once '../../dompdf/autoload.inc.php';


    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require "dbh.inc.php";

        $project_code = $_GET['p'];

        $sql = "SELECT * FROM projects WHERE project_code = '$project_code'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $customer_id = $row['customer_id'];
        $report_format = $row['report_format'];
        $results_dispatch = $row['results_dispatch'];

        $sql = "SELECT * FROM customers WHERE customer_id = '$customer_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $company_name = $row['company_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];

        $table = "";
        $table .= "
            <table>
                <tr>
                    <th style='width: 70px'>Sample Code</th>
                    <th>Sample Type</th>
                    <th>Sample Origin</th>
                    <th>Test Method</th>
                    <th>Sample Variety</th>
                    <th>Lot No.</th>
                    <th>Sample Size</th>
                    <th>Additional</th>
                    <th>Sampled by</th>
                </tr>
        ";

        $sql = "SELECT * FROM bacteriology_samples WHERE project_code = '$project_code'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $sample_code = $row['sample_code'];
                $ref_no = $row['ref_no'];
                $lab = $row['lab'];
                $sample_type = $row['sample_type'];
                $sample_origin = $row['sample_origin'];
                $sample_size = $row['sample_size'];
                $sample_variety = $row['sample_variety'];
                $sample_condition = $row['sample_condition'];
                $date_received = $row['date_received'];
                $date_sampled = $row['date_sampled'];
                $sampler = $row['sampler'];
                $received_by = strtoupper($row['received_by']);
                $additional = $row['additional_info'];

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

                $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                $result2 = mysqli_query($conn, $sql);
                while($row2 = mysqli_fetch_assoc($result2)){
                    $test_method = $row2['test_method'];
                    $table .= "
                        <tr>
                            <td>$sample_code</td>
                            <td>$sample_type</td>
                            <td>$sample_origin</td>
                            <td><i>$test_method</i></td>
                            <td>$sample_variety</td>
                            <td>$ref_no</td>
                            <td>$sample_size</td>
                            <td>$additional</td>
                            <td>$sampler</td>
                        </tr>
                    ";
                }
            }
        }

        $sql = "SELECT * FROM entomology_samples WHERE project_code = '$project_code'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $sample_code = $row['sample_code'];
                $ref_no = $row['ref_no'];
                $lab = $row['lab'];
                $sample_type = $row['sample_type'];
                $sample_origin = $row['sample_origin'];
                $sample_size = $row['sample_size'];
                $sample_variety = $row['sample_variety'];
                $sample_condition = $row['sample_condition'];
                $date_received = $row['date_received'];
                $date_sampled = $row['date_sampled'];
                $sampler = $row['sampler'];
                $received_by = strtoupper($row['received_by']);
                $additional = $row['additional_info'];

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

                $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                $result2 = mysqli_query($conn, $sql);
                while($row2 = mysqli_fetch_assoc($result2)){
                    $test_method = $row2['test_method'];
                    $table .= "
                        <tr>
                            <td>$sample_code</td>
                            <td>$sample_type</td>
                            <td>$sample_origin</td>
                            <td><i>$test_method</i></td>
                            <td>$sample_variety</td>
                            <td>$ref_no</td>
                            <td>$sample_size</td>
                            <td>$additional</td>
                            <td>$sampler</td>
                        </tr>
                    ";
                }
            }
        }

        $sql = "SELECT * FROM molecular_samples WHERE project_code = '$project_code'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $sample_code = $row['sample_code'];
                $ref_no = $row['ref_no'];
                $lab = $row['lab'];
                $sample_type = $row['sample_type'];
                $sample_origin = $row['sample_origin'];
                $sample_size = $row['sample_size'];
                $sample_variety = $row['sample_variety'];
                $sample_condition = $row['sample_condition'];
                $date_received = $row['date_received'];
                $date_sampled = $row['date_sampled'];
                $sampler = $row['sampler'];
                $received_by = strtoupper($row['received_by']);
                $additional = $row['additional_info'];

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

                $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                $result2 = mysqli_query($conn, $sql);
                while($row2 = mysqli_fetch_assoc($result2)){
                    $test_method = $row2['test_method'];
                    $table .= "
                        <tr>
                            <td>$sample_code</td>
                            <td>$sample_type</td>
                            <td>$sample_origin</td>
                            <td><i>$test_method</i></td>
                            <td>$sample_variety</td>
                            <td>$ref_no</td>
                            <td>$sample_size</td>
                            <td>$additional</td>
                            <td>$sampler</td>
                        </tr>
                    ";
                }
            }
        }

        $sql = "SELECT * FROM mycology_samples WHERE project_code = '$project_code'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $sample_code = $row['sample_code'];
                $ref_no = $row['ref_no'];
                $lab = $row['lab'];
                $sample_type = $row['sample_type'];
                $sample_origin = $row['sample_origin'];
                $sample_size = $row['sample_size'];
                $sample_variety = $row['sample_variety'];
                $sample_condition = $row['sample_condition'];
                $date_received = $row['date_received'];
                $date_sampled = $row['date_sampled'];
                $sampler = $row['sampler'];
                $received_by = strtoupper($row['received_by']);
                $additional = $row['additional_info'];

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

                $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                $result2 = mysqli_query($conn, $sql);
                while($row2 = mysqli_fetch_assoc($result2)){
                    $test_method = $row2['test_method'];
                    $table .= "
                        <tr>
                            <td>$sample_code</td>
                            <td>$sample_type</td>
                            <td>$sample_origin</td>
                            <td><i>$test_method</i></td>
                            <td>$sample_variety</td>
                            <td>$ref_no</td>
                            <td>$sample_size</td>
                            <td>$additional</td>
                            <td>$sampler</td>
                        </tr>
                    ";
                }
            }
        }

        $sql = "SELECT * FROM nematology_samples WHERE project_code = '$project_code'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $sample_code = $row['sample_code'];
                $ref_no = $row['ref_no'];
                $lab = $row['lab'];
                $sample_type = $row['sample_type'];
                $sample_origin = $row['sample_origin'];
                $sample_size = $row['sample_size'];
                $sample_variety = $row['sample_variety'];
                $sample_condition = $row['sample_condition'];
                $date_received = $row['date_received'];
                $date_sampled = $row['date_sampled'];
                $sampler = $row['sampler'];
                $received_by = strtoupper($row['received_by']);
                $additional = $row['additional_info'];

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

                $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                $result2 = mysqli_query($conn, $sql);
                while($row2 = mysqli_fetch_assoc($result2)){
                    $test_method = $row2['test_method'];
                    $table .= "
                        <tr>
                            <td>$sample_code</td>
                            <td>$sample_type</td>
                            <td>$sample_origin</td>
                            <td><i>$test_method</i></td>
                            <td>$sample_variety</td>
                            <td>$ref_no</td>
                            <td>$sample_size</td>
                            <td>$additional</td>
                            <td>$sampler</td>
                        </tr>
                    ";
                }
            }
        }

        $sql = "SELECT * FROM tissue_culture_samples WHERE project_code = '$project_code'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $sample_code = $row['sample_code'];
                $ref_no = $row['ref_no'];
                $lab = $row['lab'];
                $sample_type = $row['sample_type'];
                $sample_origin = $row['sample_origin'];
                $sample_size = $row['sample_size'];
                $sample_variety = $row['sample_variety'];
                $sample_condition = $row['sample_condition'];
                $date_received = $row['date_received'];
                $date_sampled = $row['date_sampled'];
                $sampler = $row['sampler'];
                $received_by = strtoupper($row['received_by']);
                $additional = $row['additional_info'];

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

                $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                $result2 = mysqli_query($conn, $sql);
                while($row2 = mysqli_fetch_assoc($result2)){
                    $test_method = $row2['test_method'];
                    $table .= "
                        <tr>
                            <td>$sample_code</td>
                            <td>$sample_type</td>
                            <td>$sample_origin</td>
                            <td><i>$test_method</i></td>
                            <td>$sample_variety</td>
                            <td>$ref_no</td>
                            <td>$sample_size</td>
                            <td>$additional</td>
                            <td>$sampler</td>
                        </tr>
                    ";
                }
            }
        }

        $sql = "SELECT * FROM virology_samples WHERE project_code = '$project_code'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $sample_code = $row['sample_code'];
                $ref_no = $row['ref_no'];
                $lab = $row['lab'];
                $sample_type = $row['sample_type'];
                $sample_origin = $row['sample_origin'];
                $sample_size = $row['sample_size'];
                $sample_variety = $row['sample_variety'];
                $sample_condition = $row['sample_condition'];
                $date_received = $row['date_received'];
                $date_sampled = $row['date_sampled'];
                $sampler = $row['sampler'];
                $received_by = strtoupper($row['received_by']);
                $additional = $row['additional_info'];

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

                $sql = "SELECT * FROM lab_tests WHERE sample_code = '$sample_code'";
                $result2 = mysqli_query($conn, $sql);
                while($row2 = mysqli_fetch_assoc($result2)){
                    $test_method = $row2['test_method'];
                    $table .= "
                        <tr>
                            <td>$sample_code</td>
                            <td>$sample_type</td>
                            <td>$sample_origin</td>
                            <td><i>$test_method</i></td>
                            <td>$sample_variety</td>
                            <td>$ref_no</td>
                            <td>$sample_size</td>
                            <td>$additional</td>
                            <td>$sampler</td>
                        </tr>
                    ";
                }
            }
        }

        $sql = "SELECT * FROM users WHERE username = '$received_by'";
        $resultu = mysqli_query($conn, $sql);
        $rowu = mysqli_fetch_assoc($resultu);
        $received_by = $rowu['firstname'] . " " . $rowu['lastname'];

        $table .= "</table>";

        $image = '../img/fav-logo.png';

        // Read image path, convert to base64 encoding
        $imageData = base64_encode(file_get_contents($image));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data:'.mime_content_type($image).';base64,'.$imageData;

        $pdf = "
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
                    display: inline-block;
                    width: 49%;
                }
                table {
                    margin: 20px 0;
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
            </style>
            <div id='contract-review'>
                <div class='header'>
                    <img src='$src' alt=''>
                    <h2>KENYA PLANT HEALTH INSPECTORATE SERVICE (KEPHIS)</h2>
                    <h5>P.O Box 49421-00100 Nairobi. Tel. 020-3597204/5, 0722-209505/0734-330017 Fax: 020-3536176, Email: pqs@kephis.org</h5>
                </div>
                <div class='body'>
                    <div class='header'>
                        <h3>PLANT QUARANTINE AND BIO-SECURITY STATION - MUGUGA</h3>
                        <strong><h3>SAMPLE RECEIPT/CONTRACT REVIEW FORM</h3></strong>
                    </div>
                    <div class='contract-info'>
                        <div>
                            <div><b>Lab Order #:</b> $project_code</div>
                            <div><b>Date Received:</b> $date_received</div>
                        </div>
                        <div>
                            <div><b>Customer:</b> $company_name</div>
                            <div><b>Date Sampled:</b> $date_sampled</div>
                        </div>
                    </div>
                    <div class='table'>
                        $table
                    </div>
                    <div class='contract-info'>
                        <div>
                            <div><b>Report Format: </b>$report_format</div>
                        </div>
                        <div>
                            <div><b>Results Dispatch: </b>$results_dispatch</div>
                        </div>
                    </div>
                    <div class='terms'>
                        <h5>TERMS AND CONDITIONS</h5>
                        <ul>
                            <li>In case of a client withdrawing a sample, the laboratory reserves the right to retain a portion of the same and charge appropriately.</li>
                            <li>The laboratory reserves the right to withhold results for verification purposes. However, the client will be notified in advance.</li>
                            <li>Clients are kindly advised to make full payment on collection of analytical report</li>
                            <li>Clients are advised to read and understand the KEPHIS Service Charter</li>
                        </ul>
                    </div>
                    <div class='declaration'>
                        <h5>DECLARATION: <span>To be filled by customer</span></h5>
                        <p>
                            I ......................................................................................................... , agree to the terms and conditions stated herein.
                        </p>
                        <p>
                            <b>Date:</b> .........................................  <b>Signature:</b> ........................................  <b>Time:</b> ...............................................
                        </p>
                    </div>
                    <div class='contract-info'>
                        <div>
                            <div><b>Client:</b> $company_name</div>
                            <div><b>Email:</b> $email</div>
                        </div>
                        <div>
                            <div><b>Address:</b> $address</div>
                            <div><b>Phone Number:</b> $phone</div>
                        </div>
                    </div>
                    <h5><span>Note: The laboratory has the capability and resources to undertake the tests by approved test methods in meeting requirements.</span></h5>
                    <h6 style='color: #333'>RECEIVED BY: $received_by</h6>
                </div>
            </div>
        ";

        $filename = uniqid() . ".pdf";

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $dompdf->setOptions($options);

        $dompdf->loadHtml($pdf);

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
?>