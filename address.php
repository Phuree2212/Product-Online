<?php 
include("head.php");

if(isset($_SESSION["user_id"])){
    $memberid = $_SESSION["user_id"] ;
}else{
    header("indexx.php");
}

$sql = "SELECT * FROM shoppingcart WHERE MemberID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param( $stmt,"i", $memberid);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if(mysqli_stmt_num_rows($stmt) < 1){
    echo "<script>alert('กรุณาเพิ่มสินค้าลงตะกร้าก่อนจึงจะสามารถสั่งซื้อสินค้าได้!');</script>";
    echo "<script>window.location='cart.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
                <div class="col-md-10 mx-auto">
            <?php include("banner.php") ?>
                </div>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <?php include("navbar.php") ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10 border border-primary rounded mt-2">
                <div class="d-flex align-items-center mb-3 mt-3"><h2>ที่อยู่จัดส่ง</h2><i class="fa-solid fa-truck-fast fa-3x" style="color:cornflowerblue"></i></div>
                <div class="col-md-7 mx-auto">
                    <?php if(isset($_SESSION['Fill_Address'])){ ?>
                    <div class="text-center text-danger"><?php echo $_SESSION['Fill_Address']; ?></div>
                    <?php unset($_SESSION['Fill_Address']); } ?>
                    <form action="detail_order.php" method="POST">
                <table align="center">
                        <tr height="45">
                            <td width="100" align="right">ชื่อ&nbsp;</td>
                            <td width="500"><input type="text" name="firstname" class="form-control border border-dark" maxlength="100" ></td>
                        </tr>
                        <tr height="55">
                            <td width="100" align="right">นามสกุล&nbsp;</td>
                            <td width="500"><input type="text" name="lastname" class="form-control border border-dark" maxlength="100" ></td>
                        </tr>
                        <tr height="55" align="right">
                            <td width="100" valign="top">ที่อยู่&nbsp;</td>
                            <td width="500"><textarea type="text" name="address" class="form-control border border-dark" maxlength="100" placeholder="กรุณากรอกชื่อที่อยู่ให้ถูกต้อง เพื่อความถูกต้องในการส่งสินค้า" ></textarea></td>
                        </tr>
                        <tr height="55">
                            <td width="100" align="right">เบอร์โทรศัพท์&nbsp;</td>
                            <td width="500"><input type="text" name="telephone" class="form-control border border-dark" maxlength="10" ></td>
                        </tr>
                </table>
                        <div align="center" class="mb-2">
                            <input type="submit" name="submit" value="ยืนยัน" class="btn btn-success">
                            <input type="reset" name="reset" value="ยกเลิก" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>

            </div>
        </div>
    </div>
    
</body>
</html>