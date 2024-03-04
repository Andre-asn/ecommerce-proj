<?php
SESSION_START();
require_once "configuration.php";

$ticket_id = $_SESSION['ticket_id'];
$role = $_SESSION['acc_role'];

// MySQL query that selects the ticket by the ID column, using the ID GET request variable
$sql = "SELECT * FROM support WHERE ticket_id = '$ticket_id'";
$ticketresult = mysqli_query($db, $sql);

// Update status
if (isset($_POST['submit'])) {
    $getnew = $_POST['status'];
    $new = "UPDATE support SET status = '$getnew' WHERE ticket_id = '$ticket_id'";
    $stmt = $db->prepare($new);
    $stmt->execute();
    header("location: viewTicket.php?id=$ticket_id");
}

// Check if the comment form has been submitted
if (isset($_POST['submit'])) {
    if (!empty($_POST['msg'])) {
        $msg = $_POST['msg'];
    // Insert the new comment into the "responses" table
        $sql = "INSERT INTO responses (support_id, acc_role, comment_body) VALUES ('$ticket_id', '$role', '$msg')";
        $db->query($sql);
        header("location: viewTicket.php?id=$ticket_id");
    }
}
$comments = "SELECT * FROM responses WHERE support_id = '$ticket_id' ORDER BY comment_time ASC";
$responseresult = mysqli_query($db, $comments);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticket View</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/f76a8e4e05.js" crossorigin="anonymous"></script>
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
        background: #FFFFFF;
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
    .content h2 {
        margin: 0;
        padding: 25px 0;
        font-size: 22px;
        border-bottom: 1px solid #ebebeb;
        color: #666666;
        text-align: center;
    }
    .home .tickets-list .ticket {
        padding: 15px 0;
        width: 100%;
        border-bottom: 1px solid #ebebeb;
        display: flex;
        text-decoration: none;
    }
    .home .tickets-list .ticket .con {
        display: flex;
        justify-content: center;
        flex-flow: column;
    }
    .home .tickets-list .ticket .title {
        font-weight: 600;
        color: #000000;
    }
    .home .tickets-list .ticket .body {
        font-weight: 450;
        color: #666666;
    }
    .home .tickets-list .ticket .time {
        flex-grow: 1;
        align-items: center;
        color: #999999;
        font-size: 14px;
    }
    .content {
        width: 1000px;
        margin: 0 auto;
    }
    .btns {
        display: flex;
    }
    .btns .btn {
        display: inline-block;
        text-decoration: none;
        background-color: #38b673;
        font-weight: bold;
        font-size: 14px;
        border-radius: 5px;
        color: #FFFFFF;
        padding: 10px 15px;
        margin: 15px 10px 15px 0;
    }
    .btns .btn:hover {
        background-color: #32a367;
    }
    .btns .btn.red {
        background-color: #b63838;
    } 
    .btns .btn.red:hover {
        background-color: #a33232;
    }
    .view .comments {
        margin-top: 15px;
        border-top: 1px solid #ebebeb;
        padding: 25px 0;
    }
    .view .comments .comment {
        display: flex;
        padding-bottom: 5px;
    }
    .view .comments .comment div {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        width: 70px;
        color: #e6e6e6;
        transform: scaleX(-1);
    }
    .view .comments .comment p {
        margin: 0 0 20px 0;
    }
    .view .comments .comment p span {
        display: flex;
        font-size: 14px;
        padding-bottom: 5px;
        color: gray;
    }
    i {
        text-align: center;
        width: 80px;
        color: lightblue;
    }
</style>
<body>

<?php 
if ($_SESSION['acc_role'] == "admin") {
    require_once "header_admin.php";
} elseif ($_SESSION['acc_role'] == "user")
    require_once "header.php"; 
?>

<div class="content view">

    <?php
    while ($ticketrow = mysqli_fetch_assoc($ticketresult)) {
    echo "
	<h2>{$ticketrow['title']}<span class=\"{$ticketrow['status']}\">...{$ticketrow['status']}</span></h2>

    <div class=\"ticket\">
        <p class=\"created\">{$ticketrow['time']}</p>
        <p class=\"msg\">{$ticketrow['body']}</p>
    </div>
    ";
    }
    ?>

    <?php
    if ($_SESSION['acc_role'] == "admin") {
        echo "
        <form method=\"POST\">
            <select name=\"status\" class=\"form-select\" aria-label=\"statusMenu\">
                <option selected>Select Status</option>
                <option value=\"1\">Closed</option>
                <option value=\"2\">Solved</option>
                <option value=\"3\">Open</option>
            </select>
            <input style=\"width: 70px;\" class=\"btn btn-outline-info btn-sm btn-block\" type=\"submit\" name=\"submit\" value=\"Update\">
        </form> ";
    }
    ?>

    <div class="comments">
        <?php
        while ($responserow = mysqli_fetch_assoc($responseresult)) {
            echo "
        <div class=\"comment\">
            <div>
                <i class=\"fas fa-comment fa-2x\"></i>
            </div>
            <p>
                <span>{$responserow['acc_role']}... {$responserow['comment_time']}</span>
                {$responserow['comment_body']}
            </p>
        </div>
        ";
        }
        ?>
            <form method="POST">
            <textarea name="msg" placeholder="Enter your comment..."></textarea>
            <div class="btns"> 
                <input type="submit" name="submit" value="Post Comment">
            </div> 
        </form>
    </div>
</div>
</body>
</html>