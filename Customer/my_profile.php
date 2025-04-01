<?php
session_start();
include("navigation.php");
$cus_id = $_SESSION['customer_id'];
?>

<html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" href="my_profile.css">
</head>

<body>
    <?php
        include("config.php");
        $sql = mysqli_query($con,"SELECT * FROM tbl_customer c INNER JOIN tbl_place p ON p.place_id=c.customer_place INNER JOIN tbl_district d ON d.district_id=p.district_id WHERE c.customer_id='$cus_id'");
        $display = mysqli_fetch_array($sql);
    ?>
    <div class="wrapper">
        <div class="img-area">
            <div class="inner-area">
                <img src="Assets/profile.png" alt="">
            </div>
        </div>
        <div class="name"><?php echo $display['customer_name'] ?></div>
        <div class="about">Id : <?php echo str_pad($cus_id, "8", "0", STR_PAD_LEFT) ?></div>
        <div class="social-icons">
            <a href="edit_profile.php" class="fb" title="Edit Profile"><i class="fa-solid fa-pencil"></i></a>
            <a href="change_password.php" class="fb" title="Change Password"><i class="fa-solid fa-key"></i></a>
        </div>
        <div class="buttons">
            <button>E-Mail</button>
            <button><?php echo $display['customer_email'] ?></button>
        </div>
        <div class="buttons">
            <button>Contact</button>
            <button><?php echo $display['customer_contact'] ?></button>
        </div>
        <div class="buttons">
            <button>Address</button>
            <button><?php echo $display['place_name'].", ".$display['district_name'] ?></button>
        </div>
    </div>
</body>

</html>

<!-- <body>
    <div class="wrapper">
      <div class="img-area">
        <div class="inner-area">
          <img [src]=" imageUrl || 'assets/no_profile_pic.jpg'" alt="">
        </div>
      </div>
      <div class="name">{{name}}</div>
      <div class="about">{{designation}}</div>
      <div class="social-icons">
        <a routerLink="/Admin/adminprofileedit" class="fb"><i class='bx bx-pencil'></i></a>
        <a routerLink="/Admin/adminchangepass" class="fb"><i class='bx bxs-key'></i></a>
      </div>
      <div class="buttons">
        <button>E-Mail</button>
        <button>{{email}}</button>
      </div>
    </div>
  </body> -->