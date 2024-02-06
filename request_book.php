<?php
require 'includes/db-inc.php';
require 'includes/header.php';
require 'vendor/autoload.php';

$query = "SELECT request_book.*, student.name, student.email, books.bookTitle, books.numOfBook
          FROM request_book
          JOIN student ON request_book.studentId = student.studentId
          JOIN books ON request_book.bookId = books.bookId";
        //   WHERE books.numOfBook = 0";

$result = mysqli_query($conn, $query);
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
            <strong style="font-size: 20px;">Requested Out Of Stock Books</strong>
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
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Book ID</th>
                        <th>Book Title</th>
                        <th>Student Email</th>
                        <th>Num of Books</th>
                        <th>Email Sent</th>
                        <th>Action</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                   $count = 1;
                   while ($row = mysqli_fetch_assoc($result)) {
                       echo "<tr>";
                       echo "<td>{$count}</td>";
                       echo "<td>{$row['name']}</td>";
                       echo "<td>{$row['studentId']}</td>";
                       echo "<td>{$row['bookId']}</td>";
                       echo "<td>{$row['bookTitle']}</td>";
                       echo "<td>{$row['email']}</td>";
                                           
                       // Check if 'numOfBook' is set in $row before using it
                       echo "<td>" . (isset($row['numOfBook']) ? $row['numOfBook'] : '0') . "</td>";
                   
                       echo "<td>" . ($row['email_sent'] == 1 ? 'Yes' : 'No') . "</td>";
                   
                       echo "<td>
                       <center>
                           <a href='notify_students.php?bookTitle={$row['bookId']}&studentId={$row['studentId']}'>
                               <button onclick='sendEmail({$row['studentId']}, \"{$row['bookTitle']}\")' style='width: 80%; color: #0000A6;' class='btn btn-warning'>Send Email</button>
                           </a>
                       </center>
                       </td>";
                   
                       echo "</tr>";
                       $count++;

                   }
                    ?>

                </tbody>

            </table>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>


</body>
