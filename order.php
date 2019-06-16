<?php include "inc/header.php"; ?>
<?php
if (Session::get('custLogin')==false){
    Session::destroy();
    echo "<script>window.location='login.php';</script>";
}
?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h3>Your Total Order</h3>
                        </div>
                        <?php
                            $getOrder=$order->getPendingOrderByCustomerId($_SESSION['customerId']);
                            if($getOrder){
                        ?>
                        <h5 style="margin-bottom: 10px;margin-top: 10px" class="font-italic text-primary">Pending Product</h5>
                        <table class="table text-center table-bordered table-responsive-sm table-responsive-md">
                            <thead>
                            <th>SL NO</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            </thead>
                            <?php
                                $i=0;
                                $sum=0;
                                while ($penOrder=$getOrder->fetch_assoc()){
                                    $i++;
                                    $sum=$penOrder['price']*$penOrder['quantity']+$sum;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $penOrder['productName']; ?></td>
                                        <td><img style="width: 60px; height: 60px" src="admin/upload/<?php echo $penOrder['image']; ?>" alt="Image"></td>
                                        <td><?php echo $penOrder['price']; ?></td>
                                        <td><?php echo $penOrder['quantity']; ?></td>
                                        <td><?php echo date('d F Y h:i a',strtotime($penOrder['orderDate'])); ?></td>
                                        <td>
                                            <?php
                                            if($penOrder['status']==0){
                                                echo "Pending";
                                            }else{
                                                echo "Shifted";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($penOrder['status']==0){
                                                echo "N/A";
                                            }else{
                                                ?>
                                                <a class="btn btn-danger" onclick="return confirm('Are you sure to delete cart: <?php echo $penOrder['orderId']; ?>')" href="?delCart=<?php echo $penOrder['orderId']; ?>">X</a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
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
                            <?php } ?>
                        <?php
                            if(isset($_GET['shiftDelId'])){
                                $productDelete=$order->deleteShiftedOrder($_GET['shiftDelId']);
                            }
                            if (isset($productDelete)){
                                echo $productDelete;
                            }
                        ?>
                        <?php
                            $perPage=5;
                            if (isset($_GET['page']) && is_numeric($_GET['page'])){
                                $page=$_GET['page'];
                            }else{
                                $page=1;
                            }
                            $start=($page-1)*$perPage;
                            $getOrder=$order->getShiftedOrderByCustomerId($_SESSION['customerId'],$start,$perPage);
                                if($getOrder){
                        ?>
                        <h5 style="margin-bottom: 10px;margin-top: 10px" class="font-italic text-primary">Shifted Product</h5>
                        <table class="table text-center table-bordered table-responsive-sm table-responsive-md">
                            <thead>
                            <th>SL NO</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            </thead>
                            <?php
                                $i=$page*$perPage-$perPage;
                                while ($shiftOrder=$getOrder->fetch_assoc()){
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $shiftOrder['productName']; ?></td>
                                        <td><img style="width: 60px; height: 60px" src="admin/upload/<?php echo $shiftOrder['image']; ?>" alt="Image"></td>
                                        <td><?php echo $shiftOrder['price']; ?></td>
                                        <td><?php echo $shiftOrder['quantity']; ?></td>
                                        <td><?php echo date('d F Y h:i a',strtotime($shiftOrder['orderDate'])); ?></td>
                                        <td>
                                            <?php
                                            if($shiftOrder['status']==0){
                                                echo "Pending";
                                            }else{
                                                echo "Shifted";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($shiftOrder['status']==0){
                                                echo "N/A";
                                            }else{
                                                ?>
                                                <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this shifted Order')" href="?shiftDelId=<?php echo $shiftOrder['orderId']; ?>">X</a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php }?>
                        </table>
                        <nav aria-label="Page navigation example" class="float-right">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="order.php?page=<?php
                                    if($page-1==0){
                                        echo 1;
                                    }else{
                                        echo $page-1;
                                    }
                                    ?>"><?php if ($page-1==0){ echo "First Page";}else{echo "Previous"; } ?></a></li>
                                <?php
                                    $getshifted="SELECT * FROM tbl_order WHERE status=1";
                                    $allShifted=database::connect()->query($getshifted)->num_rows;
                                    $totalPage=ceil($allShifted/5);
                                    if($totalPage>=5){
                                        $totalP=5;
                                    }else{
                                        $totalP=$totalPage;
                                    }
                                    for ($i=1;$i<=$totalP;$i++){
                                ?>
                                    <li class='page-item <?php if ($i==$page){ echo  "active"; } ?>'><a class='page-link' href='order.php?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
                                <?php

                                }
                                    if($totalPage>5){
                                    ?>

                                    <li class="page-item <?php if ( $page>5 && $page<$totalPage){ echo "active";} ?>"><a class="page-link">.</a></li>
                                    <li class="page-item"><a class="page-link">.</a></li>
                                    <li class="page-item <?php if ( $page>5 && $page+1>$totalPage){ echo "active";} ?>" ><a class="page-link">.</a></li>
                                <?php } ?>
                                <li class="page-item "><a class="page-link" href="order.php?page=<?php
                                    if($page+1>$totalPage){
                                        echo $totalPage;
                                    }else{
                                        echo $page+1;
                                    }
                                    ?>"><?php if ($page+1>$totalPage){ echo "Last Page";}else{echo "Next"; } ?></a></li>
                            </ul>
                        </nav>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
<?php include "inc/footer.php";?>