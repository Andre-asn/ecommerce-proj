<?php
SESSION_START();
require_once "configuration.php";

$account = $_SESSION["acc_id"];
$sql = "SELECT * FROM orders";
$result = mysqli_query($db, $sql);

$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

if (isset($_POST['submit'])) {
    $getnew = $_POST['status'];
    $getid = $_POST['orderid'];
    $new = "UPDATE orders SET status = '$getnew' WHERE o_id = '$getid'";
    $stmtnew = $db->prepare($new);
    $stmtnew->execute();
    header("location: orders_admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Orders</title>
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

<?php require_once "header_admin.php"; ?>

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
                                <td>
                                <form method=\"POST\">
                                    <select name=\"status\" class=\"form-select\" aria-label=\"statusMenu\">
                                ";
                                if($row['status'] == "Processing") {
                                    echo "
                                        <option value=\"1\" selected>Processing</option>
                                        <option value=\"2\">In Transit</option>
                                        <option value=\"3\">Delivered</option>
                                    ";
                                }
                                if ($row['status'] == "In Transit") {
                                    echo "
                                        <option value=\"1\" >Processing</option>
                                        <option value=\"2\" selected>In Transit</option>
                                        <option value=\"3\" >Delivered</option>
                                    ";
                                }
                                if ($row['status'] == "Delivered") {
                                    echo "
                                        <option value=\"1\" >Processing</option>
                                        <option value=\"2\" >In Transit</option>
                                        <option value=\"3\" selected>Delivered</option>
                                    ";
                                }
                                echo "    
                                    </select>
                                    <input class=\"btn btn-outline-info btn-sm btn-block\" type=\"submit\" name=\"submit\" value=\"Update\">
                                    <input type=\"hidden\" name=\"orderid\" value=\"{$row['o_id']}\">
                                </form>
                                </td>
                                <td>$ {$row['total']}</td>
                                <td>{$row['time']}</td>
                                <td><i class=\"fa fa-ellipsis-h text-black-50\"></i></td>
                            </tr>
                            ";
                            }
                            
                            if (mysqli_num_rows($result) == 0) {
                                echo "No orders have gone through yet!";
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