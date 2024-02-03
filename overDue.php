<?php
require('mail.php');
require_once('includes/db-inc.php');
require('vendor/autoload.php');
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
            <strong style="font-size: 20px;">Over Due Books</strong>
        </div>
    </div>
    <div class="container" style=" padding-bottom: 1rem; box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background-color: #fff; border-radius: 10px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row" style="margin: 1rem;">
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Book Id</th>
                        <th>Student Id</th>
                        <th>Return Date</th>
                        <th>
                            <center>Actions</center>
                        </th>
                    </tr>
                </thead>
                <?php
                $query = "SELECT * FROM borrow WHERE returnDate < CURDATE()";
                $counter = 1;
                $result = $conn->query($query);

                if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                } else {
                    // Process the query result
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                        <tbody>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $row['bookId']; ?></td>
                                <td><?php echo $row['studentId']; ?></td>
                                <td><?php echo $row['returnDate']; ?></td>
                                <td>
                                    <center>
                                        <a href="mail.php?bookTitle=<?php echo $row['bookId'] ?>&studentId=<?php echo $row['studentId'] ?>">
                                            <button style="width: 80%; color: #0000A6;" class="btn btn-warning" data-toggle="modal">send email</button>
                                        </a>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>