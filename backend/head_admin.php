<?php 
if (!isset($_SESSION["admin"])) {
    header("Location: ../login.php");
}
require("../connect.php");

?>
<title>Product Online</title>
<!-- bootstrap -->
<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>