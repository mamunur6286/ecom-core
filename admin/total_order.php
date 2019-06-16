<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Total Order List</h5>
    </div>

<?php
    if(isset($_GET['delOrder'])){
        $productDelete=$order->deleteTotalOrder($_GET['delOrder']);
    }
    if (isset($productDelete)){
        echo $productDelete;
    }
?>
    <div class="card-body">
        <div class="text-center">
            <form method="post" class="form-inline mt-2 mt-md-0">
                <label>Start Date : </label>
                <input style="margin-left: 10px" readonly id="firstDatePicker" name="firstDate" class="form-control mr-sm-2" type="" placeholder="yyyy-mm-dd" >
                <label>End Date : </label>
                <input style="margin-left: 10px" readonly id="secondDatePicker" name="secondDate" class="form-control mr-sm-2" type="" placeholder="yyyy-mm-dd" >
                <button name="show_btn" class="btn btn-success my-2 my-sm-0" type="submit">Show order</button>
            </form>
            <br>
            <?php
            if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['search_btn'])){
                $searchValue=$_POST['searchValue'];
            }
            ?>
            <form  method="post" class="form-inline mt-2 mt-md-0">
                <input required name="searchValue" id="piff" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button name="search_btn" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <br>
        <div  class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="bg-info text-light">
                <tr>
                    <th>SL No</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $perPage=10;
                if (isset($_GET['page']) && is_numeric($_GET['page'])){
                    $page=$_GET['page'];
                }else{
                    $page=1;
                }
                $start=($page-1)*$perPage;


                if(isset($_SERVER['REQUEST_METHOD'])=='POST' && isset($_POST['show_btn'])){
                    $showResult=$order->showOrderByDate($_POST);
                }
                if(!empty($searchValue)){
                    $showResult=true;
                    $searchResult=$order->searchTotalOrder($searchValue);
                    if($searchResult!=false){
                        $getTotalOrder=$searchResult;
                        $getTotal=$searchResult;
                        $showResult=true;
                        $i=0;
                    }
                }elseif ( isset($showResult) && $showResult!=false){
                    $getTotalOrder=$showResult;
                    $showResult=true;
                    $i=0;
                }else{
                    $getTotalOrder=$order->getTotalOrder($start,$perPage);
                    $getTotal=$order->getTotalOrderForAvg();
                    $i=$page*$perPage-$perPage;
                    $showResult=false;
                }
                if(isset($getTotalOrder)){
                    while ($result=$getTotalOrder->fetch_assoc()){
                        $i++;
                        ?>
                        <tr class="bg-light">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['productName']?></td>
                            <td><img width="30px" height="30px" src="upload/<?php echo $result['image']; ?>"></td>
                            <td><?php echo $result['price']?></td>
                            <td><?php echo $result['quantity']?></td>
                            <td><?php echo date('d F Y h:i a',strtotime($result['orderDate'])); ?></td>
                            <td>
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure to delete order: <?php echo $result['orderId']; ?>')" href="?delOrder=<?php echo $result['orderId']; ?>">X</a>
                            </td>
                        </tr>
                        <?php
                    } }else{ echo "<div class='col-md-12 text-center'><p class='alert alert-danger text-center' >You have no product.</p></div> "; }
                ?>
                </tbody>
            </table>
        </div>
        <?php
        if($showResult==false){
            ?>
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="Page navigation example" class="float-right">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="total_order.php?page=<?php
                                if($page-1==0){
                                    echo 1;
                                }else{
                                    echo $page-1;
                                }
                                ?>"><?php if ($page-1==0){ echo "First Page";}else{echo "Previous"; } ?></a></li>
                            <?php
                            $getPending="SELECT * FROM tbl_total_order";
                            $allPending=database::connect()->query($getPending)->num_rows;
                            $totalPage=ceil($allPending/10);
                            if($totalPage>=5){
                                $totalP=5;
                            }else{
                                $totalP=$totalPage;
                            }
                            for ($i=1;$i<=$totalP;$i++){
                                ?>
                                <li class='page-item <?php if ($i==$page){ echo  "active"; } ?>'><a class='page-link' href='total_order.php?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
                                <?php

                            }
                            if($totalPage>5){
                                ?>

                                <li class="page-item <?php if ( $page>5 && $page<$totalPage){ echo "active";} ?>"><a class="page-link">.</a></li>
                                <li class="page-item"><a class="page-link">.</a></li>
                                <li class="page-item <?php if ( $page>5 && $page+1>$totalPage){ echo "active";} ?>" ><a class="page-link">.</a></li>
                            <?php } ?>
                            <li class="page-item "><a class="page-link" href="total_order.php?page=<?php
                                if($page+1>$totalPage){
                                    echo $totalPage;
                                }else{
                                    echo $page+1;
                                }
                                ?>"><?php if ($page+1>$totalPage){ echo "Last Page";}else{echo "Next"; } ?></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-8 col-md-6">

            </div>
            <?php
            if(isset($getTotal)){
                $sum=0;
                $qnty=0;
                foreach ($getTotal as $totalOrder){
                    $sum=$totalOrder['price']*$totalOrder['quantity']+$sum;
                    $qnty=$totalOrder['quantity']+$qnty;
                }
            }
            ?>
            <div class="col-lg-4 col-md-6">
                <table class="table table-bordered  text-dark">
                    <tr>
                        <td>Total Order :</td>
                        <td><?php if (isset($getTotal)){ echo $getTotal->num_rows; }  ?></td>
                    </tr>
                    <tr>
                        <td>Total Quantity :</td>
                        <td><?php if (isset($qnty)){ echo $qnty; }  ?></td>
                    </tr>
                    <tr>
                        <td>Sub Total :</td>
                        <td>TK. <?php if (isset($sum)){ echo $sum; }  ?></td>
                    </tr>
                    <tr>
                        <td>VAT 10% :</td>
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

<?php include "inc/footer.php";?>