<?php
    //class for admin
    Class adminLogin{

        //method for admin login
        public function login($adminUser,$adminPass){
            $adminUser=mysqli_real_escape_string(database::connect(),$adminUser);
            $adminPass=mysqli_real_escape_string(database::connect(),$adminPass);
            if(empty($adminUser) || empty($adminPass)){
                $msg= "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
                return $msg;
            }else{
                $query="SELECT * FROM tbl_admin WHERE adminuser='$adminUser' AND adminpass='$adminPass'";
                $result=database::connect()->query($query);
                if($result->num_rows>0){
                    $result=$result->fetch_assoc();
                    $_SESSION['login']="true";
                    session::set("login","true");
                    session::set("adminUser",$result['adminuser']);
                    session::set("adminName",$result['adminname']);
                    echo "<script>window.location='index.php';</script>";
                }else{
                    $msg= "<p class='alert alert-danger' ><strong>Error!</strong> Email or password doesn't match.</p>";
                    return $msg;
                }
            }

        }

    }
?>
