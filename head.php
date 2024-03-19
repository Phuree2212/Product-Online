<?php 
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("connect.php");
?>
<title>Product Online</title>
<!-- bootstrap -->
<link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css"/>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>