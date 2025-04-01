<?php
    session_start();
    include("sidebar.php");
    $wallet_id = $_SESSION['shop_id'];
?>

<html>
    <head>
        <title>Widthraw Funds</title>
        <link rel="stylesheet" href="widthraw_fund.css">
    </head>
    <body>
        <?php
            if(isset($_GET['balance'])){
                $balance = $_GET['balance'];
            }
        ?>
        <div class="content">
            <div class="form">
                <div class="title">
                    <h1>Widthraw Funds</h1>
                </div>
                <form action="" method="POST">
                    <div class="input">
                        <label for="accno">Account Number</label>
                        <input type="text" pattern="[0-9]{16}" title="Enter a valid account number" required>
                    </div>
                    <div class="input">
                        <label for="name">Account Holder Name</label>
                        <input type="text" pattern="^[A-Za-z]{3-20}$" title="Enter a valid name" required>
                    </div>
                    <div class="input">
                        <label for="ifsc">IFSC Code</label>
                        <input type="text" pattern="^[A-Z]{4}0[A-Z0-9]{6}$" title="Enter a valid IFSC Code" required>
                    </div>
                    <div class="input">
                        <label for="amount">Amount</label>
                        <input type="number" name ="amount" min="100" max="<?php echo floor($balance); ?>" required>
                    </div>
                    <div class="input">
                        <center><button name="widthraw">Widthraw</button></center>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
    include("config.php");
    if(isset($_POST['widthraw'])){
        $amount = $_POST['amount'];
        $date = date("d-m-Y h:i a");
        $sql2=mysqli_query($con,"INSERT INTO tbl_transaction(transaction_date, transaction_type, transaction_amount, wallet_id, transaction_status) VALUES ('$date','Debit','$amount','$wallet_id','1')");
        echo "<script>alert('Amount Widthrawal Successful');window.location='wallet.php'</script>";	
    }
?>