<?php
include("config.php");
session_start();
$shop_id = $_SESSION['shop_id'];
$total = 0;
?>
<?php
if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    $_SESSION['category_id'] = $category_id;
}
?>

<div>
    <div id="div2">
        <table>
            <tbody>
                <?php
                $s = 1;
                $sql2 = mysqli_query($con, "SELECT * FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.transaction_status='1' AND t.wallet_id!='0' AND i.shop_id='$shop_id' AND c.category_id='$category_id'");
                while ($display2 = mysqli_fetch_array($sql2)) {
                    $total = $total + $display2['transaction_amount'];
                ?>
                    <tr>
                        <td style="width: 10%;text-align: center;"><?php echo $s++ ?></td>
                        <td style="width: 20%;text-align: center;"><img src="Uploads/<?= $display2['item_image'] ?>" alt="No Image"></td>
                        <td style="width: 20%;text-align: center;"><?php echo $display2['item_name'] ?></td>
                        <td style="width: 30%;text-align: center;"><?php echo $display2['transaction_date'] ?></td>
                        <td style="width: 20%;text-align: center;"><?php echo $display2['transaction_amount'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div id="#div3">
        <table>
            <thead>
                <tr>
                    <th style="width: 80%;">Total</th>
                    <th style="width: 20%;"><?php echo $total ?></th>
                </tr>
            </thead>
        </table>
    </div>
</div>