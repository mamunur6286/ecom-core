<?php
    include_once "inc/header.php";
?>

<section class="admin-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <div class="contact-header">
                    <h2 class="text-dark">Contact Us</h2>
                </div>
                <?php
                    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['send_btn'])){
                        $sendResult=$contact->sendMessage($_POST);
                        if(isset($sendResult)){
                            echo $sendResult;
                        }
                    }
                ?>
                <form role="form" class="admin-form" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label>Your Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label>Your Email</label>
                        <input class="form-control" type="text" name="email" placeholder="Your email">
                    </div>
                    <div class="form-group">
                        <label>Your Mobile</label>
                        <input class="form-control" type="text" name="phone" placeholder="Your phone">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" rows="6" cols="" name="message" placeholder="Your Message"></textarea>
                    </div>
                    <div class="form-group" align="right">
                        <input class="form-control btn btn-success contact-submit" type="submit" name="send_btn" value="Send">
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