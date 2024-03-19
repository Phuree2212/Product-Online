<?php
session_start();
include("head_admin.php");

$sql = "SELECT TypeID,TypeName FROM Type";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $typeid, $typename);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มผู้ดูแลระบบ</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php include("banner.php"); ?>
        </div>
        </div>
        <div class="row">
            <div class="col-md-10 mb-2 mx-auto">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-md-8">
                <div class="text-center mb-3"><h2>เพิ่มรายการสินค้า</h2></div>
                <form method="POST" action="add_admin_process.php">
                <div class="col-md-7 mx-auto">
                <div class="row">
                    <div class="mb-2">
                        <label class="label-control">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="productname" maxlength="30">
                    </div>
                    <div class="mb-2">
                        <label class="label-control">ประเภทสินค้า</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>เลือกประเภทสินค้า</option>
                            <?php while(mysqli_stmt_fetch($stmt)){ ?>
                            <option value="<?php echo $typeid ?>"><?php echo $typename ?></option>
                            <?php } ?>
                        </select>
                        </div>

                    <div class="mb-2">
                        <label class="label-control">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="telephone" maxlength="10">
                        </div>

                    <div class="mb-2">
                        <label class="label-control">อีเมลล์</label>
                            <input type="text" class="form-control" name="email" maxlength="100">
                        </div>

                        <div class="mb-2">
                        <label class="label-control">ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" name="username" maxlength="30">
                        </div>

                        <div class="mb-2">
                        <label class="password">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password" maxlength="100">
                        </div>

                        <div class="mb-2">
                        <label class="label-control">ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" name="password_confirm" maxlength="100">
                        </div>

                        <div class="mb-2 text-center">
                            <input type="submit" value="ยินยัน" class="btn btn-primary" name="submit">
                            <input type="reset" value="ยกเลิก" class="btn btn-danger">
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    
</body>
</html>