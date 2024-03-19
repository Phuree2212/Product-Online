<?php 

include("../connect.php");
session_start();

if(isset($_POST["submit"])){
    $name_type = mysqli_real_escape_string($conn, $_POST["name_type"]);

    $sql = "SELECT * FROM type WHERE TypeName = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt,"s", $name_type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) == 0){
        $sql_insert = "INSERT INTO type (TypeName) VALUES (?)";
        $stmt_insert = mysqli_prepare($conn, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert,"s", $name_type);
        
        if(mysqli_stmt_execute($stmt_insert)){
            echo "<script>alert('เพิ่มประเภทสินค้าใหม่สำเร็จ')</script>";
            echo "<script>window.location='list_type_product.php'</script>";
        }else{
            die("ไม่สามารถบันทึกข้อมูลได้ :" . mysqli_error($conn));
        }
            exit();
    }else{
        $_SESSION["duplicate"] = "ชื่อประเภทสินค้านี้ถูกเพิ่มในระบบแล้ว";
    }
    
}
header("Location: add_type_product.php");
mysqli_close($conn);

?>