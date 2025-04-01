<html>
    <body>
    <?php
        session_start();
        include("config.php");
        if(isset($_GET["item_id"])){
            $cart_id = $_SESSION["customer_id"];
            $item_id = $_GET["item_id"];
            mysqli_query($con,"INSERT INTO tbl_cart_item(cart_id, item_id, cart_item_quantity) VALUES ('$cart_id','$item_id','1')");
            echo "<script>alert('Product Added to Cart');window.location='index.php'</script>";	
    }
?>
    </body>
</html>