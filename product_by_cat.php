<?php
include_once "inc/header.php";
include_once "inc/slider.php";
?>
    <section class="feature-product">
        <div class="container">
            <div class="row">
                <?php
                    if(!isset($_GET['catId']) || $_GET['catId']==""){
                        echo "<script>window.location='404.php';</script>";
                    }else{
                        $catId=$_GET['catId'];
                    }
                    $getCat=$category->getCatById($catId);
                ?>
                <div class="col-md-12">
                    <div class="pro-head">
                        <h2 class="text-primary"><?php echo $getCat['category']; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="all_product">
            <div class="container">
                <div class="row">
                    <?php

                    $productByCat=$product->getProductByCatId($catId);

                    if (isset($productByCat)){
                        while ($productRow=$productByCat->fetch_assoc()){
                            ?>
                            <div class="col-lg-3 col-md-4">
                                <div class="product">
                                    <div class="pro-img">
                                        <a href="product_details.php?proId=<?php echo $productRow['productId']; ?>"><img class="img-fluid" src="admin/upload/<?php echo $productRow['image']; ?>" alt="image"></a>
                                    </div>
                                    <div class="pro-details">
                                        <h4 class="pro-name"><?php echo $productRow['productName']; ?></h4>
                                        <?php
                                            $ratingPro=$product->ratingProduct($productRow['productId']);
                                            if ($ratingPro==false){
                                                $ratingPro=0;
                                            }
                                        ?>
                                        <p style="margin: 0" class="font-italic text-primary"><?php if (isset($ratingPro)){ echo 'Rating ( '.$ratingPro.' )'; }  ?></p>
                                        <p style="padding: 5px"><?php echo substr($productRow['body'],'0','100').'.....'; ?></p>
                                        <h4 style="margin-top: 5px"  class="text-danger text-center font-italic"><?php echo $productRow['price']; ?> Tk</h4>
                                        <div class="card-body">
                                            <a class="btn btn-success" href="product_details.php?proId=<?php echo $productRow['productId']; ?>">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } }else{ echo "<p class='alert alert-danger'>You have no feature product.</p>"; } ?>
                </div>
            </div>
        </div>
    </section>
<?php
include_once "inc/footer.php";
?>