<?php 

session_start();

include("head_admin.php");

if(isset($_GET["type_filter"])){
    $type_filter = $_GET["type_filter"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการสินค้า</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php include("banner.php"); ?>
        </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <?php include("menu_admin.php"); ?>    
            </div>
            <div class="col-md-8"><h2 align="center">รายการสินค้า <a href="add_product.php" class="btn btn-primary">+เพิ่มสินค้า</a></h2>
            <div class="mb-2">
                <?php 
                
                $sql_type = "SELECT TypeID,TypeName FROM Type";
                $stmt_type = mysqli_prepare($conn, $sql_type);
                mysqli_stmt_execute($stmt_type);
                mysqli_stmt_bind_result($stmt_type,$typeid1,$typename1);
                
                ?>
                <form method="GET" action="list_product.php" >
            <select name="type_filter" onchange="this.form.submit()">
                <option selected>เลือกประเภทสินค้า</option>
                <?php while(mysqli_stmt_fetch($stmt_type)){ ?>
                <option value="<?php echo $typeid1 ?>"><?php echo $typename1 ?></option>
                <?php } ?>
                <option value="">ทั้งหมด</option>
            </select>
                </form>
            </div>
            <?php
            
            if(!empty($type_filter)){
                $sql = "SELECT Products.ProductID,Products.ProductName,Products.TypeID,Products.Description,Products.Price,Products.Stock,Products.Image,Type.TypeName 
                        FROM products 
                        JOIN type ON Products.TypeID = Type.TypeID
                        WHERE products.TypeID = ?";
                $stmt = mysqli_prepare($conn,$sql);
                mysqli_stmt_bind_param( $stmt,"i", $type_filter);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if(!empty($_GET['page']) and is_numeric($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }
    
                $record_show = 5; //จำนวนรายการที่แสดงในหนึ่งหน้า
                $data_num = mysqli_stmt_num_rows($stmt); //จำข้อมูลใน db
                $num_all_page = ceil($data_num/$record_show); //คำณวนหาจำนวนหน้าทั้งหมด
                $num_first_page = ($page-1) * $record_show; //คำณวนตำแหน่งเริ่มต้นของแต่ละหน้า
                
                $sql_fetch = "SELECT Products.ProductID,Products.ProductName,Products.TypeID,Products.Description,Products.Price,Products.Stock,Products.Image,Type.TypeName FROM products
                              JOIN type ON Products.TypeID = Type.TypeID 
                              WHERE products.TypeID = ? 
                              LIMIT ?, $record_show";
                $stmt_fetch = mysqli_prepare($conn,$sql_fetch);
                mysqli_stmt_bind_param($stmt_fetch, "ii" ,$type_filter,$num_first_page);
                mysqli_stmt_execute($stmt_fetch);
                mysqli_stmt_bind_result($stmt_fetch, $productid, $productname, $typeid, $description, $price, $stock, $image, $typename);
            }else{


            $sql = "SELECT Products.ProductID,Products.ProductName,Products.TypeID,Products.Description,Products.Price,Products.Stock,Products.Image,Type.TypeName FROM products JOIN type ON Products.TypeID = Type.TypeID";
            $stmt = mysqli_prepare($conn,$sql);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);


            if(!empty($_GET['page']) and is_numeric($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = 1;
            }

            $record_show = 5; //จำนวนรายการที่แสดงในหนึ่งหน้า
            $data_num = mysqli_stmt_num_rows($stmt); //จำข้อมูลใน db
            $num_all_page = ceil($data_num/$record_show); //คำณวนหาจำนวนหน้าทั้งหมด
            $num_first_page = ($page-1) * $record_show; //คำณวนตำแหน่งเริ่มต้นของแต่ละหน้า
            
            $sql_fetch = "SELECT Products.ProductID,Products.ProductName,Products.TypeID,Products.Description,Products.Price,Products.Stock,Products.Image,Type.TypeName FROM products JOIN type ON Products.TypeID = Type.TypeID 
                          LIMIT ?, $record_show ";
            $stmt_fetch = mysqli_prepare($conn,$sql_fetch);
            mysqli_stmt_bind_param($stmt_fetch, "i" ,$num_first_page);
            mysqli_stmt_execute($stmt_fetch);
            mysqli_stmt_bind_result($stmt_fetch, $productid, $productname, $typeid, $description, $price, $stock, $image, $typename); 
        }

            $i = 1;
            ?>
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th width="50" class="text-center" valign="middle">ลำดับ</th>
                        <th class="text-center">ชื่อสินค้า</th>
                        <th class="text-center">ประเภทสินค้า</th>
                        <th class="text-center">ราคา</th>
                        <th class="text-center">จำนวนสต๊อกสินค้า</th>
                        <th class="text-center">รูปภาพสินค้า</th>
                        <th class="text-center">แก้ไข</th>
                        <th class="text-center">ลบ</th>
                    </tr>
                </thead>
            <tbody>
            <?php while(mysqli_stmt_fetch($stmt_fetch)){ ?>
                    <tr>
                        <th class="text-center" valign="middle"><?php echo $i; ?></th>
                        <td class="text-center" valign="middle"><?php echo $productname ?></td>
                        <td class="text-center" valign="middle"><?php echo $typename ?></td>
                        <td class="text-center" valign="middle"><?php echo $price ?></td>
                        <td class="text-center" valign="middle"><?php echo $stock ?></td>
                        <td class="text-center" valign="middle"><img width="100" height="100" src="../img/Products/<?php echo $image ?>"></td>
                        <td class="text-center" valign="middle"><a href="edit_product.php?id=<?php echo $productid; ?>" class="btn btn-warning">แก้ไข</a></td>
                        <td class="text-center" valign="middle"><a href="delete_product.php?id=<?php echo $productid; ?>" class="btn btn-danger" onclick="return ConfirmDelete()">ลบ</a></td>
                        <?php $i++; ?>
                    </tr>
                    <?php } ?>
            </tbody>
            </table>
            <script>
                function ConfirmDelete(){
                if(confirm('คุณต้องที่จะลบข้อมูลใช่หรือไม่?')){
                return true;
                 }
                return false;
                }
                </script>

            <ul class="pagination justify-content-center">
            <li class="page-item <?php if($page == 1 ){ echo "disabled"; } ?>">
                <a class="page-link" href="list_product.php?page=<?php echo $page-1 ?>">ย้อนกลับ</a>
            </li>
            <?php 
            $start_page = max(1,$page-1); //เก็บหน้าที่อยู่ปัจจุบัน ลบด้วยหนึ่ง เพื่อให้หน้าเก่าแสดงอยู่ 1
            $end_page = min($num_all_page , $start_page + 3); //คำรวนหาหน้าสิ้นสุดที่แสดงใน pagination
            for($num = $start_page;$num <= $end_page;$num++){
            ?>
                <li class="page-item <?php if($page == $num ){ echo "active"; } ?>"><a class="page-link" href="list_product.php?page=<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php } ?>
            <li class="page-item <?php if($page == $num_all_page){ echo "disabled";} ?>">
                <a class="page-link" href="list_product.php?page=<?php echo $page+1;?>">ต่อไป</a>
            </li>
            </ul>

    </div>

            </div>
        </div>
    </div>
    
</body>
</html>