<?php
    include("sidebar.php");
?>
<html>
    <head>
        <title>District View</title>
        <link rel="stylesheet" href="district_view.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="content">
            <div class="table">
                <div class="table_header">
                    <p>District Details</p>
                    <div>
                        <a href="district_registration.php"><button class="add_new">+ Add New</button></a>
                    </div>
                </div>
                <div class="table_section">
                    <table>
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>District Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("config.php");
                                $s = 1;
                                $sql = mysqli_query($con,"SELECT * FROM tbl_district WHERE district_status='0'");
                                while($display = mysqli_fetch_array($sql)){
                                    echo "<tr>";
                                        echo"<td>".$s++."</td>";
                                        echo "<td>".$display["district_name"]."</td>";
                                        echo "<td>
                                            <a href='district_edit.php?dist_id=".$display['district_id']."'><button><i class='fa-solid fa-pen-to-square'></i></button></a>
                                            <a onClick=\"javascript: return confirm('Are You Sure...?');\" href='district_delete_action.php?dist_id=".$display['district_id']."'><button style='background-color: #f80000'><i class='fa-solid fa-trash'></i></button></a>
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