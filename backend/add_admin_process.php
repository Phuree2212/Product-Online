<?php 
session_start();
include("../connect.php");

if(isset($_POST["submit"])){
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $telephone = mysqli_real_escape_string($conn, $_POST["telephone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password_confirm = mysqli_real_escape_string($conn, $_POST["password_confirm"]);

    if(!empty($firstname) and !empty($lastname) and !empty($telephone) and !empty($email) and !empty($username) and !empty($password) and !empty($password_confirm) and !empty($password_confirm) and !empty($password_confirm)){
        if($password == $password_confirm){
            $sql = "SELECT telephone,email,username FROM member WHERE telephone = ? OR email = ? OR username = ?";
            $stmt = mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($stmt,"sss", $firstname, $lastname, $telephone);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 0){
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql_insert = "INSERT INTO member (Fname,Lname,Telephone,Email,Username,Password,Status) VALUES
                                (?,?,?,?,?,?,'1')";
                $stmt_insert = mysqli_prepare($conn,$sql_insert);
                mysqli_stmt_bind_param($stmt_insert,"ssssss", $firstname, $lastname, $telephone, $email, $username, $hashed_password);
                if(mysqli_stmt_execute($stmt_insert)){
                    echo "<script>alert('เพิ่มข้อมูลผู้ดูแลระบบสำเร็จ');</script>";
                    echo "<script>window.location='list_admin.php';</script>";
                    exit();
                }else{
                    die("ไม่สามารถสมัครสมาชิกได้ :". mysqli_error($conn));
                }
            }else{
                $_SESSION['repeat'] = 'มีชื่อผู้ใช้ อิเมลล์ หรือเบอร์โทรศัพท์ ในระบบแล้ว';
            }
        }else{
            $_SESSION['password'] = 'รหัสผ่านไม่ตรงกันกรุณาลองใหม่อีกครั้ง';
        }
    }else{
        $_SESSION['empty'] = 'กรุรากรอกข้อมูลให้ครบ';
    }
}
   header("Location: add_admin.php");
   mysqli_close($conn);
?>