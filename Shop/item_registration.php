<?php
include("sidebar.php");
?>

<html>

<head>
    <title>Product Registration</title>
    <link rel="stylesheet" href="item_registration.css">
</head>

<body>
    <div class="content">
        <form action="item_registration_action.php" method="POST" enctype="multipart/form-data">
            <div class="form">
                <h1>Product Registration</h1>
                <div class="input-control">
                    <label>Product Name</label>
                    <input name="productname" type="text" required pattern="^[a-zA-Z0-9]{3,15}$" title="Product name should contain only alphabets and numbers between 3-15 charecters">
                </div>
                <div class="input-control">
                    <label>Product Description</label>
                    <textarea name="productdes" required></textarea>
                </div>
                <div class="input-control">
                    <label>Product Image</label>
                    <input type="file" name="productimg" required></textarea>
                </div>
                <div class="input-control">
                    <label>Product Category</label>
                    <?php
                        include("config.php");
                        $sql = mysqli_query($con, "SELECT * FROM tbl_category WHERE category_status='0'");
                    ?>
                    <select name="catname" required>
                        <option value="" selected disabled>--Select--</option>
                        <?php
                            while($row=mysqli_fetch_array($sql)){
                        ?>
                        <option value="<?php echo $row['category_id'] ?>"> <?php echo $row['category_name'];?> </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="input-control">
                    <label>Product Price</label>
                    <input name="productprice" type="number" required>
                </div>
                <div class="input-control">
                    <label>Product Stock</label>
                    <input name="productstock" type="number" required>
                </div>
                <button type="submit" name="itemregbtn">REGISTER</button>
            </div>
        </form>
    </div>
</body>

</html>