<?php
include("header.php");
?>

<html>

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="user_registration.css">
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
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Customer</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Seller</label>
            <div class="login-form">
                <div class="sign-in-htm">
                    <form action="" method="POST">
                        <div class="group">
                            <label for="user" class="label">Name</label>
                            <input type="text" name="cname" class="input" required pattern="^[a-zA-Z\s]{3,20}$" title="Name should contain only alphabets and between 3-20 charecters">
                        </div>
                        <div class="group">
                            <label for="district" class="label">District</label>
                            <select name="cdistrict" class="district input" required>
                                <option style="color: black;" value="" selected disabled>--Select--</option>
                                <?php
                                include("config.php");
                                $sql = mysqli_query($con, "SELECT * FROM tbl_district WHERE district_status='0'");
                                while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                    <option style="color: black;" value="<?php echo $row['district_id'] ?>"> <?php echo $row['district_name']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="group">
                            <label for="place" class="label">Place</label>
                            <select name="place" class=" place input" required>
                                <option value="">--Select--</option>
                            </select>
                        </div>
                        <div class="group">
                            <label for="contact" class="label">Contact</label>
                            <input type="text" name="ccontact" class="input" required pattern="^[0-9]{10}$" title="Contact number should contain only 10 numbers.">
                        </div>
                        <div class="group">
                            <label for="Email" class="label">Email</label>
                            <input type="text" name="cemail" class="input" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter a valid username">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input type="text" name="cpass" class="input"required pattern=".{8,}" title="Eight or more charecters.">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign Up" name="cregister">
                        </div>
                    </form>
                </div>
                <div class="sign-up-htm">
                    <form action="" method="POST">
                        <div class="group">
                            <label for="user" class="label">Name</label>
                            <input type="text" name="sname" class="input" required pattern="^[a-zA-Z\s]{3,15}$" title="Name should contain only alphabets and between 3-20 charecters">
                        </div>
                        <div class="group">
                            <label for="district" class="label">District</label>
                            <select name="sdistrict" class="district input" required>
                                <option style="color: black;" value="" selected disabled>--Select--</option>
                                <?php
                                include("config.php");
                                $sql = mysqli_query($con, "SELECT * FROM tbl_district WHERE district_status='0'");
                                while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                    <option style="color: black;" value="<?php echo $row['district_id'] ?>"> <?php echo $row['district_name']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="group">
                            <label for="place" class="label">Place</label>
                            <select name="place" class=" place input" required>
                                <option value="">--Select--</option>
                            </select>
                        </div>
                        <div class="group">
                            <label for="Email" class="label">Email</label>
                            <input type="text" name="semail" class="input" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter a valid username">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input type="text" name="spass" class="input"required pattern=".{8,}" title="Eight or more charecters.">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign Up" name="sregister">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include("footer.php");
?>

<?php
    if (isset($_POST["cregister"])) {
        $name = $_POST["cname"];
        $place = $_POST["place"];
        $contact = $_POST["ccontact"];
        $email = $_POST["cemail"];
        $pass = $_POST["cpass"];
        $sql = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_shop,tbl_customer WHERE tbl_shop.shop_email='$email' OR tbl_customer.customer_email='$email'");
        $display=mysqli_fetch_array($sql);

        if($display['count'] > 0){
            echo "<script>alert('Email Already Exist...!!');window.location='user_registration.php'</script>";	
        } else {
            $sql=mysqli_query($con,"INSERT INTO tbl_customer(customer_name, customer_email, customer_password, customer_contact, customer_place) VALUES ('$name','$email','$pass','$contact','$place')");                    
            echo "<script>alert('Customer Registered Successfully');window.location='index.php'</script>";	
        }
    }

    if (isset($_POST["sregister"])) {
        $name = $_POST["sname"];
        $place = $_POST["place"];
        $contact = $_POST["scontact"];
        $email = $_POST["semail"];
        $pass = $_POST["spass"];
        $sql = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_shop,tbl_customer WHERE tbl_shop.shop_email='$email' OR tbl_customer.customer_email='$email'");
        $display=mysqli_fetch_array($sql);

        if($display['count'] > 0){
            echo "<script>alert('Email Already Exist...!!');window.location='user_registration.php'</script>";	
        } else {
            $sql=mysqli_query($con,"INSERT INTO tbl_shop(shop_name, shop_email, shop_password, shop_place) VALUES ('$name','$email','$pass','$place')");                    
            echo "<script>alert('Seller Registered Successfully');window.location='index.php'</script>";	
        }
    }
?>