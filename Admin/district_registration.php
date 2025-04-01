<?php
include("sidebar.php");
?>

<html>

<head>
    <title>District Registration</title>
    <link rel="stylesheet" href="district_registration.css">
</head>

<body>
    <div class="content">
        <form action="district_registration_action.php" method="POST">
            <div class="form">
                <h1>District Registration</h1>
                <div class="input-control">
                    <label>District Name</label>
                    <input name="disname" type="text" required  pattern="^[a-zA-Z]{3,20}$" title="District name should contain only alphabets and between 3-15 charecters">
                </div>
                <button type="submit" name="distregbtn">REGISTER</button>
            </div>
        </form>
    </div>
</body>

</html>