<?php
SESSION_START();
require_once "configuration.php";

$sql = "SELECT * FROM products";
$result = mysqli_query($db, $sql);

if (isset($_POST['submit'])) {
    $id = $_POST['itemid'];
    $inv = $_POST['inv'];
    if ($inv > 0 && filter_var($inv, FILTER_VALIDATE_INT)) {
        $update  = "UPDATE products SET p_count = '$inv' WHERE p_id = '$id'";
        $stmt = $db->prepare($update);
        $stmt->execute();
        header("location: products_admin.php");
    } elseif ($inv == 0) {
        $update = "UPDATE products SET p_count = '0' WHERE p_id = '$id'";
        $stmt = $db->prepare($update);
        $stmt->execute();
        header("location: products_admin.php");
    } else {
        header("location: products_admin.php?invalidqty");
    }
}
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inventory Management</title>
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
    #prodInv img {
        max-width: 35%;
        max-height: 35%;
        display: block;
    }
</style>
<body>
<?php require_once "header_admin.php"; ?>
<div class="container">
    <div class="row mb-5">
        <form class="col-md-12" method="post">
            <div class="site-blocks-table">
                <table id="prodInv" class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="category-id">Category #</th>
                        <th class="product-id">Product #</th>
                        <th class="product-thumbnail">Product Image</th>
                        <th class="product-name">Product Name</th>
                        <th class="inventory">Inventory</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()){
                        echo "
                    <tr>
                        <td class=\"category-id\">
                            <h1 class=\"h1 text-black\">#{$row['cat_no']}</h2>
                        </td>
                        <td class=\"product-id\">
                            <h1 class=\"h1 text-black\">#{$row['p_id']}</h2>
                        </td>
                        <td class=\"product-thumbnail\">
                            <img src=\"{$row['p_img']}\" alt=\"Image\" class=\"img-fluid\">
                        </td>
                        <td class=\"product-name\">
                            <h2 class=\"h2 text-black\">{$row['p_name']}</h2>
                        </td>
                        <td>
                            <div class=\"input-group mb-3\" style=\"max-width: 120px;\">
                            <form method = \"POST\">
                                <input style=\"max-width: 50px;\" value=\"{$row['p_count']}\" type=\"number\" name=\"inv\"> 
                                <input class=\"btn btn-outline-info btn-sm btn-block\" type=\"submit\" name=\"submit\" value=\"Update\">
                                <input type=\"hidden\" name=\"itemid\" value=\"{$row['p_id']}\">
                            </form>
                            </div>
                        </td>
                    </tr>
                        ";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</body>
</html>
