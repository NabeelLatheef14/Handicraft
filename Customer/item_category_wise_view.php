<?php
    session_start();
    include("navigation.php");
    $cart_id = $_SESSION["customer_id"];
?>

<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="item_category_wise_view.css">
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
            <div class="head" style="z-index: 1;">
                <span><?php echo $display["category_name"] ?></span>
            </div>
            <div class="cards" style="padding-top: 50px;flex-wrap: wrap;margin-left:auto;margin-right:auto;">
                <?php
                    $sql1=mysqli_query($con,"SELECT * FROM tbl_item WHERE category_id='$cat_id' AND item_status='0'") or die(mysqli_error($con));
  			        while($display1=mysqli_fetch_array($sql1)){
                        $real_price = intval($display1["item_price"])+intval($display1["item_price"])/100*5;
                        $item_id = $display1["item_id"];
                        $item_stock = intval($display1["item_stock"]);
                ?>
                <div class="card" style="margin: 15px;">
                    <img src="\Handicraft\Shop\Uploads\<?=$display1['item_image']?>" alt="No Image">
                    <span class="title"><?php echo $display1["item_name"] ?></span>
                    <span class="description"><?php echo $display1["item_description"] ?></span>
                    <div class="amount">
                        <span class="original">₹<?php echo ceil($real_price) ?>/-</span>
                        <span class="offer">₹<?php echo $display1["item_price"] ?>/-</span>
                    </div>
                    <?php
                        if($item_stock != 0){
                            $sql2 = mysqli_query($con,"SELECT COUNT(*) as num FROM tbl_cart_item WHERE item_id='$item_id' AND cart_id='$cart_id' AND cart_item_status='0'");
                            $display2=mysqli_fetch_array($sql2);
                            if($display2['num'] == 0){
                                echo "<a href='add_to_cart_action.php?item_id=".$display1['item_id']."'><button class='add-to-cart'>ADD TO CART</button></a>";
                            }
                            else{
                                echo "<a href='cart.php'><button class='go-to-cart'>GO TO CART</button></a>";
                            }
                        }
                        else{
                            echo "<span class='out-of-stock'>OUT OF STOCK</span>";
                        }
                    ?>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </body>
</html>