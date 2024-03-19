<?php 
session_start();
include("../connect.php");
if(isset($_GET["delete_img"])){

    $id = mysqli_real_escape_string($conn, $_GET["delete_img"]);

    $sql = "UPDATE products SET Image = NULL WHERE ProductID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt,"i", $id);
    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('ลบรูปภาพสำเร็จ');</script>";
        echo "<script>window.location='edit_product.php?id=$id';</script>";
    }else{
        die("ไม่สามารถลบรูปภาพได้ : ". mysqli_error($conn));
    }
    exit();
}
header("Location: list_product.php");

?>