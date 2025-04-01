<?php
    session_start();
    include("config.php");
    $dfrom = $_SESSION['dfrom'];
    $dto = $_SESSION['dto'];
    $total = 0;
    if($dfrom == 0 || $dto == 0){
        $s = 1;
        $sql = "SELECT c.category_name,SUM(t.transaction_amount) as sum FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.transaction_status='1' AND t.wallet_id!='0' GROUP BY c.category_name";
        $res = mysqli_query($con,$sql);
        $html = '<table border="1"><tr><th style="background:darkblue;color:#fff;">Sl. no.</th><th style="background:darkblue;color:#fff;">Item Name</th style="background:darkblue;color:#fff;"><th style="background:darkblue;color:#fff;">Date of Purchase</th><th style="background:darkblue;color:#fff;">Income</th></tr>';
        while($row = mysqli_fetch_assoc($res)){
            $amount = $row['transaction_amount']/97*100;
            $total = $total + $amount;
            $html.='<tr><td>'.$s++.'</td><td>'.$row['item_name'].'</td><td>'.$row['transaction_date'].'</td><td>'.$amount.'</td></tr>';
        }
        $html.='<tr><th colspan="3" style="background:darkblue;color:#fff;">Total Income</th><th style="background:darkblue;color:#fff;">'.$total.'</th></tr></table>';
        header('Content-Type:applications/xls');
        header('Content-Disposition:attachment;filename=between_dates_report.xls');
        echo $html;
    } else {
        $s = 1;
        $sql = "SELECT * FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.transaction_status='1' AND t.wallet_id!='0' AND (t.transaction_date BETWEEN '$dfrom' AND '$dto')";
        $res = mysqli_query($con,$sql);
        $html = '<table border="1"><tr><th style="background:darkblue;color:#fff;">Sl. no.</th><th style="background:darkblue;color:#fff;">Item Name</th style="background:darkblue;color:#fff;"><th style="background:darkblue;color:#fff;">Date of Purchase</th><th style="background:darkblue;color:#fff;">Income</th></tr>';
        while($row = mysqli_fetch_assoc($res)){
            $amount = $row['transaction_amount']/97*100;
            $total = $total + $amount;
            $html.='<tr><td>'.$s++.'</td><td>'.$row['item_name'].'</td><td>'.$row['transaction_date'].'</td><td>'.$amount.'</td></tr>';
        }
        $html.='<tr><th colspan="3" style="background:darkblue;color:#fff;">Total Income</th><th style="background:darkblue;color:#fff;">'.$total.'</th></tr></table>';
        header('Content-Type:applications/xls');
        header('Content-Disposition:attachment;filename=between_dates_report.xls');
        echo $html;
    }
?>