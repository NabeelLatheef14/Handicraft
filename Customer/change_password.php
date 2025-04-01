<?php
session_start();
include("navigation.php");
$cus_id = $_SESSION['customer_id'];
?>

<html>

<head>
    <link rel="stylesheet" href="change_password.css">
    <title>Change Password</title>
</head>

<body>
    <form class="box" action="change_password_action.php" method="POST">
        <h1>Change Password</h1>
        <input type="password" placeholder="Enter Old Password" name="oldpassword" required>
        <input type="password" placeholder="Enter New Password" name="newpassword" required pattern=".{8,}" title="Eight or more charecters.">
        <input type="password" placeholder="Confirm New Password" name="confirmnewpassword" required pattern=".{8,}" title="Eight or more charecters.">
        <input type="submit" value="Change Password" name="changepass">
    </form>
</body>

</html>