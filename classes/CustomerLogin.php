<?php

    // class for customer login
    Class CustomerLogin{

        //method for login
        public function login($customerEmail,$customerPassword){
            $customerEmail=mysqli_real_escape_string(database::connect(),$customerEmail);
            $customerPassword=mysqli_real_escape_string(database::connect(),$customerPassword);
            if(empty($customerEmail) || empty($customerPassword)){
                $msg= "<p class='alert alert-danger' ><strong>Error!</strong>Field must not be empty.</p>";
                return $msg;
            }else{
                $query="SELECT * FROM tbl_customers WHERE email='$customerEmail' AND password='$customerPassword'";
                $result=database::connect()->query($query);
                if($result->num_rows>0){
                    $getResult=$result->fetch_assoc();
                    session::set("custLogin","true");
                    session::set("customerId",$getResult['customerId']);
                    echo "<script>window.location='profile.php';</script>";
                }else{
                    $msg= "<p class='alert alert-danger' ><strong>Error!</strong> Email or password doesn't match.</p>";
                    return $msg;
                }
            }

        }

    }
?>
