<?php
SESSION_START();
require_once "configuration.php";

$account = $_SESSION["acc_id"];
$sql = "SELECT * FROM orders WHERE acc_no = '$account'";
$result = mysqli_query($db, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Past Orders</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .navbar{padding:1rem}
    .navbar-brand {
        font-family: "Impact", serif; !important;
    }
    .nav-item:hover {
        border-bottom: 3px solid #000000;
    }
    .navbar-brand:hover {
        border-bottom: 3px solid #000000;
    }
    body {
        background: #c9c7c7;
    }
    .overlay {
        color: rgb(255, 255, 255);
        position:absolute;
        z-index:12;
        top:50%;
        left:0;
        width:100%;
        text-align:center;
    }
    .cell {
    border-collapse: separate;
    border-spacing: 0 4em;
    background: #fff;
    border-bottom: 5px solid transparent;
    background-clip: padding-box
    }
    thead {
    background: #dddcdc
    }
</style>
<body>

<?php require_once "header.php"; ?>

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="rounded">
                <div class="table-responsive table-borderless">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <div class="toggle-btn">
                                        <div class="inner-circle"></div>
                                    </div>
                                </th>
                                <th>Order #</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)){
                            echo "
                            <tr class=\"cell\">
                                <td class=\"text-center\">
                                    <div class=\"toggle-btn\">
                                        <div class=\"inner-circle\"></div>
                                    </div>
                                </td>
                                <td>#{$row['o_id']}</td>
                                ";
                                if($row['status'] == "Processing") {
                                    echo "
                                    <td><span class=\"badge badge-warning\">{$row['status']}</span></td>
                                    ";
                                }
                                if ($row['status'] == "In Transit") {
                                    echo "
                                    <td><span class=\"badge badge-info\">{$row['status']}</span></td>
                                    ";
                                }
                                if ($row['status'] == "Delivered") {
                                    echo "
                                    <td><span class=\"badge badge-success\">{$row['status']}</span></td>
                                    ";
                                }
                                echo "
                                <td>$ {$row['total']}</td>
                                <td>{$row['time']}</td>
                                <td><i class=\"fa fa-ellipsis-h text-black-50\"></i></td>
                            </tr>
                            ";
                            }
                            
                            $empty = "SELECT * FROM orders WHERE acc_no = '$account'";
                            $stmt = mysqli_query($db, $empty);
                            if (mysqli_num_rows($stmt) == 0) {
                                echo "You haven't ordered anything yet. Get shopping!";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>