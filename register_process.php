<?php
session_start();
include("connect.php");
if(isset($_POST["submit"])){
$firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
$lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
$telephone = mysqli_real_escape_string($conn, $_POST["telephone"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$username = mysqli_real_escape_string($conn, $_POST["username"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);
$password_conf = mysqli_real_escape_string($conn, $_POST["password_confirm"]);

if(!empty($firstname) and !empty($lastname) and !empty($telephone) and !empty($email) and !empty($username) and !empty($password) and !empty($password_conf)){ //เช็คว่าค่าที่กรอกเข้ามาเปนค่าว่างหรือไม่
    if($password == $password_conf){ //เช็คว่ารหัส กับ รหัสยืนยัน เหมือนกันไหม
        $sql = "SELECT telephone,email,username FROM member WHERE telephone = ? OR email = ? OR username = ?";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"sss", $telephone, $email, $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) == 0){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql_insert = "INSERT INTO member (Fname,Lname,Telephone,Email,Username,Password,Status) VALUES
                        (?,?,?,?,?,?,'0')";
        $stmt_insert = mysqli_prepare($conn,$sql_insert);
        mysqli_stmt_bind_param($stmt_insert,"ssssss", $firstname, $lastname, $telephone, $email, $username, $hashed_password);
        if(mysqli_stmt_execute($stmt_insert)){
            echo "<script> alert('สมัครสมาชิกสำเร็จ');</script>";
            echo "<script> window.location='register.php';</script>";
            mysqli_close($conn);
            exit();
        }else{
            die("ไม่สามารถสมัครสมาชิกได้ : ".mysqli_error($conn));
        }
    }else{
        $_SESSION["repeat"] = "ชื่อผู้ใช้ อิเมล หรือ เบอร์โทรศัพท์ ถูกใช้แล้ว";
    }
    }else{
        $_SESSION["password"] = "รหัสผ่านผ่านไม่ตรงกัน กรุณาลองใหม่อีกครั้ง";
    }
}else{
    $_SESSION["empty"] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}
}
    header("Location: register.php");
    mysqli_close($conn);
?>