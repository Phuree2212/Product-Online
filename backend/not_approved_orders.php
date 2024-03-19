<?php 
session_start();
include("head_admin.php");

    if(isset($_GET["orderid"])){
        $order_id = $_GET["orderid"];
        $quantity = $_GET["quantity"];

        $sql = "UPDATE orders SET OrderStatus = 'ยกเลิก' WHERE OrderID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"i",$order_id);
        mysqli_stmt_execute($stmt);

        $sql2 = "SELECT ProductID,Quantity FROM orderdetails WHERE OrderID = ?";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2,"i",$order_id);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_bind_result($stmt2,$productid, $quantity);
        mysqli_stmt_store_result($stmt2);

        while(mysqli_stmt_fetch($stmt2)){
            $sql3 = "SELECT Stock FROM products WHERE ProductID = $productid";
            $stmt3 = mysqli_prepare($conn, $sql3);
            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3,$stock);
            mysqli_stmt_fetch($stmt3);

            $return = $stock + $quantity;

            mysqli_stmt_close($stmt3);

            $sql_insert = "UPDATE products SET Stock = $return WHERE ProductID = $productid";
            $stmt_insert = mysqli_prepare($conn,$sql_insert);
            mysqli_stmt_execute($stmt_insert);
        }

        echo "<script>alert('ยกเลิกคำสั่งซื้อสำเร็จ')</script>";
        echo "<script>window.location='check_orders.php';</script>";
    }else{
        header("Location: check_orders.php");
    }


?>