<?php
    session_start();
    include("config.php");
    $cart_id = $_SESSION["customer_id"];
    $total_amount = 0;

    $cart_item_id = $_POST['cart_item_id'];
    $quantity = $_POST['qty'];

    $sql1 = mysqli_query($con,"SELECT * FROM tbl_cart_item ci INNER JOIN tbl_item i ON i.item_id=ci.item_id WHERE ci.cart_item_id='$cart_item_id' AND ci.cart_id='$cart_id' AND i.item_status='0'");
    $display = mysqli_fetch_array($sql1);
    $item_stock = intval($display['item_stock']);
    if($quantity <= $item_stock){
        $sql = mysqli_query($con, "UPDATE tbl_cart_item SET cart_item_quantity='$quantity' WHERE cart_item_id='$cart_item_id'");
    } else{
        echo "<script>alert('Sorry No More Items...!')</script>";
    }
    mysqli_error($con);
?>


<h1>MY CART</h1>
            <div class="cart-items-content">
                <div class="items">
                    <table>
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Net Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("config.php");
                                $s = 1;
                                $sql = mysqli_query($con,"SELECT * FROM tbl_cart_item ci INNER JOIN tbl_item i ON i.item_id=ci.item_id WHERE cart_id='$cart_id' AND cart_item_status!='2' AND i.item_status='0'");
                                while($display = mysqli_fetch_array($sql)){
                                    $int_price = intval($display['item_price']);
                                    $int_quantity = intval($display['cart_item_quantity']);
                                    $net_amount = $int_price * $int_quantity;
                                    $total_amount = $total_amount + $net_amount; 
                                    $item_stock = intval($display["item_stock"]);
                                    $cart_item_id = $display['cart_item_id'];
                                    if($item_stock != 0){
                            ?>
                            <tr>
                                <td><?php echo $s++ ?></td>
                                <td><img src="\Handicraft\Shop\Uploads\<?=$display['item_image']?>" alt="No Image"></td>
                                <td><?php echo $display['item_name']; ?></td>
                                <td><?php echo $display['item_price']; ?></td>
                                <td>
                                    <form id="frm<?php echo $display['cart_item_id']; ?>">
                                        <input type="hidden" name="cart_item_id" value="<?php echo $display['cart_item_id']; ?>">
                                        <?php
                                            $cart_item_quantity = intval($display['cart_item_quantity']);
                                            if($cart_item_quantity > $item_stock){
                                                $sql = mysqli_query($con, "UPDATE tbl_cart_item SET cart_item_quantity='$item_stock' WHERE cart_item_id='$cart_item_id'");
                                        ?>
                                        <input type="number" name="qty" min="1" value="<?php echo $item_stock; ?>" onchange="updcart(<?php echo $display['cart_item_id']; ?>)" onkeyup="updcart(<?php echo $display['cart_item_id']; ?>)">
                                        <?php
                                            } else {
                                        ?>
                                        <input type="number" name="qty" min="1" value="<?php echo $display['cart_item_quantity']; ?>" onchange="updcart(<?php echo $display['cart_item_id']; ?>)" onkeyup="updcart(<?php echo $display['cart_item_id']; ?>)">
                                        <?php
                                            }
                                        ?>
                                    </form>
                                </td>
                                <td><?php echo $net_amount ?></td>
                                <td>
                                <?php
                                    echo "<a onClick=\"javascript: return confirm('Are You Sure...?');\" href='cart_item_delete_action.php?cart_item_id=".$display['cart_item_id']."'><button title='Remove Item'>X</button></a>"
                                ?>
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="amount" id="crt_table2">
                    <div class="title">
                        <h2>Price Details</h2>
                    </div>
                    <div class="total">
                        <span>Price (2 Items)</span>
                        <span><?php echo $total_amount; ?></span>
                    </div>
                    <?php
                        $discount = $total_amount/100*2;
                        $grand_total = $total_amount - $discount;
                    ?>
                    <div class="discount">
                        <span>Discount</span>
                        <span class="offer"><?php echo $discount; ?></span>
                    </div>
                    <div class="total">
                        <span>Total Amount</span>
                        <span><?php echo $grand_total ?></span>
                    </div>
                    <div class="message">
                        <span class="offer-message">You will save <?php echo $discount; ?> on this order.</span>
                    </div>
                    <div class="place-order">
                        <?php
                            echo "<a href='proceed_to_pay.php?cart_id=".$cart_id."'><button>Place Order</button></a>"
                        ?>
                    </div>
                </div>
            </div>