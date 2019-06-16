<?php

    //class for cart
    Class Cart{

        //method for add cart with session
        public function addToCart($quantity,$proId){
            $quantity=mysqli_real_escape_string(database::connect(),$quantity);
            $proId=mysqli_real_escape_string(database::connect(),$proId);
            if($quantity<1){
                return "<p class='alert alert-danger'><strong>Error!</strong> Please minimum one product select for Cart.</p>";
            }else {
                $chkKey = "pro_" . $proId;
                function check($chkKey)
                {
                    if (isset($_SESSION['all_pro'])) {
                        foreach ($_SESSION['all_pro'] as $k => $v) {
                            if ($k == $chkKey) {
                                return "<p class='alert alert-danger'><strong>Error!</strong>This product is already added into Cart.</p>";
                            }
                        }
                    }

                }
                if(check($chkKey)){
                    return check($chkKey);
                }else{
                    //read product data for add cart
                    $query="SELECT * FROM tbl_product WHERE productId='$proId'";
                    $getData=database::connect()->query($query)->fetch_assoc();
                    if($getData){
                        $productId=$getData['productId'];
                        $productName=$getData['productName'];
                        $productImage=$getData['image'];
                        $productPrice=$getData['price'];
                    }
                    //add data in session
                    $proDetails=['proId'=>$productId,
                        'proName'=>$productName,
                        'proImage'=>$productImage,
                        'proPrice'=>$productPrice,
                        'proQuantity'=>$quantity];
                    $uniqueId="pro_".$proId;
                    $_SESSION['all_pro'][$uniqueId]=$proDetails;
                    echo"<script>window.location='cart.php';</script>";
                }

            }
        }


        //update quantity for cart
        public function updateCart($quantity){
            if($quantity<1){
                echo "<p class='alert alert-danger'><strong>Error!</strong>Quantity must be getter than one.</p>";
            }else{
                $updateKey=$_POST['updateKey'];
                $_SESSION['all_pro'][$updateKey]['proQuantity']=$quantity;
                echo "<script>location='cart.php';</script>";
            }
        }

        //delete cart for product cart
        public function deleteCart($delKey){
            if($delKey){
                unset($_SESSION['all_pro'][$delKey]);
            }
        }
    }
?>