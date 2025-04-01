<html>
    <head>
        <title>Place Delete Action</title>
    </head>
    <body>
        <?php
            include("config.php");
            if(isset($_GET["place_id"])){
                $place_id = $_GET["place_id"];
                mysqli_query($con,"UPDATE tbl_place SET place_status='1' WHERE place_id='$place_id'");
                echo "<script>alert('Place Deleted Successfully');window.location='place_view.php'</script>";	
            }
        ?>
    </body>
</html>