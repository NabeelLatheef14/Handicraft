<?php
    session_start();
    $shop_id = $_SESSION['shop_id'];
    if(isset($_POST['changepass'])){
        include("config.php");
        $old = $_POST['oldpassword'];
        $new = $_POST['newpassword'];
        $cnew = $_POST['confirmnewpassword'];
        $sql = mysqli_query($con,"SELECT * FROM tbl_shop WHERE shop_id='$shop_id'");
        $display = mysqli_fetch_array($sql);
        if($display['shop_password'] === $old){
            if($new === $cnew){
                $sql2 = mysqli_query($con,"UPDATE tbl_shop SET shop_password='$new' WHERE shop_id='$shop_id'");
                echo mysqli_error($con);
                echo "<script>alert('Password updated');window.location='shop_profile.php'</script>";
            } else {
                echo "<script>alert('Password doesn't match');window.location='shop_profile.php'</script>";
            }
        } else {
            echo "<script>alert('Wrong Current Password');window.location='shop_profile.php'</script>";
        }
    }
?>