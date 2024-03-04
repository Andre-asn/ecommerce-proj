<?php
SESSION_START();
require_once "configuration.php";

if (!(isset($_SESSION['cart']))) {
    $_SESSION['cart'];
}

$sql = "SELECT * FROM products WHERE cat_no = '1'";
$result = mysqli_query($db, $sql);

if (isset($_GET['itemid'])) {
    $id = $_GET['itemid'];
    $qty = $_GET['amount'];
    
    if ($qty > 0 && filter_var($qty, FILTER_VALIDATE_INT)) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $qty;
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    } else {
        header("location: aot.php?invalidqty");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attack on Titan</title>
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
    .container {
        max-width: 1080px;
        margin: 24px auto 48px auto;
    }
    h1 {
        font-family: 'Montserrat', sans-serif;
        text-transform: uppercase;
    }
    .product {
        margin-bottom: 1.5rem;
    }
    .product-image {
        position: relative;
    }
    input#number {
        text-align: center;
        border: none;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        margin: 0px;
        width: 50px;
        height: 40px;
    }
</style>
<body>
    
<?php require_once "header.php"; ?>

<div class = "container">
    <div class = "row">
        <div class ="products-grid col-12">
            <div class = "row">
                <?php
                    while ($row = mysqli_fetch_assoc($result)){
                            echo "
                <div class =\"col-xl-4 col-lg-4 col-sm-6\">
                    <div class =\"product\">
                        <div class=\"product-image\">
                            <img class=\"img-fluid\" src=\"{$row['p_img']}\" alt=\"product\">
                        </div>
                        <div class=\"py-2\">
                            <h3 class=\"h6 mb-1\"><a class =\"text-dark\">{$row['p_name']} Figure</a> <span class=\"text-muted\"> $ {$row['p_cost']}</span></h3>
                            <form action =\"{$_SERVER['PHP_SELF']}\">
                                ";
                                if ($row['p_count'] == 0) {
                                    echo "
                                    <input style=\"max-width: 50px;\" placeholder=\"Qty\" type=\"number\" name=\"amount\" disabled>
                                    <button type=\"submit\" class=\"btn btn-danger\" disabled>Sold Out</button>
                                    ";
                                } else {
                                    echo "
                                    <input style=\"max-width: 50px;\" placeholder=\"Qty\" type=\"number\" name=\"amount\">
                                    <button type=\"submit\" class=\"btn btn-primary\" name=\"addToCart\">Add to Cart</button>
                                    ";
                                }
                                echo "
                                <input type=\"hidden\" name=\"itemid\" value=\"{$row['p_id']}\">
                            </form>
                        </div>
                    </div>
                </div>
    ";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>