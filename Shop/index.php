<?php
include("sidebar.php");
?>

<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <div class="content">
        <h1><a href="item_registration.php"><button>ADD NEW</button></a>Product View</h1>
        <section class="main-section">
        <?php
            session_start();
            include("config.php");
		    $shop_id = $_SESSION["shop_id"];
            $sql=mysqli_query($con,"SELECT * FROM tbl_item WHERE shop_id='$shop_id' AND item_status='0'");
  			while($display=mysqli_fetch_array($sql)){ 
        ?>
            <div class="cards">
                <img src="Uploads/<?=$display['item_image']?>" alt="No Image">
                <span class="title"><?php echo $display["item_name"] ?></span>
                <span class="description"><?php echo $display["item_description"] ?></span>
                <?php
                    if($display["item_stock"]>0){
                ?>
                <form action="" method="POST">
                    <div class="stock">
                        <div class="balance">Stock : <?php echo $display["item_stock"] ?> + </div>
                            <input type="number" name="stock" min="0" class="add">
                            <input type="hidden" name="itemid" value="<?php echo $display['item_id'];?>" required>
                    </div>
                    <button name="btnaddstock" class="add-to-cart">ADD TO STOCK</button>
                </form>
                <?php
                    }
                ?>
                <?php
                    if($display["item_stock"]==0){
                ?>
                <form action="" method="POST">
                    <div class="stock">
                        <div class="balance-red">Out of Stock + </div>
                            <input type="number" name="stock" min="0" class="add">
                            <input type="hidden" name="itemid" value="<?php echo $display['item_id'];?>" required>
                    </div>
                    <button name="btnaddstock" class="add-to-cart">ADD TO STOCK</button>
                </form>
                <?php
                    }
                ?>
            </div>
        <?php
            }
        ?>
        </section>
    </div>
</body>

</html>

<?php
    if(isset($_POST['btnaddstock'])){
        $item_id = $_POST['itemid'];
        $stock = $_POST['stock'];
        $sql1 = mysqli_query($con,"SELECT item_stock AS count FROM tbl_item WHERE item_id='$item_id'");
        $display=mysqli_fetch_array($sql1);
        $item_stock = $stock + (int) $display['count'];
        $sql2=mysqli_query($con,"UPDATE tbl_item SET item_stock='$item_stock' WHERE item_id='$item_id'");
        echo "<script>alert('Stock Updated Successfully');window.location='index.php'</script>";	
    }
?>