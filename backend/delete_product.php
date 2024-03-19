<?php 
session_start();
include("../connect.php");
if(isset($_GET["id"])){
$id = mysqli_real_escape_string($conn, $_GET["id"]);

$sql = "DELETE FROM Products WHERE ProductID = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt,"i", $id);
if(mysqli_stmt_execute($stmt)){
    echo "<script>alert('ลบรายการสินค้าสำเร็จ');</script>";
    echo "<script>window.location='list_product.php';</script>";
}else{
    die("ไม่สามารถลบข้อมูลได้ :" . mysqli_error($conn));
}
    exit();
}
header("Location: edit_admin.php");

?>