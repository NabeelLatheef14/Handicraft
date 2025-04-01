<html>
    <head>
        <title>Shop Delete Action</title>
    </head>
    <body>
        <?php
            include("config.php");
            if(isset($_GET["shop_id"])){
                $shop_id = $_GET["shop_id"];
                mysqli_query($con,"UPDATE tbl_shop SET shop_status='1' WHERE shop_id='$shop_id'");
                echo "<script>alert('Shop Deleted Successfully');window.location='shop_view.php'</script>";	
            }
        ?>
    </body>
</html>