<html>
<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';

if (isset($_POST['del'])) {
    $id = sanitize(trim($_POST['id']));

    $sql_del = "Delete from books where BookId = $id";
    $error = false;
    $result = mysqli_query($conn, $sql_del);

    if ($result) {
        $error = true;
    }
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
    <div class="container" style=" padding-bottom: 1rem; box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background-color: #fff; border-radius: 10px;">
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
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        
                        <th><center>#</center></th>
                        <th>catagories</th>
                        <th>NumberOfBook</th>
                        
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM books";
                $query = mysqli_query($conn, $sql);
                $count =1;
                $sqlCategories = "SELECT DISTINCT catagories FROM books";
                $resultCategories = mysqli_query($conn, $sqlCategories);

                while ($categoryRow = mysqli_fetch_assoc($resultCategories)) {
                    $category = $categoryRow['catagories'];

                    $sqlTotalQuantity = "SELECT SUM(numOfBook) AS totalQuantity FROM books WHERE catagories = '$category'";
                    $resultTotalQuantity = mysqli_query($conn, $sqlTotalQuantity);
                    $totalQuantity = mysqli_fetch_assoc($resultTotalQuantity)['totalQuantity'];
                ?>
                    <tr onclick="window.location.href = 'booksDetail.php?catagory=<?php echo urlencode($category); ?>';">
                        <td><center><?php echo $count++?></center></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $totalQuantity; ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>