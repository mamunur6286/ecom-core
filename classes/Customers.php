<?php
    Class Customers{

        public function addCustomer($data,$file){
            $customerName=$data['name'];
            $customerCity=$data['city'];
            $cityCode=$data['city_code'];
            $customerCountry=$data['country'];
            $address=$data['address'];
            $customerEmail=$data['email'];
            $customerPhone=$data['phone'];
            $customerPassword=$data['password'];
            $confirmPassword=$data['confirm_password'];

            $customerName=  mysqli_real_escape_string(database::connect(),$customerName);
            $customerCity=  mysqli_real_escape_string(database::connect(),$customerCity);
            $cityCode=  mysqli_real_escape_string(database::connect(),$cityCode);
            $customerCountry= mysqli_real_escape_string(database::connect(),$customerCountry);
            $address=       mysqli_real_escape_string(database::connect(),$address);
            $customerEmail= mysqli_real_escape_string(database::connect(),$customerEmail);
            $customerPhone= mysqli_real_escape_string(database::connect(),$customerPhone);
            $customerPassword= mysqli_real_escape_string(database::connect(),$customerPassword);
            $confirmPassword= mysqli_real_escape_string(database::connect(),$confirmPassword);

            $permission=array("jpg","jpeg","png","gip","rar");
            $imageName=$file['image']['name'];
            $imageSize=$file['image']['size'];
            $imagePath=$file['image']['tmp_name'];
            $div_name=explode('.',"$imageName");
            $ext=strtolower(end($div_name));
            $unique_name=substr(md5(time()),0,30).'.'.$ext;

            $select="SELECT * FROM tbl_customers WHERE email='$customerEmail'";
            $selectResult=database::connect()->query($select);
            if($selectResult){
                $chkEmail=$selectResult->num_rows;
            }
            if($customerName=="" || $customerCity=="" || $cityCode=="" || $customerCountry=="" || $address=="" || $customerEmail=="" || $customerPhone=="" || $customerPassword=="" || $imageName=="" || $confirmPassword ==""){
                $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
                return $msg;
            }elseif($customerPassword!=$confirmPassword){
                $msg= "<p class='alert alert-danger'><strong>Error!</strong> Password and confirm password doses't match.</p>";
                return $msg;
            }
            elseif(isset($chkEmail) && $chkEmail>0){
                $msg= "<p class='alert alert-danger'><strong>Error!</strong> Your email address already exits.</p>";
                return $msg;
            }
            /*elseif ($imageSize>2097152){
                $msg= "<span style='font-size: 18px; color: red;'><strong>Error!</strong>File size must be less than 2MB.</span>";
                return $msg;
            }*/elseif (in_array($ext,$permission)===false){
                $msg= "<p class='alert alert-danger'><strong>Error!</strong> Only :-".implode(', ',$permission)." file uploaded.</p>";
                return $msg;
            }else{
                $customerCity=$customerCountry.'('.$cityCode.')';
                $upload = "upload/".$unique_name;
                $query = "INSERT INTO tbl_customers(customerName,image,customerCity,customerCountry,address,email,phone,password)
                          VALUES('$customerName','$upload','$customerCity','$customerCountry','$address','$customerEmail','$customerPhone','$customerPassword')";
                move_uploaded_file($imagePath, $upload);
                $result =database::connect()->query($query);
                if ($result) {

                    echo "<p class='alert alert-success'><strong>Success!</strong> Your successfully register login now.</p>";
                } else {
                    echo "<p class='alert alert-danger' ><strong>Error!</strong> Your are not registered.</p>";
                }
            }
        }
        public function updateCustomer($data,$file,$customerId){
            $customerName=$data['name'];
            $customerCity=$data['city'];
            $customerCountry=$data['country'];
            $address=$data['address'];
            $customerEmail=$data['email'];
            $customerPhone=$data['phone'];

            $customerName=  mysqli_real_escape_string(database::connect(),$customerName);
            $customerCity=  mysqli_real_escape_string(database::connect(),$customerCity);
            $customerCountry= mysqli_real_escape_string(database::connect(),$customerCountry);
            $address=       mysqli_real_escape_string(database::connect(),$address);
            $customerEmail= mysqli_real_escape_string(database::connect(),$customerEmail);
            $customerPhone= mysqli_real_escape_string(database::connect(),$customerPhone);

            $permission=array("jpg","jpeg","png","gip","rar");
            $imageName=$file['image']['name'];
            $imageSize=$file['image']['size'];
            $imagePath=$file['image']['tmp_name'];
            $div_name=explode('.',"$imageName");
            $ext=strtolower(end($div_name));
            $unique_name=substr(md5(time()),0,30).'.'.$ext;
            if(empty($imageName)){
                if($customerName=="" || $customerCity=="" || $customerCountry=="" || $address=="" || $customerEmail=="" || $customerPhone==""){
                    $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
                    return $msg;
                }else{
                    $upload = "upload/".$unique_name;
                    $query = "UPDATE tbl_customers SET
                              customerName='$customerName',
                              customerCity='$customerCity',
                              customerCountry='$customerCountry',
                              address='$address',
                              email='$customerEmail',
                              phone='$customerPhone'
                              WHERE customerId='$customerId'";
                    move_uploaded_file($imagePath, $upload);
                    $result =database::connect()->query($query);
                    if ($result) {

                        return "<p class='alert alert-success'><strong>Success!</strong> Profile update successfully.</p>";
                    } else {
                        return "<p class='alert alert-danger'><strong>Error!</strong> Your are not updated.</p>";
                    }
                }
            }else{
                if($customerName=="" || $customerCity=="" || $customerCountry=="" || $address=="" || $customerEmail=="" || $customerPhone==""){
                    $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
                    return $msg;
                }/*elseif ($imageSize>){
                    $msg= "<span style='font-size: 18px; color: red;'><strong>Error!</strong>File size must be less than 2MB.</span>";
                    return $msg;
                }*/elseif (in_array($ext,$permission)===false){
                    $msg= "<p class='alert alert-danger'><strong>Error!</strong>Only :-".implode(', ',$permission)." file uploaded.</p>";
                    return $msg;
                }else{
                    $select="SELECT * FROM tbl_customers WHERE customerId='$customerId'";
                    $selectResult=database::connect()->query($select)->fetch_assoc();
                    if($selectResult){
                        $unlink=$selectResult['image'];
                        if($unlink){
                            unlink($unlink);
                        }
                    }
                    $upload = "upload/".$unique_name;
                    $query = "UPDATE tbl_customers SET
                              customerName='$customerName',
                              image='$upload',
                              customerCity='$customerCity',
                              customerCountry='$customerCountry',
                              address='$address',
                              email='$customerEmail',
                              phone='$customerPhone'
                              WHERE customerId='$customerId'";
                    move_uploaded_file($imagePath, $upload);
                    $result =database::connect()->query($query);
                    if ($result) {
                        return "<p class='alert alert-success'><strong>Success!</strong> Profile update successfully.</p>";
                    } else {
                        return "<p class='alert alert-danger'><strong>Error!</strong> Your are not update.</p>";
                    }
                }
            }

        }
        public function getCustomer($start,$limit){
            $query="SELECT * FROM tbl_customers ORDER  BY customerId DESC LIMIT $start,$limit";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }
        }
        public function getCustomerById($customerId){
            $query="SELECT * FROM tbl_customers WHERE customerId='$customerId'";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result->fetch_assoc();
            }
        }
        public function deleteCustomer($customerId){
            $query="DELETE FROM tbl_customers WHERE customerId='$customerId'";
            $result=database::connect()->query($query);
            if($result){
                return "<p class='alert alert-success'><strong>Success!</strong> Your customer delete successfully.</p>";
            }
        }
        //count the total row in customer
        public function getCustomerRows(){
            $query="SELECT * FROM tbl_customers ORDER  BY customerId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                $msg= "<p class='alert alert-danger'><strong>Error!</strong> Customers not found.</p>";
                return $msg;
            }
        }
        //search customer
        public function searchCustomer($value){
            $query="SELECT * FROM tbl_customers WHERE customerName LIKE '%$value%' OR customerCity LIKE '%$value%' OR customerCountry LIKE '%$value%' OR email LIKE '%$value%' OR phone LIKE '%$value%' OR address LIKE '%$value%'  ORDER  BY customerId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }
    }
?>