<html>
    <head>
    </head>
    <body>
        <?php
            include("config.php");
            if(isset($_POST["catregbtn"])){
                $cat_name = $_POST["catname"];
                $cat_description = $_POST["catdescription"];
                $sql = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_category WHERE category_name='$cat_name' AND category_status='0'");
                $display=mysqli_fetch_array($sql);

                if($display['count'] > 0){
                    echo "<script>alert('Category Already Exist...!!');window.location='category_view.php'</script>";	
                } else {
                    $sql=mysqli_query($con,"INSERT INTO tbl_category(category_name, category_description) VALUES ('$cat_name','$cat_description')");
                    echo "<script>alert('Category Registered Successfully');window.location='category_view.php'</script>";	
                }
            }
        ?>
    </body>
</html>