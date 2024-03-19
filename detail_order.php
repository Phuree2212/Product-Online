<?php 
include("head.php");

if(isset($_SESSION['user_id'])){
    $memberid = $_SESSION['user_id'];
}else{
    header('Location: indexx.php');
}

if(!empty($_POST["firstname"]) and !empty($_POST['lastname']) and !empty($_POST['address']) and !empty($_POST['telephone'])){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $address = $_POST["address"];
    $telephone = $_POST["telephone"];
}else{
    $_SESSION['Fill_Address'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
    header("Location: address.php");
}
    $total_price = 0;

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
                <div class="d-flex align-items-center mb-3 mt-3"><h2>รายละเอียดการสั่งซื้อสินค้า</h2><i class="fa-solid fa-circle-info fa-3x" style="color:cornflowerblue"></i></div>
                <div class="col-md-11 mx-auto">
                    <form action="confirm_order.php" method="POST">
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
                            <tr>
                        <?php 
                            $sql = "SELECT products.ProductName, products.Price, products.Image, shoppingcart.Quantity, shoppingcart.ProductID FROM shoppingcart 
                            INNER JOIN member ON ShoppingCart.MemberID = member.MemberID
                            INNER JOIN products ON ShoppingCart.ProductID = products.ProductID
                            WHERE shoppingcart.MemberID = ?";


                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param( $stmt,"i", $memberid);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt,$productname,$price,$image,$quantity,$productid);
                            mysqli_stmt_store_result($stmt);
                            $num = mysqli_stmt_num_rows($stmt);
                            
                            while(mysqli_stmt_fetch($stmt)){
                                $sum_price = $price * $quantity;
                                $total_price += $sum_price;
                            ?>
                            <tr>
                                <th class="text-center"><img src="img/Products/<?php echo $image ?>" width="80" height="80"></th>
                                <th valign="middle" class="text-center"><?php echo $productname ?></th>
                                <th valign="middle" class="text-center"><?php echo $price ?></th>
                                <th valign="middle" class="text-center"><?php echo $quantity ?></th>
                                <th valign="middle" class="text-center"><?php echo $sum_price; ?></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">รวมราคาสุทธิ</td>
                                <td class="text-center"><?php echo $total_price ?></td>
                                <td class="text-center">บาท</td>
                            </tr>
                        </tbody>
                </table>
                <p>(รวมสินค้าทั้งหมดจำนวน <?php echo $num?> รายการ)</p>
                </div>
                <div class="d-flex align-items-center mb-3 mt-3"><h2>รายละเอียดที่อยู่</h2><i class="fa-solid fa-truck-fast fa-3x sm-2" style="color:cornflowerblue"></i></div>
                <div align="center" class="mb-2">
                <div class="col-md-7 mx-auto">
                <table align="center">
                        <tr height="45">
                            <td width="100" align="right">ชื่อ&nbsp;</td>
                            <td width="500"><input type="text" name="firstname" readonly class="form-control border border-dark" value="<?php echo $firstname ?>"></td>
                        </tr>
                        <tr height="55">
                            <td width="100" align="right">นามสกุล&nbsp;</td>
                            <td width="500"><input type="text" name="lastname" readonly class="form-control border border-dark" value="<?php echo $lastname ?>"></td>
                        </tr>
                        <tr height="55" align="right">
                            <td width="100" valign="top">ที่อยู่&nbsp;</td>
                            <td width="500"><textarea type="text" name="address" readonly class="form-control border border-dark"><?php echo $address ?></textarea></td>
                        </tr>
                        <tr height="55">
                            <td width="100" align="right">เบอร์โทรศัพท์&nbsp;</td>
                            <td width="500"><input type="text" name="telephone" readonly class="form-control border border-dark" value="<?php echo $telephone ?>"></td>
                        </tr>
                </table>
                <input type="hidden" name="totalprice" value="<?php echo $total_price ?>">
                       
                </div>
            </div>
            <div class="mb-2" align="center">
                            <input type="submit" name="submit" value="ยืนยันการสั่งซื้อสินค้า" class="btn btn-primary" onclick="return ConfirmOrder()">
                        </div>
                            </form>

            </div>
        </div>
    </div>
    <script>
        function ConfirmOrder(){
            if(confirm('คุณต้องการจะสั่งซื้อสินค้าใช่หรือไม่?')){
                return true;
            }
                return false;
        }
        </script>
    
</body>
</html>