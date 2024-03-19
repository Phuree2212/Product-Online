<?php
session_start();

include("head_admin.php");

if(isset($_GET['status_filter'])){
    $status_filter = $_GET['status_filter'];
}

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

        <div class="col-md-8"><h2 align="center">รายการคำสั่งซื้อ</h2>
            <div class="mb-2">
                    <form method="GET" action="check_orders.php" >
                <select name="status_filter" onchange="this.form.submit()">
                    <option selected>เลือกสถานะสินค้า</option>
                    <option value="รอดำเนินการชำระเงิน">รอดำเนินการชำระเงิน</option>
                    <option value="รอดำเนินการตรวจสอบ">รอดำเนินการตรวจสอบ</option>
                    <option value="สินค้าอยู่ในระหว่างการจัดส่ง">สินค้าอยู่ในระหว่างการจัดส่ง</option>
                    <option value="ลูกค้ารับสินค้าแล้ว">ลูกค้ารับสินค้าแล้ว</option>
                    <option value="">ทั้งหมด</option>
                </select>
                    </form>
                </div>

            <table class="table text-center">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">รหัสคำสั่งซื้อ</th>
                            <th scope="col">วันที่สั่งซือ</th>
                            <th scope="col">ยอดรวม</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                            if(!empty($status_filter)){

                            $sql = "SELECT OrderID, OrderDate, TotalPrice, OrderStatus FROM orders WHERE OrderStatus = ?";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt,"s",$status_filter);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);

                            $record_show = 5;
                            $num = mysqli_stmt_num_rows($stmt);
                            $all_page = ceil($num/$record_show);

                            if(isset($_GET["page"])){
                                $page = $_GET["page"];
                            }else{
                                $page = 1;
                            }

                            $first_page = ($page-1)*$record_show;

                            $sql_limit = "SELECT OrderID, OrderDate, TotalPrice, OrderStatus FROM orders WHERE OrderStatus = ?
                            LIMIT ?,$record_show";
                            $stmt_limit = mysqli_prepare($conn, $sql_limit);
                            mysqli_stmt_bind_param($stmt_limit,"si",$status_filter,$first_page);
                            mysqli_stmt_execute($stmt_limit);
                            mysqli_stmt_bind_result($stmt_limit, $order_id, $order_date, $total_price, $order_status);

                        }else{

                            $sql = "SELECT OrderID, OrderDate, TotalPrice, OrderStatus FROM orders";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);

                            $record_show = 5;
                            $num = mysqli_stmt_num_rows($stmt);
                            $all_page = ceil($num/$record_show);

                            if(isset($_GET["page"])){
                                $page = $_GET["page"];
                            }else{
                                $page = 1;
                            }

                            $first_page = ($page-1)*$record_show;

                            $sql_limit = "SELECT OrderID, OrderDate, TotalPrice, OrderStatus FROM orders LIMIT ?,$record_show";
                            $stmt_limit = mysqli_prepare($conn, $sql_limit);
                            mysqli_stmt_bind_param($stmt_limit,"i",$first_page);
                            mysqli_stmt_execute($stmt_limit);
                            mysqli_stmt_bind_result($stmt_limit, $order_id, $order_date, $total_price, $order_status);



                        }

                            $i = 1;
                            while(mysqli_stmt_fetch($stmt_limit)){
                            ?>
                                <tr>
                            <th valign="middle"><?php echo $i; ?></th>
                            <td valign="middle"><?php echo $order_id ?></td>
                            <td valign="middle"><?php echo $order_date ?></td>
                            <td valign="middle"><?php echo $total_price ?></td>
                            <td valign="middle"><div class="btn btn-<?= ($order_status == "รอดำเนินการชำระเงิน") ? "warning" : (($order_status == "รอดำเนินการตรวจสอบ") ? "info" : (($order_status == "ยกเลิก") ? "danger" : "success")) ?>"><?php echo $order_status ?></div></td>
                            <td valign="middle"><a href="detail_orders.php?orderid=<?php echo $order_id ?>">รายการคำสั่งซื้อ</a></td>
                                </tr>
                                <?php $i++; } ?>
                        </tbody>
                    </table>
                    <ul class="pagination justify-content-center">
            <li class="page-item <?php if($page == 1 ){ echo "disabled"; } ?>">
                <a class="page-link" href="check_orders.php?page=<?php echo $page-1 ?>">ย้อนกลับ</a>
            </li>
            <?php 
            $start_page = max(1,$page-1); //เก็บหน้าที่อยู่ปัจจุบัน ลบด้วยหนึ่ง เพื่อให้หน้าเก่าแสดงอยู่ 1
            $end_page = min($all_page , $start_page + 3); //คำรวนหาหน้าสิ้นสุดที่แสดงใน pagination
            for($num = $start_page;$num <= $end_page;$num++){
            ?>
                <li class="page-item <?php if($page == $num ){ echo "active"; } ?>"><a class="page-link" href="check_orders.php?page=<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php } ?>
            <li class="page-item <?php if($page == $all_page){ echo "disabled";} ?>">
                <a class="page-link" href="check_orders.php?page=<?php echo $page+1;?>">ต่อไป</a>
            </li>
            </ul>
                </div>

        </div>
    </div>
    </div>
</body>
</html>
