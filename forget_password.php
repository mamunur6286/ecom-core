<?php
include_once "inc/header.php";
?>
    <section class="cust-login">
        <div class="container">
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-6">
                    <div class="login-header">
                        <h2 class="text-dark">Forget Password</h2>
                    </div>
                    <form role="form" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label>Your Email</label>
                            <input class="form-control" name="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group forget">
                            <input class="btn btn-primary" type="submit" name="send_code" value="Send Code">
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