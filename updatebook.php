<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';
$bdate = date('Y-m-d');
$msg = "";
$color = "";


$bookId = $_GET['bookId'];

$sql = "SELECT * FROM books WHERE bookId = '$bookId'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

$title =  $row['bookTitle'];
$author = $row['author']; 
$publisher = $row['publisherName'];
$catagories = $row['catagories']; 
$call = $row['callNumber']; 
$size = $row['numOfBook']; 


if(isset($_POST['update'])) {
    $title = sanitize(trim($_POST['title']));
    $author = sanitize(trim($_POST['author']));
    $publisher = sanitize(trim($_POST['publisher']));
    $catagories = sanitize(trim($_POST['catagories']));
    $call = sanitize(trim($_POST['call']));
    $size = sanitize(trim($_POST['size']));
    


    $sql = "UPDATE books SET `bookTitle` = ?, `author` = ?, `publisherName` = ?, `catagories` = ?, `callNumber` = ?, `numOfBook` = ? WHERE `bookId` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssiii", $title, $author, $publisher, $catagories, $call, $size, $bookId);
        $executeResult = mysqli_stmt_execute($stmt);
    
        if ($executeResult) {
            $msg = "Update successful.";
            $color = "green";
        } else {
            $msg = "Execution error: " . mysqli_stmt_error($stmt);
            $color = "red";
        }
    } else {
        $msg = "Prepare error: " . mysqli_error($conn);
        $color = "red";
    }
}
?>
<body style="display:flex; align-items:center; justify-content: center;">

    <div class="container">
        <?php include "includes/nav.php"; ?>
        <div class="container col-lg-9 col-md-11 col-sm-12 col-xs-12 offset-lg-2 offset-md-1 offset-sm-0 offset-xs-0" style="margin-top: 50px;">
            <div class="jumbotron bg-light col-lg-10 col-md-11 col-12" style="margin-top: 5rem;">
                <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); padding: .5rem; border-radius: 5px; margin-top: 3rem;">
                    <p class="page-header" style="text-align:center; font-size: 20px; font-weight: bold; color: steelblue;  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);">EDIT BOOK</p>
                    <div style="width: 300px; height: 24px; color: green;"><strong><span><?php echo '<p style="color: ' . $color . ';">' . $msg . '</p>'; ?></span></strong></div>
                                        <hr>
                    <form action="#" class="row g-3" role="form" method="post" enctype="multipart/form-data">

                       
                    <div class="form-group">
                            <div class="col-12">
                                <label for="Title" class="form-label">BOOK TITLE</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title" id="password" value="<?php echo $title; ?>" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="Author" class="form-label">AUTHOR</label>
                            <input type="text" class="form-control" name="author" placeholder="Enter Author" id="password" value="<?php echo $title; ?>" required>
</div>
                        <div class="col-12">
                            <label for="Publisher" class="form-label">PUBLISHER</label>
                            <input type="text" class="form-control" name="publisher" placeholder="Enter publisher" id="password" value="<?php echo $publisher; ?>" required>
                        </div>

                        <div class="col-md-12 col-md-offset-2">
                            <label for="Catagory" class="form-label">CATEGORY</label>
                            <select name="catagories" id="catagories" class="form-select" required placeholder="Enter category">
                                <option value="" disabled selected><?php echo $catagories; ?></option>
                                <option value="SE">Software Engg.</option>
                                <option value="CiE">Civil Engg.</option>
                                <option value="CE">Computer Sci.</option>
                                <option value="ME">Mechanical Engg.</option>
                                <option value="ChE">Chemical Engg.</option>
                                <option value="EE">Electrical Engg.</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="Publisher" class="form-label">CALL NUMBER</label>
                            <input type="text" class="form-control" name="call" placeholder="Call number" id="password" value="<?php echo $call; ?>" required>
                        </div>

                        <div class="col-12">
                            <label for="Size" class="form-label">NUMBER OF BOOK</label>
                            <input type="text" class="form-control" name="size" placeholder="Number of book" id="numOfBook" value="<?php echo $size; ?>" required>
                        </div>

                        <center>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-info col-lg-4" name="update" style="color:#fff; margin-bottom: 1rem;" >UPDATE BOOK</button>
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
