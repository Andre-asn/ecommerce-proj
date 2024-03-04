<?php
SESSION_START();
require_once "configuration.php";

if (!(isset($_SESSION['cart']))) {
    $_SESSION['cart'];
}

if (isset($_POST['submit'])) {
    $id = $_POST['itemid'];
    $qty = $_POST['qty'];
    if ($qty > 0 && filter_var($qty, FILTER_VALIDATE_INT)) {
        $_SESSION['cart'][$id] = $qty;
        header("location: cart.php");
    } elseif ($qty == 0) {
        unset($_SESSION['cart'][$id]);
        header("location: cart.php");
    } else {
        header("location: cart.php?invalidqty");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
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
    h3 {
        text-align: left;
    }
    .btn.btn-black {
        background: #000;
        color: #fff;
    }
    .site-blocks-table .btn {
        padding: 2px 10px;
    }
    .btn.btn-outline-info, .btn.btn-outline-danger, .btn.btn-outline-light, .btn.btn-success {
        padding-top: 15px;
        padding-bottom: 15px;
        padding-left: 30px;
        padding-right: 30px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .05rem;
        border-radius: 0;
    }
    #cartView img {
        max-width: 35%;
        max-height: 35%;
        display: block;
    }
</style>
<body>
<?php require_once "header.php"; ?>
<div class="container">
    <div class="row mb-5">
        <form class="col-md-12" method="post">
            <div class="site-blocks-table">
                <table id="cartView" class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="product-thumbnail">Image</th>
                        <th class="product-name">Product</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-price">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $total = 0;
                    foreach($_SESSION['cart'] as $key => $val) {
                        $sqlcart = "SELECT * FROM products WHERE p_id = '$key'";
                        $resultcart = mysqli_query($db, $sqlcart) or die("Invalid: $sqlcart");
                        $cartrow = mysqli_fetch_assoc($resultcart);
                        $sub = $val*$cartrow['p_cost'];
                        $_SESSION['globaltotal'] = $total += $sub;
                        echo "
                    <tr>
                        <td class=\"product-thumbnail\">
                            <img src=\"{$cartrow['p_img']}\" alt=\"Image\" class=\"img-fluid\">
                        </td>
                        <td class=\"product-name\">
                            <h2 class=\"h5 text-black\">{$cartrow['p_name']}</h2>
                        </td>
                        <td>
                            <div class=\"input-group mb-3\" style=\"max-width: 120px;\">
                            <form method = \"POST\">
                                <input style=\"max-width: 50px;\" value=\"$val\" type=\"number\" name=\"qty\"> 
                                <input class=\"btn btn-outline-info btn-sm btn-block\" type=\"submit\" name=\"submit\" value=\"Update\">
                                <input type=\"hidden\" name=\"itemid\" value=\"$key\">
                            </form>
                            </div>
                        </td>
                        <td>$ $sub</td>
                    </tr>
                        ";
                        }
                        
                        if(empty($_SESSION['cart'])) {
                            echo "Your cart is empty!";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row mb-5">
                <div class="col-md-6">
                    <button class="btn btn-outline-light btn-sm btn-block" onclick="window.location='categories.php'">Continue Shopping</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-outline-danger btn-sm btn-block" onclick="window.location='emptycart.php'">Clear Cart</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                            <h3 class="text-black h4 text-uppercase">Total</h3>
                            <?php
                            echo "
                            <p class=\"text-left\">$ $total</p>
                            ";
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>