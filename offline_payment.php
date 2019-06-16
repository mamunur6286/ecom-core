<?php include "inc/header.php"; ?>
<?php
    if (Session::get('custLogin')==false){
        echo "<script>window.location='login.php?msg=msg';</script>";
    }
?>
    <div class="container">
        <br>
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h3 class="text-center font-italic text-primary text-center">Offline Payment Option</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <h5 class="text-center font-italic text-primary text-center">Your Cart</h5>
                    <br>
                    <table class="table table-bordered table-responsive-md table-responsive-sm text-center">
                        <thead class="bg-light">
                        <tr>
                            <th>SL No</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!isset($_GET['id'])){
                            echo '<meta http-equiv="refresh" content="0;URL=?id=mamun"/>';
                        }
                        if (isset($_POST['update_quantity'])){
                            $quantity=$_POST['qnty'];
                            $updateResult=$cart->updateCart($quantity);
                        }
                        if (isset($_GET['delKey'])){
                            $delKey=$_GET['delKey'];
                            $deleteResult=$cart->deleteCart($delKey);
                        }
                        if (isset($_SESSION['all_pro'])){
                            $array=$_SESSION['all_pro'];
                            if (count($array)<1){
                                $_SESSION['grandTotal']=0;
                                $_SESSION['allQuantity']=0;
                                echo "<script>window.location='index.php';</script>";
                            }else{
                                $i=0;
                                $sum=0;
                                $qnty=0;
                                foreach ($array as $key=>$value){
                                    $i++;
                                    $sum= ($array[$key]['proPrice']*$array[$key]['proQuantity'])+$sum;
                                    $qnty=$array[$key]['proQuantity']+$qnty;
                                    ?>
                                    <tr class="">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $array[$key]['proName']; ?></td>
                                        <td><?php echo $array[$key]['proQuantity']; ?></td>
                                        <td><?php echo $array[$key]['proPrice']; ?></td>
                                        <td><?php echo $array[$key]['proPrice']*$array[$key]['proQuantity']; ?></td>
                                        <td><a onclick="return confirm('Are you sure to delete this cart value?')" class=" btn btn-danger" href="?delKey=<?php echo $key;?>">X</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class=" col-lg-7 col-md-6"></div>
                        <div class="col-lg-5 col-md-6">
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
                                            $_SESSION['grandTotal']=$grandTotal;
                                            $_SESSION['allQuantity']=$qnty;
                                        }
                                    ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <?php
                                if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['order_btn'])){
                                    $order->orderProduct();
                                }
                            ?>
                            <form action="" method="post">
                                <input class="btn btn-success" type="submit" name="order_btn" value="Order Now">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <h5 class="text-center font-italic text-primary text-center">Profile</h5>
                    <?php
                        if(isset($_SESSION['customerId'])){
                            $customerId=$_SESSION['customerId'];
                        }
                        $getCustomer=$customer->getCustomerById($customerId);
                    ?>
                    <div class="text-center">
                        <br>
                        <img class="img-thumbnail" style="width: 180px; height: 200px;" src="<?php echo $getCustomer['image']; ?>">

                    </div>
                    <br>
                    <table class="table-responsive-sm table  table-responsive-md bg-light">
                        <tr>
                            <td>Name </td>
                            <td><?php echo $getCustomer['customerName']; ?></td>
                        </tr>
                        <tr>
                            <td>City </td>
                            <td><?php echo $getCustomer['customerCity']; ?> </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td><?php echo $getCustomer['customerCountry']; ?></td>
                        </tr>
                        <tr>
                            <td>Address </td>
                            <td><?php echo $getCustomer['address']; ?></td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td><?php echo $getCustomer['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Mobile </td>
                            <td><?php echo $getCustomer['phone']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><a style="text-decoration: none;" class="text-primary font-italic" href="update_profile.php">Update Profile</a> </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
<?php include "inc/footer.php";?>