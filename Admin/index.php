<?php
include("sidebar.php");
?>

<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="content">
        <h1>Quick View</h1>
        <section class="main-section">
            <div class="card">
                <div class="image">
                    <img src="Assets/Districts.jpg" alt="">
                </div>
                <div class="text">
                    <center>
                        <h2>14 Districts</h2>
                    </center>
                </div>
                <div class="button">
                    <center>
                        <a href="district_view.php"><button>View All</button></a>
                    </center>
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="Assets/Places.jpg" alt="">
                </div>
                <div class="text">
                    <center>
                        <h2>100 Places</h2>
                    </center>
                </div>
                <div class="button">
                    <center>
                       <a href="place_view.php"> <button>View All</button></a>
                    </center>
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="Assets/Shops.jpg" alt="">
                </div>
                <div class="text">
                    <center>
                        <h2>250 Shops</h2>
                    </center>
                </div>
                <div class="button">
                    <center>
                        <a href="shop_view.php"><button>View All</button></a>
                    </center>
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="Assets/Customer.jpg" alt="">
                </div>
                <div class="text">
                    <center>
                        <h2>1000 Customer</h2>
                    </center>
                </div>
                <div class="button">
                    <center>
                        <a href="customers_view.php"><button>View All</button></a>
                    </center>
                </div>
            </div>
        </section>
        <br>
        <table width="100%">
            <caption>System Admins</caption>
            <thead>
                <tr>
                    <th width="20%">Sl. No.</th>
                    <th width="40%">Name</th>
                    <th width="40%">Designation</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nabeel Latheef</td>
                    <td>Developer</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Yaseen Jeffer</td>
                    <td>Network Engineer</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Jemel Salby</td>
                    <td>Software Planning</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>