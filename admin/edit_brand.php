<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Update Brand</h5>
    </div>
<?php
if($_GET['brandId']=="" || !is_numeric($_GET['brandId'])){
    echo "<script>window.location='brand_list.php'</script>";
}else{
    $brandId=$_GET['brandId'];
}
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['update_btn'])){
    $updateResult=$brand->updateBrand($brandId,$_POST['brandName']);
}
$getBrandById=$brand->getBrandById($brandId);
?>
    <form role="form" class="admin-form" enctype="multipart/form-data" method="post">
        <div class="row card-body">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php
                if (isset($updateResult)){
                    echo $updateResult;
                }
                ?>
                <div class="form-group">
                    <label>Brand Name</label>
                    <input class="form-control" value="<?php echo $getBrandById['brand']; ?>" type="text" name="brandName" placeholder="Enter your brand name">
                </div>
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="update_btn" value="Update Brand">
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
<?php include "inc/footer.php";?>