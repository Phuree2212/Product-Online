<?php 
include("head.php");

if(isset($_GET['quantity']) and isset($_GET['productid']) and isset($_GET['memberid'])){
    $productid = $_GET['productid'];

    $sql_check = "SELECT Stock FROM products WHERE ProductID = ?";
    $stmt_check = mysqli_prepare($conn,$sql_check);
    mysqli_stmt_bind_param($stmt_check,"i", $productid);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_bind_result($stmt_check, $stock);
    mysqli_stmt_fetch($stmt_check);
    mysqli_stmt_close($stmt_check);

    if($_GET['quantity'] < $stock){
        $quantity = $_GET['quantity'] + 1;
        $memberid = $_GET['memberid'];

        $sql = "UPDATE shoppingcart SET Quantity = ? WHERE MemberID = ? AND ProductID = ?";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"iii", $quantity,$memberid,$productid);
        mysqli_stmt_execute($stmt);
        header("Location: cart.php");
        exit();
    }else{
        echo "<script>alert('สินค้าถึงจำนวนจำกัดแล้ว');</script>";
        echo "<script>window.location='cart.php';</script>";
    }

}else{
    header('Location: cart.php');
}

?>