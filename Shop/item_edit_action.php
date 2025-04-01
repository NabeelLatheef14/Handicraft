<html>
    <head>
        <title>Item Edit Action</title>
    </head>

    <body>
        <?php
            session_start();
            include("config.php");
            if(isset($_POST["itemupdtbtn"]) && isset($_FILES["productimg"])){
                $shop_id= $_SESSION['shop_id'];
                $item_id =$_POST["item_id"];
                $item_name = $_POST["productname"];
                $item_des = $_POST["productdes"];
                $item_price = $_POST["productprice"];
                $item_stock = $_POST["productstock"];
                $item_cat = $_POST["catname"];

                // echo "<pre>";
                // print_r($_FILES['productimg']);
                // echo "</pre>";

                $img_name = $_FILES['productimg'] ['name'];
                $img_size = $_FILES['productimg']['size'];
                $tmp_name = $_FILES['productimg']['tmp_name'];
                $error = $_FILES['productimg']['error'];

                if($error === 0){
                    if($img_size > 125000){
                        echo "<script>alert('File size is too large...!!');</script>";
                    } else {
                        $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);

                        $allowed_exs =array("jpg","jpeg","png");

                        if(in_array($img_ex_lc,$allowed_exs)){
                            $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                            $img_upload_path = 'Uploads/'.$new_img_name;
                            move_uploaded_file($tmp_name,$img_upload_path);
                            $sql = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_item WHERE item_name='$item_name' AND category_id='$item_cat' AND shop_id='$shop_id' AND item_status='0'");
                            $display=mysqli_fetch_array($sql);

                            if($display['count'] > 0){
                                echo "<script>alert('Product Already Exist...!!');window.location='products_view.php'</script>";	
                            } else {
                                $sql=mysqli_query($con,"UPDATE tbl_item SET item_name='$item_name',item_description='$item_des',item_image='$new_img_name',item_price='$item_name',item_stock='$item_stock',category_id='$item_cat',shop_id='$shop_id' WHERE item_id='$item_id'");
                                echo "<script>alert('Product Updated Successfully');window.location='products_view.php'</script>";	
                            }
                        } else {
                            echo "<script>alert('Unsupported image type...!!');</script>";
                        }
                    }
                }
            }
        ?>
    </body>
</html>