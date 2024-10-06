<?php
SESSION_START();
require_once "configuration.php";

$account = $_SESSION["acc_id"];
// MySQL query that retrieves all the tickets from the database
$sql = "SELECT * FROM support ORDER BY time DESC";
$result = mysqli_query($db, $sql);

if (isset($_POST['submit'])) {
    $_SESSION['ticket_id'] = $ticket_id = $_POST['ticket_id'];
    header("location: viewTicket.php?id=$ticket_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Tickets</title>
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
    o {
        text-align: center;
        width: 80px;
        color: orange;
    }
    i {
        text-align: center;
        width: 80px;
        color: green;
    }
    c {
        text-align: center;
        width: 80px;
        color: red;
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
</style>
<body>

<?php require_once "header_admin.php"; ?>

<div class="content home">
	<h2>Tickets</h2>
	<p style="text-align: center;">You can view the list of your tickets below.</p>
	<div class="tickets-list">
		<?php 
		while ($row = mysqli_fetch_assoc($result)) {
		    echo "
		<form class=\"ticket\" method=\"POST\">
			<span class=\"con\">
			"; ?>
				<?php 
				if ($row['status'] == 'Open') {
				    echo "
				    <o class=\"far fa-clock fa-2x\"></i>
				    ";
				}
				else if ($row['status'] == 'Solved') {
				    echo "
				    <i class=\"fas fa-check fa-2x\"></i>
				    ";
				}
				else if ($row['status'] == 'Closed') {
				    echo "
				    <c class=\"fas fa-times fa-2x\"></i>
				    ";
				}
				?>
				<?php
				echo "
			</span>
			<span class=\"con\">
				<span class=\"title\">{$row['title']}</span>
				<span class=\"body\">{$row['body']}</span>
			</span>
			    <span class=\"con time\">{$row['time']}<input style=\"width: 50px;\"class=\"btn btn-outline-info btn-sm btn-block\" type=\"submit\" name=\"submit\" value=\"View\"></span>
		</a>
		<input type=\"hidden\" name=\"ticket_id\" value=\"{$row['ticket_id']}\">
		</form>
		";
		}
		?>
	</div>
</div>
</body>
</html>