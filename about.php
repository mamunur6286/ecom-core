<?php
    include_once "inc/header.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card-body">
                <h3 class="text-center text-secondary">Our Company Information</h3>
                <h6 class=" mt-3 text-info">24 hours | 7 days a week | 365 days a year    Live Technical Support</h6>
                <p class="mt-2 font-weight-normal">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedap euydoeiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.
           reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                <ul class="mt-3 text-center text-primary" style="font-size: 18px">
                    <li> Address: House no:47.Road no:251/252</li>
                    <li>  Uttara Dhaka 1230.</li>
                    <li>    Email: online@info.com</li>
                    <li> Telephone:034309845</li>
                    <li>  Toll Free:+088 0191-830-6970</li>
                </ul>
            </div>
            <div class="service-pro">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="text-center image">
                                <img class="text-center img-fluid p-2 .em" width="220px" height="150px" src="admin/upload/1f480af5512140fc1b9e9bdecffb75.jpg">
                            </div>
                            <h5 class="mt-2 mb-2 text-danger">DSLR Camera</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="text-center">
                                <img class="text-center img-fluid p-2" width="220px" height="150px" src="admin/upload/aeac8ac9a34cb28f80b72c723299c1.jpg">
                            </div>
                            <h5 class="mt-2 mb-2 text-danger">Fan</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="text-center">
                                <img class="text-center img-fluid" width="200px" height="200px" src="admin/upload/74547d6c2907fc0c55b5773a150f88.jpg">
                            </div>
                            <h5 class="mt-2 mb-2 text-danger">Monitor</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="text-center">
                                <img class="text-center img-fluid" width="200px" height="200px" src="admin/upload/9df6bab3a0d41f7f1dbff9d55b4840.jpg">
                            </div>
                            <h5 class="mt-2 mb-2 text-danger">CC Camera</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-body">
                <div class="card">
                    <div class=" bg-info card-header">
                        <h3 class="text-light  text-center">Our Services</h3>
                    </div>
                    <div class="card-body">
                        <div class="services">
                            <ul class="text-info " style="font-size: 20px">
                                 <?php
                            $getCategory=$category->getCategoryRows();
                            if (isset($getCategory)){
                                while ($categoryResult=$getCategory->fetch_assoc()){
                                    ?>
                                    <li class="p-1 border-bottom"><a href="product_by_cat.php?catId=<?php echo $categoryResult['catid']; ?>"><?php echo $categoryResult['category']; ?></a> </li>
                                <?php    }} ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include_once "inc/footer.php";
?>