<?php
include("header.php");
?>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_login.css">
</head>

<body>
    <div class="content" style="margin-top: 177px; margin-bottom: 166px; margin-left: 40%; margin-right: 40%;">
        <!-- partial:index.partial.html -->

        <form action="" method="POST">
            <h1 style="text-align: center;">Admin Login</h1>
            <div class="form-field">
                <input type="text" name="uname" placeholder="Username" required pattern="[A-Za-z0-9]+" title="Enter a valid username" />
            </div>

            <div class="form-field">
                <input type="password" name="password" placeholder="Password" required />
            </div>

            <div class="form-field">
                <button class="btn" type="submit" name="adminlogin">Log in</button>
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
include("config.php");
if (isset($_POST["adminlogin"])) {
    $Username = $_POST["uname"];
    $Password = $_POST["password"];
    $result = mysqli_query($con, "SELECT * FROM tbl_admin WHERE admin_username='$Username' and admin_password='$Password'");
    $row = mysqli_fetch_array($result);
    if ($row > 0) {

        header("location:../Admin/index.php");
    } else {
        echo "<script>alert('Invalid Username/Password!!');window.location='admin_login.php';</script>";
    }
}
?>