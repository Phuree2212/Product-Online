<?php
include("head.php");

if(isset($_SESSION["user_id"])){
$memberid = $_SESSION["user_id"];
}else{
  $memberid = "";
}

$sql = "SELECT * FROM ShoppingCart WHERE MemberID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt,"i", $memberid);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

$num = mysqli_stmt_num_rows($stmt);

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="indexx.php">Product</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="indexx.php">หน้าหลัก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="notice_payment.php">แจ้งชำระเงิน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="้history_order.php">ประวัติการสั่งซื้อ</a>
        </li>
        
      </ul>
      <div class="d-flex text-white align-items-center">
      <div class="auto text-center me-1 fa-lg"><?php if($num > 0){ echo "($num)"; } ?><i class="fa-solid fa-cart-plus"></i></div>
        <a class="nav-link" href="cart.php?memberid=<?php if(isset($_SESSION['user_id'])){echo $_SESSION['user_id'];} ?>">ตะกร้าสินค้า</a>
      </div>
    </div>
  </div>
</nav>