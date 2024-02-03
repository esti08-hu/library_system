<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';
$bdate = date('Y-m-d');
if (isset($_POST['submit'])) {
    $studentId = trim($_POST['studentID']);
    $due = trim($_POST['dueDate']);
    $bookId = trim($_POST['bookId']);

    $query1 = "SELECT * FROM student WHERE studentId = ?";
    $query2 = "SELECT * FROM books WHERE bookId = ?";

    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param('s', $studentId);
    $stmt1->execute();
    $studentResult = $stmt1->get_result();

    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param('s', $bookId);
    $stmt2->execute();
    $bookResult = $stmt2->get_result();

    if ($studentResult->num_rows > 0 && $bookResult->num_rows > 0) {
        // The $bookId exists in the table
        $sql = "SELECT studentId FROM borrow WHERE studentId=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $studentId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rowCount = mysqli_num_rows($result);

        if ($rowCount > 0) {
            $msg = "Please return the borrowed book first!";
        } else {
            if ($due < $bdate) {
                // header('Location: lendbook.php');
                echo "<script type='text/javascript'>alert('Invalid return date.');</script>";
            } else {
                $sql = "SELECT numOfBook FROM books WHERE bookId = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $bookId);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($currentSize);

                if ($stmt->fetch()) {
                    $newSize = $currentSize - 1;

                    $updateSql = "UPDATE books SET numOfBook = ? WHERE bookId = ?";
                    $updateStmt = $conn->prepare($updateSql);
                    $updateStmt->bind_param("ii", $newSize, $bookId);
                    $updateStmt->execute();
                    $updateStmt->close();

                }
                $stmt->close();

                $sql = "INSERT INTO borrow (studentId, bookId, borrowDate, returnDate) values ('$studentId', '$bookId', '$bdate', '$due')";
                $query = mysqli_query($conn, $sql);

                if ($query) {
                    echo "<script type='text/javascript'>alert('Success');
            document.write('');   
            </script>";
                    header('Location: borrowedbooks.php');
                } else {
                    echo "<script>alert('Unsuccessful');</script>";
                }
            }
        }
    } else {
        // The $studentId or $bookId does not exist in the table
        $msg = "Either studentId or bookId (or both) do not exist!";
    }
}
?>

<body style="display:flex; align-items:center; justify-content: center;">

    <div class="container">
        <?php include "includes/nav.php"; ?>
        <div class="container col-lg-9 col-md-11 col-sm-12 col-xs-12 offset-lg-2 offset-md-1 offset-sm-0 offset-xs-0" style="margin-top: 50px;">
            <div class="jumbotron bg-light col-lg-10 col-md-11 col-12" style="margin-top: 5rem;">

                <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); padding: .5rem; border-radius: 5px; margin-top: 3rem;">
                    <p class="page-header" style="text-align:center; font-size: 20px; font-weight: bold; color: steelblue;  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);">LEND BOOK</p>
                    <div style="width: 380px; height: 24px; color: red;"><strong><span class="loginMsg"><?php echo @$msg; ?></span></strong></div>
                    <hr>
                    <form action="#" class="row g-3" role="form" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="Book ID" class="form-label">Book ID</label>
                            <div class="col-sm-10">
                                <input type="text" name="bookId" id="bookId" class="form-control" value="<?php ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="student ID" class="form-label">Student ID</label>
                            <div class="col-sm-10">
                                <input type="text" name="studentID" id="studentID" class="form-control" value="<?php ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Borrow Date" class="form-label">BORROW DATE</label>
                            <div class="col-sm-10">
                                <input type="date" name="borrowDate" id="borrowDate" class="form-control" readonly value="<?php echo $bdate?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">RETURN DATE</label>
                            <div class="col-sm-10" id="show_product">
                                <input type="date" name="dueDate" id="dueDate" class="form-control" value="<?php ?>">
                            </div>
                        </div>

                        <center>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button class="btn btn-info col-lg-4" name="submit" style="color:#fff">Submit</button>
                                </div>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

</body>