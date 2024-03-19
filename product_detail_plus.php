<?php 

if(isset($_GET['quantity'])){
    $quantity = $_GET['quantity'];
    $id = $_GET['id'];
    if(($_GET['quantity']) < ($_GET['stock'])){
    $quantity = $quantity + 1;
    header('Location: product_detail.php?quantity='.$quantity.'&id='.$id);
}else{
    header('Location: product_detail.php?quantity='.$quantity.'&id='.$id);
}}else{
header('Location: product_detail.php');
}
?>