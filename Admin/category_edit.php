<?php
include("sidebar.php");
?>

<html>

<head>
    <title>Category Registration</title>
    <link rel="stylesheet" href="category_edit.css">
</head>

<body>
    <?php
        include("config.php");
        if(isset($_GET["cat_id"])){
            $cat_id = $_GET["cat_id"];
            $sql = mysqli_query($con,"SELECT * FROM tbl_category WHERE category_id='$cat_id'");
            $display = mysqli_fetch_array($sql);
        }
    ?>
    <div class="content">
        <form action="" method="POST">
            <div class="form">
                <h1>Category Edit</h1>
                <div class="input-control">
                    <label>Category Title</label>
                    <input name="catname" type="text" required  pattern="^[a-zA-Z]{3,15}$" title="Category title should contain only alphabets and between 3-15 charecters" value="<?php echo $display['category_name'];?>">
                </div>
                <div class="input-control">
                    <label>Category Description</label>
                    <textarea name="catdescription" required><?php echo $display['category_description'];?></textarea>
                </div>
                <button type="submit" name="catupdtbtn">UPDATE</button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
    if(isset($_POST["catupdtbtn"])){
        $cat_name = $_POST["catname"];
        $cat_description = $_POST["catdescription"];
        $sql = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_category WHERE category_name='$cat_name' AND category_status='0'");
        $display=mysqli_fetch_array($sql);

        if($display['count'] > 1){
            echo "<script>alert('Category Already Exist...!!');window.location='category_view.php'</script>";	
        } else {
            $sql=mysqli_query($con,"UPDATE tbl_category SET category_name='$cat_name',category_description='$cat_description' WHERE category_id='$cat_id'");
            echo "<script>alert('Category Updated Successfully');window.location='category_view.php'</script>";	
        }
    }
?>