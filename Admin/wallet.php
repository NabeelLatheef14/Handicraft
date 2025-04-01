<?php
    session_start();
    include("sidebar.php");
    $balance = 0;
?>

<html>
    <head>
        <title>Wallet</title>
        <link rel="stylesheet" href="wallet.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="content">
            <div class="cards">
                <div class="transactions">
                    <div class="heading">
                        <h1>Transactions</h1>
                    </div>
                    <div class="details">
                        <?php
                            include("config.php");
                            $sql = mysqli_query($con,"SELECT * FROM tbl_transaction t LEFT JOIN tbl_cart_item ci ON ci.cart_item_id=t.cart_item_id LEFT JOIN tbl_item i ON i.item_id=ci.item_id LEFT JOIN tbl_shop s ON s.shop_id=i.shop_id WHERE t.wallet_id='0' ORDER BY t.transaction_id DESC");
                            while($display = mysqli_fetch_array($sql)){
                                if($display['transaction_type']==='Credit'){
                                    $balance = $balance + $display['transaction_amount'];
                        ?>
                        <div class="credit">
                            <span>+₹<?php echo $display['transaction_amount']; ?></span>
                            <p>Credited amount by selling <?php echo $display['item_name'] ?> by <?php echo $display['shop_name'] ?> on <?php echo $display['transaction_date'] ?></p>
                        </div>
                        <?php
                                } elseif ($display['transaction_type']==='Debit'){
                                    $balance = $balance - $display['transaction_amount'];
                        ?>
                        <div class="debit">
                            <span>-₹<?php echo $display['transaction_amount']; ?></span>
                            <p>Amount withdrawal at <?php echo $display['transaction_date'] ?></p>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="wallet">
                    <div class="heading">
                        <h1>My Wallet</h1>
                    </div>
                    <div class="balance">
                        <span class="icon"><i class="fa-solid fa-wallet"></i></span>
                        <span class="amount"><span class="rupe">₹</span><?php echo $balance ?></span>
                    </div>
                    <div class="button">
                        <center><?php echo "<a href='widthraw_fund.php?balance=".$balance."'><button class='btn custom-button'><span>WITHDRAW </span></button></a>" ?></center>
                    </div>
                    <div class="info">
                        <p class="alert">****This system uses fast cash transferring technology.  Therefore, your withdrawal will be completed very quickly. Contact your bank for more information.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>