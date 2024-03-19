<?php
session_start();
include("head.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ล็อคอิน</title>
</head>
<body>
    <div class="container">
        
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php include("banner.php"); ?>
        </div>
        </div>
        <div class="col-md-5 mx-auto">
            <div class="alert alert-success text-center mt-3"><h1>เข้าสู่ระบบ</h1></div>
            <form method="POST" action="login_process.php">

                <?php if(isset($_SESSION["EnterFill"])){ ?>
                <div class="text-center text-danger"><?php echo $_SESSION["EnterFill"]; ?></div>
                <?php  unset($_SESSION["EnterFill"]); } ?>

                <?php if(isset($_SESSION["username_incorrect"])){ ?>
                <div class="text-center text-danger"><?php echo $_SESSION["username_incorrect"]; ?></div>
                <?php  unset($_SESSION["username_incorrect"]); } ?>

                <div class="mb-2">
                    <label class="label-control">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" name="username" maxlength="30">
                </div>

                <?php if(isset($_SESSION["password_incorrect"])){ ?>
                <div class="text-center text-danger"><?php echo $_SESSION["password_incorrect"]; ?></div>
                <?php  unset($_SESSION["password_incorrect"]); } ?>
                
                <div class="mb-2">
                    <label class="label-control">รหัสผ่าน</label>
                    <input type="password" class="form-control" name="password" maxlength="100">
                </div>
                <div class="mb-2 text-center">
                    <input type="submit" class="btn btn-primary" name="submit" value="เข้าสู่ระบบ">
                    <input type="reset" class="btn btn-danger" value="ยกเลิก">
                </div>
            </form>
        </div>
    </div>
</body>
</html>