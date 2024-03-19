<?php 

include("head.php");

if(!empty($_SESSION['user_id'])){
    $memberid = $_SESSION['user_id'];
}else{
    $memberid = '';
}

$total_price = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้าสินค้า</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <?php include("banner.php"); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10 mt-2 border border-primary rounded">
                <div class="d-flex align-items-center mb-3 mt-3 justify-content-center"><h2>ตะกร้าสินค้า</h2><i class="fa-solid fa-cart-plus fa-3x" style="color:cornflowerblue"></i></div>

            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <th class="text-center">รูปสินค้า</th>
                    <th class="text-center">ชื่อสินค้า</th>
                    <th class="text-center">ราคาต่อชิ้น</th>
                    <th class="text-center">จำนวน</th>
                    <th class="text-center">ราคารวม</th>
                    <th class="text-center">ลบ</th>
                </tr>
                </tbody>
                <tbody>
                    <?php
                    $sql = "SELECT products.ProductName, products.Price, products.Image, shoppingcart.Quantity, shoppingcart.ProductID FROM shoppingcart 
                    INNER JOIN member ON ShoppingCart.MemberID = member.MemberID
                    INNER JOIN products ON ShoppingCart.ProductID = products.ProductID
                    WHERE shoppingcart.MemberID = ?";
            
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param( $stmt,"i", $memberid);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt,$productname,$price,$image,$quantity,$productid);   
                    
                    while(mysqli_stmt_fetch($stmt)){ 
                    $subtotal = $price * $quantity; // คำนวณราคารวมของแต่ละรายการ
                    $total_price += $subtotal; // เพิ่มราคารวมของรายการนั้นเข้ารวมกับราคารวมทั้งหมด
                        ?>
                    <tr>
                        <td valign="middle" class="text-center"><img src="img/Products/<?php echo $image ?>" width="100" height="100"></td>
                        <td valign="middle" class="text-center"><?php echo $productname ?></td>
                        <td valign="middle" class="text-center"><?php echo number_format($price,2); ?></td>
                        <td valign="middle" class="text-center">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="update_quantity_cart_reduce.php?quantity=<?php echo $quantity ?>&productid=<?php echo $productid ?>&memberid=<?php echo $memberid ?>"><b>-</b></a></li>
                            <li class="page-item"><a class="page-link" href=""><b><?php echo $quantity ?></b></a></li>
                            <li class="page-item"><a class="page-link" href="update_quantity_cart_plus.php?quantity=<?php echo $quantity ?>&productid=<?php echo $productid ?>&memberid=<?php echo $memberid ?>"><b>+</b></a></li>
                        </ul>

                        </td>
                        <td valign="middle" class="text-center"><?php echo number_format($subtotal,2); ?></td>
                        <td valign="middle" class="text-center"><a class="btn btn-danger" href="delete_cart.php?productid=<?php echo $productid ?>">ลบ</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tbody>
                <tr>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center" valign="middle">ราคารวมสุทธิ</td>
                    <td class="text-center" valign="middle"><?php echo number_format($total_price,2);; ?></td>
                    <td class="text-center" valign="middle"><a class="btn btn-warning" href="address.php">สั่งซื้อสินค้า</a></td>
                </tr>
                </tbody>
            </table>
                
            </div>
        </div>
    </div>
    
</body>
</html>