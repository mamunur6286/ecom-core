<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Reply Message</h5>
    </div>

<?php
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['reply_btn'])){
    $replyMessage=$contact->replyMessage($_POST);
}
?>
    <form role="form" class="admin-form" enctype="multipart/form-data" method="post">
        <?php
        if(!isset($_GET['msgId']) || $_GET['msgId']==""|| !is_numeric($_GET['msgId'])){
            echo "<script>window.location='index.php';</script>";
        }else{
            $msgId=$_GET['msgId'];
            $seeMessage=$contact->messageByMsgId($msgId)->fetch_assoc();
        }
        ?>
        <div class="row card-body">
           <div class="col-md-3">

           </div>
            <div class="col-md-6">
                <?php
                if (isset($replyMessage)){
                    echo $replyMessage;
                }
                ?>
                <div class="form-group">
                    <label>From </label>
                    <input class="form-control" type="text" name="from" placeholder="Enter your email address">
                </div>
                <div class="form-group">
                    <label>To </label>
                    <select class="form-control" name="to">
                        <option value="">Select One</option>
                        <option value="<?php if (isset($seeMessage)){ echo $seeMessage['email']; } ?>"><?php if (isset($seeMessage)){ echo $seeMessage['email']; } ?></option>
                        <option value="<?php if (isset($seeMessage)){ echo $seeMessage['phone']; } ?>"><?php if (isset($seeMessage)){ echo $seeMessage['phone']; } ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Subject </label>
                    <input class="form-control" type="text" name="subject" placeholder="Enter your subject">
                </div>
                <div class="form-group">
                    <label>Reply Message</label>
                    <textarea class="form-control" rows="6" cols="" name="message" placeholder="Type your message"><?php if (isset($seeMessage)){ echo $seeMessage['message']; } ?></textarea>
                </div>
            </div>
            <div class="col-md-3">

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <input class="btn btn-success btn-block form-control" type="submit" name="reply_btn" value="Reply">
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </form>
<?php include "inc/footer.php";?>