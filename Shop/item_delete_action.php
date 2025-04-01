<html>
    <head>
        <title>Product Delete Action</title>
    </head>
    <body>
        <?php
            include("config.php");
            if(isset($_GET["item_id"])){
                $item_id = $_GET["item_id"];
                mysqli_query($con,"UPDATE tbl_item SET item_status='1' WHERE item_id='$item_id'");
                echo "<script>alert('Product Deleted Successfully');window.location='products_view.php'</script>";	
            }
        ?>
    </body>
</html>