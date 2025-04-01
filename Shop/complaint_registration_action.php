<?php
    session_start();
    $shop_id = $_SESSION["shop_id"];
    include("config.php");
    if(isset($_POST["register"])){
        $complaint = $_POST["complaint"];
        $date = date("d-m-Y h:i a");
        $sql=mysqli_query($con,"INSERT INTO tbl_complaint(complaint, complaint_date, complainant_type, complainant_id) VALUES ('$complaint','$date','Shop','$shop_id')");
        echo "<script>alert('Complaint Registered Successfully');window.location='complaint_view.php'</script>";	
            }
