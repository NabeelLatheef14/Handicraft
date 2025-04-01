<?php
session_start();
include("sidebar.php");
$total = 0;
$_SESSION['dfrom'] = 0;
$_SESSION['dto'] = 0;
$today = date("Y-m-d");
$amount = 0;
?>

<html>

<head>
    <title>Report</title>
    <link rel="stylesheet" href="report_between_dates.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <div class="content">
        <div class="title">
            <h1>Between Dates Report</h1>
        </div>
        <form action="" method="POST">
            <div class="dates">
                <div>
                    <label for="">From :</label>
                    <input type="date" name="dfrom" min="2022-06-01" max='<?php echo $today ?>'>
                </div>
                <div>
                    <label for="">To :</label>
                    <input type="date" name="dto" min="2022-06-01" max='<?php echo $today ?>'>
                </div>
                <button name="getdata">GET</button>
            </div>
        </form>
        <?php
            if(!isset($_POST['getdata'])){
        ?>
        <div class="main">
            <div class="left">
                <div class="head">
                    <span>Bussiness</span>
                </div>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            <?php
                            include("config.php");
                            $sql = mysqli_query($con, "SELECT c.category_name,SUM(t.transaction_amount) as sum FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.transaction_status='1' AND t.wallet_id!='0' GROUP BY c.category_name
                                ");
                            while ($display = mysqli_fetch_array($sql)) {
                            ?>['<?php echo $display['category_name'] ?>', <?php echo $display['sum'] ?>],
                            <?php
                            }

                            ?>
                        ]);

                        var options = {
                            title: 'Business'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                        chart.draw(data, options);
                    }
                </script>
                <div id="piechart" style="width: 450px; height: 400px;"></div>
            </div>
            <div class="right">
                <div class="head">
                    <span>Report</span>
                    <a href="between_date_report_export.php"><button>Export</button></a>
                </div>
                <div class="table">
                    <div id="#div1">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Sl. no.</th>
                                    <th style="width: 20%;">Item Image</th>
                                    <th style="width: 20%;">Item Name</th>
                                    <th style="width: 30%;">Date of Purchase</th>
                                    <th style="width: 20%;">Income</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="body">
                        <div id="div2">
                            <table>
                                <tbody>
                                    <?php
                                    $s = 1;
                                    $sql2 = mysqli_query($con, "SELECT * FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.wallet_id!='0' ORDER BY t.transaction_date DESC");
                                    while ($display2 = mysqli_fetch_array($sql2)) {
                                        $amount = $display2['transaction_amount']/97*100;
                                        $total = $total + $amount;
                                    ?>
                                        <tr>
                                            <td style="width: 10%;text-align: center;"><?php echo $s++ ?></td>
                                            <td style="width: 20%;text-align: center;"><img src="/Handicraft/Shop/Uploads/<?= $display2['item_image'] ?>" alt="No Image"></td>
                                            <td style="width: 20%;text-align: center;"><?php echo $display2['item_name'] ?></td>
                                            <td style="width: 30%;text-align: center;"><?php echo $display2['transaction_date'] ?></td>
                                            <td style="width: 20%;text-align: center;"><?php echo $amount ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="#div3">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 80%;">Total</th>
                                        <th style="width: 20%;"><?php echo $total ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            } else {
                $dfrom = $_POST["dfrom"];
                $dto = $_POST["dto"];
                $_SESSION['dfrom'] = $dfrom;
                $_SESSION['dto'] = $dto;
        ?>
        <div class="main">
            <div class="left">
                <div class="head">
                    <span>Bussiness From <?php echo $dfrom." To ".$dto ?></span>
                </div>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            <?php
                            include("config.php");
                            $sql = mysqli_query($con, "SELECT i.item_name,SUM(t.transaction_amount) as sum FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.transaction_status='1' AND t.wallet_id!='0' AND (t.transaction_date BETWEEN '$dfrom' AND '$dto') GROUP BY i.item_name");
                            while ($display = mysqli_fetch_array($sql)) {
                            ?>['<?php echo $display['item_name'] ?>', <?php echo $display['sum'] ?>],
                            <?php
                            }

                            ?>
                        ]);

                        var options = {
                            title: 'Business'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                        chart.draw(data, options);
                    }
                </script>
                <div id="piechart" style="width: 450px; height: 450px;"></div>
            </div>
            <div class="right">
                <div class="head">
                    <span>Report From <?php echo $dfrom." To ".$dto ?></span>
                    <a href="between_date_report_export.php"><button>Export</button></a>
                </div>
                <div class="table">
                    <div id="#div1">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Sl. no.</th>
                                    <th style="width: 20%;">Item Image</th>
                                    <th style="width: 20%;">Item Name</th>
                                    <th style="width: 30%;">Date of Purchase</th>
                                    <th style="width: 20%;">Income</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="body">
                        <div id="div2">
                            <table>
                                <tbody>
                                    <?php
                                    $s = 1;
                                    $sql2 = mysqli_query($con, "SELECT * FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.transaction_status='1' AND t.wallet_id!='0' AND (t.transaction_date BETWEEN '$dfrom' AND '$dto')");
                                    while ($display2 = mysqli_fetch_array($sql2)) {
                                        $amount = $display2['transaction_amount']/97*100;
                                        $total = $total + $amount;
                                    ?>
                                        <tr>
                                            <td style="width: 10%;text-align: center;"><?php echo $s++ ?></td>
                                            <td style="width: 20%;text-align: center;"><img src="/Handicraft/Shop/Uploads/<?= $display2['item_image'] ?>" alt="No Image"></td>
                                            <td style="width: 20%;text-align: center;"><?php echo $display2['item_name'] ?></td>
                                            <td style="width: 30%;text-align: center;"><?php echo $display2['transaction_date'] ?></td>
                                            <td style="width: 20%;text-align: center;"><?php echo $amount ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="#div3">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 80%;">Total</th>
                                        <th style="width: 20%;"><?php echo $total ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</body>

</html>