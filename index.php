<?php
    include_once "inc/header.php";
    include_once "inc/slider.php";

?>
    <section class="feature-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="pro-head">
                        <h2 class="text-primary">FEATURE PRODUCT</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="all_product">
            <div class="container">
                <div class="row">
                    <?php
                        $featureProduct=$product->getFeatureView();

                        if (isset($featureProduct)){
                            while ($feature=$featureProduct->fetch_assoc()){
                    ?>
                        <div class="col-lg-3 col-md-4">
                            <div class="product">
                                <div class="pro-img">
                                    <a href="product_details.php?proId=<?php echo $feature['productId']; ?>"><img class="img-fluid" src="admin/upload/<?php echo $feature['image']; ?>" alt="image"></a>
                                </div>
                                <div class="pro-details">
                                    <h4 class="pro-name"><?php echo $feature['productName']; ?></h4>
                                    <?php
                                        $ratingPro=$product->ratingProduct($feature['productId']);
                                        if ($ratingPro==false){
                                            $ratingPro=0;
                                        }
                                    ?>
                                    <p style="margin: 0" class="font-italic text-primary"><?php if (isset($ratingPro)){ echo 'Rating ( '.$ratingPro.' )'; }  ?></p>
                                    <p style="padding: 5px"><?php echo substr($feature['body'],'0','100').'.....'; ?></p>
                                    <h4 style="margin-top: 5px" class="text-danger text-center"><?php echo $feature['price']; ?> Tk</h4>
                                    <div class="card-body">
                                        <a class="btn btn-success" href="product_details.php?proId=<?php echo $feature['productId']; ?>">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } }else{ echo "<p class='alert alert-danger'>You have no feature product.</p>"; } ?>
                </div>
            </div>
        </div>
    </section>
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
                        $perPage=4;
                        if (isset($_GET['page']) && is_numeric($_GET['page'])){
                            $page=$_GET['page'];
                        }else{
                            $page=1;
                        }
                        $start=($page-1)*$perPage;
                    if(!empty($value)){
                        $searchResult=$product->searchProduct($value);
                        if($searchResult!=false){
                            $generalProduct=$searchResult;
                        }
                    } else{
                        $generalProduct=$product->getGeneralView($start);
                    }
                    if (isset($generalProduct)){
                        while ($general=$generalProduct->fetch_assoc()){
                            ?>
                            <div class="col-lg-3 col-md-4">
                                <div class="product">
                                    <div class="pro-img">
                                        <a href="product_details.php?proId=<?php echo $general['productId']; ?>"><img class="img-fluid" src="admin/upload/<?php echo $general['image']; ?>" alt="image"></a>
                                    </div>
                                    <div class="pro-details">
                                        <h4 class="pro-name"><?php echo $general['productName']; ?></h4>
                                        <?php
                                            $ratingPro=$product->ratingProduct($general['productId']);
                                            if ($ratingPro==false){
                                                $ratingPro=0;
                                            }
                                        ?>
                                        <p style="margin: 0" class="font-italic text-primary"><?php if (isset($ratingPro)){ echo 'Rating ( '.$ratingPro.' )'; }  ?></p>
                                        <p style="padding: 5px"><?php echo substr($general['body'],'0','100').'.....'; ?></p>
                                        <h4 style="margin-top: 5px"  class="text-danger text-center font-italic"><?php echo $general['price']; ?> Tk</h4>
                                        <div class="card-body">
                                            <a class="btn btn-success" href="product_details.php?proId=<?php echo $general['productId']; ?>">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } }else{ echo "<p class='alert alert-danger'>You have no feature product.</p>"; } ?>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="Page navigation example" class="float-right">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php
                                if($page-1==0){
                                    echo 1;
                                }else{
                                    echo $page-1;
                                }
                                ?>"><?php if ($page-1==0){ echo "First Page";}else{echo "Previous"; } ?></a></li>
                            <?php
                                $getgeneral="SELECT * FROM tbl_product WHERE type=1";
                                $allPro=database::connect()->query($getgeneral)->num_rows;
                                $totalPage=ceil($allPro/4);
                               for ($i=1;$i<=$totalPage;$i++){
                                   ?>
                                   <li class='page-item <?php if ($i==$page){ echo  "active"; } ?>'><a class='page-link' href='index.php?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
                                   <?php

                               }
                            ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php
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
        </div>
    </section>
<?php
    include_once "inc/footer.php";
?>