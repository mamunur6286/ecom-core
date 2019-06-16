    <?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Update Product</h5>
    </div>
    <?php
        if($_GET['proId']=="" || !is_numeric($_GET['proId'])){
            echo "<script>window.location='index.php'</script>";
        }else{
            $proId=$_GET['proId'];
        }
        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['update_btn'])){
            $updateProduct=$product->updateProduct($proId,$_POST,$_FILES);
        }
        $getProductById=$product->getProductById($proId);
    ?>
    <form role="form" class="admin-form" enctype="multipart/form-data" method="post">
        <?php
        if (isset($updateProduct)){
            echo $updateProduct;
        }
        ?>
        <div class="row">
            <div class="col-md-4">

            </div> <div class="col-md-4 text-center">
                <img class="img-thumbnail text-center" style="width: 200px; height: 200px;" src="upload/<?php echo $getProductById['image']; ?>">
            </div>
            <div class="col-md-4">

            </div>

        </div>
        <div class="row card-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Product Name</label>
                    <input class="form-control" value="<?php echo $getProductById['productName']; ?>" type="text" name="productName" placeholder="Enter your product name">
                </div>
                <div class="form-group">
                    <label>Product Descriptioption</label>
                    <textarea class="form-control" rows="6" cols="" name="body" placeholder="Your description"><?php echo $getProductById['body']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Upload Image</label>
                    <input class="form-control-file" type="file" name="image">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Product Category</label>
                    <select class="form-control" name="category">
                        <option value="">Select One</option>
                        <?php
                        $getlCatagory= $category->getCategoryRows();
                        if ($getlCatagory){
                            while ($catagoryReslt=$getlCatagory->fetch_assoc()){
                                ?>
                                <option <?php if($getProductById['catId']==$catagoryReslt['catid']){ echo "selected"; } ?> value="<?php echo $catagoryReslt['catid']; ?>"><?php echo $catagoryReslt['category']; ?></option>
                            <?php }} ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Product Brand</label>
                    <select class="form-control" name="brand">
                        <option value="">Select One</option>
                        <?php
                        $getBrand=$brand->getBrandRows();
                        if ($getBrand){
                            while ($bandResult=$getBrand->fetch_assoc()){
                                ?>
                                <option <?php if($getProductById['brandId']==$bandResult['brandid']){ echo "selected"; } ?> value="<?php echo $bandResult['brandid']; ?>"><?php echo $bandResult['brand']; ?></option>
                            <?php }} ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Product Price</label>
                    <input class="form-control" value="<?php echo $getProductById['price']; ?>" type="text" name="price" placeholder="Product price">
                </div>
                <div class="form-group">
                    <label>Product Category</label>
                    <select class="form-control" name="type">
                        <option value="">Select One</option>
                        <option <?php if($getProductById['type']==0){ echo "selected"; } ?> value="0">Featured</option>
                        <option <?php if($getProductById['type']==1){ echo "selected"; } ?> value="1">General</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <input class="btn btn-success btn-block form-control" type="submit" name="update_btn" value="Update Product">
                <br>
                <br>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </form>
<?php include "inc/footer.php";?>