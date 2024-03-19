<?php 
session_start();
include("head_admin.php");

if(!empty($_GET['id'])){
$id = mysqli_real_escape_string($conn, $_GET["id"]);

$sql = "SELECT TypeName FROM type WHERE TypeID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt,"i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$typename);
mysqli_stmt_store_result($stmt);
mysqli_stmt_fetch($stmt);

    if(mysqli_stmt_num_rows($stmt) == 1){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขประเภทสินค้า</title>
</head>
<body>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-md-8">
                <div class="text-center"><h2>แก้ไขประเภทสินค้า</h2></div>
                <form method="POST" action="add_type_product_update.php">
                <div class="col-md-2 mx-auto">
                    <div class="mb-2 text-center">
                        <label class="label-control">รหัสประเภทสินค้า</label>
                        <input type="text" class="form-control" name="id_type" maxlength="30" value="<?php echo $id; ?>" readonly>
                    </div>
                </div>
                    <div class="col-md-7 mx-auto">

                    <?php if(isset($_SESSION['Fill'])){ ?>
                    <div class="text-center text-danger"><?php echo $_SESSION['Fill']; ?></div>
                    <?php unset($_SESSION['Fill']); } ?>

                    <?php if(isset($_SESSION['duplicate_type'])){ ?>
                    <div class="text-center text-danger"><?php echo $_SESSION['duplicate_type']; ?></div>
                    <?php unset($_SESSION['duplicate_type']); } ?>

                    <div class="mb-2">
                        <label class="label-control">ชื่อประเภทสินค้า</label>
                        <input type="text" class="form-control" name="name_type" maxlength="30" value="<?php echo $typename; ?>">
                    </div>
                    <div class="mb-2">
                        <input type="submit" name="submit" class="btn btn-primary" value="ยืนยัน">
                        <input type="reset" class="btn btn-danger" value="ยกเลิก">
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php }else{ ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขประเภทสินค้า</title>
</head>
<body>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-md-8">
                <div class="text-center"><h2>แก้ไขประเภทสินค้า</h2></div>
                <hr>
                <div class="text-center text-danger"><h1>ไม่พบรายการข้อมูลประเภทสินค้าที่ต้องการแก้ไข</h1></div>
                <hr>
            </div>
        </div>
    </div>
</body>
</html>

    <?php } ?>
<?php }else{ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขประเภทสินค้า</title>
</head>
<body>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-md-8">
                <div class="text-center"><h2>แก้ไขประเภทสินค้า</h2></div>
                <hr>
                <div class="text-center text-danger"><h1>ไม่พบรายการข้อมูลประเภทสินค้าที่ต้องการแก้ไข</h1></div>
                <hr>
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>