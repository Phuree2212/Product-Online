<?php 

session_start();
include("head_admin.php");

if(!empty($_GET["orderid"])){
    $order_id = $_GET['orderid'];

    $sql_check = "SELECT OrderStatus FROM orders WHERE OrderID = ? AND OrderStatus = 'สินค้าอยู่ในระหว่างการจัดส่ง'";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check,"i",$order_id);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if(mysqli_stmt_num_rows($stmt_check) == 1){

    $status = "ลูกค้ารับสินค้าแล้ว";
    echo $order_id;

    $sql = "UPDATE orders SET OrderStatus = '$status' WHERE OrderID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt,"i", $order_id);
    mysqli_stmt_execute($stmt);
    echo "<script>alert('อัพเดตสถานะคำสั่งซื้อสำเร็จ');</script>";
    echo "<script>window.location='check_orders.php';</script>";
    }else{
        header("Location: check_orders.php");
    }
}else{
    header("Location: check_orders.php");
}

?>