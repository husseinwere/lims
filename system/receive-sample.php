<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT | Receive Sample</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/receive-sample.js"></script>
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
                <h2>Receive Sample</h2>
            </div>
            <div class="main-content">
                <div class="form-content">
                    <form action="" id="logsample">
                        <div class="label-title">Reception</div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Lot/Ref no</label>
                                <input type="text" id="ref_no">
                            </div>
                            <div class="input-box">
                                <label for="">Sampled By</label>
                                <input type="text" id="sampled_by">
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Date Sampled</label>
                                <input type="date" id="date_sampled">
                            </div>
                            <div class="input-box">
                                <label for="">Date Received</label>
                                <input type="date" id="date_received">
                            </div>
                        </div>

                        <div class="label-title">Sample Details</div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Sample Type</label>
                                <input type="text" id="sample_type">
                            </div>
                            <div class="input-box">
                                <label for="">Sample Variety</label>
                                <input type="text" id="sample_variety">
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Sample Origin</label>
                                <input type="text" id="sample_origin">
                            </div>
                            <div class="input-box">
                                <label for="">Sample Description</label>
                                <textarea id="sample_description"></textarea>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Sample Size</label>
                                <input type="text" id="sample_size">
                            </div>
                            <div class="input-box">
                                <label for="">Sample Condition</label>
                                <select id="sample_condition">
                                    <option value="Good">Good</option>
                                    <option value="Bad">Bad</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Part Submitted</label>
                                <select id="part_submitted">
                                    <option value="Stem">Stem</option>
                                    <option value="Root tuber">Root tuber</option>
                                    <option value="Vegetative material">Vegetative material</option>
                                    <option value="Fruit">Fruit</option>
                                    <option value="Seed">Seed</option>
                                    <option value="Water">Water</option>
                                    <option value="Plant tissue">Plant tissue</option>
                                    <option value="Liquid">Liquid</option>
                                    <option value="Leaves">Leaves</option>
                                    <option value="Whole plant">Whole plant</option>
                                    <option value="Arthropod">Arthropod</option>
                                    <option value="Soil/Rock material">Soil/Rock material</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="input-box">
                                <label for="">Sampling bag</label>
                                <select id="sampling_bag">
                                    <option value="Amber glass bottle">Amber glass bottle</option>
                                    <option value="Box">Box</option>
                                    <option value="Bulk cargo">Bulk cargo</option>
                                    <option value="Clear glass bottle">Clear glass bottle</option>
                                    <option value="Gunny bag">Gunny bag</option>
                                    <option value="Khaki bag">Khaki bag</option>
                                    <option value="Net">Net</option>
                                    <option value="Plastic">Plastic</option>
                                    <option value="Plastic paper bag">Plastic paper bag</option>
                                    <option value="Sisal bag">Sisal bag</option>
                                    <option value="Tin">Tin</option>
                                    <option value="Vials">Vials</option>
                                </select>
                            </div>
                        </div>

                        <div class="label-title">Lab Details</div>
                        <div class="input-box">
                            <label for="">Select test methods(s)</label>
                            <div id="labs"></div>
                        </div>

                        <div class="label-title">Other Details</div>
                        <div class="input-flex">
                            <div class="input-box">
                                <label for="">Additional Information</label>
                                <textarea id="additional_info"></textarea>
                            </div>
                            <div class="input-box"></div>
                        </div>
                        
                        <div id="errors" class="errors"></div>

                        <div class="button-box flex">
                            <button type="submit" id="logsamplebtn">LOG SAMPLE</button>
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