<?php
require "includes/header.php";
require "includes/db-inc.php";
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body style="background: radial-gradient(#fff, #AED2FF)">
<div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background: radial-gradient(#FFF, #FFCC70); border-radius: 10px; margin-top: 6rem;">
<div class="alert col-lg-7 col-md-12 col-sm-12 col-12 offset-lg-2" style="text-align: center; margin-top: 70px;">
            <span class="glyphicon glyphicon-book"></span>
            <strong style="font-size: 20px;">List of Books in the Library</strong>
        </div>
    </div>

    <div class="container" style=" padding-bottom: 1rem; box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background-color: #fff; border-radius: 10px;">
        <div class="row">
            <a style="margin-top: 1rem; width: 13rem;" href="index.php"><button style="width: 100%;" class="btn btn-success col-lg-3 col-md-4 col-sm-12 col-12 me-3 mb-3"><span class="glyphicon glyphicon-home"></span>&nbsp;HOME</button></a>
        </div>

        <div class="panel panel-default">
            <table class="table table-bordered">
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
                <?php
                $sql = "SELECT * from books";
                $query = mysqli_query($conn, $sql);
                $counter = 1;
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <tbody>
                        <tr>
                            <td><center><?php echo $counter++ ?></center></td>
                            <td><?php echo $row['bookId'] ?></td>
                            <td><?php echo $row['bookTitle'] ?></td>
                            <td><?php echo $row['author'] ?></td>

                            <td><?php echo $row['publisherName'] ?></td>
                            <td><?php echo $row['catagories'] ?></td>
                            <td><?php echo $row['callNumber'] ?></td>
                            <td><center><?php echo $row['numOfBook'] ?></center></td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>