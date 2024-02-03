<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';
?>

<head>

        <!-- CSS -->
        <link rel="stylesheet" href="style.css" type="text/css"> 
         <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Bootstrap Bundle with Poper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- FORTAWSOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body style="background: radial-gradient(#fff, #AED2FF)">
    <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background: radial-gradient(#FFF, #FFCC70); border-radius: 10px; margin-top: 6rem;">
        <?php include "includes/nav.php" ?>

        <div class="alert col-lg-7 col-md-12 col-sm-12 col-12 offset-lg-2" style="text-align: center; margin-top: 70px;">
            <span class="glyphicon glyphicon-book"></span>
            <strong style="font-size: 20px;">Currently Issued Books To Students</strong>
        </div>
    </div>

    <div class="container" style=" padding-bottom: 1rem; box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background-color: #fff; border-radius: 10px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row" style="margin: 1rem;">
                    <a style="margin-top: 1rem; width: 13rem;" href="lendbook.php"><button style="width: 100%; " class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-11" style="margin-left: 15px; margin-bottom:5px">Lend Book</button></a>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><center>#</center></th>
                        <th>Book Id</th>
                        <th>Book Title</th>
                        <th>Student Id</th>
                        <th>Issued Date</th>
                        <th>Return Date</th>
                        <th>
                            <center>Actions</center>
                        </th>
                    </tr>
                </thead>
                <?php
               $sql = "SELECT * FROM `books` natural join `borrow`;";
//            $sql = "SELECT *
// FROM books
// JOIN borrow ON books.bookId = borrow.bookId";   
            $result = mysqli_query($conn, $sql);
               $counter = 1;
               
               if (!$result) {
                 die("Query failed: " . mysqli_error($conn));
               } else {
                 while ($row = mysqli_fetch_array($result)) { ?>
                    <tbody>
                        <tr>
                            <td><center><?php echo $counter++; ?></center></td>
                            <td><?php echo $row['bookId']; ?></td>
                            <td><?php echo $row['bookTitle']; ?></td>
                            <td><?php echo $row['studentId']; ?></td>
                            <td><?php echo $row['borrowDate']; ?></td>
                            <td><?php echo $row['returnDate']; ?></td>
                            <td>
                                <center>
                                    <a href="delete_query.php?bookId=<?php echo $row['bookId'] ?>&studentId=<?php echo $row['studentId'] ?>"><button style="width: 80%; color: #fff;" class="btn btn-info" data-toggle="modal">Return</button></a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
                <?php } ?>
               

            </table>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>