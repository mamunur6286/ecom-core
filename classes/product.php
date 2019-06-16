
<?php
    // class for product
    Class Product{

        //method for add product
        public function addProduct($data,$file){
            $productName=mysqli_real_escape_string(database::connect(),$data['productName']);
            $productCategory=mysqli_real_escape_string(database::connect(),$data['category']);
            $productBrand=mysqli_real_escape_string(database::connect(),$data['brand']);
            $productBody=mysqli_real_escape_string(database::connect(),$data['body']);
            $productPrice=mysqli_real_escape_string(database::connect(),$data['price']);
            $productType=mysqli_real_escape_string(database::connect(),$data['type']);
            $permission=array("jpg","jpeg","png","gip","rar");
            $imageName=$file['image']['name'];
            $imageSize=$file['image']['size'];
            $imagePath=$file['image']['tmp_name'];
            $div_name=explode('.',"$imageName");
            $ext=strtolower(end($div_name));
            $unique_name=substr(md5(time()),0,30).'.'.$ext;
            if($productName=="" || $productCategory=="" || $productBrand=="" || $productBody=="" || $productPrice=="" || $productType=="" || $unique_name==""){
                $msg= "<p class='alert alert-danger'><strong>Error!</strong>Field must not be empty.</p>";
                return $msg;
            }elseif ($imageSize>2097152){
                $msg= "<p class='alert alert-danger'><strong>Error!</strong>File size must be less than 2MB.</p>";
                return $msg;
            }elseif (in_array($ext,$permission)===false){
                $msg= "<p class='alert alert-danger'><strong>Error!</strong>Only :-".implode(', ',$permission)." file uploaded.</p>";
                return $msg;
            }else{
                //make unique name
                $upload = "upload/".$unique_name;
                $query = "INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type)
                          VALUES('$productName','$productCategory','$productBrand','$productBody','$productPrice','$unique_name','$productType')";
                move_uploaded_file($imagePath, $upload);
                $result = database::connect()->query($query);
                if ($result) {

                    echo "<p class='alert alert-success' <strong>Success!</strong>Your product add successfully.</p>";
                } else {
                    echo "<p class='alert alert-danger'>Your product not add.</p>";
                }
            }
        }

        //method for update product by product id
        public function updateProduct($updateId,$data,$file){
            $productName=mysqli_real_escape_string(database::connect(),$data['productName']);
            $productCategory=mysqli_real_escape_string(database::connect(),$data['category']);
            $productBrand=mysqli_real_escape_string(database::connect(),$data['brand']);
            $productBody=mysqli_real_escape_string(database::connect(),$data['body']);
            $productPrice=mysqli_real_escape_string(database::connect(),$data['price']);
            $productType=mysqli_real_escape_string(database::connect(),$data['type']);
            $permission=array("jpg","jpeg","png","gip","rar");
            $imageName=$file['image']['name'];
            $imageSize=$file['image']['size'];
            $imagePath=$file['image']['tmp_name'];
            $div_name=explode('.',"$imageName");
            $ext=strtolower(end($div_name));
            $unique_name=substr(md5(time()),0,30).'.'.$ext;

            if($imageName==""){
                if($productName=="" || $productCategory=="" || $productBrand=="" || $productBody=="" || $productPrice=="" || $productType==""){
                    $msg= "<p class='alert alert-danger'><strong>Error!</strong>Field must not be empty.</p>";
                    return $msg;
                } else{
                    $query = "UPDATE tbl_product SET 
                          productName='$productName',
                          catId='$productCategory',
                          brandId='$productBrand',
                          body='$productBody',
                          price='$productPrice',
                          type='$productType'
                          WHERE productId='$updateId'
                          ";
                    $result =database::connect()->query($query);
                    if ($result) {
                        echo "<p class='alert alert-success'><strong>Success!</strong>Your product update successfully.</p>";
                    } else {
                        echo "<p class='alert alert-danger'>Your product not updated.</p>";
                    }
                }
            }else {
                if ($productName == "" || $productCategory == "" || $productBrand == "" || $productBody == "" || $productPrice == "" || $productType == "" || $unique_name == "") {
                    $msg = "<p class='alert alert-danger'><strong>Error!</strong>Field must not be empty.</p>";
                    return $msg;
                } elseif ($imageSize > 2097152) {
                    $msg = "<p class='alert alert-danger'><strong>Error!</strong>File size must be less than 2MB.</p>";
                    return $msg;
                } elseif (in_array($ext, $permission) === false) {
                    $msg = "<p class='alert alert-danger'><strong>Error!</strong>Only :-" . implode(', ', $permission) . " file uploaded.</p>";
                    return $msg;
                } else {
                    $select="SELECT * FROM tbl_product WHERE productId='$updateId'";
                    $selectResult=database::connect()->query($select)->fetch_assoc();
                    if($selectResult){
                        $unlink="upload/".$selectResult['image'];
                        unlink($unlink);
                    }

                    // upload product with image
                    $upload = "upload/" . $unique_name;
                    $query = "UPDATE tbl_product SET 
                              productName='$productName',
                              catId='$productCategory',
                              brandId='$productBrand',
                              body='$productBody',
                              price='$productPrice',
                              image='$unique_name',
                              type='$productType'
                              WHERE productId='$updateId'
                              ";

                    move_uploaded_file($imagePath, $upload);
                    $result = database::connect()->query($query);
                    if ($result) {
                        echo "<p class=' alert alert-success'><strong>Success!</strong>Your product update successfully.</span>";
                    } else {
                        echo "<p class='alert alert-danger'>Your product not updated.</span>";
                    }
                }

            }
        }

        //get product by limit
        public function getProduct($start,$limit){
            $query="SELECT p.*,c.category,b.brand 
                    FROM tbl_product as p,tbl_category as c ,tbl_brand as b
                    WHERE p.catId=c.catid AND p.brandId=b.brandid ORDER BY p.productid DESC Limit $start,$limit";
           /* $query="SELECT  tbl_product.*,tbl_category.category,tbl_brand.brand
            FROM tbl_product INNER JOIN tbl_category
            ON tbl_product.catId= tbl_category.catid
            INNER  JOIN tbl_brand ON tbl_product.brandId=tbl_brand.brandid
            ORDER BY tbl_product.productId";*/
            $result=database::connect()->query($query);
            if ($result->num_rows<0) {
                echo "<p class='alert alert-danger'><strong>Error!</strong>Product not found.</p>";
            } else {
                return $result;
            }
        }
        // delete product by product id
        public function deleteProduct($productDelId){
            $query="SELECT * FROM tbl_product WHERE productid='$productDelId'";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                while ($row=$result->fetch_assoc()){
                    $unlink="upload/".$row['image'];
                    unlink($unlink);
                }
            }else{
                echo "<script>window.location='productList.php';</script>";
            }
            $del_query="DELETE FROM tbl_product WHERE productId='$productDelId'";
            $del_result=database::connect()->query($del_query);
            if($del_result){
                return "<p class='alert alert-success'><strong>Success!</strong> Product delete successfully.</p>";
            }else{
                echo "<script>window.location='product_list.php';</script>";
            }


        }
        //Get product by id
        public function getProductById($productId){
            $query="SELECT * FROM tbl_product WHERE productid='$productId'";
            $result=database::connect()->query($query);
            if(!is_object($result)){
                echo "<script>window.location='productList.php';</script>";
            }elseif($result->num_rows>0){
                return $result->fetch_assoc();
            }
        }
        //Get feature product in product table
        public function getFeatureView(){
            $query="SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4 ";
            $result=database::connect()->query($query);
            if(!is_object($result)){
                echo "<script>window.location='404.php';</script>";
            }elseif($result->num_rows>0){
                return $result;
            }
        }

        //get product for pagination
        public function getProductPagination($start){
            $query="SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $start,8";
            $result=database::connect()->query($query);
            if(!is_object($result)){
                echo "<script>window.location='404.php';</script>";
            }elseif($result->num_rows>0){
                return $result;
            }
        }
        //Get new product in product table
        public function getGeneralView($start){
            $query="SELECT * FROM tbl_product WHERE type='1' ORDER BY productId DESC LIMIT $start,4 ";
            $result=database::connect()->query($query);
            if(!is_object($result)){
                echo "<script>window.location='404.php';</script>";
            }elseif($result->num_rows>0){
                return $result;
            }
        }

        // get all product by pro id
        public function getAllProductById($proId){
            $query="SELECT p.*,c.category,b.brand FROM tbl_product as p,tbl_category as c,tbl_brand as b 
                    WHERE p.catId=c.catid AND p.brandId=b.brandid AND p.productId='$proId' ORDER BY p.productId DESC ";
            $result=database::connect()->query($query);
            if(!is_object($result)){
                echo "<script>window.location='404.php';</script>";
            }elseif($result->num_rows>0){
                return $result->fetch_assoc();
            }else{
                return false;
            }
        }

        // get first brand in brand table
        public function getBrandFirst($brandId){
            $query="SELECT p.*,c.category,b.brand FROM tbl_product as p,tbl_category as c,tbl_brand as b 
                    WHERE p.catId=c.catid AND p.brandId=b.brandid AND b.brandid='$brandId' ORDER BY p.productId DESC LIMIT 1";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }

        }

        //get product by cat id
        public  function getProductByCatId($catId){
            $query="SELECT * FROM tbl_product WHERE catId='$catId' ORDER BY productId DESC ";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                echo "<script>window.location='404.php';</script>";
            }

        }
        // get product by brand id
        public  function getProductByBrandId($brandId){
            $query="SELECT * FROM tbl_product WHERE brandId='$brandId' ORDER BY productId DESC ";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                echo "<script>window.location='404.php';</script>";
            }

        }
        //Get top brand product here
        public function getBrandTop($brandId){
            $query="SELECT p.*,c.category,b.brand FROM tbl_product as p,tbl_category as c,tbl_brand as b 
                    WHERE p.catId=c.catid AND p.brandId=b.brandid AND b.brandid='$brandId' ORDER BY p.productId DESC LIMIT 4";
            $result=database::connect()->query($query);
            if(!is_object($result)){
                echo "<script>window.location='404.php';</script>";
            }elseif($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }
        //count the total row in product
        public function getProductRows(){
            $query="SELECT * FROM tbl_product ORDER  BY productId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                $msg= "<p class='alert alert-danger'><strong>Error!</strong> Product not found.</p>";
                return $msg;
            }
        }
        //Rating product
        public function ratingProduct($proId){
            $query="SELECT * FROM tbl_total_order where productId='$proId' ORDER  BY productId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                $qnty=0;
                foreach ($result as $value){
                    $qnty=$value['quantity']+$qnty;
                }
                return $qnty;
            }else{
               return false;
            }
        }
        //add to wishlist
        public function addToWishList($customerId,$quantity,$proId){

            $quantity=mysqli_real_escape_string(database::connect(),$quantity);
            $proId=mysqli_real_escape_string(database::connect(),$proId);

            $query="SELECT * FROM tbl_product WHERE productId='$proId'";
            $getData=database::connect()->query($query)->fetch_assoc();
            if($getData){
                $productId=$getData['productId'];
                $productName=$getData['productName'];
                $productImage=$getData['image'];
                $productPrice=$getData['price'];
            }
            $insertQuery="INSERT INTO tbl_wishlist(customerId,productId,productName,image,price,quantity)
                          VALUES('$customerId','$productId','$productName','$productImage','$productPrice','$quantity')";
            $result=database::connect()->query($insertQuery);
            if ($result){
                echo "<script>window.location='wishList.php';</script>";
            }
        }
// select wish list for with limit
        public function getWishList($start,$limit)
        {
            $query="SELECT * FROM tbl_wishlist ORDER  BY wishId DESC LIMIT $start,$limit";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }
    //delete wish list product by wish id
        public function deleteWish($delId)
        {
            $del_query="DELETE FROM tbl_wishlist WHERE wishId='$delId'";
            $del_result=database::connect()->query($del_query);
            if($del_result){
                return "<p class='alert alert-success'><strong>Success!</strong> Wish Product delete successfully.</p>";
            }else{
                echo "<script>window.location='wishList.php';</script>";
            }
        }
        ///search product
        public function searchProduct($value){
            $search_query="SELECT p.*,c.category,b.brand FROM tbl_product as p,tbl_category as c,tbl_brand as b 
                    WHERE p.catId=c.catid AND p.brandId=b.brandid AND ( productName LIKE '%$value%' OR body LIKE '%$value%' OR price LIKE '%$value%' OR brand LIKE '%$value%' OR category LIKE '%$value%') ORDER BY productId DESC";
            $search_result=database::connect()->query($search_query);
            if($search_result->num_rows>0){
                return $search_result;
            }else{
                return false;
            }
        }

    }
?>