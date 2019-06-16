<?php include "inc/header.php"; ?>
    <?php
        if(count($_SESSION['all_pro'])<0){
            echo "<script> window.location='index.php';</script>";
        }
    ?>
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
                        <div class="col-md-12">
                            <div class="text-center">
                                <a class="btn btn-success mt-4" href="offline_payment.php">Offline Payment</a>
                                <a class="btn btn-success mt-4" href="">Online Payment</a>
                            </div>

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