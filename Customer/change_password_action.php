<?php
    session_start();
    $cus_id = $_SESSION['customer_id'];
    if(isset($_POST['changepass'])){
        include("config.php");
        $old = $_POST['oldpassword'];
        $new = $_POST['newpassword'];
        $cnew = $_POST['confirmnewpassword'];
        $sql = mysqli_query($con,"SELECT * FROM tbl_customer WHERE customer_id='$cus_id'");
        $display = mysqli_fetch_array($sql);
        if($display['customer_password'] === $old){
            echo $new.", ".$old.", ".$cus_id;
            if($new === $cnew){
                $sql2 = mysqli_query($con,"UPDATE tbl_customer SET customer_password='$new' WHERE customer_id='$cus_id'");
                echo mysqli_error($con);
                echo "<script>alert('Password updated');window.location='my_profile.php'</script>";
            } else {
                echo "<script>alert('Password doesn't match');window.location='my_profile.php'</script>";
            }
        } else {
            echo "<script>alert('Wrong Current Password');window.location='my_profile.php'</script>";
        }
    }
?>