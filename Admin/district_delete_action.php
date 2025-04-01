<html>
    <head>
        <title>District Delete Action</title>
    </head>
    <body>
        <?php
            include("config.php");
            if(isset($_GET["dist_id"])){
                $dist_id = $_GET["dist_id"];
                mysqli_query($con,"UPDATE tbl_district SET district_status='1' WHERE district_id='$dist_id'");
                echo "<script>alert('District Deleted Successfully');window.location='district_view.php'</script>";	
            }
        ?>
    </body>
</html>