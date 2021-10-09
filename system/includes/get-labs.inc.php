<?php
    header('Content-Type: application/x-www-form-urlencoded');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    session_start();

    if(isset($_SESSION['pqsuser']) && $_SESSION['designation'] == "System"){
        require 'dbh.inc.php';

        $sql = "SELECT * FROM laboratories";
        $result = mysqli_query($conn, $sql);

        $labs = "";
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];

            $labs .= "
                <div class='lab-test'>
                    <label class='radio'>
                        <span>$name</span>
                    </label>
                    <div style='margin-bottom: 10px;'>
            ";

            $sql = "SELECT * FROM test_methods WHERE lab = '$name'";
            $result2 = mysqli_query($conn, $sql);
            $labs .= "";
            while($row2 = mysqli_fetch_assoc($result2)){
                $acronym = $row2['acronym'];
                $test_method = $row2['name'];
                $labs .= "
                    <label class='radio'><input type='checkbox' value='$acronym' name='test_methods' style='width: unset'><span>$test_method</span></label>
                ";
            }

            $labs .= "</div></div>";
        }

        echo json_encode(array(
            'message' => 'success',
            'labs' => $labs
        ));
    }
?>