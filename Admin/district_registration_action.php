<html>
    <head>
    </head>
    <body>
        <?php
            include("config.php");
            if(isset($_POST["distregbtn"])){
                $dist_name = $_POST["disname"];
                $sql = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_district WHERE district_name='$dist_name' AND district_status='0'");
                $display=mysqli_fetch_array($sql);

                if($display['count'] > 0){
                    echo "<script>alert('District Already Exist...!!');window.location='district_view.php'</script>";	
                } else {
                    $sql=mysqli_query($con,"INSERT INTO tbl_district(district_name) VALUES ('$dist_name')");
                    echo "<script>alert('District Registered Successfully');window.location='district_view.php'</script>";	
                }
            }
        ?>
    </body>
</html>