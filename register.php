<?php 
include("head.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>สมัครสมาชิก</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php include("banner.php"); ?>
        </div>
        </div>
        <div class="col-md-5 mx-auto">
            <div class="alert alert-dark mt-2 text-center"><h1>สมัครสมาชิก</h1></div>
        
        <form method="POST" action="register_process.php">
            <div class="row">
                

                    <?php if(isset($_SESSION["empty"])){ ?>
                    <div class="text-center text-danger"><?php echo $_SESSION["empty"]; ?></div>
                    <?php unset($_SESSION["empty"]); }?>
                    
                    <?php if(isset($_SESSION["repeat"])){ ?>
                    <div class="text-center text-danger"><?php echo $_SESSION["repeat"]; ?></div>
                    <?php unset($_SESSION["repeat"]); }?>

                    <?php if(isset($_SESSION["password"])){ ?>
                    <div class="text-center text-danger"><?php echo $_SESSION["password"]; ?></div>
                    <?php unset($_SESSION["password"]); }?>

                    <div class="col mb-2">
                        <label class="label-control">ชื่อ</label>
                        <input type="text" name="firstname" class="form-control" maxlength="30">
                    </div>
                    <div class="col">
                        <label class="label-control">นามสกุล</label>
                        <input type="text" name="lastname" class="form-control" maxlength="30">
                    </div>
                    <div class="mb-2">
                        <label>เบอร์โทรศัพท์</label>
                        <input type="text" name="telephone" class="form-control" maxlength="10">
                    </div>
                    <div class="mb-2">
                        <label>อีเมลล์</label>
                        <input type="email" name="email" class="form-control" maxlength="50">
                    </div>
                    <div class="mb-2">
                        <label>ชื่อผู้ใช้</label>
                        <input type="text" name="username" class="form-control" maxlength="30">
                    </div>
                    <div class="mb-2">
                        <label>รหัสผ่าน</label>
                        <input type="password" name="password" class="form-control" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label>ยืนยันรหัสผ่าน</label>
                        <input type="password" name="password_confirm" class="form-control" maxlength="100">
                    </div>
                    <div class="mb-2 text-center">
                        <input type="submit" class="btn btn-primary" value="ยืนยันการสมัครสมาชิก" name="submit">
                        <input type="reset" class="btn btn-danger" value="ยกเลิก">
                    </div>

            </div>

        </form>

        </div>
    </div>
</body>
</html>