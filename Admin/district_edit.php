<?php
include("sidebar.php");
?>

<html>

<head>
    <title>District Edit</title>
    <link rel="stylesheet" href="district_registration.css">
</head>

<body>
    <?php
        include("config.php");
        if(isset($_GET["dist_id"])){
            $dist_id = $_GET["dist_id"];
            $sql = mysqli_query($con,"SELECT * FROM tbl_district WHERE district_id='$dist_id'");
            $display = mysqli_fetch_array($sql);
        }
    ?>
    <div class="content">
        <form action="" method="POST">
            <div class="form">
                <h1>District Edit</h1>
                <div class="input-control">
                    <label>District Name</label>
                    <input name="disname" type="text" required  pattern="^[a-zA-Z]{3,15}$" title="District name should contain only alphabets and between 3-15 charecters" value="<?php echo $display['district_name'];?>">
                </div>
                <button type="submit" name="distupdtbtn">Update</button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
    if(isset($_POST['distupdtbtn'])){
        $dist_name = $_POST["disname"];
        $sql = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_district WHERE district_name='$dist_name' AND district_status='0'");
        $display=mysqli_fetch_array($sql);

        if($display['count'] > 1){
            echo "<script>alert('District Already Exist...!!');window.location='district_view.php'</script>";	
        } else {
            $sql=mysqli_query($con,"UPDATE tbl_district SET district_name='$dist_name' WHERE district_id='$dist_id'");
            echo "<script>alert('District Updated Successfully');window.location='district_view.php'</script>";	
        }
    }
?>