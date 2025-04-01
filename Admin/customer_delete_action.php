<html>
    <head>
        <title>Customer Delete Action</title>
    </head>
    <body>
        <?php
            include("config.php");
            if(isset($_GET["cus_id"])){
                $cus_id = $_GET["cus_id"];
                mysqli_query($con,"UPDATE tbl_customer SET customer_status='1' WHERE customer_id='$cus_id'");
                echo "<script>alert('Customer Deleted Successfully');window.location='customers_view.php'</script>";	
            }
        ?>
    </body>
</html>