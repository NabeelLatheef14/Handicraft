<?php
    session_start();
    include("sidebar.php");
    $shop_id = $_SESSION['shop_id'];
?>
<html>
    <head>
        <title>Product View</title>
        <link rel="stylesheet" href="product_view.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="content">
            <div class="table">
                <div class="table_header">
                    <p>Product Details</p>
                    <div>
                        <a href="item_registration.php"><button class="add_new">+ Add New</button></a>
                    </div>
                </div>
                <div class="table_section">
                    <table>
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("config.php");
                                $s = 1;
                                $sql = mysqli_query($con,"SELECT * FROM tbl_item i INNER JOIN tbl_category c ON i.category_id=c.category_id WHERE i.item_status='0' AND i.shop_id='$shop_id'");
                                while($display = mysqli_fetch_array($sql)){
                                    echo "<tr>";
                                        echo"<td>".$s++."</td>";
                                        ?>
                                        <td><img src="Uploads/<?=$display['item_image']?>" alt="No Image" style="width: 100px; height:100px;"></td>
                                        <?php
                                        echo "<td>".$display["item_name"]."</td>";
                                        echo "<td>".$display["category_name"]."</td>";
                                        echo "<td>".$display["item_stock"]."</td>";
                                        echo "<td>
                                            <a href='item_edit.php?item_id=".$display['item_id']."'><button><i class='fa-solid fa-pen-to-square'></i></button></a>
                                            <a onClick=\"javascript: return confirm('Are You Sure...?');\" href='item_delete_action.php?item_id=".$display['item_id']."'><button style='background-color: #f80000'><i class='fa-solid fa-trash'></i></button></a>
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