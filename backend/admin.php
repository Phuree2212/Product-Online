<?php 
session_start();
include("head_admin.php");

date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$month = date("m");
$year = date("Y");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>ระบบหลังบ้าน</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <?php include("banner.php"); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto mb-3">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-md-8">
            <div class="alert alert-primary text-center"><h1>ยินดีต้อนรับผู้ดูแลระบบ</h1></div>
                <div class="text-center"><h3>ภาพรวมทั้งหมด</h3></div>
                <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการสมาชิก</h4></div>
                    <div class="card-body">
                    <?php 
                        $sql_member = "SELECT * FROM member WHERE Status = 1";
                        $stmt_member = mysqli_prepare($conn, $sql_member);
                        mysqli_stmt_execute($stmt_member);
                        mysqli_stmt_store_result($stmt_member);
                        $num_member = mysqli_stmt_num_rows($stmt_member);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_member ?> คน</h6>
                        <a href="list_admin.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการออเดอร์</h4></div>
                    <div class="card-body">
                    <?php 
                        $sql_orders = "SELECT * FROM orders";
                        $stmt_orders = mysqli_prepare($conn, $sql_orders);
                        mysqli_stmt_execute($stmt_orders);
                        mysqli_stmt_store_result($stmt_orders);
                        $num_orders = mysqli_stmt_num_rows($stmt_orders);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_orders ?> รายการ</h6>
                        <a href="check_orders.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการสินค้า</h4></div>
                    <div class="card-body">
                        <?php 
                        $sql_product = "SELECT * FROM products";
                        $stmt_product = mysqli_prepare($conn, $sql_product);
                        mysqli_stmt_execute($stmt_product);
                        mysqli_stmt_store_result($stmt_product);
                        $num_product = mysqli_stmt_num_rows($stmt_product);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_product ?> รายการ</h6>
                        <a href="list_product.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>ยอดขาย</h4></div>
                    <div class="card-body">
                    <?php 
                        $sum = 0;
                        $sql_sales = "SELECT TotalPrice FROM orders WHERE OrderStatus = 'สินค้าอยู่ในระหว่างการจัดส่ง' OR OrderStatus = 'ลูกค้ารับสินค้าแล้ว'";
                        $stmt_sales = mysqli_prepare($conn, $sql_sales);
                        mysqli_stmt_execute($stmt_sales);
                        mysqli_stmt_bind_result($stmt_sales,$total_price);
                        while(mysqli_stmt_fetch($stmt_sales)){
                            $sum += $total_price;
                        }
                        ?>
                        <h6 class="card-title">จำนวน <?php echo number_format($sum,2) ?> บาท</h6>
                        <a href="" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>

                </div>
                <hr>
                <div class="text-center"><h3>ภาพรวมประจำวัน</h3></div>
                <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการสมาชิก</h4></div>
                    <div class="card-body">
                    <?php 
                        $sql_member = "SELECT * FROM member WHERE Status = 1";
                        $stmt_member = mysqli_prepare($conn, $sql_member);
                        mysqli_stmt_execute($stmt_member);
                        mysqli_stmt_store_result($stmt_member);
                        $num_member = mysqli_stmt_num_rows($stmt_member);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_member ?> คน</h6>
                        <a href="list_admin.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการออเดอร์</h4></div>
                    <div class="card-body">
                    <?php 
                        $sql_orders = "SELECT * FROM orders WHERE DATE(OrderDate) = '$date'";
                        $stmt_orders = mysqli_prepare($conn, $sql_orders);
                        mysqli_stmt_execute($stmt_orders);
                        mysqli_stmt_store_result($stmt_orders);
                        $num_orders = mysqli_stmt_num_rows($stmt_orders);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_orders ?> รายการ</h6>
                        <a href="check_orders.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการสินค้า</h4></div>
                    <div class="card-body">
                        <?php 
                        $sql_product = "SELECT * FROM products";
                        $stmt_product = mysqli_prepare($conn, $sql_product);
                        mysqli_stmt_execute($stmt_product);
                        mysqli_stmt_store_result($stmt_product);
                        $num_product = mysqli_stmt_num_rows($stmt_product);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_product ?> รายการ</h6>
                        <a href="list_product.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>ยอดขาย</h4></div>
                    <div class="card-body">
                    <?php 
                        $sum = 0;
                        $sql_sales = "SELECT TotalPrice FROM orders WHERE OrderDate = '$date' AND OrderStatus = 'สินค้าอยู่ในระหว่างการจัดส่ง' OR OrderStatus = 'ลูกค้ารับสินค้าแล้ว'";
                        $stmt_sales = mysqli_prepare($conn, $sql_sales);
                        mysqli_stmt_execute($stmt_sales);
                        mysqli_stmt_bind_result($stmt_sales,$total_price);
                        while(mysqli_stmt_fetch($stmt_sales)){
                            $sum += $total_price;
                        }
                        ?>
                        <h6 class="card-title">จำนวน <?php echo number_format($sum,2) ?> บาท</h6>
                        <a href="" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>

                </div>
                <hr>
                <div class="text-center"><h3>ภาพรวมประจำเดือน</h3></div>
                <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการสมาชิก</h4></div>
                    <div class="card-body">
                    <?php 
                        $sql_member = "SELECT * FROM member WHERE Status = 1";
                        $stmt_member = mysqli_prepare($conn, $sql_member);
                        mysqli_stmt_execute($stmt_member);
                        mysqli_stmt_store_result($stmt_member);
                        $num_member = mysqli_stmt_num_rows($stmt_member);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_member ?> คน</h6>
                        <a href="list_admin.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการออเดอร์</h4></div>
                    <div class="card-body">
                    <?php 
                        $sql_orders = "SELECT * FROM orders WHERE MONTH(OrderDate) = '$month'";
                        $stmt_orders = mysqli_prepare($conn, $sql_orders);
                        mysqli_stmt_execute($stmt_orders);
                        mysqli_stmt_store_result($stmt_orders);
                        $num_orders = mysqli_stmt_num_rows($stmt_orders);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_orders ?> รายการ</h6>
                        <a href="check_orders.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการสินค้า</h4></div>
                    <div class="card-body">
                        <?php 
                        $sql_product = "SELECT * FROM products";
                        $stmt_product = mysqli_prepare($conn, $sql_product);
                        mysqli_stmt_execute($stmt_product);
                        mysqli_stmt_store_result($stmt_product);
                        $num_product = mysqli_stmt_num_rows($stmt_product);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_product ?> รายการ</h6>
                        <a href="list_product.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>ยอดขาย</h4></div>
                    <div class="card-body">
                    <?php 
                        $sum = 0;
                        $sql_sales = "SELECT TotalPrice FROM orders WHERE MONTH(OrderDate) = '$month' AND OrderStatus = 'สินค้าอยู่ในระหว่างการจัดส่ง' OR OrderStatus = 'ลูกค้ารับสินค้าแล้ว'";
                        $stmt_sales = mysqli_prepare($conn, $sql_sales);
                        mysqli_stmt_execute($stmt_sales);
                        mysqli_stmt_bind_result($stmt_sales,$total_price);
                        while(mysqli_stmt_fetch($stmt_sales)){
                            $sum += $total_price;
                        }
                        ?>
                        <h6 class="card-title">จำนวน <?php echo number_format($sum,2) ?> บาท</h6>
                        <a href="" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>

                </div>
                <hr>
                <div class="text-center"><h3>ภาพรวมประจำปี</h3></div>
                <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการสมาชิก</h4></div>
                    <div class="card-body">
                    <?php 
                        $sql_member = "SELECT * FROM member WHERE Status = 1";
                        $stmt_member = mysqli_prepare($conn, $sql_member);
                        mysqli_stmt_execute($stmt_member);
                        mysqli_stmt_store_result($stmt_member);
                        $num_member = mysqli_stmt_num_rows($stmt_member);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_member ?> คน</h6>
                        <a href="list_admin.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการออเดอร์</h4></div>
                    <div class="card-body">
                    <?php 
                        $sql_orders = "SELECT * FROM orders WHERE YEAR(OrderDate) = '$year'";
                        $stmt_orders = mysqli_prepare($conn, $sql_orders);
                        mysqli_stmt_execute($stmt_orders);
                        mysqli_stmt_store_result($stmt_orders);
                        $num_orders = mysqli_stmt_num_rows($stmt_orders);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_orders ?> รายการ</h6>
                        <a href="check_orders.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>รายการสินค้า</h4></div>
                    <div class="card-body">
                        <?php 
                        $sql_product = "SELECT * FROM products";
                        $stmt_product = mysqli_prepare($conn, $sql_product);
                        mysqli_stmt_execute($stmt_product);
                        mysqli_stmt_store_result($stmt_product);
                        $num_product = mysqli_stmt_num_rows($stmt_product);
                        ?>
                        <h6 class="card-title">จำนวน <?php echo $num_product ?> รายการ</h6>
                        <a href="list_product.php" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header"><h4>ยอดขาย</h4></div>
                    <div class="card-body">
                    <?php 
                        $sum = 0;
                        $sql_sales = "SELECT TotalPrice FROM orders WHERE YEAR(OrderDate) = '$year' AND OrderStatus = 'สินค้าอยู่ในระหว่างการจัดส่ง' OR OrderStatus = 'ลูกค้ารับสินค้าแล้ว'";
                        $stmt_sales = mysqli_prepare($conn, $sql_sales);
                        mysqli_stmt_execute($stmt_sales);
                        mysqli_stmt_bind_result($stmt_sales,$total_price);
                        while(mysqli_stmt_fetch($stmt_sales)){
                            $sum += $total_price;
                        }
                        ?>
                        <h6 class="card-title">จำนวน <?php echo number_format($sum,2) ?> บาท</h6>
                        <a href="" class="text-white" style="text-decoration:none;">รายละเอียด...</a>
                    </div>
                    </div>
                </div>

                </div>
                <hr>
        </div>
        </div>

    </div>
    
</body>
</html>