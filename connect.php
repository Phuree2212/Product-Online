<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ProductOnline";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn){
    die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้ :" . mysqli_connect_error());
}
    mysqli_set_charset($conn,"utf8");
?>