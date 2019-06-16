
<?php

    // class for contact
    Class Contact{

        //send message for admin
        public function sendMessage($data){
                $customerName = $data['name'];
                $customerEmail = $data['email'];
                $customerPhone = $data['phone'];
                $customerMessage =$data['message'];

                $customerName = mysqli_real_escape_string(database::connect(), $customerName);
                $customerEmail = mysqli_real_escape_string(database::connect(), $customerEmail);
                $customerPhone = mysqli_real_escape_string(database::connect(), $customerPhone);
                $customerMessage = mysqli_real_escape_string(database::connect(), $customerMessage);


                if ($customerName == "" || $customerEmail == "" || $customerPhone == "" ||$customerMessage == "") {
                    $msg = "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
                    return $msg;
                } else {
                    $query = "INSERT INTO tbl_message(name,email,phone,message)
                                  VALUES('$customerName','$customerEmail','$customerPhone','$customerMessage')";
                    $result =database::connect()->query($query);
                    if ($result) {
                        echo "<p class='alert alert-success'><strong>Success!</strong> Your message send successfully.</p>";
                    } else {
                        echo "<p class='alert alert-danger'><strong>Error!</strong> Your message not send.</p>";
                    }
                }
            }

        //get unseen Massage by limit with start for pagination
        public function getUnseenMessage($start,$limit){
                $select="SELECT * FROM tbl_message WHERE status=0 ORDER BY messageId DESC LIMIT $start,$limit";
                $selectResult=database::connect()->query($select);
                if($selectResult->num_rows>0){
                    return $selectResult;
                }else{
                    return false;
                }
            }

            //get total unseen message for admin
        public function getTotalUnseenMessage(){
                $select="SELECT * FROM tbl_message WHERE status=0 ORDER BY messageId DESC ";
                $selectResult=database::connect()->query($select);
                if($selectResult->num_rows>0){
                    return $selectResult;
                }else{
                    return false;
                }
            }
            /// get seen message
        public function getSeenMessage($start,$limit){
            $select="SELECT * FROM tbl_message WHERE status=1 ORDER BY messageId DESC LIMIT $start,$limit";
            $selectResult=database::connect()->query($select);
            if($selectResult->num_rows>0){
                return $selectResult;
            }else{
                return false;
            }
        }
        //count the total row in Message
        public function getMessageRows(){
            $query="SELECT * FROM tbl_message ORDER  BY messageId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }
        //search Message
        public function searchMessage($value){
            $query="SELECT * FROM tbl_message WHERE name LIKE '%$value%' OR email LIKE '%$value%' OR phone LIKE '%$value%' OR date LIKE '%$value%' OR message LIKE '%$value%'   ORDER  BY messageId DESC";
            $result=database::connect()->query($query);
            if($result->num_rows>0){
                return $result;
            }else{
                return false;
            }
        }
        //delete Message
        public function deleteMessage($delId){
            $query="DELETE  FROM tbl_message WHERE messageId='$delId' ";
            $result=database::connect()->query($query);
            if($result){
                $msg="<p class='alert alert-success'><strong>Success!</strong> Your message delete successfully.</p>";
                return $msg;
            }else{
                $msg="<p class='alert alert-danger'><strong>Error!</strong> Your message not delete.</p>";
                return $msg;
            }
        }
        // Message select by message Id
        public function messageByMsgId($msgId){
            $query="SELECT * FROM tbl_message WHERE messageId='$msgId' ";
            $result=database::connect()->query($query);
            if($result){
               return $result;
            }else{
               return false;
            }
        }

        // reply message by mail to function
        public function replyMessage($post)
        {
            $from=$post['from'];
            $to=$post['to'];
            $message=$post['message'];
            $subject=$post['subject'];
            if(empty($from) || empty($to) || empty($subject) || empty($message)){
                $msg = "<p class='alert alert-danger'><strong>Error!</strong> Field must not be empty.</p>";
                return $msg;
            }else{
                $result=1;
                //$result=mail($to,$subject,$message,$from);
                if ($result){
                    $msg= "<p class='alert alert-success'><strong>Success!</strong> Your message send successfully.</p>";
                    return $msg;
                }

            }
        }
        //Create message  seen to unseen
        public function seenMessage($seenId)
        {
            $query="UPDATE tbl_message SET status=1 WHERE messageId='$seenId'";
            $result=database::connect()->query($query);
            if($result){
                return $result;
            }
        }
    }
?>