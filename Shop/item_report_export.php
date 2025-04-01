<?php
    session_start();
    include("config.php");
    $item_id = $_SESSION['item_id'];
    $Shop_id = $_SESSION['shop_id'];
    $total = 0;
    if($item_id == 0){
        $s = 1;
        $sql = "SELECT * FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.transaction_status='1' AND t.wallet_id!='0' AND i.shop_id='$Shop_id'";
        $res = mysqli_query($con,$sql);
        $html = '<table border="1"><tr><th style="background:darkblue;color:#fff;">Sl. no.</th><th style="background:darkblue;color:#fff;">Item Name</th style="background:darkblue;color:#fff;"><th style="background:darkblue;color:#fff;">Date of Purchase</th><th style="background:darkblue;color:#fff;">Purchased Quantity</th><th style="background:darkblue;color:#fff;">Income</th></tr>';
        while($row = mysqli_fetch_assoc($res)){
            $total = $total + $row['transaction_amount'];
            $html.='<tr><td>'.$s++.'</td><td>'.$row['item_name'].'</td><td>'.$row['transaction_date'].'</td><td>'.$row['cart_item_quantity'].'</td><td>'.$row['transaction_amount'].'</td></tr>';
        }
        $html.='<tr><th colspan="4" style="background:darkblue;color:#fff;">Total Income</th><th style="background:darkblue;color:#fff;">'.$total.'</th></tr></table>';
        header('Content-Type:applications/xls');
        header('Content-Disposition:attachment;filename=item_report.xls');
        echo $html;
    } else {
        $s = 1;
        $sql = "SELECT * FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.transaction_status='1' AND t.wallet_id!='0' AND i.shop_id='$Shop_id' AND i.item_id='$item_id'";
        $res = mysqli_query($con,$sql);
        $html = '<table border="1"><tr><th style="background:darkblue;color:#fff;">Sl. no.</th><th style="background:darkblue;color:#fff;">Item Name</th style="background:darkblue;color:#fff;"><th style="background:darkblue;color:#fff;">Date of Purchase</th><th style="background:darkblue;color:#fff;">Purchased Quantity</th><th style="background:darkblue;color:#fff;">Income</th></tr>';
        while($row = mysqli_fetch_assoc($res)){
            $total = $total + $row['transaction_amount'];
            $html.='<tr><td>'.$s++.'</td><td>'.$row['item_name'].'</td><td>'.$row['transaction_date'].'</td><td>'.$row['cart_item_quantity'].'</td><td>'.$row['transaction_amount'].'</td></tr>';
        }
        $html.='<tr><th colspan="4" style="background:darkblue;color:#fff;">Total Income</th><th style="background:darkblue;color:#fff;">'.$total.'</th></tr></table>';
        header('Content-Type:applications/xls');
        header('Content-Disposition:attachment;filename=item_report.xls');
        echo $html;
    }
?>