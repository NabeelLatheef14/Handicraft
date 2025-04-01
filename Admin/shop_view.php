<?php
    include("sidebar.php");
?>
<html>
    <head>
        <title>Place View</title>
        <link rel="stylesheet" href="district_view.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="content">
            <div class="table">
                <div class="table_header">
                    <p>Place Details</p>
                    <div>
                        <!-- <a href="place_registration.php"><button class="add_new">+ Add New</button></a> -->
                    </div>
                </div>
                <div class="table_section">
                    <table>
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Shop Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("config.php");
                                $s = 1;
                                $sql = mysqli_query($con,"SELECT * FROM tbl_shop s INNER JOIN tbl_place p ON p.place_id=s.shop_place INNER JOIN tbl_district d ON d.district_id=p.district_id WHERE s.shop_status='0'");
                                while($display = mysqli_fetch_array($sql)){
                                    echo "<tr>";
                                        echo"<td>".$s++."</td>";
                                        echo "<td>".$display["shop_name"]."</td>";
                                        echo "<td>".$display["shop_email"]."</td>";
                                        echo "<td>".$display["place_name"].", ".$display['district_name']."</td>";
                                        echo "<td>
                                            <a onClick=\"javascript: return confirm('Are You Sure...?');\" href='shop_delete_action.php?shop_id=".$display['shop_id']."'><button style='background-color: #f80000'><i class='fa-solid fa-trash'></i></button></a>
                                        </td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>