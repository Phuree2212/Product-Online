<?php
session_start();
include("head_admin.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มประเภทสินค้า</title>
</head>
<body>
<div class="row">
        <div class="col-md-10 mx-auto">
            <?php include("banner.php"); ?>
        </div>
        </div>
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
                <div class="text-center"><h2>เพิ่มประเภทสินค้า</h2></div>
                <form method="POST" action="add_type_product_process.php">
                    <div class="col-md-7 mx-auto">
                        
                    <?php if(isset($_SESSION['duplicate'])){ ?>
                    <div class="text-center text-danger"><?php echo $_SESSION['duplicate']; ?></div>
                    <?php unset($_SESSION['duplicate']); } ?>

                    <div class="mb-2">
                        <label class="label-control">ชื่อประเภทสินค้า</label>
                        <input type="text" class="form-control" name="name_type" maxlength="30">
                    </div>
                    <div class="mv-2">
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