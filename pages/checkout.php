<?php
SESSION_START();
require_once "configuration.php";

$account = $_SESSION["acc_id"];
$globaltotal = $_SESSION['globaltotal'];

foreach($_SESSION['cart'] as $key => $val) {
    $condition = "SELECT p_count FROM products WHERE p_id = '$key'";
    $check = mysqli_query($db, $condition);
    $otherrow = $check->fetch_assoc();
    if ($val > $otherrow['p_count']) {
        header("location: cart.php?error=NotEnoughInventory");
        exit();
    }
}

foreach($_SESSION['cart'] as $key => $val) {
    $sqltwo = "UPDATE products SET p_count = p_count-'$val' WHERE p_id = '$key'";
    $stmt = $db->prepare($sqltwo);
    $stmt->execute();
}

$sqlthree = "INSERT INTO orders (acc_no, total) VALUES ('$account', '$globaltotal')";
$db->query($sqlthree);
header("location: purchaseComplete.php");

?>