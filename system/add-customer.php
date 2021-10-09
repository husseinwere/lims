<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT | Add Customer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/add-customer.js"></script>
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
                <a href="add-customer.php"><button class="active"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Customer</button></a>
                <a href="projects.php"><button><i class="fa fa-files-o" aria-hidden="true"></i>Projects</button></a>
                <a href="create-project.php"><button><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>Create Project</button></a>
                <a href="test-methods.php"><button><i class="fa fa-flask" aria-hidden="true"></i>Test Methods</button></a>
                <a href="add-test-method.php"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Test Method</button></a>
                <a href="users.php"><button><i class="fa fa-users" aria-hidden="true"></i>Users</button></a>
                <a href="database.php"><button><i class="fa fa-database" aria-hidden="true"></i>Database</button></a>
            </div>
        </div>
        <div id="sidebar-rep"></div>
        <div id="main">
            <div class="page-title">
                <h2>Add Customer</h2>
            </div>
            <div class="main-content">
                <div class="form-content">
                    <form action="">
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Name</label>
                                <input type="text" id="company_name">
                            </div>
                            <div class="input-box">
                                <label for="">Type</label>
                                <select id="type">
                                    <option value="International">International</option>
                                    <option value="JKIA">JKIA</option>
                                    <option value="KEPHIS Office">KEPHIS Office</option>
                                    <option value="KEPHIS Regional Office">KEPHIS Regional Office</option>
                                    <option value="Local Customer">Local Customer</option>
                                    <option value="Ministry of Health">Ministry of Health</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Category</label>
                                <select id="customer_category">
                                    <option value="Public">Public</option>
                                    <option value="Private">Private</option>
                                    <option value="KEPHIS">KEPHIS</option>
                                </select>
                            </div>
                            <div class="input-box"></div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Phone</label>
                                <input type="text" id="phone">
                            </div>
                            <div class="input-box">
                                <label for="">Email</label>
                                <input type="text" id="email">
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Address</label>
                                <input type="text" id="address">
                            </div>
                            <div class="input-box">
                                <label for="">Address 2</label>
                                <input type="text" id="address2">
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Description</label>
                                <textarea id="description"></textarea>
                            </div>
                            <div class="input-box"></div>
                        </div>
                        
                        <div id="errors" class="errors"></div>

                        <div class="button-box flex">
                            <button id="addcustomer">ADD CUSTOMER</button>
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