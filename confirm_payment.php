<?php 
include("head.php");

date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d H:i:s");

if(isset($_POST["submit"])){
    if(isset($_POST["orderid"])){
        $order_id = $_POST["orderid"];

        $sql_check = "SELECT * FROM payment WHERE OrderID = ?";
        $stmt_check = mysqli_prepare($conn,$sql_check);
        mysqli_stmt_bind_param($stmt_check,"i",$order_id);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if(mysqli_stmt_num_rows($stmt_check) == 0){
          
        if(is_uploaded_file($_FILES['payment']['tmp_name'])){
            $new_image_name = 'pay_'.uniqid().".".pathinfo(basename($_FILES['payment']['name']),PATHINFO_EXTENSION);
            $image_upload_path = "./img/Payment/".$new_image_name;
            move_uploaded_file($_FILES['payment']['tmp_name'],$image_upload_path);
          }else{
            echo "<script>alert('กรุณาแนบหลักฐานการชำระเงิน')</script>";
            echo "<script>window.location='detail_notice_payment.php?orderid=$order_id'</script>";
          }    
        $sql = "INSERT INTO payment (OrderID,PaymentDate,ProofofPayment) 
                VALUES (?,?,?)";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"iss", $order_id,$date,$new_image_name);
        mysqli_stmt_execute($stmt);

        $sql_status = "UPDATE orders SET OrderStatus = 'รอดำเนินการตรวจสอบ' WHERE OrderID = ?";
        $stmt_status = mysqli_prepare($conn,$sql_status); 
        mysqli_stmt_bind_param($stmt_status,"i",$order_id);
        mysqli_stmt_execute($stmt_status);
        
        echo "<script>alert('แจ้งชำระเงินสำเร็จ กรุณารอการตรวจสอบภายใน 24 ชั่วโมง')</script>";
        echo "<script>window.location='notice_payment.php'</script>";
    }
     
      else{
          echo "<script>alert('คุณได้ดำเนินการชำระเงินแล้ว')</script>";
          echo "<script>window.location='detail_notice_payment.php?orderid=$order_id'</script>";
          exit();}
  }else{
    header("Location: notice_payment.php");
  }
}else{
    header("Location: notice_payment.php");
}
?>