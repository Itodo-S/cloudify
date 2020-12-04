<?php 
include("includes/db_connection.php");
include("includes/functions.php");
$errorMessage = "";

    if(isset($_POST['btnSubmit'])){
      
      $firstName = sanitize_data($_POST['txtFirstname']);
      $lastName = sanitize_data($_POST['txtLastname']);
      $email = sanitize_data($_POST['txtEmail']);
      $password1 = sanitize_data($_POST['txtPassword1']);
      $password2 = sanitize_data($_POST['txtPassword2']);

        if ($password1 != $password2) {
          $errorMessage = "password do not match";
        }else {

          $hashed_password = password_hash($password1, PASSWORD_DEFAULT);        
          $sql = "INSERT INTO users (firstname,lastname,email,`password`) VALUES('$firstName','$lastName','$email','$hashed_password')";
          $result = mysqli_query($conn,$sql);

          if (!$result) {
              die("Ooops! Something went wrong ");
          }else{
              header("location: login.php?login=success");
          }
        }        
    }


?>
WHERE IS MY FREE WIFI AND COFEE !!!!

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Cloudify</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="index.html">Cloudify</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="login.html">Login</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="signup.html">Sign Up <span class="sr-only">(current)</span></a>
        </li>
    </div>
    </div>
  </nav>

  <div class="container mt-5">
    <form style="width: 400px; margin: auto" action="signup.php" method="post">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputFirstName">First Name</label>
                    <input type="text" class="form-control" id="exampleInputFirstName" aria-describedby="emailHelp" name="txtFirstname" autofocus required>
                  </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputLastName">Last Name</label>
                    <input type="text" class="form-control" id="exampleInputLastName" aria-describedby="emailHelp" name="txtLastname" required>
                  </div>
            </div>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtEmail" required>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1" >Password</label>
          <input type="password" [class.is-invalid]="name.invalid && name.touch" class="form-control" id="exampleInputPassword1" name="txtPassword1" required>
          <small class="is-valid-feedback"><?=$errorMessage; ?></small>
        </div>
        <div class="form-group">
          <label for="exampleInputConfirmPassword">Confirm Password</label>
          <input type="password" [class.is-invalid]="name.invalid && name.touch" class="form-control" id="exampleInputConfirmPassword" name="txtPassword2" required>
          <small class="is-valid-feedback"><?=$errorMessage; ?></small>
        </div>
        <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
      </form>
  </div>
  <footer class="bg-light p-3 mt-auto text-center">
    <p class="mb-0" style="font-size: 0.9rem;">COPYRIGHT © 2019–2020 Cloudify</p>
  </footer>

    <script src="./js/jquery-3.5.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>
</html>