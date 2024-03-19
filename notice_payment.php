<?php
include("head.php");

if(!empty($_SESSION['user_id'])){
    $memberid = $_SESSION['user_id'];
}else{
    $memberid = "";
}

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
            <div class="d-flex align-items-center mb-3 mt-3 justify-content-center"><h2 class="me-2">แจ้งชำระเงิน</h2><i class="fa-solid fa-file-invoice fa-3x" style="color:cornflowerblue"></i></div>
                <table class="table text-center">
                    <thead>
                        <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">รหัสคำสั่งซื้อ</th>
                        <th scope="col">วันที่สั่งซือ</th>
                        <th scope="col">ยอดรวม</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                            $sql = "SELECT OrderID, OrderDate, TotalPrice, OrderStatus FROM orders WHERE MemberID = ? AND OrderStatus = 'รอดำเนินการชำระเงิน'";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt,"i", $memberid);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt,$order_id,$order_date,$total_price,$order_status);
                            $i = 1;
                                while(mysqli_stmt_fetch($stmt)){ 
                            ?>
                            <tr>
                        <th valign="middle"><?php echo $i ?></th>
                        <td valign="middle"><?php echo $order_id ?></td>
                        <td valign="middle"><?php echo $order_date ?></td>
                        <td valign="middle"><?php echo number_format($total_price,2) ?></td>
                        <td valign="middle"><div class="btn btn-<?= ($order_status == "รอดำเนินการชำระเงิน") ? "warning" : (($order_status == "รอดำเนินการตรวจสอบ") ? "info" : (($order_status == "ยกเลิก") ? "danger" : "success")) ?>"><?php echo $order_status ?></div></td>
                        <td valign="middle"><a href="detail_notice_payment.php?orderid=<?php echo $order_id ?>">รายละเอียดคำสั่งซื้อ</a></td>
                            </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>