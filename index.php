<?php
session_start();

if ((isset($_SESSION['auth']) && $_SESSION['auth'] === true)) {
    header("Location: admin.php");
    exit();
}

if (isset($_GET['access'])) {
    $alert_user = true;
}

require 'includes/snippet.php';
require 'includes/db-inc.php';
include 'includes/header.php';

echo "<br>";

if (isset($_POST['submit'])) {
    $username = sanitize(trim($_POST['username']));
    $password = sanitize(trim($_POST['password']));

    $sql_admin = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

    $query = mysqli_query($conn, $sql_admin);
    echo mysqli_error($conn);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $_SESSION['auth'] = true;
            $_SESSION['username'] = $row['username'];
        }
        if ($_SESSION['auth'] === true) {
            header("Location: admin.php");
            
        }
    } else {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong class="d-block text-center">Wrong Username and Password.</strong>
    </div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <style>
    body {
  background-image: url("img/bg1.jpg");
   background-repeat: no-repeat;
  background-size: cover;
  background-position: bottom center;
/* 
  background-color: steelblue; */
  color: #fff;
  font-family: "Montserrat", sans-serif;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  overflow: hidden;
  margin: 0;
  z-index: -2;
}

body::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: -1;
}

.container {
  background-color: steelblue;
  padding: 20px 40px;
  border-radius: 5px;
  box-shadow: 0 2px 10px #fff;
  max-width: 500px;
}
.container a {
  text-decoration: none;
  color: lightblue;
  margin: 10px;
}
form{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  
}
.btn {
  cursor: pointer;
  width: 60%;
  background: lightblue;
  padding: 10px;
  font-family: inherit;
  font-size: 16px;
  border: 0;
  border-radius: 5px;

}

.btn:focus {
  outline: 0;
}

.btn:active {
  transform: scale(0.98);
}

.text {
  margin-top: 30px;
}


.form-control {
  position: relative;
  margin: 20px 0px 40px;
  width: 100%;
}

.form-control input {
  background-color: transparent;
  border: 0;
  border-bottom: 2px solid #fff;
  display: block;
  width: 100%;
  font-size: 18px;
  color: gray;
}

.form-control input:focus,
.form-control input:valid {
  outline: 0;
}

.form-control label {
  position: absolute;
  top: 15px;
  left: 0;
}

.form-control label span {
  display: inline-block;
  font-size: 14px;
  min-width: 5px;
  transition: 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.form-control input:focus + label span,
.form-control input:valid + label span {
  color: lightblue;
  border-bottom-color: lightblue;
  transform: translateY(-25px);
}

#username::placeholder, #password::placeholder{
    color: gray;
}
    </style>


    <div class="container">
        <h1>ADMIN LOGIN</h1>

        <form action="index.php" method="post" role="form">
            <div class="form-control">
                <input type="text" name="username" id="username" required placeholder="Username">
            </div>

            <div class="form-control">
                <input type="password" name="password" id="password" required placeholder="Password">
            </div>

            <button type="submit" name="submit" class="btn">Login</button>
            <p class="text">Browse the available books.<a href="bookslist.php">BooksList</a></p>
        </form>
    </div>
    
    <script src="js/main.js"></script>
</body>