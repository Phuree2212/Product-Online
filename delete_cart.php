<?php 
include("head.php");

if(isset($_SESSION['user_id'])){
    $memberid = $_SESSION['user_id'];
}else{
    header('Location: indexx.php');
}

if(isset($_GET['productid'])){
    $productid = $_GET['productid'];
    $sql = "DELETE FROM shoppingcart WHERE MemberID = ? AND ProductID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt,"ii", $memberid,$productid);
    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('ลบสินค้าในตะกร้าสำเร็จ');</script>";
        echo "<script>window.location='cart.php';</script>";
    }else{
        die("เกิดข้อผิดพลาดไม่สามารถลบสินค้าในตะกร้าได้ :" . mysqli_error($conn));
    }
}else{
    header('Location: cart.php');
}
?>