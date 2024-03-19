<?php
include("head.php");

if(!empty($_SESSION['user_id'])){
    $memberid = $_SESSION['user_id'];
}else{
    $memberid = "";
}

if(isset($_GET["orderid"])){
    $order_id = $_GET["orderid"];
}else{
    header("Location: notice_payment.php");
}

$sql = "SELECT orders.OrderDate, orders.ShippingAddress, orders.TotalPrice, orders.OrderStatus FROM orders WHERE OrderID = ?";
$stmt = mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i", $order_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$order_date,$shippingaddress,$totalprice,$order_status);
mysqli_stmt_fetch($stmt);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
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
            <div class="d-flex align-items-center mb-3 mt-3 justify-content-center"><h2 class="me-2">รายละเอียดคำสั่งซื้อ</h2><i class="fa-solid fa-file-invoice fa-3x" style="color:cornflowerblue"></i></div>
            <div class="col-md-1 mx-auto text-center">
                <div class="mb-2">
                    <label class="label-control">รหัสคำสั่งซื้อ</label>
                    <div class="form-control w-10" type="text"><?php echo $order_id; ?></div>
                </div>
            </div>
            <div class="col-md-3 mx-auto text-center">
            <div class="mb-2">
                    <label class="label-control">วันที่สั่งซื้อ</label>
                    <div class="form-control w-10" type="text"><?php echo $order_date; ?></div>
                </div>
            </div>
            <table align="center" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">รูปภาพ</th>
                                <th class="text-center">ชื่อสินค้า</th>
                                <th class="text-center">ราคาต่อชิ้น</th>
                                <th class="text-center">สั่งซื้อจำนวน</th>
                                <th class="text-center">ราคารวม</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                
                                $sql_product = "SELECT products.image,  products.productname,  products.price,  orderdetails.quantity FROM orderdetails 
                                        INNER JOIN products ON orderdetails.ProductID = products.ProductID 
                                        WHERE orderdetails.OrderID = ?";
                                $stmt_product = mysqli_prepare($conn,$sql_product);
                                mysqli_stmt_bind_param($stmt_product,"i",$order_id);
                                mysqli_stmt_execute($stmt_product);
                                mysqli_stmt_bind_result($stmt_product,$image,$productname,$productprice,$quantity);
                                mysqli_stmt_store_result($stmt_product);
                                $num = mysqli_stmt_num_rows($stmt_product);
                                
                                while(mysqli_stmt_fetch($stmt_product)){
                                
                                $sumprice = $productprice * $quantity;
                                ?>
                            <tr>
                                <th class="text-center"><img src="img/Products/<?php echo $image ?>" width="80" height="80"></th>
                                <th valign="middle" class="text-center"><?php echo $productname ?></th>
                                <th valign="middle" class="text-center"><?php echo number_format($productprice,2) ?></th>
                                <th valign="middle" class="text-center"><?php echo $quantity ?></th>
                                <th valign="middle" class="text-center"><?php echo number_format($sumprice,2); ?></th>
                            </tr>
                            <?php } ?>
                           
                        </tbody>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">รวมราคาสุทธิ</td>
                                <td class="text-center"><?php echo number_format($totalprice,2); ?></td>
                                <td class="text-center">บาท</td>
                            </tr>
                        </tbody>
                </table>
                <p>(คำสั่งซื้อสินค้าทั้งหมดจำนวน <?php echo $num;?> ชิ้น)</p>
                <hr>
                
                <div class="row">
                <div class="col-md-6">
                <div class="d-flex align-items-center mb-3 mt-3"><h2>รายละเอียดที่อยู่</h2><i class="fa-solid fa-truck-fast fa-3x sm-2" style="color:cornflowerblue"></i></div>
    
                <table>
                        
                        <tr height="55" align="right">
                            <td width="100" valign="top">ที่อยู่&nbsp;</td>
                            <td width="500"><textarea type="text" name="address" rows="5" readonly class="form-control border border-dark"><?php echo $shippingaddress ?></textarea></td>
                        </tr>
                </table>
                       
                </div>
                <div class="col-md-6">
                <div class="d-flex align-items-center mb-3 mt-3"><h2>สถานะการชำระเงิน</h2><i class="fa-solid fa-money-bill fa-3x sm-2" style="color:cornflowerblue"></i></div>
                <form action="confirm_payment.php" method="post" enctype="multipart/form-data">
                <table>
                        <tr height="45">
                            <td width="100" align="right">สถานะ&nbsp;</td>
                            <td valign="middle"><div class="btn btn-<?= ($order_status == "รอดำเนินการชำระเงิน") ? "warning" : (($order_status == "รอดำเนินการตรวจสอบ") ? "info" : (($order_status == "ยกเลิก") ? "danger" : "success")) ?>"><?php echo $order_status ?></div></td>
                        </tr>
                        <tr height="55">
                            <td width="100" align="right">ช่องทางชำระเงิน&nbsp;</td>
                            <td width="500">
                                <?php 
                                require_once("lib/PromptPayQR.php");

                                $PromptPayQR = new PromptPayQR(); // new object
                                $PromptPayQR->size = 6; // Set QR code size to 8
                                $PromptPayQR->id = '0885786135'; // PromptPay ID
                                $PromptPayQR->amount = $totalprice; // Set amount (not necessary)
                                echo '<img src="' . $PromptPayQR->generate() . '" />';
                                
                                ?>
                                พร้อมเพย์ 088-5786135
                            </td>
                        </tr>
                        <tr height="55" align="right">
                            <td width="100" valign="top">ยอดที่ต้องชำระ&nbsp;</td>
                            <td width="500"><input type="text" name="totalprice" value="<?php echo number_format($totalprice); ?>" class="form-control border border-dark" readonly disabled></td>
                        </tr>
                        <tr height="55">
                            <td width="100" align="right">แนบหลักฐานชำระเงิน&nbsp;</td>
                            <?php 
                            
                            $sql_check = "SELECT ProofofPayment FROM payment WHERE OrderID = ?";
                            $stmt_check = mysqli_prepare($conn,$sql_check);
                            mysqli_stmt_bind_param($stmt_check,"i",$order_id);
                            mysqli_stmt_execute($stmt_check);
                            mysqli_stmt_bind_result($stmt_check,$proof_payment);
                            mysqli_stmt_fetch($stmt_check);
                            
                            if(!empty($proof_payment)){ ?>
                            
                            <td><a href="img/Payment/<?php echo $proof_payment ?>" target="_blank"><img src="img/Payment/<?php echo $proof_payment ?>" width="180" height="280" ></a></td>
                            
                            <?php }else{ ?>

                                <td width="500"><input type="file" name="payment" class="form-control border border-dark"></td>

                            <?php } ?>

                        </tr>
                </table>
                <input type="hidden" value="<?php echo $order_id ?>" name="orderid">
                <div class="mb-2 mt-2 text-center">
                    <input type="submit" value="ยืนยันการชำระเงิน" name="submit" class="btn btn-success">
                </div>
                </form>

                </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>