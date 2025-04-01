<?php
    include("sidebar.php");
?>
<html>
    <head>
        <title>Category View</title>
        <link rel="stylesheet" href="district_view.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="content">
            <div class="table">
                <div class="table_header">
                    <p>Category Details</p>
                    <div>
                        <a href="category_registration.php"><button class="add_new">+ Add New</button></a>
                    </div>
                </div>
                <div class="table_section">
                    <table>
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Category Name</th>
                                <th>Category Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("config.php");
                                $s = 1;
                                $sql = mysqli_query($con,"SELECT * FROM tbl_category WHERE category_status='0'");
                                while($display = mysqli_fetch_array($sql)){
                                    echo "<tr>";
                                        echo"<td>".$s++."</td>";
                                        echo "<td>".$display["category_name"]."</td>";
                                        echo "<td>".$display["category_description"]."</td>";
                                        echo "<td>
                                            <a href='category_edit.php?cat_id=".$display['category_id']."'><button><i class='fa-solid fa-pen-to-square'></i></button></a>
                                            <a onClick=\"javascript: return confirm('Are You Sure...?');\" href='category_delete_action.php?cat_id=".$display['category_id']."'><button style='background-color: #f80000'><i class='fa-solid fa-trash'></i></button></a>
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