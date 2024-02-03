<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';

if (isset($_POST['submit'])) {
    $name = sanitize(trim($_POST['name']));
    $username = sanitize(trim($_POST['username']));
    $password1 = sanitize(trim($_POST['password1']));
    $password2 = sanitize(trim($_POST['password2']));
    $email = sanitize(trim($_POST['email']));

    if ($password1 == $password2) {
        $password1 = password_hash($_POST['password1'], PASSWORD_DEFAULT);
        $password2 = password_hash($_POST['password2'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin (adminName, password, username, email) VALUES ('$name', '$password1', '$username', '$email')";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            $success = true;
        } else {
            $error = true;
        }
    } else {
        $passwordMismatch = true;
    }
}
?>

<body style="height:100vh; display: flex; align-items:center; justify-content:center;">
    <div class="container">
        <?php include "includes/nav.php"; ?>
        <div class="container col-lg-9 col-md-11 col-sm-12 col-xs-12 offset-lg-2 offset-md-1 offset-sm-0 offset-xs-0" style="margin-top: 50px;">
            <div class="jumbotron bg-light col-lg-10 col-md-11 col-12">
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Record Added Successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } elseif (isset($error)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed to add record</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } elseif (isset($passwordMismatch)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Passwords do not match!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); padding: .5rem; border-radius: 5px;">
                    <p class="page-header" style="text-align:center; font-size: 20px; font-weight: bold; color: steelblue;  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);">ADD ADMIN</p>
                    <form action="adduser.php" method="post" role="form" class="row g-3">
                        <div class="col-md-2">
                            <label for="name" class="form-label">Full Name</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" placeholder="Enter Full Name" id="name" required>
                        </div>
                        <div class="col-md-2">
                            <label for="username" class="form-label">Username</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="username" placeholder="Enter Username" id="username" required>
                        </div>
                        <div class="col-md-2">
                            <label for="password1" class="form-label">Password</label>
                        </div>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password1" placeholder="Enter Password" id="password1" required>
                        </div>
                        <div class="col-md-2">
                            <label for="password2" class="form-label">Confirm Password</label>
                        </div>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password2" placeholder="Confirm Password" id="password2" required>
                        </div>
                        <div class="col-md-2">
                            <label for="email" class="form-label">Email</label>
                        </div>
                        <div class="col-md-10">
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" id="email" required>
                        </div>
                        <center>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button class="btn btn-info col-lg-4" name="submit" style="color:#fff">Submit</button>
                                </div>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>