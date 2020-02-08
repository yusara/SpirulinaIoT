<?php 
session_start();
$_SESSION = [];
session_unset();
session_destroy();

// header("location: http://localhost/physics_expo/page/admin");
header("location: index.php");
exit;
 ?>