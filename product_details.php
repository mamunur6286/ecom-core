<?php
    include_once "inc/header.php";
?>

<section class="details">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="main-view card">

                    <?php
                        if(!isset($_GET['proId'])|| $_GET['proId']=="" || !is_numeric($_GET['proId'])){
                            echo "<script>window.location='404.php'</script>";
                        }else{
                            $proId=preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['proId']);
                            $getDetailsResult=$product->getAllProductById($proId);
                        }
                    ?>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="pro-img text-center">
                                <a href="admin/upload/<?php echo $getDetailsResult['image']; ?>" target="_blank"><img class="img-fluid" src="admin/upload/<?php echo $getDetailsResult['image']; ?>" alt="image" width="300px" height="300px"></a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="main-details ">
                                <ul>
                                    <li><h3 class="text-danger"><?php echo $getDetailsResult['productName']; ?></h3></li>
                                    <li><h4 class='font-italic'><span class="text-primary">Price : </span><?php echo $getDetailsResult['price']; ?> TK</h4></li>
                                    <li><h4 class='font-italic'><span span class="text-primary">Category :</span><?php echo $getDetailsResult['category']; ?></h4></li>
                                    <li><h4 class='font-italic'><span span class="text-primary">Brand: </span><?php echo $getDetailsResult['brand']; ?></h4></li>
                                    <?php
                                    $ratingPro=$product->ratingProduct($getDetailsResult['productId']);
                                    if ($ratingPro==false){
                                        $ratingPro=0;
                                    }
                                    ?>
                                    <h5 style="margin: 0" class="font-italic text-info"><?php if (isset($ratingPro)){ echo 'Rating ( '.$ratingPro.' )'; }  ?></h5>
                                    <li>
                                        <?php
                                        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add_cart'])){
                                            $quantity=$_POST['quantity'];
                                            $cartResult=$cart->addToCart($quantity,$proId);
                                            if (isset($cartResult)){
                                                echo $cartResult;
                                            }
                                        }
                                        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add_wishList'])){
                                            $quantity=$_POST['quantity'];
                                            if(isset($_SESSION['customerId'])){
                                                $customerId=$_SESSION['customerId'];
                                                $wishListResult=$product->addToWishList($customerId,$quantity,$proId);
                                            }else{
                                                echo "<script>window.location='login.php';</script>";
                                            }
                                            if (isset($wishListResult)){
                                                echo $wishListResult;
                                            }
                                        }
                                        ?>
                                        <form action="" class="" method="post">
                                            <input class="form-control-sm border" name="quantity" type="number" value="1">
                                            <input style="margin-top: 8px" class="btn btn-sm btn-warning text-center" name="add_cart" type="submit" value="Add to cart"><br>
                                            <input style="margin-top: 8px" class="btn btn-sm btn-info text-center" name="add_wishList" type="submit" value="Add To Wish List">
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="details-header">
                                    <h5 style="margin-top: 10px" class="bg-primary text-light">PRODUCT DETAILS</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <p><?php echo $getDetailsResult['body']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="categores">
                    <div class="brand-list">
                        <ul>
                            <li class="border-bottom "><h3 class="text-primary">Brand List</h3></li>
                            <?php
                                $getBrand=$brand->getBrandRows();
                                if (isset($getBrand)){
                                    while ($brandResult=$getBrand->fetch_assoc()){
                            ?>
                                        <a style="text-decoration: none" class="text-primary" href="product_by_brand.php?brandId=<?php echo $brandResult['brandid']; ?>"><li class="border-bottom "><img src="images/drop_arrow.png" width="16px"><?php echo $brandResult['brand']; ?></li></a>
                                    <?php    }}else { echo "<p class='alert alert-danger'>You have no brand.</p>"; } ?>
                        </ul>
                    </div>
                    <div class="category-list">
                        <ul>
                            <li class="border-bottom "><h3 class="text-primary">Category List</h3></li>
                            <?php
                            $getCategory=$category->getCategoryRows();
                            if (isset($getCategory)){
                                while ($categoryResult=$getCategory->fetch_assoc()){
                                    ?>
                                    <a style="text-decoration: none" class="text-primary" href="product_by_cat.php?catId=<?php echo $categoryResult['catid']; ?>"><li class="border-bottom "><img src="images/drop_arrow.png" width="16px"><?php echo $categoryResult['category']; ?></li></a>
                                <?php    }}else { echo "<p class='alert alert-danger'>You have no category.</p>"; } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    include_once "inc/footer.php";
?>