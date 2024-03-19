<?php 
session_start();
include("../connect.php");
error_reporting(0);
ini_set('display_errors', 0);

if(isset($_POST["submit"])){
    $id = mysqli_real_escape_string($conn, $_POST["Pro_ID"]);
    $productname = mysqli_real_escape_string($conn, $_POST["productname"]);
    $typename = mysqli_real_escape_string($conn, $_POST["type"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $stock = mysqli_real_escape_string($conn, $_POST["stock"]);

    if(is_uploaded_file($_FILES['image_update']['tmp_name'])){
        $new_image_name = 'pro_'.uniqid().".".pathinfo(basename($_FILES['image_update']['name']),PATHINFO_EXTENSION);
        $image_upload_path = "./../img/Products/".$new_image_name;
        move_uploaded_file($_FILES['image_update']['tmp_name'],$image_upload_path);
            
        if(!empty($productname) and !empty($typename) and !empty($description) and !empty($price) and !empty($stock)){
            $sql_update = "UPDATE products SET productname = ?,typeid = ?,description = ?, price = ?, stock = ?,image = ? WHERE ProductID = ? ";
            $stmt_update = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt_update,"ssssssi", $productname, $typename, $description, $price, $stock,$new_image_name, $id);
                if(mysqli_stmt_execute($stmt_update)){
                    echo "<script>alert('อัพเดตข้อมูลสำเร็จ');</script>";
                    echo "<script>window.location='list_product.php';</script>";
                }else{
                    die("ไม่สามารถอัพเดตข้อมูลได้ :" . mysqli_error($conn));
                }
                    exit();
        }else{
            $_SESSION["FillInput"] = "กรุณากรอกข้อมูลให้ครบถ้วน";
            header("Location: edit_product.php?id=$id");
        }
    }else{
        $new_image_name = "";
        if(!empty($productname) and !empty($typename) and !empty($description) and !empty($price) and !empty($stock)){
            $sql_update = "UPDATE products SET productname = ?,typeid = ?,description = ?, price = ?, stock = ? WHERE ProductID = ? ";
            $stmt_update = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt_update,"sssssi", $productname, $typename, $description, $price, $stock, $id);
                if(mysqli_stmt_execute($stmt_update)){
                    echo "<script>alert('อัพเดตข้อมูลสำเร็จ');</script>";
                    echo "<script>window.location='list_product.php';</script>";
                }else{
                    die("ไม่สามารถอัพเดตข้อมูลได้ :" . mysqli_error($conn));
                }
                    exit();
        }else{
            $_SESSION["FillInput_image"] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        }
        
      }
}else{
    header("Location: list_admin.php");
}
mysqli_close($conn);
?>