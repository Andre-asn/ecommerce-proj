<?php
SESSION_START();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Support</title>
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
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        height: 100px;
        width: 100px;
        background-size: 100%, 100%;
        border-radius: 50%;
        background-image: none;
    }
    .carousel-control-next-icon:after
    {
        content: '>>';
        font-size: 65px;
        color: darkred;
    }
    .carousel-control-prev-icon:after {
        content: '<<';
        font-size: 65px;
        color: darkred;
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
</style>
<body>

<?php require_once "header.php"; ?>

<div class = "container">
    <form action="ticket_creation.php" method="POST">
        <h2>Contact Us!</h2>
        <div class="form-group">
            <label for="title">Subject</label>
            <input type="text" class="form-control" name="title" placeholder="My figure broke during delivery!" required>
        </div>
        <div class="form-group">
            <label for="body">Details</label>
            <textarea class="form-control" name="body" rows="3" placeholder="This is an outrage! I want a refund :("></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        </div>
    </form>
</body>
</html>
