<?php

include("head.php");

$sql = "SELECT * FROM type";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $typeid,$typename);

?>
<ul class="list-group">
  <b>USER : <?php if(isset($_SESSION['user'])){echo $_SESSION['user']; }else{echo "GUEST";} ?> </b>
  <a href="indexx.php" class="list-group-item active">หน้าหลัก</a>
  <?php while(mysqli_stmt_fetch($stmt)){ ?>
  <a href="list_admin.php" class="list-group-item"><?php echo $typename ?></a>
  <?php } ?>
  <?php if(isset($_SESSION['user'])){ ?>
  <a href="logout.php" class="btn btn-danger mt-3">ออกจากระบบ</a>
  <?php }else{ ?>
  <a href="login.php" class="btn btn-primary mt-3">เข้าสู่ระบบ</a>
  <?php } ?>
</ul>
