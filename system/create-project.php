<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT | Create Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/create-project.js"></script>
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
                <a href="customers.php"><button><i class="fa fa-tasks" aria-hidden="true"></i>Customers</button></a>
                <a href="add-customer.php"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Customer</button></a>
                <a href="projects.php"><button><i class="fa fa-files-o" aria-hidden="true"></i>Projects</button></a>
                <a href="create-project.php"><button class="active"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>Create Project</button></a>
                <a href="test-methods.php"><button><i class="fa fa-flask" aria-hidden="true"></i>Test Methods</button></a>
                <a href="add-test-method.php"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Test Method</button></a>
                <a href="users.php"><button><i class="fa fa-users" aria-hidden="true"></i>Users</button></a>
                <a href="database.php"><button><i class="fa fa-database" aria-hidden="true"></i>Database</button></a>
            </div>
        </div>
        <div id="sidebar-rep"></div>
        <div id="main">
            <div class="page-title">
                <h2>Create Project</h2>
            </div>
            <?php
                require "includes/dbh.inc.php";

                $sql = "SELECT * FROM projects ORDER BY created DESC";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $id = $row['project_id'];

                if(mysqli_num_rows($result) == 0){
                    $id = 0;
                }
                $id = $id + 1;

                $length = 3;
                $id = substr(str_repeat(0, $length).$id, - $length);

                $month = date('m');
                $month = (int)$month;
                $months = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
                $m = $months[$month-1];
            ?>
            <div class="main-content">
                <div class="form-content">
                    <form action="" id="createproject">
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Lab Order No</label>
                                <input type="text" disabled value="<?php echo "PQS-" . date("Y") . "-" . $m . "-" . $id; ?>">
                            </div>
                            <div class="input-box">
                                <label for="">Customer</label>
                                <select id="customer"></select>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Report Format</label>
                                <select id="report_format">
                                    <option value="All samples in one report">All samples in one report</option>
                                </select>
                            </div>
                            <div class="input-box">
                                <label for="">Results Dispatch</label>
                                <select id="results_dispatch">
                                    <option value="Electronically">Electronically</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Number of samples</label>
                                <input type="number" id="sample_amount">
                            </div>
                            <div class="input-box"></div>
                        </div>

                        <div class="label-title">Billing</div>
                        <div class="input-box radio">
                            <label for="">Payment Made?</label>
                            <select id="payment">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Amount Charged</label>
                                <input type="text" id="amount_charged" disabled>
                            </div>
                            <div class="input-box">
                                <label for="">Receipt no</label>
                                <input type="text" id="receipt_no" disabled>
                            </div>
                        </div>
                        
                        <div id="errors" class="errors"></div>

                        <div class="button-box flex">
                            <button id="createprojectbtn">CREATE PROJECT</button>
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
    if(!isset($_SESSION['pqsuser']) || $_SESSION['designation'] != "System") {
        header('location: ../login.php');
    }
?>