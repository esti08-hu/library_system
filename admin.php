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

<style>
  body {
    margin: 0;
    padding: 0;
  }

  a {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s;
    filter: brightness(0.8);
    box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3);
  }

  a:hover {
    transform: scale(1.1);
    filter: brightness(1);
  }

  img {
    width: 10rem;
    padding: 5px;
  }

  .button-container {
    width: 100%;
    display: flex;
    justify-content: center;
  }
</style>
</head>

<body style="background: radial-gradient(#fff, #AED2FF)">
    <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background: radial-gradient(#FFF, #FFCC70); border-radius: 10px; margin-top: 6rem;">
        <?php include 'includes/nav.php'; ?>

        <div class="alert col-lg-7 col-md-12 col-sm-12 col-12 offset-lg-2" style="text-align: center; margin-top: 70px;">
            <strong style="font-size: 20px;">ADMIN DASHBOARD</strong>
        </div>
    </div>
    <div class="row" style="display: flex; align-items: center; justify-content: center;">
    <a style="width: 12rem; margin: 5rem 5rem ; padding: 0;" href="bookstable.php">
  <img src="img/books.png" alt="Books Icon">
  <div class="button-container">
    <button style="width: 10rem;" class="btn btn-success col-lg-3 col-md-4 col-sm-12 col-12 me-3 mb-3">
      All Books
    </button>
  </div>
</a>

<a style="width: 12rem; margin: 5rem 5rem ;" href="viewstudents.php">
  <img src="img/students.png" alt="Students Icon">
  <div class="button-container">
    <button style="width: 10rem;" class="btn btn-success col-lg-3 col-md-4 col-sm-12 col-12 me-3 mb-3">
      Students List
    </button>
  </div>
</a>

<a style="width: 12rem; margin: 5rem 5rem ;" href="borrowedbooks.php">
  <img src="img/borrowedbooks.png" alt="Borrowed Books Icon">
  <div class="button-container">
    <button style="width: 10rem;" class="btn btn-success col-lg-3 col-md-4 col-sm-12 col-12 me-3 mb-3">
      Borrowed Books
    </button>
  </div>
</a>

    </div>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
</body>

</html>
