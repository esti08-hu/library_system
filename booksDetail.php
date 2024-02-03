<?php
require "includes/header.php";
require "includes/db-inc.php";
$catagory = $_GET['catagory'];
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body style="background: radial-gradient(#fff, #AED2FF)">
    <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background: radial-gradient(#FFF, #FFCC70); border-radius: 10px; margin-top: 6rem;">
        <div class="alert col-lg-7 col-md-12 col-sm-12 col-12 offset-lg-2" style="text-align: center; margin-top: 70px;">
            <span class="glyphicon glyphicon-book"></span>
            <strong style="font-size: 20px;"><?php echo $catagory ?> BOOKS</strong>
        </div>
    </div>

    <div class="container" style=" padding-bottom: 1rem; box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background-color: #fff; border-radius: 10px;">
        <div class="row"  style="margin: 1rem;">
            <a style="margin: 1rem 0; width: 13rem;" href="bookstable.php"><button style="width: 100%; " class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-11" style="margin-left: 15px; margin-bottom:5px"><i class="fa-solid fa-angle-left"></i>&nbsp;  Back</button></a>
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
                        <!-- <th>catagories</th> -->
                        <th>callNumber</th>
                        <th>numberOfBook</th>
                        <th>
                            <center>Action</center>
                        </th>
                    </tr>
                </thead>

                <?php
                $catagory = $_GET['catagory'];
                $sql = "SELECT * FROM books WHERE catagories = '$catagory'";
                $result = mysqli_query($conn, $sql);
                // $dsc = '';
                $counter = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tbody>
                            <tr>
                                <td><center><?php echo $counter++ ?></center></td>
                                <td><?php echo $row['bookId'] ?></td>
                                <td><?php echo $row['bookTitle'] ?></td>
                                <td><?php echo $row['author'] ?></td>

                                <td><?php echo $row['publisherName'] ?></td>
                                <!-- <td><?php echo $row['catagories'] ?></td> -->
                                <td><?php echo $row['callNumber'] ?></td>
                                <td><center><?php echo $row['numOfBook'] ?></center></td>
                                <td>
                            <form action="bookstable.php" method="post">
                                <input type="hidden" value="<?php echo $row['bookId']; ?>" name="id">
                                <center>
                                    <a title="mark as done" href="updatebook.php?bookId=<?php echo urlencode($row['bookId']); ?>" class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a> |
                                    <button name="del" type="submit" value="Delete" class="btn btn-danger">
                                        <span class="fas fa-trash"></span>
                                    </button>
                                </center>
                            </form>
                        </tbody>
                    <?php } ?>
            </table>
        <?php } else { ?>

            <?php echo "No books found in the selected category."; ?>

        <?php } ?>

        </div>

    </div>
    <center>
        <div id="book-detail" style="width: 60%; margin: 2rem 0; ">
            <!-- <h3>DISCRIPTION</h3>
            <p>
               <?php echo $dsc;?> 
            </p> -->
        </div>
    </center>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>
