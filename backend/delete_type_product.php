<?php 
session_start();
include("head_admin.php");
if(isset($_GET["id"])){
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    $sql_check = "SELECT * FROM products WHERE TypeID = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check,"i", $id);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if(mysqli_stmt_num_rows($stmt_check) == 0){
        $sql = "DELETE FROM type WHERE TypeID = ?";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"i", $id);
        if(mysqli_stmt_execute($stmt)){
            echo "<script>alert('ลบข้อมูลสำเร็จ')</script>";
            echo "<script>window.location='list_type_product.php'</script>";
        }else{
            die('ไม่สามารถลบข้อมูลได้ :'. mysqli_error($conn));
        }
    }else{
        echo "<script>alert('ไม่สามารถลบประเภทสินค้านี้ได้เนื่องจากมีสินค้าที่อ้างอิงอยู่');</script>";
        echo "<script>window.location='list_type_product.php'</script>"; 
    }
}
header("list_type_product.php");
?>