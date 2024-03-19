<?php
session_start();
include("../connect.php");

if(isset($_POST["submit"])){
    $id = mysqli_real_escape_string($conn, $_POST["ID"]);
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $telephone = mysqli_real_escape_string($conn, $_POST["telephone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
        if(!empty($firstname) && !empty($lastname) && !empty($telephone) && !empty($email) && !empty($username)){
            $sql_telephone = "SELECT telephone FROM member WHERE telephone = ? AND MemberID != ?";
            $stmt_telephone = mysqli_prepare($conn, $sql_telephone);
            mysqli_stmt_bind_param($stmt_telephone,"si", $telephone, $id);
            mysqli_stmt_execute($stmt_telephone);
            mysqli_stmt_store_result($stmt_telephone);
            //เช็คเบอร์โทรศัพท์ซ้ำ
                if(mysqli_stmt_num_rows($stmt_telephone) == 0){
                    $sql_email = "SELECT email FROM member WHERE email = ? AND MemberID != ?";
                    $stmt_email = mysqli_prepare($conn, $sql_email);
                    mysqli_stmt_bind_param($stmt_email,"si", $email, $id);
                    mysqli_stmt_execute($stmt_email);
                    mysqli_stmt_store_result($stmt_email);
                    //เช็คอีเมลล์ซ้ำ
                        if(mysqli_stmt_num_rows($stmt_email) == 0){
                            $sql_username = "SELECT username FROM member WHERE username = ? AND MemberID != ?";
                            $stmt_username = mysqli_prepare($conn, $sql_username);
                            mysqli_stmt_bind_param($stmt_username,"si", $username, $id);
                            mysqli_stmt_execute($stmt_username);
                            mysqli_stmt_store_result($stmt_username);
                            //เช็คชื่อผู้ดูแลซ้ำ
                                if(mysqli_stmt_num_rows($stmt_username) == 0){

                                    $sql_update = "UPDATE member SET Fname = ?,Lname = ?,Telephone = ?, Email = ?, Username = ? WHERE MemberID = ? ";
                                    $stmt_update = mysqli_prepare($conn, $sql_update);
                                    mysqli_stmt_bind_param($stmt_update,"sssssi", $firstname, $lastname, $telephone, $email, $username, $id);
                                if(mysqli_stmt_execute($stmt_update)){
                                    echo "<script>alert('อัพเดตข้อมูลสำเร็จ');</script>";
                                    echo "<script>window.location='list_admin.php';</script>";
                                }else{
                                    die("ไม่สามารถอัพเดตข้อมูลได้ :" . mysqli_error($conn));
                                }
                                    exit();
                                }else{
                                    $_SESSION["username"] = "ชื่อผู้ดูแลระบบนี้ถูกใช้แล้ว";
                                }
                    }else{
                        $_SESSION["email"] = "อีเมลล์นี้ถูกใช้แล้ว";
                    }
        }else{
            $_SESSION["telephone"] = "เบอร์โทรศัพท์นี้ถูกใช้แล้ว";
        }
        }else{
            $_SESSION['FillInput'] = "กรุณากรอกข้อมูลให้ครบ";
        }
        header("Location: edit_admin.php?id=".$id);
}else{
    header("Location: list_admin.php");
}
mysqli_close($conn);
?>