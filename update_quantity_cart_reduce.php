<?php 
include("head.php");

if(isset($_GET['quantity']) and isset($_GET['productid']) and isset($_GET['memberid'])){
    if($_GET['quantity'] > 1){
        $quantity = $_GET['quantity'] - 1;
        $productid = $_GET['productid'];
        $memberid = $_GET['memberid'];

        $sql = "UPDATE shoppingcart SET Quantity = ? WHERE MemberID = ? AND ProductID = ?";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"iii", $quantity,$memberid,$productid);
        mysqli_stmt_execute($stmt);
        header("Location: cart.php");
        exit();
    }else{
        header("Location: cart.php");
    }

}else{
    header('Location: cart.php');
}

?>