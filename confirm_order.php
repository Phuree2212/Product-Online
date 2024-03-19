<?php 
include("head.php");
if(isset($_SESSION['user_id'])){
    $memberid = $_SESSION['user_id'];
}else{
    header("Location: indexx.php"); 
}

if(isset($_POST["submit"])){
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Y-m-d H:i:s");

    $total_price = $_POST['totalprice'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];

    $shippingaddress= $firstname." ".$lastname." ".$address." "."เบอร์โทรติดต่อ :".$telephone; 

    $order_status = "รอดำเนินการชำระเงิน"; 

    $sql = "INSERT INTO orders (MemberID,OrderDate,ShippingAddress,TotalPrice,OrderStatus) 
            VALUES (?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt,"issis",$memberid,$date,$shippingaddress,$total_price,$order_status);
    mysqli_stmt_execute($stmt);

    $order_id = mysqli_insert_id($conn);

    $sql_detail = "SELECT shoppingcart.productid, shoppingcart.quantity, products.price FROM shoppingcart
                  INNER JOIN products ON shoppingcart.productid = products.productid
                  WHERE MemberID = ?";
    $stmt_detail = mysqli_prepare($conn,$sql_detail); 
    mysqli_stmt_bind_param($stmt_detail,"i",$memberid);
    mysqli_stmt_execute($stmt_detail);
    mysqli_stmt_bind_result($stmt_detail,$productid,$quantity,$price);
    mysqli_stmt_store_result($stmt_detail);

    while(mysqli_stmt_fetch($stmt_detail)){
        $sum = $quantity*$price;
        $sql_insert = "INSERT INTO orderdetails (OrderID,ProductID,Quantity,PriceSum) 
                        VALUES (?,?,?,?)";
        $stmt_insert = mysqli_prepare($conn, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert,"iiii",$order_id,$productid,$quantity,$sum);
        mysqli_stmt_execute($stmt_insert);

        mysqli_stmt_close($stmt_insert);

        $sql_stock = "SELECT Stock FROM products WHERE ProductID = ?";
        $stmt_stock = mysqli_prepare($conn,$sql_stock);
        mysqli_stmt_bind_param($stmt_stock,"i",$productid);
        mysqli_stmt_execute($stmt_stock);
        mysqli_stmt_bind_result($stmt_stock,$quantity_stock);
        mysqli_stmt_fetch($stmt_stock);

        mysqli_stmt_close($stmt_stock);

        $cal = $quantity_stock - $quantity;

        $sql_update = "UPDATE products SET Stock = ? WHERE productid = ?";
        $stmt_update = mysqli_prepare($conn,$sql_update);
        mysqli_stmt_bind_param($stmt_update,"ii",$cal,$productid);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);

        $sql_clear = "DELETE FROM shoppingcart WHERE memberid = ? AND productid = ?";
        $stmt_clear = mysqli_prepare($conn,$sql_clear);
        mysqli_stmt_bind_param($stmt_clear,"ii",$memberid,$productid);
        mysqli_stmt_execute($stmt_clear);
    }
        echo "<script>alert('สั่งซื้อสินค้าสำเร็จ!');</script>";
        echo "<script>window.location='indexx.php';</script>";
        exit();
}else{
    header("Location: indexx.php");
}

?>