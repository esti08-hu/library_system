<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!(isset($_SESSION['auth']) && $_SESSION['auth'] == true)) {
    header("Location: admin.php");
    exit();
}
if (isset($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
}
?>

<head>
    <link rel="stylesheet" href="../style.css">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="admin.php" class="navbar-brand">Library Management System</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bookstable.php">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Admins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewstudents.php">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="borrowedbooks.php">Issued Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="overDue.php">OverDueBooks</a>
                </li>

            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>