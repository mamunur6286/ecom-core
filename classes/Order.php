<?php
    Class Order{
        //Order product
        public function orderProduct(){
            if(isset($_SESSION['all_pro'])) {
                $array = array_reverse($_SESSION['all_pro']);
                foreach ($array as $key => $value) {
                    $customerId=$_SESSION['customerId'];
                    $proId=$array[$key]['proId'];
                    $proName=$array[$key]['proName'];
                    $proImage=$array[$key]['proImage'];
                    $proPrice=$array[$key]['proPrice'];
                    $proQuantity=$array[$key]['proQuantity'];

                    $orderQuery="INSERT INTO tbl_order(customerId,productId,productName,image,quantity,price)
                          VALUES('$customerId','$proId','$proName','$proImage','$proQuantity','$proPrice')";
                    $orderResult=database::connect()->query($orderQuery);
                    if($orderResult){
                        $_SESSION['total']=round($_SESSION['grandTotal']);
                        unset($_SESSION['all_pro']);
                        unset($_SESSION['grandTotal']);
                        unset($_SESSION['allQuantity']);
                        echo "<script>window.location='order_success.php';</script>";
                    }
                }
            }
        }
        //get order product by customer Id pending
        public function getPendingOrderByCustomerId($customerId){
            $query="SELECT * FROM tbl_order WHERE status=0 AND customerId='$customerId' ORDER BY orderId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        } //get order product by customer Id shifted
        public function getShiftedOrderByCustomerId($customerId,$start,$limit){
            $query="SELECT * FROM tbl_order WHERE status=1 AND customerId='$customerId' ORDER BY orderId DESC LIMIT $start,$limit";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }
        //get pending order
        public function getOrderPendingProductAdmin($start,$limit){
            $query="SELECT * FROM tbl_order WHERE status=0 ORDER BY orderDate DESC LIMIT $start,$limit";
            $result=database::connect()->query($query);
            if($result->num_rows<0){
                echo "<script>window.location='404.php';</script>";
            }else{
                return $result;
            }
        }
        //count the total row in order
        public function getOrderRows(){
            $query="SELECT * FROM tbl_order ORDER  BY OrderId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }
        //class for make shift Product
        public function makeShiftProduct($customerId){
            $getOrderByCustomer=$this->getPendingOrderByCustomerId($customerId);
            if($getOrderByCustomer){
                $query="UPDATE tbl_order SET status='1' WHERE customerId='$customerId'";
                $result=database::connect()->query($query);
                if($result){
                    $msg= "<p class='alert alert-success'><strong>Success!</strong> Your product shifted successful.</p>";
                    return $msg;
                }
            }else{
                $msg= "<p class='alert alert-danger'><strong>Error!</strong> You have no pending product.</p>";
                return $msg;
            }

        }
        //delete shifted product
        public function deleteShiftedOrder($delId){
            $query="DELETE FROM tbl_order  WHERE status='1' && orderId='$delId'";
            $result=database::connect()->query($query);
            if($result){
                $msg= "<p class='alert alert-success'><strong>Success!</strong> Your shifted product delete successful.</p>";
                return $msg;
            }
        }
        //add product in total product table
        public function addTotalProduct($customerId){
            $getOrderByCustomer=$this->getPendingOrderByCustomerId($customerId);
            if(!$getOrderByCustomer){
                $msg= "<p class='alert alert-success'><strong>Error!</strong> You have no pending product.</p>";
                return $msg;
            }
            foreach ($getOrderByCustomer as $value){
                $customerId=$value['customerId'];
                $productId=$value['productId'];
                $productName=$value['productName'];
                $image=$value['image'];
                $price=$value['price'];
                $quantity=$value['quantity'];
                $date=$value['orderDate'];

                $query="INSERT INTO tbl_total_order(customerId,productId,productName,image,price,quantity,orderDate)
                            VALUES('$customerId','$productId','$productName','$image','$price','$quantity','$date')";
                database::connect()->query($query);
            }
        }
        //get total order
        public function getTotalOrder($start,$limit){
            $query="SELECT * FROM tbl_total_order ORDER BY orderId DESC LIMIT $start,$limit";
            $result=database::connect()->query($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }
        //get total order by customerId
        public function getOrderByCustomerId($customerId){
            $query="SELECT * FROM tbl_total_order WHERE customerId='$customerId' ORDER BY orderId DESC";
            $result=database::connect()->query($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }
        //delete total order
        public function deleteTotalOrder($delId){
            $query="DELETE  FROM tbl_total_order WHERE orderId='$delId'";
            $result=database::connect()->query($query);
            if($result){
                $msg= "<p class='alert alert-success'><strong>Success!</strong> Your order product delete successful.</p>";
                return $msg;
            }else{
                return false;
            }
        } //delete total order
        public function showOrderByDate($post){
            $startDate=$post['firstDate']." 00:00:00";
            $secondDate=$post['secondDate']." 24:00:00";

            $query="SELECT * FROM tbl_total_order WHERE orderDate >= '$startDate' AND orderDate <= '$secondDate' ORDER BY orderId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }
        //get total order for average quantity and order
        public function getTotalOrderForAvg(){
            $query="SELECT * FROM tbl_total_order  ORDER BY orderId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }
        //get total order for average quantity and order
        public function getPendingWithoutLimit(){
            $query="SELECT * FROM tbl_order  WHERE status='0' ORDER BY orderId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }
        //search total order
        public function searchTotalOrder($value){
            $query="SELECT * FROM tbl_total_order WHERE orderDate LIKE '%$value%' OR productName LIKE '%$value%' OR price LIKE '%$value%'  ORDER  BY orderId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }

    }
?>
