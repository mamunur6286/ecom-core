<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Pending Order List</h5>
    </div>
    <div class="card-body">
        <form class="form-inline mt-2 mt-md-0">
            <input id="piff" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
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
                    <th>Status</th>
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

                $getPendingOrder=$order->getOrderPendingProductAdmin($start,$perPage);
                if(isset($getPendingOrder)){
                    $i=$page*$perPage-$perPage;
                    while ($result=$getPendingOrder->fetch_assoc()){
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
                                <?php $customerId=$result['customerId'];
                                if($result['status']==0){
                                    echo "<a href='confirm_order.php?custId=$customerId'>Confirm</a>";
                                }else{
                                    echo "Shifted";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if($result['status']==0){
                                    echo "N/A";
                                }else{
                                    ?>
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure to delete order: <?php echo $result['orderId']; ?>')" href="?delOrder=<?php echo $result['orderId']; ?>">X</a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    } }
                ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example" class="float-right">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="pending_order.php?page=<?php
                    if($page-1==0){
                        echo 1;
                    }else{
                        echo $page-1;
                    }
                    ?>"><?php if ($page-1==0){ echo "First Page";}else{echo "Previous"; } ?></a></li>
                <?php
                $getPending="SELECT * FROM tbl_order WHERE status=0";
                $allPending=database::connect()->query($getPending)->num_rows;
                $totalPage=ceil($allPending/10);
                if($totalPage>=5){
                    $totalP=5;
                }else{
                    $totalP=$totalPage;
                }
                for ($i=1;$i<=$totalP;$i++){
                    ?>
                    <li class='page-item <?php if ($i==$page){ echo  "active"; } ?>'><a class='page-link' href='pending_order.php?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
                    <?php

                }
                if($totalPage>5){
                ?>

                <li class="page-item <?php if ( $page>5 && $page<$totalPage){ echo "active";} ?>"><a class="page-link">.</a></li>
                <li class="page-item"><a class="page-link">.</a></li>
                <li class="page-item <?php if ( $page>5 && $page+1>$totalPage){ echo "active";} ?>" ><a class="page-link">.</a></li>
                <?php } ?>
                <li class="page-item "><a class="page-link" href="pending_order.php?page=<?php
                    if($page+1>$totalPage){
                        echo $totalPage;
                    }else{
                        echo $page+1;
                    }
                    ?>"><?php if ($page+1>$totalPage){ echo "Last Page";}else{echo "Next"; } ?></a></li>
            </ul>
        </nav>
    </div>

<?php include "inc/footer.php";?>