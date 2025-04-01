<?php
    session_start();
    $cus_id = $_SESSION['customer_id'];
    include("navigation.php");
?>
<html>
    <head>
        <title>Complaint View</title>
        <link rel="stylesheet" href="complaint_view.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="content">
            <div class="table">
                <div class="table_header">
                    <p>Complaint Details</p>
                    <div>
                        <a href="register_complaint.php"><button class="add_new">+ Add New</button></a>
                    </div>
                </div>
                <div class="table_section">
                    <table>
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Complaint</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action/Reply</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("config.php");
                                $s = 1;
                                $sql = mysqli_query($con,"SELECT * FROM tbl_complaint WHERE complainant_type='Customer' AND complainant_id='$cus_id' ORDER BY complaint_id DESC");
                                while($display = mysqli_fetch_array($sql)){
                                    echo "<tr>";
                                        echo"<td>".$s++."</td>";
                                        echo "<td>".$display["complaint"]."</td>";
                                        echo "<td>".$display["complaint_date"]."</td>";
                                        if($display["complaint_status"]==0){
                                            echo "<td>Not Solved</td>";
                                            echo "<td><a onClick=\"javascript: return confirm('Are You Sure...?');\" href='complaint_delete_action.php?comp_id=".$display['complaint_id']."'><button style='background-color: #f80000'><i class='fa-solid fa-trash'></i></button></a></td>";
                                        }
                                        if($display["complaint_status"]==1){
                                            echo "<td>Solved</td>";
                                            echo "<td>".$display["complaint_response"]."</td>";
                                        }
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