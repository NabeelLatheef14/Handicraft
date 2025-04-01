<?php
include("config.php");
session_start();
$cus_id = $_SESSION['customer_id'];
?>
<?php
$sql1 = mysqli_query($con, "SELECT * FROM tbl_customer c INNER JOIN tbl_place p ON p.place_id=c.customer_place INNER JOIN tbl_district d ON d.district_id=p.place_id WHERE c.customer_id='$cus_id'");
$display = mysqli_fetch_array($sql1);
if (isset($_POST['district_id'])) {
    $district_id = $_POST['district_id'];
    $sql = mysqli_query($con, "SELECT * FROM tbl_place WHERE district_id='$district_id'");
?>

    <select name="district">
        <?php
        $sql1 = mysqli_query($con, "SELECT * FROM tbl_place p INNER JOIN tbl_district d ON d.district_id=p.district_id WHERE p.district_id='$district_id'");
        while ($row = mysqli_fetch_array($sql1)) {
        ?>
            <option value="<?php echo $row['place_id'] ?>"><?php echo $row['place_name'] ?></option>
    <?php
        }
    }
    ?>
    </select>