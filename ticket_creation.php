<?php
SESSION_START();
require_once "configuration.php";

// Check if POST data exists (user submitted the form)
if (isset($_POST['submit'])) {
    // Validation checks... make sure the POST data is not empty
    if (empty($_POST['title']) || empty($_POST['body'])) {
        header('Location: support.php?error=EmptyFields');
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $account = $_SESSION["acc_id"];
        // Insert new record into the tickets table
        $sql = "INSERT INTO support (acc_no, title, body, status) VALUES ('$account', '$title', '$body', 'Open')";
        $db->query($sql);
        // Redirect to the view ticket page, the user will see their created ticket on this page
        header('Location: myTickets.php');
    }
}
?>