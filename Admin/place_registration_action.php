<html>
    <head>
        <title>Place Registration Action</title>
    </head>

    <body>
        <?php
            include("config.php");
            if(isset($_POST["placeregbtn"])){
                $place_name = $_POST["placename"];
                $dist_id = $_POST["disname"];
                $sql = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_place WHERE place_name='$place_name' AND district_id='$dist_id' AND place_status='0'");
                $display=mysqli_fetch_array($sql);

                if($display['count'] > 0){
                    echo "<script>alert('Place Already Exist...!!');window.location='place_view.php'</script>";	
                } else {
                    $sql=mysqli_query($con,"INSERT INTO tbl_place (place_name, district_id) VALUES ('$place_name','$dist_id')");
                    echo "<script>alert('Place Registered Successfully');window.location='place_view.php'</script>";	
                }
            }
        ?>
    </body>
</html>