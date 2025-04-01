<?php
    session_start();
    include("config.php");
        if(isset($_POST["paynow"])){
            $cart_id = $_SESSION["customer_id"];
            $sql1=mysqli_query($con,"SELECT * FROM tbl_transaction t INNER JOIN tbl_cart_item ci ON ci.cart_item_id=t.cart_item_id INNER JOIN tbl_item i ON i.item_id=ci.item_id WHERE ci.cart_item_status='1' AND ci.cart_id='$cart_id'");
  			    while($display1=mysqli_fetch_array($sql1)){
                    $cart_item_id = $display1['cart_item_id'];
                    $item_id = $display1['item_id'];
                    $item_stock = intval($display1['item_stock']);
                    $cart_item_quantity = intval($display1['cart_item_quantity']);
                    if($item_stock >= $cart_item_quantity){
                        $sql=mysqli_query($con,"UPDATE tbl_cart_item SET cart_item_status='2' WHERE cart_id='$cart_id' AND cart_item_status='1'");
                        $stock = $item_stock - $cart_item_quantity;
                        $sql3=mysqli_query($con,"UPDATE tbl_item SET item_stock='$stock' WHERE item_id='$item_id'");
                        $sql2=mysqli_query($con,"UPDATE tbl_transaction SET transaction_status='1' WHERE cart_item_id='$cart_item_id'");
                    } else {
                        echo "<script>alert('An Error Occured');window.location='cart.php'</script>";	
                    }
                }
            mysqli_error($con);
            echo "<script>window.location='index.php'</script>";
        }
?>