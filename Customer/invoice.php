<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("location:index.php");
}
include("config.php");
$c_id = $_SESSION['customer_id'];
$cart_item_id = $_GET['cart_item_id'];
$sql1 = mysqli_query($con, "SELECT * FROM tbl_transaction t INNER JOIN tbl_cart_item ci ON ci.cart_item_id=t.cart_item_id INNER JOIN tbl_item i ON i.item_id=ci.item_id INNER JOIN tbl_customer c ON c.customer_id=ci.cart_id INNER JOIN tbl_place p ON p.place_id=c.customer_id INNER JOIN tbl_district d ON d.district_id=p.district_id WHERE t.wallet_id!='0' AND ci.cart_item_id='$cart_item_id' AND c.customer_id='$c_id'");
$display = mysqli_fetch_array($sql1);
$bill_no = strval($display['cart_item_id']).strval($display['transaction_id']).strval($display['item_id']).strval($c_id);
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container" style="padding-top: 50px;">
    <p>Bill no. LC<?php echo str_pad($bill_no, "8", "0", STR_PAD_LEFT) ?></p>
    <div class="row" style="border-bottom: 5px solid green;margin-bottom: 20px;">
        <div class="col-md-12">
            <h1 style="text-align: center;">LALA CRAFT</h1>
            <p style="text-align: center;">Find Your Crafts</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <p>Billing Name : <?php echo $display['customer_name'] ?></p>
                    <p>Billing E-Mail : <?php echo $display['customer_email'] ?></p>
                    <p>Billing Contact : <?php echo $display['customer_contact'] ?></p>
                    <p>Billing Address : <?php echo $display['place_name'] . ", " . $display['district_name']; ?></p>
                </div>
                <div class="col-md-6">
                    <p>Shipping Name : <?php echo $display['customer_name'] ?></p>
                    <p>Shipping E-Mail : <?php echo $display['customer_email'] ?></p>
                    <p>Shipping Contact : <?php echo $display['customer_contact'] ?></p>
                    <p>Shipping Address : <?php echo $display['place_name'] . ", " . $display['district_name']; ?></p>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $display['item_name']; ?></td>
                            <td><?php echo $display['item_description']; ?></td>
                            <td><?php echo $display['item_price']; ?></td>
                            <td><?php echo $display['cart_item_quantity']; ?></td>
                            <td><?php echo $display['item_price'] * $display['cart_item_quantity']; ?></td>
                        </tr>
                        <tr style="background: antiquewhite;">
                            <th colspan="4">Sub Total</th>
                            <th><?php echo $display['item_price'] * $display['cart_item_quantity']; ?></th>
                        </tr>
                        <tr style="background: antiquewhite;">
                            <th colspan="4">Discount</th>
                            <?php
                               $discount = ($display['item_price'] * $display['cart_item_quantity'])/100*2;
                               $total = ($display['item_price'] * $display['cart_item_quantity'])-$discount;
                            ?>
                            <th><?php echo ceil($discount); ?></th>
                        </tr>
                        <tr style="background: green; color:white;">
                            <th colspan="4">Amount Payed</th>
                            <th><?php echo ceil($total); ?></th>
                        </tr>
                    </tbody>
                </table>
                <div class="row" style="display: flex; width: 100%; justify-content: space-between;">
                    <div class="col-md-6">
                        <p style="float: left;">Date and Time : <?php echo $display['transaction_date']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p style="float: right;">Signature : LALA CRAFT</p>
                        <img src="Assets/seal.png" alt="" style="width:100px;float: right;" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
</script>