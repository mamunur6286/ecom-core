<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Product List</h5>
    </div>

<?php
    if(isset($_GET['proDelId'])){
        $productDelete=$product->deleteProduct($_GET['proDelId']);
    }
    if (isset($productDelete)){
        echo $productDelete;
    }
?>
    <div class="card-body">
        <?php
            if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['search_btn'])){
                $searchValue=$_POST['searchValue'];
            }
        ?>
        <form  method="post" class="form-inline mt-2 mt-md-0">
            <input required name="searchValue" id="piff" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button name="search_btn" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <br>
        <div  class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="bg-info text-light">
                <tr>
                    <th>SL No</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
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
                if(!empty($searchValue)){
                    $searchResult=$product->searchProduct($searchValue);
                    if($searchResult!=false){
                        $getProduct=$searchResult;
                    }
                } else{
                    $getProduct=$product->getProduct($start,$perPage);
                }
                if(isset($getProduct)){
                    $i=$page*$perPage-$perPage;
                    while ($result=$getProduct->fetch_assoc()){
                        $i++;
                        ?>
                        <tr class="bg-light">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['productName']?></td>
                            <td><img width="60px" height="60px" src="upload/<?php echo $result['image']; ?>"></td>
                            <td><?php echo  substr($result['body'],'0','20')."...."; ?></td>
                            <td><?php echo $result['category']?></td>
                            <td><?php echo $result['brand']?></td>
                            <td><?php echo $result['price']?></td>
                            <td>
                                <a class="btn btn-success" href="edit_product.php?proId=<?php echo $result['productId'] ?>">Edit</a>
                                <a class="btn btn-danger" onclick="return confirm('Are you sure to delete product: <?php echo $result['productName']; ?>')" href="product_list.php?proDelId=<?php echo $result['productId'] ?>">X</a>
                            </td>
                        </tr>
                        <?php
                    } }else{ echo "<div class='col-md-12 text-center'><p class='alert alert-danger text-center' >You have no product.</p></div> "; }
                ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example" class="float-right">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="product_list.php?page=<?php
                    if($page-1==0){
                        echo 1;
                    }else{
                        echo $page-1;
                    }
                    ?>"><?php if ($page-1==0){ echo "First Page";}else{echo "Previous"; } ?></a></li>
                <?php
                $getPro="SELECT * FROM tbl_product";
                $allPro=database::connect()->query($getPro)->num_rows;
                $totalPage=ceil($allPro/10);
                if($totalPage>=5){
                    $totalP=5;
                }else{
                    $totalP=$totalPage;
                }
                for ($i=1;$i<=$totalP;$i++){
                    ?>
                    <li class='page-item <?php if ($i==$page){ echo  "active"; } ?>'><a class='page-link' href='product_list.php?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
                    <?php

                }
                if($totalPage>5){
                    ?>

                    <li class="page-item <?php if ( $page>5 && $page<$totalPage){ echo "active";} ?>"><a class="page-link">.</a></li>
                    <li class="page-item"><a class="page-link">.</a></li>
                    <li class="page-item <?php if ( $page>5 && $page+1>$totalPage){ echo "active";} ?>" ><a class="page-link">.</a></li>
                <?php } ?>
                <li class="page-item "><a class="page-link" href="product_list.php?page=<?php
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