<?php
session_start();
if (!(isset($_SESSION['auth']) && $_SESSION['auth'] === true)) {
    header("Location: index.php");
    exit();
} else {
    // $admin = $_SESSION['admin'];
}
require 'includes/db-inc.php';
include 'includes/header.php';

?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background: radial-gradient(#fff, #AED2FF)">
    <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background: radial-gradient(#FFF, #FFCC70); border-radius: 10px; margin-top: 6rem;">
        <?php include 'includes/nav.php'; ?>

        <div class="alert col-lg-7 col-md-12 col-sm-12 col-12 offset-lg-2" style="text-align: center; margin-top: 70px;">
            <strong style="font-size: 20px;">ADMIN DASHBOARD</strong>
        </div>
    </div>
    <div class="row" style="display: flex; align-items: center; justify-content: center;">

            <a style="width: 12rem; margin: 1rem 2rem ;" href="bookstable.php"> <button style="width: 100%; margin: 0;" class="btn btn-success col-lg-3 col-md-4 col-sm-12 col-12 me-3 mb-3"><span class="glyphicon"></span><i class="fa-solid fa-book"></i> All Books</button></a>
            <a style="width: 12rem; margin: 1rem 2rem ;" href="viewstudents.php"><button style="width: 100%;" class="btn btn-success col-lg-3 col-md-4 col-sm-12 col-12 me-3 mb-3"><span class="glyphicon"></span><i class="fa-solid fa-book-open-reader"></i> Students List</button></a>
            <a style="width: 12rem; margin: 1rem 2rem ;" href="borrowedbooks.php"><button style="width: 100%;" class="btn btn-success col-lg-3 col-md-4 col-sm-12 col-12 me-3 mb-3"><span class="glyphicon"></span><i class="fa-solid fa-book-open"></i> Borrowed Books</button></a>
       
    </div>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
</body>

</html>