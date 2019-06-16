<?php
    include_once "inc/header.php";
    include_once "inc/slider.php";
?>






    <?php
        if(!empty($value)){
            $searchResult=$product->searchProduct($value);
            if($searchResult!=false){
                ?>
                <section class="feature-product">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pro-head">
                                    <h2 class="text-primary">ALL PRODUCT</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="all_product">
                        <div class="container">
                            <div class="row">
                                <?php

                                if (isset($searchResult)){
                                    while ($productRow=$searchResult->fetch_assoc()){
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
                                <?php } }else{ echo "<div class='col-md-12 text-center'><p class='alert alert-danger text-center' >You have no product.</p></div> "; } ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }
        } else{
            ?>
            <section class="feature-product">
                <?php
                $getBrand=$brand->getBrandLimit();
                if($getBrand){
                    while ($getId=$getBrand->fetch_assoc()){
                        $bId=$getId['brandid'];
                        ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pro-head">
                                        <h2 class="text-primary"><?php echo $getId['brand']; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="all_product">
                            <div class="container">
                                <div class="row">
                                    <?php
                                    $topProduct=$product->getBrandTop($bId);
                                    if (isset($topProduct)){
                                        while ($productResult=$topProduct->fetch_assoc()){
                                            ?>
                                            <div class="col-lg-3 col-md-4">
                                                <div class="product">
                                                    <div class="pro-img">
                                                        <a href="product_details.php?proId=<?php echo $productResult['productId']; ?>"><img class="img-fluid" src="admin/upload/<?php echo $productResult['image']; ?>" alt="image"></a>
                                                    </div>
                                                    <div class="pro-details">
                                                        <h4 class="pro-name"><?php echo $productResult['productName']; ?></h4>
                                                        <?php
                                                        $ratingPro=$product->ratingProduct($productResult['productId']);
                                                        if ($ratingPro==false){
                                                            $ratingPro=0;
                                                        }
                                                        ?>
                                                        <p style="margin: 0" class="font-italic text-primary"><?php if (isset($ratingPro)){ echo 'Rating ( '.$ratingPro.' )'; }  ?></p>
                                                        <p style="padding: 5px"><?php echo substr($productResult['body'],'0','80'); ?></p>
                                                        <form method="post" action="product_details.php?proId=<?php echo $productResult['productId']; ?>">
                                                            <input type="submit" class="btn btn-success" value="Details">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }} ?>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>
            </section>
            <?php
        }
    ?>

<?php
    include_once "inc/footer.php";

?>