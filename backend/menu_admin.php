<?php
include("head_admin.php");
?>
<ul class="list-group">
  <b>ADMIN : <?php echo $_SESSION['admin']; ?> </b>
  <a href="admin.php" class="list-group-item active">หน้าหลัก</a>
  <a href="list_admin.php" class="list-group-item">จัดการผู้ดูแลระบบ</a>
  <a href="list_type_product.php" class="list-group-item">จัดการประเภทสินค้า</a>
  <a href="list_product.php" class="list-group-item">จัดการสินค้า</a>
  <a href="check_orders.php" class="list-group-item mb-3">เช็คออเดอร์</a>
  <a href="../logout.php" class="btn btn-danger">ออกจากระบบ</a>
</ul>
