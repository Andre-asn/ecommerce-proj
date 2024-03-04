<?php
$db = new mysqli('store-db.cjcu4yo0sjqd.us-east-2.rds.amazonaws.com', 'admin', 'nU4bkKrdFusUs0hHoHiA', 'ecommerce', '3306');
if (mysqli_connect_errno()) {
    echo 'Failure '. mysqli_connect_error();
}
?>