<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT | Sample</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/sample.js"></script>
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
        <?php
                require "includes/dbh.inc.php";

                if(!isset($_GET['s']) || empty($_GET['s']) || !isset($_GET['l']) || empty($_GET['l'])){
                    header("location: samples.php");
                    exit();
                }

                $lab = $_GET['l'];
                $sample = $_GET['s'];

                $sql = "SELECT * FROM " . $lab . " WHERE sample_id = '$sample'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $ref_no = $row['ref_no'];
                $sampler = $row['sampler'];
                $date_sampled = $row['date_sampled'];
                $date_received = $row['date_received'];
                $sample_type = $row['sample_type'];
                $sample_variety = $row['sample_variety'];
                $sample_origin = $row['sample_origin'];
                $sample_description = $row['sample_description'];
                $sample_size = $row['sample_size'];
                $sample_condition = $row['sample_condition'];
                $part_submitted = $row['part_submitted'];
                $sampling_bag = $row['sampling_bag'];
                $additional_info = $row['additional_info'];

                $table = $lab;
                if($lab == "mycology_samples"){
                    $lab = "Mycology";
                }
                else if($lab == "entomology_samples"){
                    $lab = "Entomology";
                }
                else if($lab == "nematology_samples"){
                    $lab = "Nematology";
                }
                else if($lab == "bacteriology_samples"){
                    $lab = "Bacteriology";
                }
                else if($lab == "virology_samples"){
                    $lab = "Virology";
                }
                else if($lab == "tissue_culture_samples"){
                    $lab = "Tissue Culture";
                }
                else if($lab == "molecular_samples"){
                    $lab = "Molecular";
                }

                $sql = "SELECT * FROM laboratories WHERE name = '$lab'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $lab_short = $row['lab_id'];

                $length = 4;
                $id = substr(str_repeat(0, $length).$sample, - $length);
                $scode = $lab_short . "-" . date('Y')[2] . date('Y')[3] . "-" . $id;

                $sql = "SELECT * FROM lab_tests WHERE sample_code = '$scode'";
                $result = mysqli_query($conn, $sql);
                $test_methods = [];
                while($row = mysqli_fetch_assoc($result)){
                    $test_method = $row['test_method'];

                    array_push($test_methods, $test_method);
                }
            ?>
            <div class="page-title">
                <h2>Sample</h2>
            </div>
            <div class="main-content">
                <div class="form-content">
                    <form action="" id="logsample">
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Sample Code</label>
                                <input type="text" id="ref_no" value="<?php echo $scode; ?>" disabled>
                            </div>
                            <div class="input-box"></div>
                        </div>
                        <div class="label-title">Reception</div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Lot/Ref no</label>
                                <input type="text" id="ref_no" value="<?php echo $ref_no; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Sampled By</label>
                                <input type="date" id="sampler" value="<?php echo $sampler; ?>" disabled>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Date Sampled</label>
                                <input type="date" id="date_sampled" value="<?php echo $date_sampled; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Date Received</label>
                                <input type="date" id="date_received" value="<?php echo $date_received; ?>" disabled>
                            </div>
                        </div>

                        <div class="label-title">Sample Details</div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Sample Type</label>
                                <input type="text" id="sample_type" value="<?php echo $sample_type; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Sample Variety</label>
                                <input type="text" id="sample_variety" value="<?php echo $sample_variety; ?>" disabled>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Sample Origin</label>
                                <input type="text" id="sample_origin" value="<?php echo $sample_origin; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Sample Description</label>
                                <textarea id="sample_description" disabled><?php echo $sample_description; ?></textarea>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Sample Size</label>
                                <input type="text" id="sample_size" value="<?php echo $sample_size; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Sample Condition</label>
                                <input type="text" id="sample_condition" value="<?php echo $sample_condition; ?>" disabled>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Part Submitted</label>
                                <input type="text" id="part_submitted" value="<?php echo $part_submitted; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Sampling bag</label>
                                <input type="text" id="sampling_bag" value="<?php echo $sampling_bag; ?>" disabled>
                            </div>
                        </div>

                        <div class="label-title">Lab Details</div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Lab</label>
                                <input id="lab" value="<?php echo $lab; ?>" disabled>
                            </div>
                            <div class="input-box"></div>
                        </div>
                        <div class="input-box">
                            <label for="">Test Method(s)</label>
                            <textarea id="test-methods" disabled><?php echo implode(',', $test_methods); ?></textarea>
                        </div>

                        <div class="label-title">Other Details</div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Additional Information</label>
                                <textarea id="additional_info" disabled><?php echo $additional_info; ?></textarea>
                            </div>
                            <div class="input-box"></div>
                        </div>
                    </form>
                </div>
            </div>
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