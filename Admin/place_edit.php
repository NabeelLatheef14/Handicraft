<?php
include("sidebar.php");
?>

<html>

<head>
    <title>Place Edit</title>
    <link rel="stylesheet" href="place_registration.css">
</head>

<body>
    <?php
    include("config.php");
        if(isset($_GET["place_id"])){
            $place_id = $_GET["place_id"];
            $sql1 = mysqli_query($con,"SELECT * FROM tbl_place p INNER JOIN tbl_district d ON d.district_id=p.place_id WHERE p.place_id='$place_id' AND p.place_status='0'");
            $display = mysqli_fetch_array($sql1);
            $dist_id = $display["district_id"];
        }
    ?>
    <div class="content">
        <form action="" method="POST">
            <div class="form">
                <h1>Place Edit</h1>
                <div class="input-control">
                    <label>Place Name</label>
                    <input name="placename" type="text" required pattern="^[a-zA-Z]{3,15}$" title="Place name should contain only alphabets and between 3-15 charecters" value="<?php echo $display['place_name'];?>">
                </div>
                <div class="input-control">
                    <label>District Name</label>
                    <?php
                        $sql = mysqli_query($con, "SELECT * FROM tbl_district WHERE district_id!='$dist_id'");
                    ?>
                    <select name="disname" required>
                        <option value="<?php echo $display['district_id'];?>" selected><?php echo $display['district_name'];?></option>
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
                <button type="submit" name="placeupdtbtn">UPDATE</button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
    if(isset($_POST["placeupdtbtn"])){
        $place_name = $_POST["placename"];
        $dis_id = $_POST["disname"];
        $sql = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_place WHERE place_name='$place_name' AND district_id='$dis_id'");
        $display=mysqli_fetch_array($sql);

        if($display['count'] > 1){
            echo "<script>alert('Place Already Exist...!!');window.location='place_view.php'</script>";	
        } else {
            $sql=mysqli_query($con,"UPDATE tbl_place SET place_name='$place_name',district_id='$dis_id' WHERE place_id='$place_id'");
            echo "<script>alert('Place Updated Successfully');window.location='place_view.php'</script>";	
        }
    }
?>