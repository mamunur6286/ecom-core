<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Add Category</h5>
    </div>

<?php
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add_btn'])){
    $addResult=$category->addCategory($_POST['categoryName']);
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
                    <label>Category Name</label>
                    <input class="form-control" type="text" name="categoryName" placeholder="Enter your product name">
                </div>
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="add_btn" value="Add Category">
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
<?php include "inc/footer.php";?>