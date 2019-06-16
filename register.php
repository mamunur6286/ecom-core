<?php
    include_once "inc/header.php";
?>

<section class="cust-register">
    <div class="container">
        <div class="row">
            <div class="col-md-1">

            </div>
            <div class="col-md-10">
                <div class="register-header">
                    <h2 class="text-dark">Register Here</h2>
                </div>
                <?php
                if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['register_btn'])){
                    $registerResult=$customer->addCustomer($_POST,$_FILES);
                    if(isset($registerResult)){
                        echo $registerResult;
                    }
                }
                ?>
                <form role="form" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Your Image</label>
                                <input class="form-control" type="file" name="image">
                            </div>
                            <div class="form-group">
                                <label>Your Name</label>
                                <input class="form-control" name="name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label>Your Country</label>
                                <input class="form-control" name="country" placeholder="Your email">
                            </div>
                            <div class="form-group">
                                <label>Your City</label>
                                <input class="form-control" name="city" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label>City Code</label>
                                <input class="form-control" name="city_code" placeholder="Your email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Your Address</label>
                                <input class="form-control" name="address" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label>Your Email</label>
                                <input class="form-control" name="email" placeholder="Your email">
                            </div>
                            <div class="form-group">
                                <label>Your phone</label>
                                <input class="form-control" name="phone" placeholder="Enter your mobile">
                            </div>
                            <div class="form-group">
                                <label>Your password</label>
                                <input type='password' class="form-control" name="password" placeholder="Your password">
                            </div>
                            <div class="form-group">
                                <label>Your Confirm password</label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Your confirm password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" align="center">
                        <input class="btn btn-primary register-btn" type="submit" name="register_btn" value="Create Account">
                    </div>
                </form>
            </div>
            <div class="col-md-1">

            </div>
        </div>
    </div>
</section>

<?php
    include_once "inc/footer.php";

?>