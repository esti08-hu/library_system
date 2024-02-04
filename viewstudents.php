<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body style="background: radial-gradient(#fff, #AED2FF)">
    <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background: radial-gradient(#FFF, #FFCC70); border-radius: 10px; margin-top: 6rem;">
        <?php include "includes/nav.php"; ?>

        <div class="alert col-lg-7 col-md-12 col-sm-12 col-xs-12 offset-lg-2 offset-md-0 offset-sm-1" style="text-align: center; margin-top: 70px;">
            <span class="glyphicon glyphicon-book"></span>
            <strong style="font-size: 20px;">Student Table</strong>
        </div>
    </div>

    <div class="container" style=" padding-bottom: 1rem; box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background-color: #fff; border-radius: 10px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row" style="margin: 1rem;">
                    <a style="margin-top: 1rem; width: 13rem;" href="addstudent.php"><button style="width: 100%; " class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-11" style="margin-left: 15px; margin-bottom:5px"><i class="fa-solid fa-plus"></i> Add Student</button></a>
                </div>
            </div>

            <!-- Add the search form and button -->
            <div class="row" style='width:25rem; margin-left:5px'>
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Search by student Id">
                        <div class="input-group-append">
                            <button style='margin-left:3px'  class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            // Check if the search form is submitted for the second table
            if (isset($_GET['search'])) {
                // Get the search term from the user
                $searchTerm = $_GET['search'];

                // Prepare the SQL query for the second table
                $sqlSecondTable = "SELECT * FROM student WHERE studentId LIKE '%$searchTerm%'";

                // Execute the query for the second table
                $resultSecondTable = $conn->query($sqlSecondTable);

                // Check if any results were found for the second table
                if ($resultSecondTable->num_rows > 0) {
                    echo '<div class="row" style="margin: 1rem;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Phone no.</th>
                            <th><center>REMOVE</center></th>
                        </tr>
                    </thead>
                    <tbody>';
                    $counter = 1;
                    while ($row = $resultSecondTable->fetch_assoc()) {
                        echo '<tr>
                    <td>' . $counter++ . '</td>
                    <td>' . $row['studentId'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['department'] . '</td>
                    <td>' . $row['phoneNumber'] . '</td>
                    <td>
                        <form action="viewstudents.php" method="post">
                            <input type="hidden" value="' . $row['studentId'] . '" name="del_btn">
                            <center><button type="submit" name="submit" style="color: #fff;" class="btn btn-danger"><span class="fas fa-trash"></button></center>
                        </form>
                    </td>
                </tr>';
                    }
                    echo '</tbody>
                </table>
              </div>';
                } else {
                    echo '<div class="row" style="margin: 1rem;">
                <div class="alert alert-warning" role="alert">
                    No results found for the second table.
                </div>
              </div>';
                }
            } else {
                $sqlAllStudents = "SELECT * FROM student";
                $resultAllStudents = $conn->query($sqlAllStudents);

                if ($resultAllStudents->num_rows > 0) {
                    echo '<div class="row" style="margin: 1rem;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Phone no.</th>
                            <th><center>REMOVE</center></th>
                        </tr>
                    </thead>
                    <tbody>';
                    $counter = 1;
                    while ($row = $resultAllStudents->fetch_assoc()) {
                        echo '<tr>
                    <td>' . $counter++ . '</td>
                    <td>' . $row['studentId'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['department'] . '</td>
                    <td>' . $row['phoneNumber'] . '</td>
                    <td>
                        <form action="viewstudents.php" method="post">
                            <input type="hidden" value="' . $row['studentId'] . '" name="del_btn">
                            <center><button type="submit" name="submit" style="color: #fff;" class="btn btn-danger"><span class="fas fa-trash"></button></center>
                        </form>
                    </td>
                </tr>';
                    }
                    echo '</tbody>
                </table>
              </div>';
                } else {
                    echo '<div class="row" style="margin: 1rem;">
                <div class="alert alert-warning" role="alert">
                    No students found.
                </div>
              </div>';
                }
            }

            ?>

        </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>