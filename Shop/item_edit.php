<?php
session_start();
include("sidebar.php");
?>

<html>

<head>
    <title>Product Edit</title>
    <link rel="stylesheet" href="item_edit.css">
</head>

<body>
    <?php
        include("config.php");
        if(isset($_GET["item_id"])){
            $item_id = $_GET["item_id"];
            $sql1 = mysqli_query($con,"SELECT * FROM tbl_item i INNER JOIN tbl_category c ON c.category_id=i.category_id WHERE i.item_id='$item_id' AND category_status='0'");
            $display = mysqli_fetch_array($sql1);
            $cat_id = $display["category_id"];
        }
    ?>
    <div class="content">
        <form action="item_edit_action.php" method="POST" enctype="multipart/form-data">
            <div class="form">
                <h1>Product Edit</h1>
                <div class="input-control">
                    <label>Product Name</label>
                    <input name="productname" type="text" required pattern="^[a-zA-Z0-9]{3,15}$" title="Product name should contain only alphabets and numbers between 3-15 charecters" value="<?php echo $display['item_name'];?>">
                    <input name="item_id" type="hidden" value="<?php echo $item_id;?>">
                </div>
                <div class="input-control">
                    <label>Product Description</label>
                    <textarea name="productdes" required><?php echo $display['item_description'];?></textarea>
                </div>
                <div class="input-control">
                    <label>Product Image</label>
                    <input type="file" name="productimg" required value="Uploads/<?=$display['item_image']?>"></textarea>
                </div>
                <div class="input-control">
                    <label>Product Category</label>
                    <?php
                        include("config.php");
                        $sql = mysqli_query($con, "SELECT * FROM tbl_category WHERE category_id!='$cat_id' AND category_status='0'");
                    ?>
                    <select name="catname" required>
                        <option value="<?php echo $display['category_id']; ?>" selected><?php echo $display['category_name']; ?></option>
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
                    <input name="productprice" type="number" required value="<?php echo $display['item_price'] ?>">
                </div>
                <div class="input-control">
                    <label>Product Stock</label>
                    <input name="productstock" type="number" required value="<?php echo $display['item_stock'] ?>">
                </div>
                <button type="submit" name="itemupdtbtn">UPDATE</button>
            </div>
        </form>
    </div>
</body>

</html>