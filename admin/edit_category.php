<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Update Category</h5>
    </div>
<?php
    if($_GET['catId']=="" || !is_numeric($_GET['catId'])){
        echo "<script>window.location='category_list.php'</script>";
    }else{
        $catId=$_GET['catId'];
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['update_btn'])){
        $updateResult=$category->updateCategory($catId,$_POST['categoryName']);
    }
    $getCategoryById=$category->getCatById($catId);
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
                    <label>Category Name</label>
                    <input class="form-control" value="<?php echo $getCategoryById['category']; ?>" type="text" name="categoryName" placeholder="Enter your category name">
                </div>
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="update_btn" value="Update Category">
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
<?php include "inc/footer.php";?>