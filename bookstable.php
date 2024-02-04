<!DOCTYPE html>
<html lang="en">

<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';

if (isset($_POST['del'])) {
    $id = sanitize(trim($_POST['id']));

    $sql_del = "DELETE FROM books WHERE bookId = $id";
    $error = false;
    $result = mysqli_query($conn, $sql_del);

    if ($result) {
        $error = true;
    }
}
$sqlCategories = "SELECT DISTINCT catagories FROM books";
$resultCategories = mysqli_query($conn, $sqlCategories);

if (isset($_GET['search'])) {
    $searchTerm = sanitize(trim($_GET['search']));

    $sqlSearch = "SELECT * FROM books WHERE bookId LIKE '%$searchTerm%'";
    $resultSearch = mysqli_query($conn, $sqlSearch);
} else {
    $sql = "SELECT * FROM books";
    $query = mysqli_query($conn, $sql);
    $count = 1;
}
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body style="background: radial-gradient(#fff, #AED2FF)">
    <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background: radial-gradient(#FFF, #FFCC70); border-radius: 10px; margin-top: 6rem;">
        <?php include "includes/nav.php"; ?>

        <div class="alert col-lg-7 col-md-12 col-sm-12 col-12 offset-lg-2" style="text-align: center; margin-top: 70px;">
            <span class="bi bi-book"></span>
            <strong style="font-size: 20px;">Books Table</strong>
        </div>
    </div>
    <div class="container" style="padding-bottom: 1rem; box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background-color: #fff; border-radius: 10px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php if (isset($error) === true) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Record Deleted Successfully!</strong>
                    </div>
                <?php } ?>

                <div class="row" style="margin: 1rem;">
                    <a style="margin-top: 1rem; width: 13rem;" href="addbook.php"><button style="width: 100%; " class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-11" style="margin-left: 15px; margin-bottom:5px"><i class="fa-solid fa-plus"></i> Add Book</button></a>
                </div>

                <!-- Add the search form -->
                <form action="" method="GET" style='width:25rem; margin-left:5px'>
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search"  placeholder="Search by BookId">
                        <div class="input-group-append">
                            <button style="margin-left: 3px" class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <?php
            if (isset($_GET['search'])) {
                if (mysqli_num_rows($resultSearch) > 0) {
                    echo '<div class="row" style="margin: 1rem;">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th><center>#</center></th>
                                <th>BoookId</th>
                                <th>BoookTitle</th>
                                <th>author</th>
        
                                <th>publisherName</th>
                                <th>catagories</th>
                                <th>callNumber</th>
                                <th>numberOfBook</th>
                                </tr>
                            </thead>
                            <tbody>';

                    $count = 1;
                    while ($row = mysqli_fetch_assoc($resultSearch)) {
                        echo '<tr>
                                <td><center>' . $count++ . '</center></td>
                                <td>' . $row['bookId'] . '</td>
                                <td>' . $row['bookTitle'] . '</td>
                                <td>' . $row['author'] . '</td>
                                <td>' . $row['publisherName'] . '</td>
                                <td>' . $row['catagories'] . '</td>
                                <td>' . $row['callNumber'] . '</td>
                                <td>' . $row['numOfBook'] . '</td>
                            </tr>';
                    }

                    echo '</tbody>
                        </table>
                    </div>';
                } else {
                    echo '<div class="row" style="margin: 1rem;">
                            <div class="alert alert-warning" role="alert">
                                No results found for the search.
                            </div>
                        </div>';
                }
            } else
             {
                echo '<table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><center>#</center></th>
                            <th>Categories</th>
                            <th>NumberOfBook</th>
                        </tr>
                    </thead>
                    <tbody>';
            
                while ($categoryRow = mysqli_fetch_assoc($resultCategories)) {
                    $category = $categoryRow['catagories'];
            
                    $sqlTotalQuantity = "SELECT SUM(numOfBook) AS totalQuantity FROM books WHERE catagories = '$category'";
                    $resultTotalQuantity = mysqli_query($conn, $sqlTotalQuantity);
                    $totalQuantity = mysqli_fetch_assoc($resultTotalQuantity)['totalQuantity'];
            
                    echo '<tr onclick="window.location.href = \'booksDetail.php?catagory=' . urlencode($category) . '\';">
                        <td><center>' . $count++ . '</center></td>
                        <td>' . $category . '</td>
                        <td>' . $totalQuantity . '</td>
                    </tr>';
                }
            
                echo '</tbody>
                </table>';
            }
            ?>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>';