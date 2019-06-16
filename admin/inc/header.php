<?php

    require_once '../lib/Session.php';
    Session::init();
    require_once '../lib/Database.php';
    require_once '../classes/adminLogin.php';
    $adminLogin= new adminLogin();
    require_once '../classes/Brand.php';
    $brand= new Brand();
    require_once '../classes/Category.php';
    $category= new Category();
    require_once '../classes/product.php';
    $product= new Product();
    require_once '../classes/Customers.php';
    $customer= new Customers();
    require_once '../classes/Contact.php';
    $contact= new Contact();
    require_once '../classes/Order.php';
    $order= new Order();

    Session::checkSession();


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>online store</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
    <script src="assets/js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            $('#firstDatePicker').datepicker({
                dateFormat:'yy-mm-dd',
                changeYear:true,
                changeMonth:true
            });
            $('#secondDatePicker').datepicker({
                dateFormat:'yy-mm-dd',
                changeYear:true,
                changeMonth:true
            });
            $('#date').datepicker({
                dateFormat:'yy-mm-dd',
                changeYear:true,
                changeMonth:true
            });
            $(document).tooltip({
                track:true
            });
            $('#sidebar-btn').click(function () {
                $('.sidebar-option').slideToggle('slow');
            });
            $('#accordion').accordion();
        });
    </script>
    <style>
        .button-img{
            width: 60px;
            height: 40px;
            border-radius: 7px;
            border: 1px solid gray;
        }
        #sidebar-btn{
            display: none;
        }
        @media all and (min-width: 575px) {
            .sidebar-option {
                position: fixed;
                top: 51px;
                bottom: 0;
                left: 0;
                z-index: 1000;
                padding: 20px 0;
                overflow-x: hidden;
                overflow-y: auto;
                border-right: 1px solid #eee;
            }
        }
        @media all and (max-width: 575px) {
            .sidebar-option {
                padding: 20px 0;
                width: 200px;
                display: none;
            }
            #sidebar-btn{
                display: block;
                margin-left: 45px;
            }
        }
        @media all and (max-width: 200px) {
            #sidebar-btn{
                margin-top: 45px;
            }
        }


    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" style="font-size: 26px" href="index.php">Online Store</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse float-right"  id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">

            </ul>
            <?php
                if (isset($_GET['action']) && $_GET['action']=="logout") {
                    session_destroy();
                    echo "<script>window.location='login.php';</script>";
                }
            ?>
            <a href="?action=logout" style="padding-right: 15px ">Logout</a><span class="text-light"><?php echo '('.$_SESSION['adminName'].')'; ?></span>
        </div>
    </nav>
</header>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <button id="sidebar-btn" class=""><img class="button-img" src="img/button.PNG"></button>
        </div>
    </div>

    <div class="row">
        <nav class="col-sm-3 col-md-2  d-sm-block bg-dark sidebar-option">
            <ul id="accordion">
                <li style="list-style: none; margin-top: -6px" class="text-center text-light bg-primary nav-link">Side Menu</li>
                <li>
                    <a href="">Product</a>
                    <ul>
                        <li><a href="add_product.php">Add Product</a></li>
                        <li><a href="product_list.php">Product List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="">Category</a>
                    <ul>
                        <li><a href="add_category.php">Add Category</a></li>
                        <li><a href="category_list.php">Category List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="">Brand</a>
                    <ul>
                        <li><a href="add_brand.php">Add Brand</a></li>
                        <li><a href="brand_list.php">Brand List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="">Order</a>
                    <ul>
                        <?php
                            $pendingOrdr=$order->getPendingWithoutLimit();
                            if ($pendingOrdr){
                                $t_pending=$pendingOrdr->num_rows;
                            }
                            $orderTotal=$order->getTotalOrderForAvg();
                            if ($orderTotal){
                                $t_order=$orderTotal->num_rows;
                            }
                        ?>
                        <li><a href="pending_order.php">Pending Order <?php if (isset($t_pending)){ echo '('.$t_pending.')'; }  ?></a></li>
                        <li><a href="total_order.php">Total Order <?php if (isset($t_order)){ echo '('.$t_order.')'; }  ?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="">Customer</a>
                    <ul>
                        <li><a href="customer_list.php">Customer List</a></li>
                    </ul>
                </li>
                <li>
                    <?php
                        $unseenMsg=$contact->getTotalUnseenMessage();
                        if ($unseenMsg){
                            $t_unseenMsg=$unseenMsg->num_rows;
                        }
                    ?>
                    <a href="">Message <?php if (isset($t_unseenMsg)){ echo '('.$t_unseenMsg.')'; }  ?></a>
                    <ul>
                        <li><a href="unseen_message.php">Unseen Message</a></li>
                        <li><a href="seen_message.php">Seen Message</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">