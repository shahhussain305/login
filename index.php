<?php
//-------Display page errors------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("libs/classes/MyMethods.php");
$method = new MyMethods();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo($method->baseUrl()); ?>/assets/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo($method->baseUrl()); ?>/assets/custom_css.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo($method->baseUrl()); ?>/assets/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?php echo($method->baseUrl()); ?>/assets/jquery/popper.min.js"></script>
    <script src="<?php echo($method->baseUrl()); ?>/assets/bootstrap4/js/bootstrap.min.js"></script>
    <script src="<?php echo($method->baseUrl()); ?>/assets/jquery/Login.js" ></script>
    <script src="<?php echo($method->baseUrl()); ?>/assets/jquery/login_function.js" ></script>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo($method->baseUrl()); ?>/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo($method->baseUrl()); ?>/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo($method->baseUrl()); ?>/favicon/favicon-16x16.png">
<link rel="manifest" href="<?php echo($method->baseUrl()); ?>/favicon/site.webmanifest">
    <title>ESDN Login System with Multi-users support</title>
</head>
<body>
        <div class="sidenav"></div>
        <div class="main">
            <div class="col-md-6 col-sm-12">
                <div class="login-form">
                    <form>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control" id="user_id" placeholder="User Name">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="user_key" class="form-control" placeholder="Password">
                        </div>
                        <input type="button" class="btn btn-black login" value="Login">
                        <a href="javascript:void(0)" class="forgot_password">Forgot Password?</a>
                    </form>
                    <div class="msg"></div>
                </div>
            </div>
        </div>

</body>
</html>
