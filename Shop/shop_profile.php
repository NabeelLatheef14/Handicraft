<?php
    session_start();
    include("sidebar.php");
    $shop_id = $_SESSION['shop_id'];
?>

<html>
    <head>
        <link rel="stylesheet" href="shop_profile.css">
        <title>Profile</title>
    </head>
    <body>
    <?php
        include("config.php");
        $sql = mysqli_query($con,"SELECT * FROM tbl_shop s INNER JOIN tbl_place p ON p.place_id=s.shop_place INNER JOIN tbl_district d ON d.district_id=p.district_id WHERE s.shop_id='$shop_id'");
        $display = mysqli_fetch_array($sql);
    ?>
        <div class="content">
        <div class="wrapper">
        <div class="img-area">
            <div class="inner-area">
                <img src="Assets/profile.png" alt="">
            </div>
        </div>
        <div class="name"><?php echo $display['shop_name'] ?></div>
        <div class="about">Id : <?php echo str_pad($shop_id, "8", "0", STR_PAD_LEFT) ?></div>
        <div class="social-icons">
            <a href="edit_profile.php" class="fb" title="Edit Profile"><i class="fa-solid fa-pencil"></i></a>
            <a href="change_password.php" class="fb" title="Change Password"><i class="fa-solid fa-key"></i></a>
        </div>
        <div class="buttons">
            <button>E-Mail</button>
            <button><?php echo $display['shop_email'] ?></button>
        </div>
        <div class="buttons">
            <button>Address</button>
            <button><?php echo $display['place_name'].", ".$display['district_name'] ?></button>
        </div>
    </div>
        </div>
    </body>
</html>