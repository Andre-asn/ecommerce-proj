<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <nav class="navbar navbar-dark bg-danger">
        <span class="navbar-brand mb-0 h1">Anime Axis</span>
    </nav>

  <form action="register_valid.php" method = "post">

    <div class="form-group">
        <div class="col-4">
            <label for="uname">Username:</label>
            <input type="text" class="form-control" name="uname" placeholder="NarutoRules564" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-4">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="pwd" placeholder="mysupersecretpassword" required>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-4">
            <label for="confpwd">Confirm Password:</label>
            <input type="password" class="form-control" name="confpwd" placeholder="mysupersecretpassword" required>
        </div>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit Registration</button>
    </div>
  </form>
    Have an account already? Login here :)
    <button class="btn btn-success" onclick="window.location='login.php'">To Login Page</button>
</div>
</body>
</html>
