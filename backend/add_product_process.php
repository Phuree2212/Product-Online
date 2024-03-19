<?php 
session_start();
include("../connect.php");

if(isset($_POST["submit"])){
    $productname = mysqli_real_escape_string($conn, $_POST["productname"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $stock = mysqli_real_escape_string($conn, $_POST["stock"]);

    if(is_uploaded_file($_FILES['image']['tmp_name'])){
        $new_image_name = 'pro_'.uniqid().".".pathinfo(basename($_FILES['image']['name']),PATHINFO_EXTENSION);
        $image_upload_path = "./../img/Products/".$new_image_name;
        move_uploaded_file($_FILES['image']['tmp_name'],$image_upload_path);
      }else{
        $new_image_name = "";
      }      

    if(!empty($productname) and !empty($type) and !empty($description) and !empty($price) and !empty($stock)){

                $sql = "INSERT INTO products (ProductName,TypeID,Description,Price,Stock,Image) VALUES
                                (?,?,?,?,?,?)";
                $stmt = mysqli_prepare($conn,$sql);
                mysqli_stmt_bind_param($stmt,"ssssss", $productname, $type, $description, $price, $stock, $new_image_name);
                if(mysqli_stmt_execute($stmt)){
                    echo "<script>alert('เพิ่มข้อมูลสินค้าสำเร็จ');</script>";
                    echo "<script>window.location='list_product.php';</script>";
                }else{
                    die("ไม่สามารถเพิ่มข้อมูลได้ :". mysqli_error($conn));
                }
                exit();
            
    }else{
        $_SESSION['empty'] = 'กรุณากรอกข้อมูลให้ครบ';
    }
}
   header("Location: add_product.php");
   mysqli_close($conn);
?>