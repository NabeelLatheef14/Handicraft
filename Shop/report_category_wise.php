<?php
session_start();
include("sidebar.php");
$Shop_id = $_SESSION['shop_id'];
$total = 0;
$_SESSION['category_id'] = 0;
?>

<html>

<head>
    <title>Report</title>
    <link rel="stylesheet" href="report_category_wise.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".category").change(function() {
                var category_id = $(this).val();
                $.ajax({
                    url: "get_category_report.php",
                    method: "POST",
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        $(".body").html(data);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="content">
        <div class="title">
            <h1>Category Wise Report</h1>
        </div>
        <div class="main">
            <div class="left">
                <div class="head">
                    <h1>Category Wise Bussiness</h1>
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
                            $sql = mysqli_query($con, "SELECT c.category_name,SUM(t.transaction_amount) as sum FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.transaction_status='1' AND t.wallet_id!='0' AND i.shop_id='$Shop_id' GROUP BY c.category_name
                                ");
                            while ($display = mysqli_fetch_array($sql)) {
                            ?>['<?php echo $display['category_name'] ?>', <?php echo $display['sum'] ?>],
                            <?php
                            }

                            ?>
                        ]);

                        var options = {
                            title: 'Category Wise Business'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                        chart.draw(data, options);
                    }
                </script>
                <div id="piechart" style="width: 450px; height: 450px;"></div>
            </div>
            <div class="right">
                <div class="head">
                    <h1>Report</h1>
                    <a href="category_report_export.php"><button>Export</button></a>
                </div>
                <div class="input">
                    <label for="">Select Category</label>
                    <select name="category" id="" class="category">
                        <option value="" selected disabled>--select--</option>
                        <?php
                        $sql1 = mysqli_query($con, "SELECT * FROM tbl_category");
                        while ($display1 = mysqli_fetch_array($sql1)) {
                        ?>
                            <option value="<?php echo $display1['category_id'] ?>"><?php echo $display1['category_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
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
                                    $sql2 = mysqli_query($con, "SELECT * FROM tbl_category c INNER JOIN tbl_item i ON i.category_id=c.category_id INNER JOIN tbl_cart_item ci ON ci.item_id=i.item_id INNER JOIN tbl_transaction t ON t.cart_item_id=ci.cart_item_id WHERE t.transaction_status='1' AND t.wallet_id!='0' AND i.shop_id='$Shop_id'");
                                    while ($display2 = mysqli_fetch_array($sql2)) {
                                        $total = $total + $display2['transaction_amount'];
                                    ?>
                                        <tr>
                                            <td style="width: 10%;text-align: center;"><?php echo $s++ ?></td>
                                            <td style="width: 20%;text-align: center;"><img src="Uploads/<?= $display2['item_image'] ?>" alt="No Image"></td>
                                            <td style="width: 20%;text-align: center;"><?php echo $display2['item_name'] ?></td>
                                            <td style="width: 30%;text-align: center;"><?php echo $display2['transaction_date'] ?></td>
                                            <td style="width: 20%;text-align: center;"><?php echo $display2['transaction_amount'] ?></td>
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
    </div>
</body>

</html>