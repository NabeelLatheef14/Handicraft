<?php
session_start();
include("sidebar.php");
$shop_id = $_SESSION['shop_id'];
?>

<html>

<head>
    <link rel="stylesheet" href="change_password.css">
    <title>Profile</title>
</head>

<body>
    <div class="content">
        <form class="box" action="change_password_action.php" method="POST">
            <h1>Change Password</h1>
            <input type="password" placeholder="Enter Old Password" name="oldpassword" required>
            <input type="password" placeholder="Enter New Password" name="newpassword" required pattern=".{8,}" title="Eight or more charecters.">
            <input type="password" placeholder="Confirm New Password" name="confirmnewpassword" required pattern=".{8,}" title="Eight or more charecters.">
            <input type="submit" value="Change Password" name="changepass">
        </form>
    </div>
</body>

</html>