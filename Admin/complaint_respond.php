<?php
    include("sidebar.php");
?>
<html>
    <head>
        <title>Complaint Repond</title>
        <link rel="stylesheet" href="complaint_respond.css">
    </head>
    <body>
    <?php
    include("config.php");
        if(isset($_GET["comp_id"])){
            $comp_id = $_GET["comp_id"];
            $sql1 = mysqli_query($con,"SELECT * FROM tbl_complaint c LEFT JOIN tbl_customer cu ON cu.customer_id=c.complainant_id LEFT JOIN tbl_shop s ON s.shop_id=c.complainant_id WHERE c.complaint_id='$comp_id'");
            $display = mysqli_fetch_array($sql1);
        }
    ?>
        <div class="content">
            <div class="table">
                <div class="head">
                    <span>Complaint Details</span>
                </div>
                <div class="body">
                    <table border="1">
                        <tr>
                            <th>Complainant ID</th>
                            <td><?php if($display['complainant_type']=='Customer'){ echo str_pad($display['customer_id'], "8", "0", STR_PAD_LEFT);}elseif($display['complainant_type']=='Shop'){ echo str_pad($display['shop_id'], "8", "0", STR_PAD_LEFT);} ?></td>
                        </tr>
                        <tr>
                            <th>Complainant Name</th>
                            <td><?php if($display['complainant_type']=='Customer'){echo $display['customer_name'];}elseif($display['complainant_type']=='Shop'){echo $display['shop_name'];} ?></td>
                        </tr>
                        <tr>
                            <th>Complainant Type</th>
                            <td><?php echo $display['complainant_type'] ?></td>
                        </tr>
                        <tr>
                            <th>Complaint ID</th>
                            <td><?php echo str_pad($display['complaint_id'], "8", "0", STR_PAD_LEFT); ?></td>
                        </tr>
                        <tr>
                            <th>Complaint</th>
                            <td><?php echo $display['complaint'] ?></td>
                        </tr>
                        <form action="" method="POST">
                            <tr>
                                <th>Complaint Reply</th>
                                <td><textarea name="responce" id="" cols="30" rows="10" style="width: 890px; height: 156px;"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <center><button name="submit">SUBMIT</button></center>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
    if(isset($_POST["submit"])){
        $response = $_POST["responce"];
        $sql=mysqli_query($con,"UPDATE tbl_complaint SET complaint_response='$response', complaint_status='1' WHERE complaint_id='$comp_id'");
        echo "<script>alert('Response Recorded Successfully');window.location='complaint_view.php'</script>";	
    }
?>