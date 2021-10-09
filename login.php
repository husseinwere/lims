<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HKT | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/login.js"></script>
    <link rel="shortcut icon" type="image/png" href="img/fav-logo.png"/>
</head>
<body>
    <div id="accounts">
        <div id="form">
            <div class="logo">
                <img src="img/kephis-logo.png" alt="">
            </div>
            <form action="">
                <div class="input-box">
                    <label for="">Username</label>
                    <input type="text" id="username">
                </div>
                
                <div class="input-box">
                    <label for="">Designation</label>
                    <select id="designation">
                        <option value="System">System</option>
                        <option value="Mycology">Mycology</option>
                        <option value="Virology">Virology</option>
                        <option value="Bacteriology">Bacteriology</option>
                        <option value="Nematology">Nematology</option>
                        <option value="Entomology">Entomology</option>
                        <option value="Tissue Culture">Tissue Culture</option>
                        <option value="Molecular">Molecular</option>
                    </select>
                </div>

                <div class="input-box">
                    <label for="">Password</label>
                    <div class="password">
                        <input id="password-input" type="password">
                        <i id="show" class="fa fa-eye" aria-hidden="true"></i>
                        <i id="hide" class="fa fa-eye-slash" aria-hidden="true"></i>
                    </div>
                </div>

                <div id="errors" class="errors"></div>

                <div class="button-box">
                    <button id="login">LOGIN</button>
                </div>
            </form>
        </div>
        <div id="bg"></div>
    </div>
</body>
</html>