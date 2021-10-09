<?php
    require "dbh.inc.php";

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "
            <div class='content-table'>
                <div class='table-row head'>
                    <div class='rq'>Full Name</div>
                    <div class='ph'>Username</div>
                    <div class='ph'>Designation</div>
                </div>
        ";

        while($row = mysqli_fetch_assoc($result)){
            $name = $row['firstname'] . " " . $row['lastname'];
            $username = $row['username'];
            $designation = $row['designation'];

            $change = "change-password.php?u=" . $username;

            echo "
                <div class='table-row'>
                    <div class='rq'>
                        <div class='name'>$name</div>
                        <a href='$change'><button class='link'>Reset password</button></a>
                        <button class='link del' id='d$username'>Delete</button>
                    </div>
                    <div class='ph'>
                        $username
                    </div>
                    <div class='ph'>
                        $designation
                    </div>
                </div>
                <script>
                    $('#d$username').click(()=>{
                        if(window.confirm('Permanently delete this user?')){
                            $('#d$username').html('<img src=img/35.gif class=button-loader>')
                            $.ajax({
                                type: 'POST',
                                url: 'includes/delete-user.inc.php',
                                data: {username: '$username'}, 
                                success: (data)=>{
                                    data = JSON.parse(data)
                                    if(data.message == 'success'){
                                        toastr.success('User deleted successfully')
                                        $('#users').load('includes/users.inc.php')
                                    }
                                }
                            })
                        }
                    })
                </script>
            ";
        }

        echo "</div>";
    }
    else {
        echo "<div class='info'>There are no users to display. <a href='add-user.php'>Add</a> now.</div>";
    }
?>