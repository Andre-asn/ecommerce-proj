<?php
// Include config file
require_once "configuration.php";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $username = trim($_POST["uname"]);
    $password = trim($_POST["pwd"]);
    $confpass = trim($_POST["confpwd"]);
    
    // Prepare a select statement
    $sql = "SELECT * FROM accounts WHERE acc_user = '$username'";
    
    //Prepare and execute the prepared statement
    $stmt = $db->prepare($sql);
    $stmt->execute();
    // Store result
    $stmt->store_result();
                
    // If username already exists, throw error
    if($stmt->num_rows == 1){
        header("location: register.php?error=1");
    } else {
        // If password and the confirmation dont match, throw error
        if ($password != $confpass) {
            header("location: register.php?error=2");
        } else {
            $sql = "INSERT INTO accounts (acc_role, acc_user, acc_pass) VALUES ('user', '$username', '$password')";
            $db->query($sql);
            echo "<script>
            alert('Registration successful! Please login using your new account.');
            window.location.href='login.php';
            </script>";
        }
    }
// Close statement
$stmt->close();
// Close connection
$db->close();
}
?>