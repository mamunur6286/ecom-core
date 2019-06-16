<?php
    require_once '../lib/Database.php';
    require_once '../lib/Session.php';
    Session::init();
    require_once '../classes/adminLogin.php';
    $adminLogin= new adminLogin();
    Session::checkLogin();
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <!------------- main css here ---------->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body class="bg-secondary">



<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="main-login bg-light">
                    <h3 class="bg-primary text-light text-center">Login Here</h3>
                    <div class="container">
                        <?php
                            if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['login_btn'])){
                                $username=$_POST['username'];
                                $password=$_POST['password'];
                                $loginResult= $adminLogin->login($username,$password);
                            }
                        ?>
                        <form role="form" enctype="multipart/form-data" method="post">
                            <?php
                                if(isset($loginResult)){
                                    echo $loginResult;
                                }
                            ?>
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" name="username" placeholder="Your username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input  type="password" class="form-control" name="password" placeholder="Your password">
                            </div>
                            <div class="form-group forget">
                                <input class="btn btn-success" type="submit" name="login_btn" value="Login">
                                <a href="#"><h5>Forget Password?</h5></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">

            </div>
        </div>
    </div>
</section>




<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>