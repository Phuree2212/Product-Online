<?php 
include("head.php");

if(isset($_SESSION['user_id'])){
    $memberid = $_SESSION['user_id'];
}else{
    $memberid = "";
}

if(!empty($_GET['quantity']) and ($_GET['quantity']) > 0 and is_numeric($_GET['quantity']) ){
    $quantity = $_GET['quantity'];
}else{
    $quantity = 1;
}
if(isset($_GET['id']) and ($_GET['id']) != ""){
    $id = $_GET['id'];
    $sql = "SELECT ProductName,Description,Price,Stock,Image FROM products WHERE ProductID = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$productname,$description,$price,$stock,$image);
    mysqli_stmt_fetch($stmt);

    $decimal_price = number_format( $price,2); //แปลงราคาให้เป็นทศนิยมสองตำแหน่ง
}else{
    header("Location: indexx.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Online</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <?php include("banner.php"); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <?php include("menu.php"); ?>
            </div>
            <div class="col-md-8">
                <div class="row mx-auto">
                    <div class="col-md-5 mt-4">
                        <img src="img/Products/<?php echo $image; ?>" width="350" height="350">
                    </div>
                    <div class="col-md-6 mt-4">
                    <div class="text-center"><h2><?php echo $productname; ?></h2></div>
                    <hr>
                        <p>&nbsp;&nbsp;<?php echo $description ?></p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-6">
                    <div class="d-flex mb-1">
                        <b><font size="30" class="text-danger">฿<?php echo $decimal_price ?></font></b>
                    </div>
                        <div class="d-flex mb-2">
                            <h4>จำนวน</h4> 
                            <div class="ms-2 ml-auto">
                            <ul class="pagination">
                                <li class="page-item <?php if($quantity == 1){ echo "disabled" ;} ?>"><a class="page-link" href="product_detail_reduce.php?quantity=<?php echo $quantity ?>&id=<?php echo $id ?>"><b>-</b></a></li>
                                <li class="page-item"><div class="page-link" name="quantity"><b><?php echo $quantity ?></b></div>
                                <li class="page-item"><a class="page-link" href="product_detail_plus.php?quantity=<?php echo $quantity ?>&id=<?php echo $id ?>&stock=<?php echo $stock ?>"><b>+</b></a></li>
                            </ul>
                            </div>
                            <div class="ms-2 ml-auto mt-1">
                            <p>มีสินค้าทั้งหมด <?php echo $stock; ?> ชิ้น</p>
                            </div>
                        </div>
                        <?php 
                        
                        if($quantity == $stock){
                            echo "<script>alert('สินค้าถึงจำนวนจำกัดแล้ว');</script>";
                        }
                        
                        ?>
                    <div class="text-center">
                        <a href="" class="btn btn-outline-success">ซื้อเลย</a>
                        <a href="add_product_to_cart.php?productid=<?php echo $id ?>&memberid=<?php echo $memberid ?>&quantity=<?php echo $quantity ?>" class="btn btn-outline-primary">เพิ่มลงรถเข็น</a>
                    </div>
                    </div>
                </div>
                <hr>

                <form method="POST" action="comment_submit.php">
                <div class="mb-2">
                <label class="label-control">แสดงความคิดเห็น</label>
                <textarea type="text" class="form-control border border-primary" placeholder="แสดงคงวามคิดเห็น" name="comment" required></textarea>
                <input type="hidden" value="<?php echo $id ?>" name="productid">
                <input type="hidden" value="<?php echo $memberid ?>" name="memberid">
                </div>
                <div class="mb-2">
                    <input type="submit" value="ส่งความคิดเห็น" class="btn btn-primary" name="submit">
                    <input type="reset" value="ยกเลิก" class="btn btn-danger">
                </div>
                </form>
                <hr>

                <label class="label-control mb-3"><h2>ความคิดเห็นลูกค้า</h2></label>
                    <?php 
                    
                    $sql_fetch = "SELECT member.Username,comment.CommentText,comment.CommentDate FROM comment 
                            INNER JOIN Products ON comment.ProductID = products.ProductID
                            INNER JOIN Member ON comment.MemberID = member.MemberID 
                            WHERE comment.ProductID = ?";
                    $stmt_fetch = mysqli_prepare($conn,$sql_fetch);
                    mysqli_stmt_bind_param($stmt_fetch,"i",$id);
                    mysqli_stmt_execute($stmt_fetch);
                    mysqli_stmt_bind_result($stmt_fetch,$username,$commenttext,$comment_date);

                    while(mysqli_stmt_fetch($stmt_fetch)){
                    ?>
                <div class="mb-2">
                    <label><?php echo $username ?></label>
                    <textarea type="text" readonly class="form-control border border-dark"><?php echo $commenttext ?></textarea>
                    <div class="form-text">วันที่แสดงความคิดเห็น <?php echo $comment_date ?></div>
                    <hr>
                </div>
                <?php } ?>
            </div>
            
        </div>
    </div>
    
</body>
</html>