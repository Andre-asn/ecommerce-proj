<?php
// Include config file
require_once "configuration.php";
$id = $role = $this_pass = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $username = trim($_POST["uname"]);
    $password = trim($_POST["pwd"]);
    
    // Prepare a select statement
    $sql = "SELECT acc_id, acc_role, acc_user, acc_pass FROM accounts WHERE acc_user = '$username'";
    
    //Prepare and execute the prepared statement
    $stmt = $db->prepare($sql);
    $stmt->execute();
    // Store result
    $stmt->store_result();
                
    // Check if username exists, if yes then verify password
    if($stmt->num_rows == 1){
                
        // Bind & fetch result variables
        $stmt->bind_result($id, $role, $username, $this_pass);
        $stmt->fetch();
                    
        if($password == $this_pass) {
            
            if ($role == "admin") {
                
                // If password is correct, start a new session
                SESSION_START();                
                // Store data in session variables
                $_SESSION["condition"] = TRUE;
                $_SESSION["acc_id"] = $id;
                $_SESSION["acc_user"] = $username;
                $_SESSION["acc_role"] = $role;   
                            
                // Redirect user to welcome page
                header("location: home_admin.php");
                
            } elseif ($role == "user") {
                
                // If password is correct, start a new session
                SESSION_START();                
                // Store data in session variables
                $_SESSION["condition"] = TRUE;
                $_SESSION["acc_id"] = $id;
                $_SESSION["acc_user"] = $username;
                $_SESSION["acc_role"] = $role;   
                            
                // Redirect user to welcome page
                header("location: home.php");
                
            }
        } else {
            // Password is not valid, redirect + error
            header("location: login.php?error=1");
        }
    } else {
        // Username doesn't exist, redirect + error
        header("location: login.php?error=2");
    }
// Close statement
$stmt->close();
// Close connection
$db->close();
}
?>