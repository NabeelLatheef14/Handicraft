<?php
include("sidebar.php");
?>

<html>

<head>
    <title>Place Registration</title>
    <link rel="stylesheet" href="place_registration.css">
</head>

<body>
    <div class="content">
        <form action="place_registration_action.php" method="POST">
            <div class="form">
                <h1>Place Registration</h1>
                <div class="input-control">
                    <label>Place Name</label>
                    <input name="placename" type="text" required pattern="^[a-zA-Z]{3,15}$" title="Place name should contain only alphabets and between 3-15 charecters">
                </div>
                <div class="input-control">
                    <label>District Name</label>
                    <?php
                        include("config.php");
                        $sql = mysqli_query($con, "SELECT * FROM tbl_district WHERE district_status='0'");
                    ?>
                    <select name="disname" required>
                        <option value="" selected disabled>--Select--</option>
                        <?php
                            while($row=mysqli_fetch_array($sql)){
                        ?>
                        <option value="<?php echo $row['district_id'] ?>"> <?php echo $row['district_name'];?> </option>
                        <?php
                            }
                        ?>
                    </select>
                    <div class="error"></div>
                </div>
                <button type="submit" name="placeregbtn">REGISTER</button>
            </div>
        </form>
    </div>
</body>

</html>