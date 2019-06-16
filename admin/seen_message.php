<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Seen Message List</h5>
    </div>

<?php
//delete unseen message here
if(isset($_GET['msgDelId'])){
    $msgDelete=$contact->deleteMessage($_GET['msgDelId']);
    if (isset($msgDelete)){
        echo $msgDelete;
    }
}
?>
    <div class="card-body">
        <?php
        //search message here
        if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['search_btn'])){
            $searchValue=$_POST['searchValue'];
        }
        //Message seen here and send message id in see message page
        if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['seen_btn'])){
            $messageId=$_POST['msgId'];
            echo "<script>window.location='see_message.php?msgId=$messageId';</script>";
        }
        ?>
        <form  method="post" class="form-inline mt-2 mt-md-0">
            <input required name="searchValue" id="piff" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button name="search_btn" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <br>
        <div  class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="bg-info text-light">
                <tr>
                    <th>SL No</th>
                    <th>Sender Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Message</th>
                    <th>Send Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //pagination start here
                $perPage=10;
                if (isset($_GET['page']) && is_numeric($_GET['page'])){
                    $page=$_GET['page'];
                }else{
                    $page=1;
                }
                $start=($page-1)*$perPage;

                // chose value for show table like search value or total unseen message
                if(!empty($searchValue)){
                    $searchResult=$contact->searchMessage($searchValue);
                    if($searchResult!=false){
                        $getMsg=$searchResult;
                    }
                } else{
                    $getMsg=$contact->getSeenMessage($start,$perPage);
                }
                // show message value here by table
                if($getMsg){
                    $i=$page*$perPage-$perPage;
                    while ($result=$getMsg->fetch_assoc()){
                        $i++;
                        ?>
                        <tr class="bg-light">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['name']?></td>
                            <td><?php echo $result['email']?></td>
                            <td><?php echo $result['phone']?></td>
                            <td><?php echo  substr($result['message'],'0','20')."...."; ?></td>
                            <td><?php echo date('d F Y',strtotime($result['date'])); ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="msgId" value="<?php echo $result['messageId']; ?>">
                                    <input class="btn btn-success" type="submit" name="seen_btn" value="Seen">
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this message?')" href="?msgDelId=<?php echo $result['messageId'] ?>">X</a>
                                </form>
                            </td>
                        </tr>
                        <?php
                    } }else{ echo "<div class='col-md-12 text-center'><p class='alert alert-danger text-center' >You have no message.</p></div> "; }
                ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example" class="float-right">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="unseen_message.php?page=<?php
                    if($page-1==0){
                        echo 1;
                    }else{
                        echo $page-1;
                    }
                    ?>"><?php if ($page-1==0){ echo "First Page";}else{echo "Previous"; } ?></a></li>
                <?php
                $getQuery="SELECT * FROM tbl_message";
                $allMsg=database::connect()->query($getQuery)->num_rows;
                $totalPage=ceil($allMsg/10);
                if($totalPage>=5){
                    $totalP=5;
                }else{
                    $totalP=$totalPage;
                }
                for ($i=1;$i<=$totalP;$i++){
                    ?>
                    <li class='page-item <?php if ($i==$page){ echo  "active"; } ?>'><a class='page-link' href='unseen_message.php?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
                    <?php

                }
                if($totalPage>5){
                    ?>

                    <li class="page-item <?php if ( $page>5 && $page<$totalPage){ echo "active";} ?>"><a class="page-link">.</a></li>
                    <li class="page-item"><a class="page-link">.</a></li>
                    <li class="page-item <?php if ( $page>5 && $page+1>$totalPage){ echo "active";} ?>" ><a class="page-link">.</a></li>
                <?php } ?>
                <li class="page-item "><a class="page-link" href="unseen_message.php?page=<?php
                    if($page+1>$totalPage){
                        echo $totalPage;
                    }else{
                        echo $page+1;
                    }
                    ?>"><?php if ($page+1>$totalPage){ echo "Last Page";}else{echo "Next"; } ?></a></li>
            </ul>
        </nav>
    </div>

<?php include "inc/footer.php";?>