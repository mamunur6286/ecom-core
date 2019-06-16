<?php

    //class for brand
Class Brand{

    //class for add brand
    public function addBrand($brandName){
        $brandName=mysqli_real_escape_string(database::connect(),$brandName);
        if(empty($brandName)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong>Field must not be empty.</p>";
            return $msg;
        }else{
            $query="INSERT INTO tbl_Brand(brand)VALUES('$brandName')";
            $result=database::connect()->query($query);
            if($result){
                $msg= "<p class='alert alert-success'><strong>Success!</strong> Brand add successfully.</span>";
                return $msg;
            }else{
                return false;
            }
        }

    }

    //update brand by brand brand Id
    public function updateBrand($brandiId,$brandName){
        $brandName=mysqli_real_escape_string(database::connect(),$brandName);
        if(empty($brandName)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong>Field must not be empty.</p>";
            return $msg;
        }else{
            $query="UPDATE tbl_brand SET brand='$brandName' WHERE brandid='$brandiId'";
            $result=database::connect()->query($query);
            if($result){
                $msg= "<p class='alert alert-success'><strong>Success!</strong> Brand update successfully.</span>";
                return $msg;
            }else{
                return false;
            }
        }

    }

    //method for select brand by limit with start row for read data
    public function getBrand($start,$limit){
        $query="SELECT * FROM tbl_brand ORDER BY brandid DESC LIMIT $start,$limit";
        $result=database::connect()->query($query);
        if($result->num_rows>0){
            return $result;
        }else{
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Brand not found.</p>";
            return $msg;
        }
    }

    //delete brand by brand id
    public function deleteBrand($brandDelId){
        $del_query="DELETE FROM tbl_brand WHERE brandid='$brandDelId'";
        $del_result=database::connect()->query($del_query);
        if($del_result){
            return "<p class='alert alert-success '><strong>Success!</strong> Brand delete successfully.</span>";
        }else{
            return false;
        }
    }
    // get brand by brand id
    public function getBrandById($brandId){
        $query="SELECT * FROM tbl_brand WHERE brandid='$brandId'";
        $result=database::connect()->query($query);
        if($result->num_rows>0){
            $result=$result->fetch_assoc();
            return $result;
        }else{
            return false;
        }
    }
    //get brand with limit for update brand
    public function getBrandLimit(){
        $query="SELECT * FROM tbl_brand ORDER BY brandid DESC LIMIT 4";
        $result=database::connect()->query($query);
        if($result->num_rows>0){
            return $result;
        }else{
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Brand not found.</p>";
            return $msg;
        }
    }
    //count the total row in brand
    public function getBrandRows(){
        $query="SELECT * FROM tbl_brand ORDER  BY brandid DESC";
        $result=database::connect()->query($query);
        if($result->num_rows>0){
            return $result;
        }else{
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Brand not found.</p>";
            return $msg;
        }
    }
    //search Brand
    public function searchBrand($value){
        $query="SELECT * FROM tbl_brand WHERE brand LIKE '%$value%' ORDER  BY brandid DESC";
        $result=database::connect()->query($query);
        if($result->num_rows>0){
            return $result;
        }else{
            return false;
        }
    }
}
?>
