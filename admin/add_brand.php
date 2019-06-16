<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Add Brand</h5>
    </div>

<?php
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add_btn'])){
    $addResult=$brand->addBrand($_POST['brandName']);
}
?>
    <form role="form" class="admin-form" enctype="multipart/form-data" method="post">
        <div class="row card-body">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php
                if (isset($addResult)){
                    echo $addResult;
                }
                ?>
                <div class="form-group">
                    <label>Brand Name</label>
                    <input class="form-control" type="text" name="brandName" placeholder="Enter your brand name">
                </div>
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="add_btn" value="Add Brand">
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
<?php include "inc/footer.php";?>