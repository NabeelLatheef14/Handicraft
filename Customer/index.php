<?php
    session_start();
    include("navigation.php");
    $cart_id = $_SESSION["customer_id"];
?>

<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="cus-home.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    </head>
    <body>
        <div class="content">
            <?php
                include("config.php");
                $sql=mysqli_query($con,"SELECT * FROM tbl_category WHERE category_status='0' AND category_id IN (SELECT category_id FROM tbl_item)");
  			    while($display=mysqli_fetch_array($sql)){
                    $cat_id = $display["category_id"];
            ?>
            <div class="category-wise">
                <div class="head">
                    <span><?php echo $display["category_name"] ?></span>
                    <?php
                        echo "<a href='item_category_wise_view.php?cat_id=".$display['category_id']."'><button>View All <i class='fa-solid fa-circle-arrow-right'></i></button></a>";
                    ?>
                </div>
                <div class="cards">
                    <?php
                        $sql1=mysqli_query($con,"SELECT * FROM tbl_item WHERE category_id='$cat_id' AND item_status='0'") or die(mysqli_error($con));
  			            while($display1=mysqli_fetch_array($sql1)){
                            $real_price = intval($display1["item_price"])+intval($display1["item_price"])/100*5;
                            $item_id = $display1["item_id"];
                            $item_stock = intval($display1["item_stock"]);
                    ?>
                    <div class="card">
                        <img src="\Handicraft\Shop\Uploads\<?=$display1['item_image']?>" alt="No Image">
                        <span class="title"><?php echo $display1["item_name"] ?></span>
                        <span class="description"><?php echo $display1["item_description"] ?></span>
                        <div class="amount">
                            <span class="original">₹<?php echo ceil($real_price) ?>/-</span>
                            <span class="offer">₹<?php echo $display1["item_price"] ?>/-</span>
                        </div>
                        <?php
                            if($item_stock > 0){
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
            <?php
                }
            ?>
    </body>
</html>