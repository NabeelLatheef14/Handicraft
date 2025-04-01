<html>
    <head>
        <title>Cart Item Delete Action</title>
    </head>
    <body>
        <?php
            include("config.php");
            if(isset($_GET["cart_item_id"])){
                $cart_item_id = $_GET["cart_item_id"];
                mysqli_query($con,"DELETE FROM tbl_cart_item WHERE cart_item_id='$cart_item_id'");
                echo "<script>alert('Item Removed');window.location='cart.php'</script>";	
            }
        ?>
    </body>
</html>