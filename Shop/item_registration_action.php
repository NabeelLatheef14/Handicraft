<html>
    <head>
        <title>Item Registration Action</title>
    </head>

    <body>
        <?php
            session_start();
            include("config.php");
            if(isset($_POST["itemregbtn"]) && isset($_FILES["productimg"])){
                $shop_id= $_SESSION['shop_id'];
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
                            $sql = mysqli_query($con,"SELECT COUNT(*) as count FROM tbl_item WHERE item_name='$item_name' AND category_id='$item_cat' AND shop_id='$shop_id'");
                            $display=mysqli_fetch_array($sql);

                            if($display['count'] > 0){
                                echo "<script>alert('Product Already Exist...!!');window.location='index.php'</script>";	
                            } else {
                                $sql=mysqli_query($con,"INSERT INTO tbl_item(item_name, item_description, item_image, item_price, item_stock, category_id, shop_id) VALUES ('$item_name','$item_des','$new_img_name','$item_price','$item_stock','$item_cat','$shop_id')");
                                echo "<script>alert('Product Registered Successfully');window.location='index.php'</script>";	
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