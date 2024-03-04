<?php
SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Categories</title>
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
    .column {
        width: 100%;
        display: inline-block;
        text-align: center;
    }
    .column img {
        display: block;
        width: 100%;
        height: 300px;
    }
    .column#caption {
        position: relative;
    }
    .column#caption .text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
        opacity: 0;
        transition: all 0.8s ease;
    }
    .column#caption .text h1 {
        margin: 0;
        font-weight: bolder;
        color: #ffffff;
        font-size: xxx-large;
    }
    .column#caption:hover .text {
        opacity: 1;
    }
    .column#caption:hover img {
        -webkit-filter: blur(5px);
    }
</style>
<body>

<?php require_once "header.php"; ?>

<div class = "container">
    <div class = "column">
        <a href = "aot.php" class = "column col-xs-6" id = "caption">
            <span class = "text">
                <h1>Attack on Titan</h1>
            </span>
            <img src = "https://i.pinimg.com/originals/5b/26/26/5b262629a153363a7f0e150a6ca9dffb.png">
        </a>
        <a href = "ds.php" class = "column col-xs-6" id = "caption">
            <span class = "text">
                <h1>Demon Slayer</h1>
            </span>
            <img src = "https://ih0.redbubble.net/cover.1454914.2400x600.jpg">
        </a>
        <a href = "jjk.php" class = "column col-xs-6" id = "caption">
            <span class = "text">
                <h1>Jujutsu Kaisen</h1>
            </span>
            <img src = "https://pbs.twimg.com/media/Ek2UZ7DU8AsANCP?format=jpg&name=large">
        </a>
        <a href = "mha.php" class = "column col-xs-6" id = "caption">
            <span class = "text">
                <h1>My Hero Academia</h1>
            </span>
            <img src = "https://i.pinimg.com/originals/f6/75/56/f67556b42a5bd17977d09626d11e3333.jpg">
        </a>
        <a href = "op.php" class = "column col-xs-6" id = "caption">
            <span class = "text">
                <h1>One Piece</h1>
            </span>
            <img src = "https://i.pinimg.com/originals/ca/be/92/cabe92739a219345f5f1d7b1ea8a2b62.jpg">
        </a>
    </div>
</div>
</body>
</html>