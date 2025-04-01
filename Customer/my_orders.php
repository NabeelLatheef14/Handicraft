<?php
    session_start();
    include("navigation.php");
    $cart_id = $_SESSION['customer_id'];
?>

<html>
    <head>
        <title>My Orders</title>
        <link rel="stylesheet" href="my_orders.css">
    </head>
    <body>
        <div class="content">
            <div class="title">
                <h1>MY ORDERS</h1>
            </div>
            <div class="cards">
                <?php
                    include("config.php");
                    $s = 1;
                    $sql = mysqli_query($con,"SELECT * FROM tbl_transaction t INNER JOIN tbl_cart_item ci ON ci.cart_item_id=t.cart_item_id INNER JOIN tbl_item i ON i.item_id=ci.item_id WHERE t.wallet_id!='0' AND ci.cart_id='$cart_id' AND ci.cart_item_status='2'  ORDER BY ci.cart_item_id DESC");
                    while($display = mysqli_fetch_array($sql)){
                ?>
                <div class="card">
                    <div class="number">
                        <span><?php echo $s++; ?></span>
                    </div>
                    <div class="photo">
                        <img src="\Handicraft\Shop\Uploads\<?=$display['item_image']?>" alt="No Image">
                    </div>
                    <div class="name">
                        <span><?php echo $display['item_name']; ?></span>
                    </div>
                    <div class="details">
                        <span>Product Price : <?php echo $display['item_price']; ?></span>
                    </div>
                    <div class="export">
                        <?php
                            echo "<a target='_blank' href='invoice.php?cart_item_id=".$display['cart_item_id']."'><button>Invoice <i class='fa-solid fa-download'></i></button></a>";
                        ?>
                    </div>
                </div>
                <?php
                    }
                ?>
                </div>
            </div>
        </div>
    </body>
</html>