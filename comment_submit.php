<?php 
include("head.php");



if(!empty($_POST["submit"]) and !empty($_POST['productid'])){
    if(!empty($_POST["comment"])){
        $comment = mysqli_real_escape_string($conn,$_POST["comment"]);
        $productid = mysqli_real_escape_string($conn,$_POST["productid"]);

        if(!empty($_POST["memberid"]) and ($_POST['memberid'] != "")){
        $memberid = mysqli_real_escape_string($conn,$_POST["memberid"]);

        date_default_timezone_set('Asia/Bangkok');
        $comment_date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO comment (ProductID,MemberID,CommentText,CommentDate) VALUES
                (?,?,?,?)";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"iiss", $productid, $memberid, $comment, $comment_date);
        if(mysqli_stmt_execute($stmt)){
            echo "<script>alert('แสดงความคิดเห็นเรียบร้อย!')</script>";
            echo "<script>window.location='product_detail.php?id=$productid'</script>";
        }else{
            die("ไม่สามารถบันทึกข้อมูลได้ : ".mysqli_error($conn));
        }
        exit();
    }else{
        echo "<script>alert('กรุณาเข้าสู่ระบบก่อนจึ้งจะสามรารถแสดงความคิดเห็นได้!')</script>";
        echo "<script>window.location='product_detail.php?id=$productid'</script>";
        exit();
    }
    }else{
        $_SESSION["please_comment"]="กรุณาแสดงความคิดเห็นด้วยครับ/ค่ะ";
    }
}else{
    header("Location: product_detail.php");
}

?>
