<?php include "inc/header.php"; ?>

<?php
    if (Session::get('custLogin')==false){
        Session::destroy();
        echo "<script>window.location='login.php';</script>";
    }
?>
<script>
    function printdiv(printpage)
    {
        var headstr = "<html><head><title></title></head><body>";
        var footstr = "</body>";
        var newstr = document.all.item(printpage).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr+newstr+footstr;
        window.print();
        document.body.innerHTML = oldstr;
        return false;
    }
</script>
    <div class="container">
        <br>
        <p style="font-size: 18px;">For print your profile click <a class="text-primary" style="text-decoration: none;" onClick="printdiv('div_print')" href="">here.</a></p>
        <br>
        <div id="div_print" class="card">
            <div class="card-body">
                <div class="card-header">
                    <h3 class="text-center font-italic text-primary text-center">Profile Page</h3>
                    <?php
                        if(isset($_SESSION['customerId'])){
                            $customerId=$_SESSION['customerId'];
                        }
                        $getCustomer=$customer->getCustomerById($customerId);
                    ?>
                </div>
                <div class="text-center">
                    <br>
                    <img class="img-thumbnail" style="width: 200px; height: 220px;" src="<?php echo $getCustomer['image']; ?>">

                </div>
                <br>
                <table class="table-responsive-sm table  table-responsive-md bg-light">
                    <tr>
                        <td>Name </td>
                        <td><?php echo $getCustomer['customerName']; ?></td>
                    </tr>
                    <tr>
                        <td>City </td>
                        <td><?php echo $getCustomer['customerCity']; ?></td>
                    </tr>
                    <tr>
                        <td>Country </td>
                        <td><?php echo $getCustomer['customerCountry'];  ?></td>
                    </tr>
                    <tr>
                        <td>Address </td>
                        <td><?php echo $getCustomer['address']; ?></td>
                    </tr>
                    <tr>
                        <td>Email </td>
                        <td><?php echo $getCustomer['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Mobile </td>
                        <td><?php echo $getCustomer['phone']; ?></td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td><a style="text-decoration: none;" class="text-primary font-italic" href="update_profile.php">Update Profile</a> </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php include "inc/footer.php";?>