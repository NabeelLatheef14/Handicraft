<?php
    session_start();
    include("config.php");
?>
<?php
    if(isset($_POST['district_id'])){
        $district_id = $_POST['district_id'];
        $sql = mysqli_query($con,"SELECT * FROM tbl_place WHERE district_id='$district_id' AND place_status='0'");
?>

<select name="place" class="input" required>
    <option style="color: black;" value="">--Select--</option>
    <?php
        while($row = mysqli_fetch_array($sql)){
    ?>
    <option style="color: black;" value="<?php echo $row['place_id'] ?>"><?php echo $row['place_name'] ?></option>
    <?php
        }
    ?>
<?php
    }
?>
</select>