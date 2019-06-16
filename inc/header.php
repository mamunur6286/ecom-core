<?php
    require_once 'lib/Session.php';
    Session::init();
    require_once 'lib/Database.php';
    require_once 'classes/adminLogin.php';
    $adminLogin= new adminLogin();
    require_once 'classes/Brand.php';
    $brand= new Brand();
    require_once 'classes/Category.php';
    $category= new Category();
    require_once 'classes/product.php';
    $product= new Product();
    require_once 'classes/Cart.php';
    $cart= new Cart();
    require_once 'classes/Contact.php';
    $contact= new Contact();
    require_once 'classes/Customers.php';
    $customer= new Customers();
    require_once 'classes/CustomerLogin.php';
    $customerLogin= new customerLogin();
    require_once 'classes/Order.php';
    $order= new Order();
?>
<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: max-age=2592000");
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <!------------- main css here ---------->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
<header class="header-area bg-dark">
    <div class="container">
        <div class="row">
            <div class=" col-lg-3 col-md-6">
                <div class="logo">
                    <h2>Online Store</h2>
                    <P><a href="index.php">www.onlinestore.com</a></P>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">

                <div class="search">
                    <?php
                        if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['search_btn'])){
                            $value=$_POST['searchValue'];
                        }
                    ?>
                    <form method="post" action="" class="form-inline my-1 my-lg-0">
                        <input required name="searchValue" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-primary my-2 my-sm-0" name="search_btn" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="shopping_cart">
                    <div class="cart">
                        <img src="images/header_cart.png">
                        <a style="text-decoration: none;" href="cart.php" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <span class="no_product">
                                   <?php
                                       if(isset($_SESSION['grandTotal'])) {
                                          if($_SESSION['grandTotal'] > 0) {
                                               $grandTotal=round($_SESSION['grandTotal']);
                                               $allQty=$_SESSION['allQuantity'];
                                               echo $grandTotal." | Qt ".$allQty;
                                           }else{
                                               echo "(empty)";
                                           }
                                       }else {
                                           echo "(empty)";
                                       }
                                   ?>
                                </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="login">
                    <nav>
                        <ul>
                            <?php
                            if (isset($_GET['action'])&& $_GET['action']=='logout'){
                                Session::destroy();
                            }
                                if (isset($_SESSION['custLogin'])==true){
                                    ?>
                                    <li><a class="font-weight-bold" href="?action=logout">Logout</a></li>
                                    <?php
                                }else{
                                    ?>
                                    <li><a class="font-weight-bold" href="login.php">Login</a></li>
                            <?php
                                }
                            ?>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="nav-area bg-success">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a class="menu-bar" href="#"><img width="50px" height="50px" src="images/button.png"></a>
                <div class="main-menu">
                    <nav>
                        <ul id="navber">
                            <?php
                                $exp=explode('/',$_SERVER['SCRIPT_NAME']);
                                $pageName=end($exp);
                            ?>
                            <li><a class="border-left-0 <?php if($pageName=="index.php"){ echo 'active'; } ?>" href="index.php">Home</a></li>
                            <li><a class="<?php if($pageName=="product.php"){ echo 'active'; } ?>" href="product.php">PRODUCT</a></li>
                            <li><a class="<?php if($pageName=="top_brand.php"){ echo 'active'; } ?>" href="top_brand.php">TOP BRAND</a></li>
                            <?php
                                if(isset($_SESSION['all_pro'])){
                                    if(count($_SESSION['all_pro'])>0) {
                                        ?>
                                        <li><a class="<?php if($pageName=="cart.php"){ echo 'active'; } ?>" href="cart.php">Cart</a></li>
                                        <li><a class="<?php if($pageName=="payment.php"){ echo 'active'; } ?>" href="payment.php">Payment</a></li>
                                        <?php
                                    } }
                                ?>
                            <?php
                                if (isset($_SESSION['custLogin'])=='true'){
                                    ?>
                                    <li><a class="<?php if($pageName=="profile.php"){ echo 'active'; } ?>" href='profile.php'>PROFILE</a></li>
                                    <li><a class="<?php if($pageName=="order.php"){ echo 'active'; } ?>" href='order.php'>ORDER</a></li>
                                    <?php
                                        $wishResult=$product->getWishList(0,10);
                                        if ($wishResult){
                                            if($wishResult->num_rows!=0){
                                                ?>
                                                <li><a class="<?php if($pageName=="wishList.php"){ echo 'active'; } ?>" href="wishList.php">WISH LIST</a></li>
                                                <?php
                                            }
                                        }
                                    ?>

                            <?php
                                }
                            ?>
                            <li><a class="<?php if($pageName=="contact.php"){ echo 'active'; } ?>" href="contact.php">CONTACT</a></li>
                            <li><a class="<?php if($pageName=="about.php"){ echo 'active'; } ?>" href="about.php">ABOUT</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>