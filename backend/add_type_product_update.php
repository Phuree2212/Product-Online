<?php
session_start();
include("../connect.php");

if(isset($_POST['submit'])){
    $id = mysqli_real_escape_string($conn, $_POST['id_type']);
    $typename = mysqli_real_escape_string($conn, $_POST['name_type']);
    if(!empty($id) and !empty($typename)){
        $sql = "SELECT * FROM type WHERE TypeID != ? AND TypeName = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,"is", $id, $typename);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            $sql_update = "UPDATE type SET TypeName = ? WHERE TypeID = ?";
            $stmt_update = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt_update,"si",$typename, $id);
            if(mysqli_stmt_execute($stmt_update)){
                echo "<script>alert('อัพเดตข้อมูลสำเร็จ')</script>";
                echo "<script>window.location='list_type_product.php'</script>";
            }else{
                die("ไม่สามารถบันทึกข้อมูลได้ :" . mysqli_error($conn));
            }
            exit();
        }else{
            $_SESSION['duplicate_type'] = 'ข้อมูลที่ทำการแก้ไขซ้ำกับข้อมูลอื่นในระบบ';
        }

    }else{
        $_SESSION['Fill'] = 'กรุณากรอกข้อมูลให้ครบ';
    }
    header('Location: edit_type_product.php?id='.$id);
}else{
header('Location: list_type_product.php');
}
mysqli_close($conn);




?>