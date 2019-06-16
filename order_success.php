<?php include "inc/header.php"; ?>
    <br>
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="text-center font-italic text-primary text-center">Chose Your Payment Option</h3>
                    </div>
                    <br>
                    <br>
                    <div class='row'>
                        <div class="col-lg-1">

                        </div>
                        <div class="col-md-10 text-center" style="font-size: 17px">
                            <p>Your order successfully.</p><p  class="text-danger">Total amount(including vat) <?php echo  $_SESSION['total']; ?> tk.</p>
                            <p>Thanks for order.We call you for discuss about your order.Your order details <a href="order.php">here</a>.</p>
                        </div>
                        <div class="col-lg-1">

                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-1">

        </div>
    </div>
    <br>
    <br>
<?php include "inc/footer.php";?>