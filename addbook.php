<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';

if (isset($_POST['submit'])) {
    $title = sanitize(trim($_POST['title']));
    $author = sanitize(trim($_POST['author']));

    $publisher = sanitize(trim($_POST['publisher']));
    $catagories = sanitize(trim($_POST['catagories']));
    $call = sanitize(trim($_POST['call']));
    $size = sanitize(trim($_POST['size']));
    // $discription = sanitize(trim($_POST['bookDiscription']));

    $sql = "INSERT INTO books(bookTitle, author, ISBN, publisherName, catagories, callNumber, numOfBook) values ('$title', '$author', '0000', '$publisher', '$catagories', '$call', '$size')";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>alert('New Book has been added');
                location.href = 'bookstable.php';
            </script>";
    } else {
        echo "<script>alert('Book not added! ');</script>";
    }
}
?>

<body style="display: flex; align-items:center; justify-content:center;">

    <div class="container">
        <?php include "includes/nav.php"; ?>
        <div class="container col-lg-9 col-md-11 col-12" style="margin-top: 50px;">
            <div class="jumbotron bg-light col-lg-10 col-md-11 col-12" style="margin: 5rem 0;">
                <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); padding: .5rem; border-radius: 5px;">
                    <p class="page-header" style="text-align:center; font-size: 20px; font-weight: bold; color: steelblue;  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);">ADD BOOK</p>
                    <form action="addbook.php" class="row g-3" role="form" enctype="multipart/form-data" method="post">

                        <div class="form-group">
                            <div class="col-12">
                                <label for="Title" class="form-label">BOOK TITLE</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title" id="password" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="Author" class="form-label">AUTHOR</label>
                            <input type="text" class="form-control" name="author" placeholder="Enter Author" id="password" required>
                        </div>

                        <!-- <div class="col-12">
                            <label for="ISBN" class="form-label">ISBN</label>
                            <input type="text" class="form-control" name="label" placeholder="Enter ISBN" id="password" required>
                        </div> -->

                        <div class="col-12">
                            <label for="Publisher" class="form-label">PUBLISHER</label>
                            <input type="text" class="form-control" name="publisher" placeholder="Enter publisher" id="password" required>
                        </div>

                        <!-- <div class="col-12">
                            <label for="Catagory" class="form-label">CATEGORY</label>
                            <input type="text" class="form-control" name="catagories" placeholder="Enter category" id="catagories" required>
                        </div> -->

                        <div class="col-md-12 col-md-offset-2">
                            <label for="Catagory" class="form-label">CATEGORY</label>
                            <select name="catagories" id="catagories" class="form-select" required placeholder="Enter category">
                                <option value="" disabled selected>Select category</option>
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
                            <input type="text" class="form-control" name="call" placeholder="Call number" id="password" required>
                        </div>

                        <div class="col-12">
                            <label for="Size" class="form-label">NUMBER OF BOOK</label>
                            <input type="text" class="form-control" name="size" placeholder="Number of book" id="numOfBook" required>
                        </div>
                        <!-- <div class="col-12">
                            <label for="Size" class="form-label">DISCRIPTION</label><br>
                            <textarea cols="80" rows="5" name='bookDiscription' id="bookDiscription" required style="outline:none;"></textarea>
                           
                        </div> -->

                        <center>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button class="btn btn-info col-lg-4" name="submit" style="color:#fff; margin-bottom: 1rem;">ADD BOOK</button>
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

</html>