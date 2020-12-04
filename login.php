<?php

    include("includes/db_connection.php");
    include("includes/functions.php");

    if (isset($_GET['login'])){
        if ($_GET['login'] == 'success'){
            $successMsg ="<div id='successMsg' class='alert alert-success' role='alert'>
                              <strong>Welcome! Your account was successful</strong><a class='close' data-dismiss='alert'>&times;</a>
                          </div>";
        }
    }

    $successMsg = $errorMessage = "";

    if(isset($_POST['btnLogin'])){

        $email = sanitize_data($_POST['txtEmail']);
        $password = sanitize_data($_POST['txtPassword']);
  
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) < 1 ){
          $errorMessage ='<div id="errorMsg" class="alert alert-danger" role="alert">
                            <strong>Incorrect Username/Email or Password</strong><a class="close" data-dismiss="alert">&times;</a>
                          </div>';
                            
                            
        }elseif(mysqli_num_rows($result) > 0){
  
          while($row =  mysqli_fetch_assoc($result)){
            $hashed_password = $row['password'];
            $id = $row['id'];
            $user_firstname = $row['firstname'];
  
          }
  
          // dehash password and compare
          $check_password = password_verify($password, $hashed_password);
  
          if(!$check_password){
            
            $errorMessage ='<div id="errorMsg" class="alert alert-danger" role="alert">
                              <strong>Incorrect Username/Email or Password</strong><a class="close" data-dismiss="alert">&times;</a>
                            </div>';
                            
                           
          }else{
  
            // User is valid, create sessions
            session_start();
  
            $_SESSION['user_identity'] = $email;
            $_SESSION['id']=TRUE;
            // $_SESSION['firstname'];
            $_SESSION['logged_in'] = $id;
            $user_firstname = $_SESSION['user_firstname'];
  
            // set cookies
            $duration = time(60 * 60 * 24 * 365);
  
            
          
            setcookie('User', $user_id, $duration);
            setcookie('Password', $password, $duration);
  
            header("Location: dashboard.php?login=successful");
  
          }
          
        }
  
      }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cloudify</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
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
        <li class="nav-item active">
          <a class="nav-link" href="login.html">Login <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signup.html">Sign Up</a>
        </li>
    </div>
    </div>
  </nav>

  <div class="container mt-5">      
      <?=$successMsg; ?>
      <?=$errorMessage; ?>
    <form action="login.php" method="POST" style="width: 400px; margin: auto">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="txtEmail" value="<?php echo $email; ?>"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autofocus required>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="txtPassword" class="form-control" id="exampleInputPassword1" required>
        </div>
        <button type="submit" name="btnLogin" class="btn btn-block btn-primary">Submit</button>
      </form>
  </div>
  <footer class="bg-light p-3 mt-auto text-center">
    <p class="mb-0" style="font-size: 0.9rem;">COPYRIGHT © 2019–2020 Cloudify</p>
  </footer>

    <script src="./js/jquery-3.5.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>
</html>