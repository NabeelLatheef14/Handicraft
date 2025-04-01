<?php
include("navigation.php");
?>

<html>

<head>
    <title>Complaint Registration</title>
    <link rel="stylesheet" href="register_complaint.css">
</head>

<body>
    <div class="content">
        <form action="complaint_registration_action.php" method="POST" enctype="multipart/form-data">
            <div class="form">
                <h1>Complaint Registration</h1>
                <div class="input-control">
                    <label>Enter Your Complaint</label>
                    <textarea name="complaint" required></textarea>
                </div>
                <button type="submit" name="register">REGISTER</button>
            </div>
        </form>
    </div>
</body>

</html>