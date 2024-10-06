<?php

$url = parse_url(getenv('JAWSDB_URL'));

$db_host = $url["host"];
$db_user = $url["user"];
$db_password = $url["pass"];
$db_name = substr($url["path"], 1);

$db = new mysqli($db_host, $db_user, $db_password, $db_name, '3306');
if (mysqli_connect_errno()) {
    echo 'Failure '. mysqli_connect_error();
}
?>