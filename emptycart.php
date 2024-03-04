<?php
SESSION_START();

require_once "configuration.php";

$_SESSION['cart'] = array();
header("location: cart.php");

?>