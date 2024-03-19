<?php 
session_start();
include("head_admin.php");

if(isset($_POST["submit"])){
    if(isset($_POST["orderid"])){
        $order_id = $_POST["orderid"];
        $sql = "UPDATE orders SET OrderStatus = 'สินค้าอยู่ในระหว่างการจัดส่ง' WHERE OrderID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"i",$order_id);
        mysqli_stmt_execute($stmt);
    
        echo "<script>alert('อนุมัติคำสั่งซื้อสำเร็จ')</script>";
        echo "<script>window.location='check_orders.php';</script>";
    }else{
        header("Location: check_orders.php");
    }
}else{
    header("Location: check_orders.php");
}


?>