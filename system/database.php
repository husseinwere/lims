<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT | Export Database</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.min.js" integrity="sha512-WaHZ16+n6qSSVxDii8MZGmFlnro3iZdJa/hb1XKraoMx1/HVILhLdAX22ypk4lT/8+t4XMYcjzCDwfvZ1CAJgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/css/tableexport.css">
    <link rel="shortcut icon" type="image/png" href="img/fav-logo.png"/>
    <style>
        #tableCarrier {
            display: none;
        }
    </style>
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
                <a href="create-project.php"><button><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>Create Project</button></a>
                <a href="test-methods.php"><button><i class="fa fa-flask" aria-hidden="true"></i>Test Methods</button></a>
                <a href="add-test-method.php"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Test Method</button></a>
                <a href="users.php"><button><i class="fa fa-users" aria-hidden="true"></i>Users</button></a>
                <a href="database.php"><button class="active"><i class="fa fa-database" aria-hidden="true"></i>Database</button></a>
            </div>
        </div>
        <div id="sidebar-rep"></div>
        <div id="main">
            <div class="page-title">
                <h2>Export Database</h2>
            </div>
            <?php
                require "includes/dbh.inc.php";

                $sql = "SELECT * FROM lab_tests";
                $result = mysqli_query($conn, $sql);
                $consolidated = mysqli_num_rows($result);

                $sql = "SELECT * FROM lab_tests WHERE lab = 'Bacteriology'";
                $result = mysqli_query($conn, $sql);
                $bacteriology = mysqli_num_rows($result);

                $sql = "SELECT * FROM lab_tests WHERE lab = 'Entomology'";
                $result = mysqli_query($conn, $sql);
                $entomology = mysqli_num_rows($result);

                $sql = "SELECT * FROM lab_tests WHERE lab = 'Nematology'";
                $result = mysqli_query($conn, $sql);
                $nematology = mysqli_num_rows($result);

                $sql = "SELECT * FROM lab_tests WHERE lab = 'Molecular'";
                $result = mysqli_query($conn, $sql);
                $molecular = mysqli_num_rows($result);

                $sql = "SELECT * FROM lab_tests WHERE lab = 'Tissue Culture'";
                $result = mysqli_query($conn, $sql);
                $tissue_culture = mysqli_num_rows($result);

                $sql = "SELECT * FROM lab_tests WHERE lab = 'Virology'";
                $result = mysqli_query($conn, $sql);
                $virology = mysqli_num_rows($result);

                $sql = "SELECT * FROM lab_tests WHERE lab = 'Mycology'";
                $result = mysqli_query($conn, $sql);
                $mycology = mysqli_num_rows($result);

                $sql = "SELECT * FROM customers";
                $result = mysqli_query($conn, $sql);
                $customers = mysqli_num_rows($result);
            ?>
            <div class="main-content">
                <div class='content-table'>
                    <div class='table-row head'>
                        <div class='rq'>Data</div>
                        <div class='ph'>Records</div>
                    </div>
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>Consolidated database</div>
                            <button class='link' id='consolidateddb'>Export database</button>
                        </div>
                        <div class='ph'><?php echo $consolidated; ?></div>
                    </div>
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>Molecular database</div>
                            <button class='link' id='moleculardb'>Export database</button>
                        </div>
                        <div class='ph'><?php echo $molecular; ?></div>
                    </div>
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>Bacteriology database</div>
                            <button class='link' id='bacteriologydb'>Export database</button>
                        </div>
                        <div class='ph'><?php echo $bacteriology; ?></div>
                    </div>
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>Entomology database</div>
                            <button class='link' id='entomologydb'>Export database</button>
                        </div>
                        <div class='ph'><?php echo $entomology; ?></div>
                    </div>
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>Virology database</div>
                            <button class='link' id='virologydb'>Export database</button>
                        </div>
                        <div class='ph'><?php echo $virology; ?></div>
                    </div>
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>Mycology database</div>
                            <button class='link' id='mycologydb'>Export database</button>
                        </div>
                        <div class='ph'><?php echo $mycology; ?></div>
                    </div>
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>Nematology database</div>
                            <button class='link' id='nematologydb'>Export database</button>
                        </div>
                        <div class='ph'><?php echo $nematology; ?></div>
                    </div>
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>Tissue Culture database</div>
                            <button class='link' id='tissueculturedb'>Export database</button>
                        </div>
                        <div class='ph'><?php echo $tissue_culture; ?></div>
                    </div>
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>Customers database</div>
                            <button class='link' id='customersdb'>Export database</button>
                        </div>
                        <div class='ph'><?php echo $customers; ?></div>
                    </div>
                </div>
            </div>
            <div id="tableCarrier"></div>
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