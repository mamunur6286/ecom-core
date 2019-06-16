<?php
    include_once "inc/header.php";
?>
<?php
if (Session::get('custLogin')==true){
    echo "<script>window.location='index.php';</script>";
}
?>
<section class="cust-login">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <div class="login-header">
                    <h2 class="text-dark">Login Here</h2>
                </div>

                <?php
                    if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['login_btn'])){
                        $email=$_POST['email'];
                        $password=$_POST['password'];
                        $loginResult=$customerLogin->login($email,$password);
                        if (isset($loginResult)){
                            echo $loginResult;
                        }
                    }
                ?>
                <?php
                    if( isset($_GET['msg']) && $_GET['msg']=='msg' && !isset($loginResult)){
                        echo "<p class='alert alert-danger'>For order your product.Please login or register first.</p>";
                    }
                ?>
                <form role="form" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label>Your Email</label>
                        <input class="form-control" name="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label>Your Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Your password">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="client_remember" id="client_remember" class="btn btn-mini custom-checkbox active" value="1"
                                <?php
                                if(isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
                                    echo 'checked="checked"';
                                }
                                else {
                                    echo '';
                                }
                                ?> >
                            &nbsp;&nbsp;&nbsp;Remember Me
                        </label>
                    </div>
                    <div class="form-group forget">
                        <input class="btn btn-primary" type="submit" name="login_btn" value="Login">
                            <span>Or</span>
                            <a class="btn btn-success" href="register.php">Register Now</a>
                           <a href="forget_password.php"><h5>Forget Password?</h5></a>
                    </div>
                </form>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
</section>

<?php
    include_once "inc/footer.php";
?>