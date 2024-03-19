<?php 
session_start();
include("connect.php");

if(isset($_POST['submit'])){
    $username_from_user = mysqli_real_escape_string($conn, $_POST['username']);
    $password_from_user = mysqli_real_escape_string($conn, $_POST['password']);
}
if(!empty($username_from_user) and !empty($password_from_user)){
    $sql = "SELECT memberid,username,password,status FROM member WHERE username = ? ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt,"s", $username_from_user);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt,$memberid,$username, $password_db, $status);

    if(mysqli_stmt_num_rows($stmt) == 1){
        mysqli_stmt_fetch($stmt);
        if(password_verify($password_from_user, $password_db)){
            if($status == "0"){
            $_SESSION["user"] = $username;
            $_SESSION["user_id"] = $memberid;
            header("Location: indexx.php");
            }
            else{
            $_SESSION["admin"] = $username;
            header("Location: backend/admin.php");
            }
            exit();
        }else{
            $_SESSION["password_incorrect"] = "รหัสผ่านไม่ถูกต้องกรุณาลองใหม่อีกครั้ง";
        }
    
    }else{
        $_SESSION["username_incorrect"] = "ชื่อผู้ใช้ไม่ถูกต้องกรุณาลองใหม่อีกครั้ง";  
    }
}else{
    $_SESSION['EnterFill'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
}

header('Location: login.php');
mysqli_close($conn);

?>