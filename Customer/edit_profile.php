<?php
session_start();
include("navigation.php");
$cus_id = $_SESSION['customer_id'];
?>

<html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" href="edit_profile.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".district").change(function() {
                var district_id = $(this).val();
                $.ajax({
                    url: "getlocation.php",
                    method: "POST",
                    data: {
                        district_id: district_id
                    },
                    success: function(data) {
                        $(".place").html(data);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <?php
        include("config.php");
        $sql = mysqli_query($con,"SELECT * FROM tbl_customer c INNER JOIN tbl_place p ON p.place_id=c.customer_place INNER JOIN tbl_district d ON d.district_id=p.place_id WHERE c.customer_id='$cus_id'");
        $display = mysqli_fetch_array($sql);
    ?>
    <form action="" method="POST">
        <div class="wrapper">
            <div class="img-area">
                <div class="inner-area">
                    <img src="Assets/profile.png" alt="">
                </div>
            </div>
            <div class="icon arrow" routerLink="/Admin/adminprofile"><i class='bx bx-left-arrow-alt'></i></div>
            <div class="name"><?php echo $display['customer_name'] ?></div>
            <div class="about">Id : <?php echo str_pad($cus_id, "8", "0", STR_PAD_LEFT) ?></div>
            <br>
            <div class="buttons">
                <button>E-Mail</button>
                <input type="text" name="email" value="<?php echo $display['customer_email'] ?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter a valid username">
            </div>
            <div class="buttons">
                <button>Contact</button>
                <input type="text" name="contact" value="<?php echo $display['customer_contact'] ?>">
            </div>
            <div class="buttons">
                <button>District</button>
                <select name="district" id="" class="district">
                    <option value="<?php echo $display['district_id'] ?>" selected><?php echo $display['district_name'] ?></option>
                    <?php
                        $sql1 = mysqli_query($con, "SELECT * FROM tbl_district WHERE district_id!='".$display['district_id']."'");
                        while ($row = mysqli_fetch_array($sql1)) {
                    ?>
                    <option value="<?php echo $row['district_id'] ?>"><?php echo $row['district_name'] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="buttons">
                <button>Place</button>
                <select name="place" id="" class="place">
                    <option value="<?php echo $display['place_id'] ?>" selected><?php echo $display['place_name'] ?></option>
                    <?php
                        $sql1 = mysqli_query($con, "SELECT * FROM tbl_place p INNER JOIN tbl_district d ON d.district_id=p.district_id WHERE p.place_id!='".$display['place_id']."' AND p.district_id'".$display['district_id']."'");
                        while ($row = mysqli_fetch_array($sql1)) {
                    ?>
                    <option value="<?php echo $row['place_id'] ?>"><?php echo $row['place_name'] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="social-icons">
                <button name="update" class="save" (click)="updateprofile()"><i class="fa-solid fa-floppy-disk"></i></button>
            </div>
        </div>
    </form>
</body>

</html>

<?php
    if(isset($_POST['update'])){
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $place_id = $_POST['place'];
        $sql3 = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_customer WHERE customer_email='$email'");
        $display3=mysqli_fetch_array($sql3);
        $sql4 = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_shop WHERE shop_email='$email'");
        $display4=mysqli_fetch_array($sql4);

        if($display3['count'] > 1 || $display4['count'] > 0){
            echo "<script>alert('Email Already Exist...!!');window.location='my_profile.php'</script>";	
        } else {
            $sql=mysqli_query($con,"UPDATE tbl_customer SET customer_email='$email',customer_contact='$contact',customer_place='$place_id' WHERE customer_id='$cus_id'");
            echo mysqli_error($con);
            echo "<script>alert('Profile Updated Successfully');window.location='my_profile.php'</script>";	
        }
    }
?>