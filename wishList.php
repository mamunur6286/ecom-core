<?php include "inc/header.php"; ?>

<?php
    if (Session::get('custLogin')==false){
        Session::destroy();
        echo "<script>window.location='login.php';</script>";
    }
    $wishResult=$product->getWishList(0,10);
    if ($wishResult==false){
        echo "<script>window.location='index.php';</script>";
    }
?>
    <div class="container">
        <br>
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h3 class="font-italic text-primary">Your Wish List</h3>
                </div>
                <br>
                <?php
                    if(isset($_GET['delId'])){
                        $wishDelete=$product->deleteWish($_GET['delId']);
                    }
                    if (isset($wishDelete)){
                        echo $wishDelete;
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
                        $perPage=5;
                        if (isset($_GET['page']) && is_numeric($_GET['page'])){
                            $page=$_GET['page'];
                        }else{
                            $page=1;
                        }
                        $start=($page-1)*$perPage;
                    $getWishList=$product->getWishList($start,$perPage);
                    if ($getWishList){
                        $i=$page*$perPage-$perPage;
                        $sum=0;
                        while ($wishlist=$getWishList->fetch_assoc()){
                            $i++;
                            $sum=$wishlist['price']*$wishlist['quantity']+$sum;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $wishlist['productName']; ?></td>
                                <td><img style="width: 60px; height: 60px" src="admin/upload/<?php echo $wishlist['image']; ?>" alt="Image"></td>
                                <td><?php echo $wishlist['price']; ?></td>
                                <td><?php echo $wishlist['quantity']; ?></td>
                                <td><?php echo date('d F Y h:i a',strtotime($wishlist['wishDate'])); ?></td>
                                <td>
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure to delete cart: <?php echo $wishlist['wishId']; ?>')" href="?delId=<?php echo $wishlist['wishId']; ?>">X</a>
                                </td>
                            </tr>
                        <?php }} ?>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation example" class="float-right">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="wishList.php?page=<?php
                                    if($page-1==0){
                                        echo 1;
                                    }else{
                                        echo $page-1;
                                    }
                                    ?>"><?php if ($page-1==0){ echo "First Page";}else{echo "Previous"; } ?></a></li>
                                <?php
                                $getWishQ="SELECT * FROM tbl_wishlist ORDER BY wishId DESC";
                                $getWish=database::connect()->query($getWishQ)->num_rows;
                                $totalPage=ceil($getWish/5);
                                if($totalPage>=5){
                                    $totalP=5;
                                }else{
                                    $totalP=$totalPage;
                                }
                                for ($i=1;$i<=$totalP;$i++){
                                    ?>
                                    <li class='page-item <?php if ($i==$page){ echo  "active"; } ?>'><a class='page-link' href='wishList.php?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
                                    <?php

                                }
                                if($totalPage>5){
                                    ?>

                                    <li class="page-item <?php if ( $page>5 && $page<$totalPage){ echo "active";} ?>"><a class="page-link">.</a></li>
                                    <li class="page-item"><a class="page-link">.</a></li>
                                    <li class="page-item <?php if ( $page>5 && $page+1>$totalPage){ echo "active";} ?>" ><a class="page-link">.</a></li>
                                <?php } ?>
                                <li class="page-item "><a class="page-link" href="wishList.php?page=<?php
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
                <div class="row">
                    <div class="col-lg-8 col-md-6">

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
    </div>
<?php include "inc/footer.php";?>