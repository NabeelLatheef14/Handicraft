<?php
    include("sidebar.php");
?>
<html>
    <head>
        <title>Complaint View</title>
        <link rel="stylesheet" href="complaint_view.css">
    </head>
    <body>
        <div class="content">
        <div class="table">
                <div class="table_header">
                    <p>Complaint Details</p>
                </div>
                <div class="table_section">
                    <table>
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Complainant Name</th>
                                <th>Complainant Type</th>
                                <th>Complaint</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("config.php");
                                $s = 1;
                                $sql = mysqli_query($con,"SELECT * FROM tbl_complaint c LEFT JOIN tbl_customer cu ON cu.customer_id=c.complainant_id LEFT JOIN tbl_shop s ON s.shop_id=c.complainant_id WHERE c.complaint_status='0' ORDER BY c.complaint_date ASC");
                                while($display = mysqli_fetch_array($sql)){
                                    echo "<tr>";
                                        echo"<td>".$s++."</td>";
                                        if($display['complainant_type'=='Customer']){
                                            echo "<td>".$display["customer_name"]."</td>";
                                            echo "<td>".$display["complainant_type"]."</td>";
                                        } elseif($display['complainant_type'=='Shop']){
                                            echo "<td>".$display["shop_name"]."</td>";
                                            echo "<td>".$display["complainant_type"]."</td>";
                                        }
                                        echo "<td>".$display["complaint"]."</td>";
                                        echo "<td>
                                            <a href='complaint_respond.php?comp_id=".$display['complaint_id']."'><button title='Respond'><i class='fa-solid fa-reply'></i></button></a>
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