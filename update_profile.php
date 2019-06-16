<?php include "inc/header.php"; ?>

<?php
if (Session::get('custLogin')==false){
    Session::destroy();
    echo "<script>window.location='login.php';</script>";
}
?>

    <div class="container">
        <br>
        <div id="" class="card">
            <div class="card-body">
                <div class="card-header">
                    <h3 class="text-center font-italic text-primary text-center">Update Profile</h3>

                </div>
                <?php
                    if(isset($_SESSION['customerId'])){
                        $customerId=$_SESSION['customerId'];
                    }
                    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['update_btn'])){
                        $updateResult=$customer->updateCustomer($_POST,$_FILES,$customerId);
                        if(isset($updateResult)){
                            echo $updateResult;
                        }
                    }
                    $getCustomer=$customer->getCustomerById($customerId);
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                        <br>
                        <img class="img-thumbnail" style="width: 200px; height: 220px;" src="<?php echo $getCustomer['image']; ?>">
                    </div>
                    <br>
                    <table class="table-responsive-sm table  table-responsive-md bg-light">
                        <tr>
                            <td>Image </td>
                            <td><input type="file" name="image"></td>
                        </tr>
                        <tr>
                            <td>Name </td>
                            <td><input class="form-control" type="text" name="name" value="<?php echo $getCustomer['customerName']; ?>"></td>
                        </tr>
                        <tr>
                            <td>City </td>
                            <td><input class="form-control" type="text" name="city" value="<?php echo $getCustomer['customerCity']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Country </td>
                            <td><input class="form-control" type="text" name="country" value="<?php echo $getCustomer['customerCountry']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Address </td>
                            <td><input class="form-control" type="text" name="address" value="<?php echo $getCustomer['address']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td><input class="form-control" type="text" name="email" value="<?php echo $getCustomer['email']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Mobile </td>
                            <td><input class="form-control" type="text" name="phone" value="<?php echo $getCustomer['phone']; ?>"></td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td><input type="submit" class=" btn btn-primary" name="update_btn" href="" value="Update Now"> </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php include "inc/footer.php";?>