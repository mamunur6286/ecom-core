<section class="slider-brand">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <?php
                    $getBrand=$brand->getBrandLimit();
                    if($getBrand){
                    while ($getId=$getBrand->fetch_assoc()){
                    $bId=$getId['brandid'];
                    $getBrandFirst=$product->getBrandFirst($bId);
                    if($getBrandFirst){
                    while($LatestBrand=$getBrandFirst->fetch_assoc()){
                    ?>
                    <div class="col-lg-6 col-md-12">
                        <div class="brand">
                            <div class="brand-img">
                                <a href="product_details.php?proId=<?php echo  $LatestBrand['productId']; ?>"><img src="admin/upload/<?php echo$LatestBrand['image']; ?>"></a>
                            </div>
                            <div class="brand-details">
                                <h5 class="text-primary font-italic"><?php echo$LatestBrand['brand']; ?></h5>
                                <?php
                                    $ratingPro=$product->ratingProduct($LatestBrand['productId']);
                                    if ($ratingPro==false){
                                        $ratingPro=0;
                                    }
                                ?>
                                <p style="margin: 0" class="font-italic text-info"><?php if (isset($ratingPro)){ echo 'Rating ( '.$ratingPro.' )'; }  ?></p>
                                <p style="padding: 4px" class="font-weight-bold text-danger"><?php echo $LatestBrand['productName']; ?></p>
                                <form method="post" action="product_details.php?proId=<?php echo  $LatestBrand['productId']; ?>">
                                    <input class="btn btn-primary" type="submit" name="add-cart" value="Add to cart">
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } } }}?>
                </div>
            </div>
            <div class=" col-lg-6 col-md-12">
                <div class="slider">
                    <!--start div slider-->
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="images/1.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/2.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/3.jpg" alt="Third slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/4.jpg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>