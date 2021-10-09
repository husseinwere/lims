<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                <a href="home.php"><button class="active"><i class="fa fa-home" aria-hidden="true"></i>Home</button></a>
                <a href="projects.php"><button><i class="fa fa-files-o" aria-hidden="true"></i>Projects</button></a>
                <a href="test-methods.php"><button><i class="fa fa-flask" aria-hidden="true"></i>Test Methods</button></a>
                <a href="add-test-method.php"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Test Method</button></a>
                <a href="users.php"><button><i class="fa fa-users" aria-hidden="true"></i>Users</button></a>
            </div>
        </div>
        <div id="sidebar-rep"></div>
        <div id="main">
            <div class="page-title">
                <h2>Dashboard</h2>
            </div>
            <div class="main-content">
                <div class="info">
                    <h2 class="content-title"><b>Welcome to the <?php echo strtoupper($_SESSION['designation']); ?> user dashboard</b></h2>
                    <p>Navigate through the system using the links on the menu</p>
                </div>
            </div>
            <?php
                require "includes/dbh.inc.php";
                $lab = $_SESSION['designation'];

                $sql = "SELECT * FROM users WHERE designation = '$lab'";
                $result = mysqli_query($conn, $sql);
                $users = mysqli_num_rows($result);

                $sql = "SELECT * FROM lab_tests WHERE lab = '$lab' AND results = ''";
                $result = mysqli_query($conn, $sql);
                $pending_tests = mysqli_num_rows($result);

                $sql = "SELECT * FROM test_methods WHERE lab = '$lab'";
                $result = mysqli_query($conn, $sql);
                $test_methods = mysqli_num_rows($result);

                $complete_projects = 0;
                $sql = "SELECT DISTINCT project_code FROM lab_tests WHERE lab = '$lab'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    $project_code = $row['project_code'];
                    $sql = "SELECT * FROM projects WHERE project_code = '$project_code' AND status = 'complete'";
                    $result2 = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result2) > 0){
                        $complete_projects = $complete_projects + 1;
                    }
                }
            ?>
            <div class="card-house">
                <a href="test-methods.php" class="cardh">
                    <div class="header"><img src='img/tests.png' class="icon"><br>Test Methods</div>
                    <div class="value"><?php echo $test_methods; ?></div>
                </a>
                <a href="projects.php" class="cardh">
                    <div class="header"><img src='img/incomplete.png' class="icon"><br>Pending tests</div>
                    <div class="value"><?php echo $pending_tests; ?></div>
                </a>
                <a href="complete-projects.php" class="cardh">
                    <div class="header"><img src='img/complete.png' class="icon"><br>Complete projects</div>
                    <div class="value"><?php echo $complete_projects; ?></div>
                </a>
                <a href="users.php" class="cardh">
                    <div class="header"><img src='img/users.png' class="icon"><br>Users</div>
                    <div class="value"><?php echo $users; ?></div>
                </a>
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