
<?php

// class for category
Class Category{

    //add category method here
    public function addCategory($category){
        $category=mysqli_real_escape_string(database::connect(),$category);
        if(empty($category)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong>Field must not be empty.</span>";
            return $msg;
        }else{
            $query="INSERT INTO tbl_category(category)VALUES('$category')";
            $result=database::connect()->query($query);
            if($result){
                $msg= "<p class='alert alert-success'><strong>Success!</strong> Category add successfully.</p>";
                return $msg;
            }
        }
    }

    //update catrgory here by category id
    public function updateCategory($catid,$category){
        $category=mysqli_real_escape_string(database::connect(),$category);
        if(empty($category)){
            $msg= "<p class='alert alert-danger'><strong>Error!</strong>Field must not be empty.</p>";
            return $msg;
        }else{
            $query="UPDATE tbl_category SET category='$category' WHERE catid='$catid'";
            $result=database::connect()->query($query);
            if($result){
                $msg= "<p class='alert alert-success'><strong>Success!</strong> Category update successfully.</p>";
                return $msg;
            }
        }

    }

    // get category row start with limit
    public function getCat($start,$limit){
        $query="SELECT * FROM tbl_category ORDER BY catid DESC LIMIT $start,$limit";
        $result=database::connect()->query($query);
        if($result->num_rows>0){
            return $result;
        }else{
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Category not found.</p>";
            return $msg;
        }
    }

    //delete category by category id
    public function deleteCat($delId){
        $del_query="DELETE FROM tbl_category WHERE catid='$delId'";
        $del_result=database::connect()->query($del_query);
        if($del_result){
            return "<p class='alert alert-success'><strong>Success!</strong> Category delete successfully.</p>";
        }else{
            echo "<script>window.location='category_list.php';</script>";
        }
    }

    //get category by category id
    public function getCatById($catId){
        $query="SELECT * FROM tbl_category WHERE catid='$catId'";
        $result=database::connect()->query($query);
        if($result->num_rows>0){
            $result=$result->fetch_assoc();
            return $result;
        }else{
            echo "<script>window.location='category_list.php';</script>";
        }
    }

    //count the total row in category
    public function getCategoryRows(){
        $query="SELECT * FROM tbl_category ORDER  BY catid DESC";
        $result=database::connect()->query($query);
        if($result->num_rows>0){
            return $result;
        }else{
            $msg= "<p class='alert alert-danger'><strong>Error!</strong> Category not found.</p>";
            return $msg;
        }
    }
    //search category
    public function searchCategory($value){
        $query="SELECT * FROM tbl_category WHERE category LIKE '%$value%' ORDER  BY catid DESC";
        $result=database::connect()->query($query);
        if($result->num_rows>0){
            return $result;
        }else{
            return false;
        }
    }
}
?>