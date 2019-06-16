<?php include "inc/header.php"; ?>

<?php
?>
    <script>
        function printdiv(printpage)
        {
            var headstr = "<html><head><title></title></head><body>";
            var footstr = "</body>";
            var newstr = document.all.item(printpage).innerHTML;
            var oldstr = document.body.innerHTML;
            document.body.innerHTML = headstr+newstr+footstr;
            window.print();
            document.body.innerHTML = oldstr;
            return false;
        }
    </script>
    <div class="container">
        <br>
        <p style="font-size: 18px;">For print customer order details click <a class="text-primary" style="text-decoration: none;" onClick="printdiv('div_print')" href="">here.</a></p>
        <?php
            if(isset($_GET['custId'])){
                $customerId=$_GET['custId'];
            }else{
                echo "<script>window.location='index.php';</script>";
            }

        ?>
        <div id="div_print" class="card">
            <div class="card-body">
                    <?php
                        $getCustomer=$customer->getCustomerById($customerId);
                    ?>
                    <h3 class="text-center font-italic text-primary text-center"><?php echo $getCustomer['customerName']; ?>  Profile</h3>
                    <br>
                <div class="text-center">
                    <img class="img-thumbnail" style="width: 150px; height: 160px; margin-bottom: 10px" src="../<?php echo $getCustomer['image']; ?>">
                </div>

                <table class="table-responsive-sm table table-bordered  table-responsive-md bg-light">
                    <tr>
                        <td>Name </td>
                        <td><?php echo $getCustomer['customerName']; ?></td>
                        <td>City </td>
                        <td><?php echo $getCustomer['customerCity']; ?></td>
                    </tr>
                    <tr>
                        <td>Country </td>
                        <td><?php echo $getCustomer['customerCountry'];  ?></td>
                        <td>Address </td>
                        <td><?php echo $getCustomer['address']; ?></td>
                    </tr>
                    <tr>
                        <td>Email </td>
                        <td><?php echo $getCustomer['email']; ?></td>
                        <td>Mobile </td>
                        <td><?php echo $getCustomer['phone']; ?></td>
                    </tr>
                </table>
                <h3 class="text-center font-italic text-primary text-center">Your Order</h3>
                <br>
                <?php
                    $getOrderByCustomer=$order->getPendingOrderByCustomerId($customerId);
                    if(isset($_SERVER['REQUEST_METHOD'])=="POST" && isset($_POST['shifted_btn'])){
                        $addTotalProduct=$order->addTotalProduct($customerId);
                        $makeShift=$order->makeShiftProduct($customerId);
                        if (isset($makeShift)){
                            echo $makeShift;
                        }
                    }
                ?>
                <table class="table text-center table-bordered table-responsive-sm table-responsive-md">
                    <thead>
                    <th>SL NO</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Action</th>
                    </thead>
                    <?php
                    if($getOrderByCustomer){
                        $i=0;
                        $sum=0;
                        while ($order=$getOrderByCustomer->fetch_assoc()){
                            $sum=$order['price']*$order['quantity']+$sum;
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $order['productName']; ?></td>
                                <td><img style="width: 60px; height: 60px" src="upload/<?php echo $order['image']; ?>" alt="Image"></td>
                                <td><?php echo $order['price']; ?></td>
                                <td><?php echo $order['quantity']; ?></td>
                                <td><?php echo date('d F Y h:i a',strtotime($order['orderDate'])); ?></td>
                                <td>
                                    <?php
                                    if($order['status']==0){
                                        echo "N/A";
                                    }else{
                                        ?>
                                        <a class="btn btn-danger" onclick="return confirm('Are you sure to delete cart: <?php echo $order['orderId']; ?>')" href="?delCart=<?php echo $order['orderId']; ?>">X</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php }} ?>
                </table>
                <div class="row">
                    <div class="col-md-8">

                    </div>
                    <div class="col-lg-4 col-md-6">
                        <table class="table border text-dark">
                            <tr>
                                <td>Sub Total :</td>
                                <td>TK. <?php if (isset($sum)){ echo $sum; }  ?></td>
                            </tr>
                            <tr>
                                <td>VAT :10% :</td>
                                <td>TK. <?php if (isset($sum)){ echo($sum/100)*10; }  ?></td>
                            </tr>
                            <tr>
                                <td>Grand Total :</td>
                                <td>TK. <?php
                                    if(isset($sum)){
                                        $grandTotal=$sum+($sum/100)*10;
                                        echo $grandTotal;
                                    }
                                    ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4">
                <form action="" method="post">
                    <input class="btn btn-primary btn-block" name="shifted_btn" value="Shifted Now" type="submit">
                </form>
            </div>
            <div class="col-4">
            </div>
        </div>
        <br>
        <br>
    </div>
<?php include "inc/footer.php";?>