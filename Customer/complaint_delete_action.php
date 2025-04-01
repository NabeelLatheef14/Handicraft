<html>
    <head>
        <title>Complaint Delete Action</title>
    </head>
    <body>
        <?php
            include("config.php");
            if(isset($_GET["comp_id"])){
                $comp_id = $_GET["comp_id"];
                mysqli_query($con,"DELETE FROM tbl_complaint WHERE complaint_id='$comp_id'");
                echo "<script>alert('Complaint Deleted Successfully');window.location='complaint_view.php'</script>";	
            }
        ?>
    </body>
</html>