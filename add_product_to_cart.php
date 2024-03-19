<?php

include("head.php");

if(!empty($_GET["productid"]) and !empty($_GET["quantity"])){
        $productid = $_GET["productid"];        
        $quantity = $_GET["quantity"];
    if($_GET["memberid"] != ""){
        $memberid = $_GET["memberid"];
        
        $sql_check = "SELECT * FROM shoppingcart WHERE MemberID = ? AND ProductID = ?";
        $stmt_check = mysqli_prepare($conn, $sql_check);
        mysqli_stmt_bind_param($stmt_check,"ii", $memberid,$productid);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_bind_result($stmt_check,$memberid_check,$product_check,$quantity_check);
        mysqli_stmt_store_result($stmt_check);
        mysqli_stmt_fetch($stmt_check);

        if(mysqli_stmt_num_rows($stmt_check) != 1){
        
        $sql = "INSERT INTO ShoppingCart (MemberID,ProductID,Quantity)
                VALUES (?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"iii", $memberid, $productid, $quantity);
        if(mysqli_stmt_execute($stmt)){
            echo "<script>alert('เพิ่มสินค้าลงตะกร้าสำเร็จ');</script>";
            echo "<script>window.location='cart.php?memberid=$memberid';</script>";
        }else{
            die("ไม่สามารถเพิ่มสินค้าลงตะกร้าได้ : ".mysqli_error($conn));
            }

        }else{
            $plus_quantity = $quantity_check + 1;
            $sql_update = "UPDATE shoppingcart SET Quantity = $plus_quantity WHERE MemberID = ? AND ProductID = ?";
            $stmt_update = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt_update,"ii",$memberid,$productid);
            mysqli_stmt_execute($stmt_update);
            header("Location: cart.php?memberid=".$memberid);
        }
    }else{
        echo "<script>alert('กรุณาล้อคอินเข้าสู่ระบบก่อน');</script>";
        echo "<script>window.location='product_detail.php?id=$productid';</script>";
    }
}else{
    header("Location: indexx.php");
}
?>