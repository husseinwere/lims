<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT | Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/project.js"></script>
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

                if(!isset($_GET['p']) || empty($_GET['p'])){
                    header("location: projects.php");
                    exit();
                }

                $project = $_GET['p'];

                $sql = "SELECT * FROM projects WHERE project_code = '$project'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $customer = $row['customer_id'];
                $report_format = $row['report_format'];
                $results_dispatch = $row['results_dispatch'];
                $sample_amount = $row['sample_amount'];

                $sql = "SELECT * FROM customers WHERE customer_id = '$customer'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $company_name = $row['company_name'];
                $phone = $row['phone'];
                $email = $row['email'];
                $address = $row['address'];
            ?>
            <div class="page-title flex">
                <h2>Project</h2>
                <button class="apply" id="contract-review"><i class="fa fa-download" aria-hidden="true"></i>Contract Review Form</button>
            </div>
            <div class="main-content">
                <div class="form-content">
                    <form action="">
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Lab Order No</label>
                                <input type="text" value="<?php echo $project; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Number of samples</label>
                                <input type="text" value="<?php echo $sample_amount; ?>" disabled>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Report Format</label>
                                <input type="text" value="<?php echo $report_format; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Results Dispatch</label>
                                <input type="text" value="<?php echo $results_dispatch; ?>" disabled>
                            </div>
                        </div>
                        <div class="label-title">Customer</div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Name</label>
                                <input type="text" id="cname" value="<?php echo $company_name; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Phone</label>
                                <input type="text" id="phone" value="<?php echo $phone; ?>" disabled>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Email</label>
                                <input type="text" id="email" value="<?php echo $email; ?>" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Physical Address</label>
                                <input type="text" id="address" value="<?php echo $address; ?>" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-title flex">
                <h2>Tests</h2>
                <a href="generate-report.php?p=<?php echo $project; ?>"><button class="apply">GENERATE REPORT</button></a>
            </div>
            <div class="main-content" id="samples"></div>
            <div id="contract-review-form" style="color: #eee;"></div>
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