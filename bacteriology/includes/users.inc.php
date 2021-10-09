<?php
    session_start();
    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "Bacteriology"){
        require "dbh.inc.php";

        $designation = $_SESSION['designation'];
        $sql = "SELECT * FROM users WHERE designation = '$designation'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            echo "
                <div class='content-table'>
                    <div class='table-row head'>
                        <div class='rq'>Full Name</div>
                        <div class='ph'>Username</div>
                        <div class='ph'>Email</div>
                    </div>
            ";

            while($row = mysqli_fetch_assoc($result)){
                $name = $row['firstname'] . " " . $row['lastname'];
                $username = $row['username'];
                $email = $row['email'];
                $role = $row['role'];

                echo "
                    <div class='table-row'>
                        <div class='rq'>
                            <div class='name'>$name</div>
                            <span class='thethorn' style='color: green'>$role</span>
                        </div>
                        <div class='ph'>
                            $username
                        </div>
                        <div class='ph'>
                            $email
                        </div>
                    </div>
                ";
            }

            echo "</div>";
        }
        else {
            echo "<div class='info'>There are no users to display. <a href='add-user.php'>Add</a> now.</div>";
        }
    }
?>