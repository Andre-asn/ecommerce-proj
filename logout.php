<?php
session_start();
$_SESSION['condition'] = FALSE;
unset($_SESSION["acc_user"]);
unset($_SESSION["acc_id"]);
unset($_SESSION["acc_role"]);
session_destroy();
header("location: login.php");
exit;
?>