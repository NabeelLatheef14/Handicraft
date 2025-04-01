<?php
    include("config.php");
        if(isset($_GET["cart_id"])){
            $cart_id = $_GET["cart_id"];

            $sql1 = mysqli_query($con,"SELECT * FROM tbl_cart_item ci INNER JOIN tbl_item i ON i.item_id=ci.item_id INNER JOIN tbl_shop s ON s.shop_id=i.shop_id WHERE ci.cart_id='$cart_id' AND ci.cart_item_status!='2' AND i.item_status='0'");
            while($display = mysqli_fetch_array($sql1)){
                $shop_id = $display['shop_id'];
                $amount = intval($display['cart_item_quantity']) * intval($display['item_price']);
                $admin_amount = $amount/100*3;
                $shop_amount = $amount - $admin_amount;
                $cart_item_id = $display['cart_item_id'];
                $sql=mysqli_query($con,"UPDATE tbl_cart_item SET cart_item_status='1' WHERE cart_item_id='$cart_item_id'");
                $date = date("Y-m-d");
                $sql4 = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_transaction WHERE cart_item_id='$cart_item_id'");
                $display4=mysqli_fetch_array($sql4);

                if($display4['count'] == 2 ){
                    $sql5=mysqli_query($con,"UPDATE tbl_transaction SET transaction_date='$date' WHERE cart_item_id='$cart_item_id'");
                } else {
                    $sql2=mysqli_query($con,"INSERT INTO tbl_transaction(transaction_date, transaction_type, transaction_amount, wallet_id, cart_item_id) VALUES ('$date','Credit','$shop_amount','$shop_id','$cart_item_id')");
                    $sql3=mysqli_query($con,"INSERT INTO tbl_transaction(transaction_date, transaction_type, transaction_amount, wallet_id, cart_item_id) VALUES ('$date','Credit','$admin_amount','0','$cart_item_id')");
                }
            }
            echo "<script>window.location='payment.php'</script>";
        }
?>