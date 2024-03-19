<?php 
include("head.php");

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
            <div class="col col-md-10 mx-auto">
                <?php include("navbar.php"); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <?php include("menu.php"); ?>
            </div>
            <div class="col-md-8 mt-4">
                <div class="row">
                    <?php 
                    $sql = "SELECT * FROM Products";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $productid,$productname,$type,$description,$price,$stock,$image);
                    
                    while(mysqli_stmt_fetch($stmt)){ 
                        ?>
                    <div class="col-sm-3 mb-3">
    <div class="card">
      <img src="img/Products/<?php echo $image; ?>" class="card-img-top" width="200" height="150">
      <div class="card-body text-center">
        <h6 class="card-title"><?php echo $productname ?></h6>
        <a href="product_detail.php?id=<?php echo $productid ?>" class="btn btn-primary p-1"><font size="3.5">รายละเอียดสินค้า</font></a>
      </div>
    </div>
  </div>
  <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>