<?php
    include_once "inc/header.php";
?>
<section class="admin-contact">
    <div class="container">
        <div class="row">
            <div class=" col-lg-12 col-md-12">
                <div style="margin-top: 7px" class="card">
                    <div class="card-header">
                        <h3 class="text-dark text-lg-left">Your Cart Here</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-md table-responsive-sm text-center">
                            <thead class="bg-dark text-light"
                            <tr>
                                <th>SL No</th>
                                <th>Product Name</th>
                                <th>Image</th>
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
                                        <tr class="bg-light">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $array[$key]['proName']; ?></td>
                                            <td><img class="figure-img" width="60px" height="50px" src="admin/upload/<?php echo $array[$key]['proImage']; ?>" alt="img"></td>
                                            <td>
                                                <form action="" class="" method="post">
                                                    <input class="form-control-sm border qnty" type="number" name="qnty" value="<?php echo $array[$key]['proQuantity']; ?>">
                                                    <input type="hidden" name="updateKey" value="<?php echo $key; ?>">
                                                    <input class="btn btn-sm btn-dark text-center " type="submit" name="update_quantity" value="Update">
                                                </form>
                                            </td>
                                            <td><?php echo $array[$key]['proPrice']; ?></td>
                                            <td><?php echo $array[$key]['proPrice']*$array[$key]['proQuantity']; ?></td>
                                            <td><a onclick="return confirm('Are you sure to delete this cart value?')" class=" btn btn-outline-danger" href="?delKey=<?php echo $key;?>">X</a></td>
                                        </tr>
                                       <?php
                                    }
                                }
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-8">

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <table class="table border text-dark font-weight-bold">
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
                        <div class="col-md-6 text-center">
                            <a href="index.php"><img src="images/shop.png"></a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="payment.php"><img src="images/check.png" width="280px" height="80px"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include_once "inc/footer.php";
?>