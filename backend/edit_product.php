<?php 
session_start();
include("head_admin.php");
if(!empty($_GET["id"])){
$id = mysqli_real_escape_string($conn, $_GET["id"] );

$sql = "SELECT products.ProductName, products.Description, products.Price, products.Stock, products.Image, type.TypeID, type.TypeName 
        FROM products JOIN type ON products.TypeID = type.TypeID WHERE products.ProductID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt,"i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $productname, $description, $price, $stock, $image, $typeid ,$typename);
mysqli_stmt_fetch($stmt);
    if(mysqli_stmt_num_rows ($stmt) > 0){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผู้ดูแลระบบ</title>
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
            <div class="col-md-8">
                <div class="text-center mb-3"><h2>แก้ไขข้อมูลสินค้า</h2></div>
                <hr>
                <form method="POST" action="edit_product_update.php" onsubmit="LimitDecimal(this.priceInput)" enctype="multipart/form-data">
                <div class="col-md-2 mx-auto text-center">
                    <div class="mb-2">
                        <label class="label-control">รหัสสินค้า</label>
                        <input type="text" class="form-control" name="Pro_ID" value="<?php echo $id ?>" readonly>
                    </div>
                </div>
                    <div class="col-md-7 mx-auto">
                    <div class="row">
                        <div class="col mb-2">
                            <label class="label-control">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="productname" maxlength="30" value="<?php echo $productname ?>">
                        </div>
                        <div class="col">
                            <label class="label-control">ประเภทสินค้า</label>
                            <select class="form-select" name="type">
                            <option selected value="<?php echo $typeid; ?>"><?php echo $typename ?></option>
                                <?php 
                                
                                $sql_Type = "SELECT * FROM type WHERE TypeID != ?";
                                $stmt_Type = mysqli_prepare($conn, $sql_Type);
                                mysqli_stmt_bind_param($stmt_Type,"i",$typeid);
                                mysqli_stmt_execute($stmt_Type);
                                mysqli_stmt_bind_result($stmt_Type, $type_id_type, $type_name_type)
                                
                                ?>

                             <?php while(mysqli_stmt_fetch($stmt_Type)){ ?>
                            <option value="<?php echo $type_id_type ?>"><?php echo $type_name_type ?></option>
                        <?php } ?>
                        </select>
                        </div>

                        <div class="mb-2">
                        <label class="label-control">รายละเอียดสินค้า</label>
                            <textarea class="form-control" name="description"><?php echo $description ?></textarea>
                        </div>

                    <div class="mb-2">
                        <label class="label-control">ราคา</label>
                            <input type="number" class="form-control" name="price" maxlength="100" value="<?php echo $price ?>" id="priceInput" onchange="LimitDecimal(this)">
                        </div>

                        <script>
                            function LimitDecimal(input){

                                input.value = parseFloat(input.value).toFixed(2);

                            }
                        </script>

                        <div class="mb-2">
                        <label class="label-control">จำนวนสินค้า</label>
                            <input type="text" class="form-control" name="stock" maxlength="30" value="<?php echo $stock ?>">
                        </div>

                        <div class="mb-1">
                        <label class="label-control">รูปภาพสินค้า</label>
                        <?php if(!empty($image)){ ?>
                        </div>
                            <div><img src="../img/Products/<?php echo $image ?>" width="400" height="350"><a href="delete_image_product.php?delete_img=<?php echo $id ?>" class="btn btn-danger">ลบรูปภาพ</a>
                        </div>
                        <?php }else{ ?>
                            <input type="file" name="image_update" class="form-control mb-2">

                            <?php } ?>
                        

                        <div class="mb-2 text-center">
                            <input type="submit" value="ยินยัน" class="btn btn-primary" name="submit">
                            <input type="reset" value="ยกเลิก" class="btn btn-danger">
                        </div>
                        
                    </div>
                    </div>
                </form>
            <hr>
            </div>
        </div>
    </div>
    
</body>
</html>
<?php }else{ ?>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mb-2 mx-auto">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-md-8">
                <div class="text-center mb-3"><h2>แก้ไขข้อมูลสินค้า</h2></div>
                <hr>
                <div class="text-danger text-center"><h3>ไม่พบรายชื่อข้อมูลที่ต้องการแก้ไขในระบบ</h3></div>
                <hr>
                    </div>
                    </div>
            </div>
        </div>
    </div>

<?php }}else{ ?>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mb-2 mx-auto">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <?php include("menu_admin.php"); ?>
            </div>
            <div class="col-md-8">
                <div class="text-center mb-3"><h2>แก้ไขข้อมูลสินค้า</h2></div>
                <hr>
                <div class="text-danger text-center"><h3>ไม่พบรายชื่อข้อมูลที่ต้องการแก้ไขในระบบ</h3></div>
                <hr>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <?php } ?>