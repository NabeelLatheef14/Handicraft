<?php
    session_start();
    include("navigation.php");
    $cus_id = $_SESSION["customer_id"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>payment</title>
    <link rel="stylesheet" type="text/css" href="payment.css">
</head>

<body>
    <?php
        include("config.php");
        $sql = mysqli_query($con,"SELECT * FROM tbl_customer c INNER JOIN tbl_place p ON p.place_id=c.customer_place INNER JOIN tbl_district d ON d.district_id=p.district_id WHERE customer_id='$cus_id'");
        $display = mysqli_fetch_array($sql);
    ?>
    <header>
        <div class="container">
            <div class="left">
                <h3>BILLING ADDRESS</h3>
                <form>
                    Full name
                    <input type="text" name="" placeholder="Enter name" value="<?php echo $display['customer_name'] ?>" disabled>
                    Email
                    <input type="text" name="" placeholder="Enter email" value="<?php echo $display['customer_email'] ?>" disabled>
                    City
                    <input type="text" name="" placeholder="Enter City" value="<?php echo $display['place_name'] ?>" disabled>
                    District
                    <input type="text" name="" placeholder="Enter City" value="<?php echo $display['district_name'] ?>" disabled>
                    <div id="zip">
                        <label>
                            State
                            <select disabled>
                                <option value="" selected disabled>Kerala</option>
                            </select>
                        </label>
                        <label>
                            Zip code
                            <input type="number" name="" placeholder="Zip code" value="685582" disabled>
                        </label>
                    </div>
                </form>
            </div>
            <div class="right">
                <h3>PAYMENT</h3>
                <form action="payment_action.php" method="POST">
                    Accepted Card <br>
                    <img src="Assets/card1.png" width="100">
                    <img src="Assets/card2.png" width="50">
                    <br><br>

                    Credit card number
                    <input type="text" name="" placeholder="Enter card number"  pattern="[0-9]{12}" required>

                    Exp month
                    <input class="num" type="number" name="" placeholder="Enter Month" min="1" max="12" required>
                    <div id="zip">
                        <label>
                            Exp year
                            <select required>
                                <option value="" selected disabled>Choose Year..</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </label>
                        <label>
                            CVV
                            <input type="number" name="" placeholder="CVV" pattern="{3}" required>
                        </label>
                    </div>
                    <input type="submit" name="paynow" value="Proceed to Checkout">
                </form>
            </div>
        </div>
    </header>
</body>

</html>