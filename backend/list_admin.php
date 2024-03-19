<?php 
session_start();
include("head_admin.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>จัดการผู้ดูแลระบบ</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php include("banner.php"); ?>
        </div>
        </div>
        <div class="row">
            <div class="col-md-10 mb-2 mx-auto">

            <?php include("navbar.php"); ?>

            </div>
        </div>
        <div class="row justify-content-center">
        <div class="col-md-2">
            <?php include("menu_admin.php"); ?>
        </div>

        <div class="col-md-8"><h2 align="center">รายการ Admin <a href="add_admin.php" class="btn btn-primary">+เพิ่ม</a></h2>
            <?php
            $sql = "SELECT MemberID,Fname,Lname,Telephone,Email,Username FROM member WHERE status = '1'";
            $stmt = mysqli_prepare($conn,"$sql");
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            if(!empty($_GET['page']) and is_numeric($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = 1;
            }

            $record_show = 5; //จำนวนรายการที่ต้องการให้แสดงใน 1 หน้า
            $record_num = mysqli_stmt_num_rows($stmt); //จำนวนรายการแถวที่ต้องการแสดง
            $num_all_page = ceil($record_num/$record_show); //คำณวนหาจำนวนหน้าทั้งหมด

            $num_first_page = ($page - 1) * $record_show; //คำณวนหาค่าเริ่มต้นของแต่ละหน้า

            $sql_fetch = "SELECT MemberID,Fname,Lname,Telephone,Email,Username FROM member WHERE status = '1' LIMIT $num_first_page, $record_show";
            $stmt_fetch = mysqli_prepare($conn,$sql_fetch);
            mysqli_stmt_execute($stmt_fetch);
            mysqli_stmt_bind_result($stmt_fetch, $admin_id, $firstname, $lastname, $telephone, $email, $username);

            $i = 1;
            ?>
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th width="50" class="text-center" valign="middle">ลำดับ</th>
                        <th class="text-center">ชื่อ</th>
                        <th class="text-center">สกุล</th>
                        <th width="150" class="text-center">เบอร์โทรศัพท์</th>
                        <th class="text-center">อีเมลล์</th>
                        <th class="text-center">ชื่อผู้ใช้</th>
                        <th class="text-center">แก้ไข</th>
                        <th class="text-center">ลบ</th>
                    </tr>
                </thead>
            <tbody>
            <?php while(mysqli_stmt_fetch($stmt_fetch)){ ?>
                    <tr>
                        <th class="text-center" valign="middle"><?php echo $i; ?></th>
                        <td class="text-center" valign="middle"><?php echo $firstname ?></td>
                        <td class="text-center" valign="middle"><?php echo $lastname ?></td>
                        <td class="text-center" valign="middle"><?php echo $telephone ?></td>
                        <td class="text-center" valign="middle"><?php echo $email ?></td>
                        <td class="text-center" valign="middle"><?php echo $username ?></td>
                        <td class="text-center" valign="middle"><a href="edit_admin.php?id=<?php echo $admin_id; ?>" class="btn btn-warning">แก้ไข</a></td>
                        <td class="text-center" valign="middle"><a href="delete_admin.php?id=<?php echo $admin_id; ?>" class="btn btn-danger" onclick="return ConfirmDelete()">ลบ</a></td>
                        <?php $i++; ?>
                    </tr>
                <?php } ?>

                    <script>
                        function ConfirmDelete(){
                            if(confirm('คุณต้องที่จะลบข้อมูลใช่หรือไม่?')){
                                return true;
                            }
                                return false;
                        }
                </script>

            </tbody>
            </table>

            <ul class="pagination pagination-sm justify-content-center">
            <li class="page-item <?php if($page == 1){ echo "disabled"; } ?>">
                <a class="page-link" href="list_admin.php?page=<?php echo $page-1; ?>">ย้อนกลับ</a>
            </li>
            <?php 
                    $start_page = max(1, $page - 1); // เริ่มต้นที่หน้าก่อนหน้าหน้าปัจจุบันหรือหน้า 1 (ถ้าหน้าปัจจุบันเป็นหน้าแรก)
                    $end_page = min($num_all_page, $start_page + 3); // สิ้นสุดที่หน้าถัดไปหรือหน้าสุดท้าย (ถ้าหน้าถัดไปเกินหน้าสุดท้าย)
                    for($num = $start_page; $num <= $end_page; $num++){ 
                    ?>
                <li class="page-item <?php if($num == $page){echo "active"; } ?>"><a class="page-link" href="list_admin.php?page=<?php echo $num; ?>"><?php echo $num; ?></a></li>
                <?php } ?>
                <li class="page-item <?php if($page == $num_all_page){ echo "disabled"; } ?>">
                <a class="page-link" href="list_admin.php?page=<?php echo $page+1; ?>">ต่อไป</a>
            </li>
            </ul>

    </div>

        </div>
    </div>
    </div>
</body>
</html>
