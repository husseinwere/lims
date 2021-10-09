<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT | Record Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/record-results.js"></script>
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
                <a href="add-test-method.php"><button class="active"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Test Method</button></a>
                <a href="users.php"><button><i class="fa fa-users" aria-hidden="true"></i>Users</button></a>
            </div>
        </div>
        <div id="sidebar-rep"></div>
        <div id="main">
            <?php
                require "includes/dbh.inc.php";

                $test_id = $_GET['t'];
                $lab = $_SESSION['designation'];

                $sql = "SELECT * FROM lab_tests WHERE test_id = '$test_id' AND lab = '$lab'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    $sample_code = $row['sample_code'];
                    $test_method = $row['test_method'];
                }
                else {
                    header("location: projects.php");
                    exit();
                }
            ?>
            <div class="page-title">
                <h2>Enter test results</h2>
            </div>
            <div class="main-content">
                <div class="form-content">
                    <form action="" id="recordresults">
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Sample Code</label>
                                <input type="text" id="acronym" value="<?php echo $sample_code; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Test Method</label>
                                <input type="text" value="<?php echo $test_method; ?>" disabled>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Results</label>
                                <select id="results">
                                    <option value="Negative">Negative</option>
                                    <option value="Positive">Positive</option>
                                </select>
                            </div>
                            <div class="input-box"></div>
                        </div>
                        
                        <div id="errors" class="errors"></div>

                        <div class="button-box flex">
                            <button id="recordresultsbtn">RECORD RESULT</button>
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