<?php
include("header.php");
?>
<html>

<head>
    <title>User Login</title>
    <link rel="stylesheet" href="user_login.css">
</head>

<body>
    <div class="content" style="margin-top: 177px; margin-bottom: 166px; margin-left: 40%; margin-right: 40%;">
        <!-- partial:index.partial.html -->

        <form action="" method="POST">
            <h1 style="text-align: center;">User Login</h1>
            <div class="form-field">
            <input type="text" name="email" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter a valid email" />
            </div>

            <div class="form-field">
                <input type="password" name="password" placeholder="Password" required />
            </div>

            <div class="form-field">
                <button class="btn" type="submit" name="userlogin">Log in</button>
            </div>
        </form>
        <!-- partial -->
    </div>
</body>

</html>

<?php
include("footer.php");
?>

<?php
session_start();
include("config.php");
if (isset($_POST["userlogin"])) {
    $Email = $_POST["email"];
    $Password = $_POST["password"];
    $result1 = mysqli_query($con, "SELECT * FROM tbl_shop WHERE shop_email='$Email' AND shop_password='$Password' AND shop_status='0'");
    $result2 = mysqli_query($con, "SELECT * FROM tbl_customer WHERE customer_email='$Email' AND customer_password='$Password' AND customer_status='0'");
    $row1 = mysqli_fetch_array($result1);
    $row2 = mysqli_fetch_array($result2);
    if ($row1 > 0) {
        $_SESSION['shop_id'] = $row1['shop_id'];

        header("location:../Shop/index.php");
    } else if($row2 > 0){
        $_SESSION['customer_id'] = $row2['customer_id'];

        header("location:../Customer/index.php");
    } else {
        echo "<script>alert('Invalid Username/Password!!');window.location='user_login.php';</script>";
    }
}
?>