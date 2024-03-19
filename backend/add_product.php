<?php 
session_start();
include("head_admin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มรายการสินค้า</title>
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
                <form method="POST" action="add_product_process.php" enctype="multipart/form-data">
                <div class="col-md-7 mx-auto">
                    <div class="mb-2">
                        <label class="label-control">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="productname" maxlength="30">
                    </div>
                    <div class="mb-2">
                        <label class="label-control">ประเภทสินค้า</label>
                        <select class="form-select" required name="type">
                            <option selected>เลือกประเภทสินค้า</option>
                            <?php
                            
                            $sql = "SELECT * FROM Type";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $typeid,$typename);
                            
                            
                            
                            while(mysqli_stmt_fetch($stmt)){ ?>
                            <option value="<?php echo $typeid ?>"><?php echo $typename ?></option>
                            <?php } ?>
                        </select>
                        </div>

                    <div class="mb-2">
                        <label class="label-control">คำอธิบายสินค้า</label>
                            <textarea height="200" class="form-control" name="description"></textarea>
                        </div>

                    <div class="mb-2">
                        <label class="label-control">ราคา</label>
                            <input type="number" class="form-control" name="price" maxlength="100">
                        </div>

                        <div class="mb-2">
                        <label class="label-control">จำนวนสตีอกสินค้า</label>
                            <input type="number" class="form-control" name="stock" maxlength="10">
                        </div>

                        <div class="mb-2">
                        <label class="password">รูปภาพสินค้า</label>
                            <input type="file" class="form-control" name="image" maxlength="100">
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