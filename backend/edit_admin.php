<?php 
session_start();
include("head_admin.php");
if(!empty($_GET["id"])){
$id = mysqli_real_escape_string($conn, $_GET["id"] );

$sql = "SELECT Fname,Lname,Telephone,Email,Username FROM member WHERE MemberID = ? AND status = 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt,"i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $firstname, $lastname, $telephone, $email, $username);
mysqli_stmt_fetch($stmt);
    if(mysqli_stmt_num_rows ($stmt) > 0){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผู้ดูแลระบบ</title>
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
                <div class="text-center mb-3"><h2>แก้ไขข้อมูลผู้ดูแลระบบ</h2></div>
                <hr>
                <form method="POST" action="edit_admin_update.php">
                <div class="col-md-2 mx-auto text-center">
                    <div class="mb-2">
                        <label class="label-control">รหัส Admin</label>
                        <input type="text" class="form-control" name="ID" value="<?php echo $id ?>" readonly>
                    </div>
                </div>
                    <div class="col-md-7 mx-auto">
                    <div class="row">
                        <div class="col mb-2">
                            <label class="label-control">ชื่อ</label>
                            <input type="text" class="form-control" name="firstname" maxlength="30" value="<?php echo $firstname ?>">
                        </div>
                        <div class="col">
                            <label class="label-control">นามสกุล</label>
                            <input type="text" class="form-control" name="lastname" maxlength="30" value="<?php echo $lastname ?>">
                        </div>

                        <?php if(isset($_SESSION['telephone'])){ ?>
                        <div class="text-center text-danger"><?php echo $_SESSION['telephone']; ?></div>
                        <?php unset($_SESSION['telephone']); } ?>

                        <div class="mb-2">
                        <label class="label-control">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="telephone" maxlength="10" value="<?php echo $telephone ?>">
                        </div>

                        <?php if(isset($_SESSION['email'])){ ?>
                        <div class="text-center text-danger"><?php echo $_SESSION['email']; ?></div>
                        <?php unset($_SESSION['email']); } ?>

                    <div class="mb-2">
                        <label class="label-control">อีเมลล์</label>
                            <input type="text" class="form-control" name="email" maxlength="100" value="<?php echo $email ?>">
                        </div>

                        <?php if(isset($_SESSION['username'])){ ?>
                        <div class="text-center text-danger"><?php echo $_SESSION['username']; ?></div>
                        <?php unset($_SESSION['username']); } ?>

                        <div class="mb-2">
                        <label class="label-control">ชื่อผู้ดูแลระบบ</label>
                            <input type="text" class="form-control" name="username" maxlength="30" value="<?php echo $username ?>">
                        </div>

                        <div class="mb-2 text-center">
                            <input type="submit" value="ยินยัน" class="btn btn-primary" name="submit">
                            <input type="reset" value="ยกเลิก" class="btn btn-danger">
                        </div>
                        
                    </div>
                    </div>
                </form>
            <hr>
            </div>
        </div>
    </div>
    
</body>
</html>
<?php }else{ ?>
    <body>
    <div class="container">
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
                <div class="text-center mb-3"><h2>แก้ไขข้อมูลผู้ดูแลระบบ</h2></div>
                <hr>
                <div class="text-danger text-center"><h3>ไม่พบรายชื่อข้อมูลที่ต้องการแก้ไขในระบบ</h3></div>
                <hr>
                    </div>
                    </div>
            </div>
        </div>
    </div>

<?php }}else{ ?>
    <body>
    <div class="container">
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
                <div class="text-center mb-3"><h2>แก้ไขข้อมูลผู้ดูแลระบบ</h2></div>
                <hr>
                <div class="text-danger text-center"><h3>ไม่พบรายชื่อข้อมูลที่ต้องการแก้ไขในระบบ</h3></div>
                <hr>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <?php } ?>