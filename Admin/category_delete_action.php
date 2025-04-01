<html>
    <head>
        <title>Category Delete Action</title>
    </head>
    <body>
        <?php
            include("config.php");
            if(isset($_GET["cat_id"])){
                $cat_id = $_GET["cat_id"];
                mysqli_query($con,"UPDATE tbl_category SET category_status='1' WHERE category_id='$cat_id'");
                echo "<script>alert('Category Deleted Successfully');window.location='category_view.php'</script>";	
            }
        ?>
    </body>
</html>