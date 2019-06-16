<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Add Product</h5>
    </div>

    <?php
        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add_btn'])){
            $addResult=$product->addProduct($_POST,$_FILES);
        }
    ?>
    <form role="form" class="admin-form" enctype="multipart/form-data" method="post">
        <?php
        if (isset($addResult)){
            echo $addResult;
        }
        ?>
        <div class="row card-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Product Name</label>
                    <input class="form-control" type="text" name="productName" placeholder="Enter your product name">
                </div>
                <div class="form-group">
                    <label>Product Descriptioption</label>
                    <textarea class="form-control" rows="6" cols="" name="body" placeholder="Your description"></textarea>
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
                                <option value="<?php echo $catagoryReslt['catid']; ?>"><?php echo $catagoryReslt['category']; ?></option>
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
                        <option value="<?php echo $bandResult['brandid']; ?>"><?php echo $bandResult['brand']; ?></option>
                        <?php }} ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Product Price</label>
                    <input class="form-control" type="text" name="price" placeholder="Product price">
                </div>
                <div class="form-group">
                    <label>Product Category</label>
                    <select class="form-control" name="type">
                        <option value="">Select One</option>
                        <option value="0">Feature</option>
                        <option value="1">General</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <input class="btn btn-success btn-block form-control" type="submit" name="add_btn" value="Add Product">
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </form>
<?php include "inc/footer.php";?>