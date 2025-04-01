<?php
include("sidebar.php");
?>

<html>

<head>
    <title>Category Registration</title>
    <link rel="stylesheet" href="category_registration.css">
</head>

<body>
    <div class="content">
        <form action="category_registration_action.php" method="POST">
            <div class="form">
                <h1>Category Registration</h1>
                <div class="input-control">
                    <label>Category Title</label>
                    <input name="catname" type="text" required  pattern="^[a-zA-Z]{3,25}$" title="Category title should contain only alphabets and between 3-25 charecters">
                </div>
                <div class="input-control">
                    <label>Category Description</label>
                    <textarea name="catdescription" required></textarea>
                </div>
                <button type="submit" name="catregbtn">REGISTER</button>
            </div>
        </form>
    </div>
</body>

</html>