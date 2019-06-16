<?php include "inc/header.php"; ?>
    <div class="">
        <h5 style="margin-top: -8px;padding: 8px; border-radius: 3px" class=' text-center text-light font-weight-bold bg-primary'>Dashboard</h5>
    </div>
    <?php
        $t_order=$order->getOrderRows();
        $total_order=$t_order->num_rows;

        $t_message=$contact->getMessageRows();
        $total_message=$t_message->num_rows;

        $t_product=$product->getProductRows();
        $total_product=$t_product->num_rows;

        $t_customer=$customer->getCustomerRows();
        $total_customer=$t_customer->num_rows;

    ?>
    <div class="row text-center">
        <div style="margin-top: 5px" class="col-lg-3 col-md-6">
            <div class="card-body bg-warning">
                <h3>Products (<?php if (isset($total_product)){ echo  $total_product; } ?>)</h3>
            </div>
        </div>
        <div style="margin-top: 5px" class="col-lg-3 col-md-6">
            <div class="card-body bg-danger">
                <h3>Customer (<?php if (isset($total_customer)){ echo  $total_customer; } ?>)</h3>
            </div>
        </div>
        <div style="margin-top: 5px" class="col-lg-3 col-md-6">
            <div class="card-body bg-primary">
                <h3>Order (<?php if (isset($total_order)){ echo  $total_order; } ?>)</h3>
            </div>
        </div>
        <div style="margin-top: 5px" class="col-lg-3 col-md-6">
            <div class="card-body bg-success">
                <h3>Message (<?php if (isset($total_message)){ echo  $total_message; } ?>)</h3>
            </div>
        </div>
    </div>
    <div class=" row card-body">
        <div class="col-md-12">
            <p>Welcome admin panel</p>
        </div>
    </div>


<?php include "inc/footer.php";?>