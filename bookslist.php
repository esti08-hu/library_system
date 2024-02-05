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
                        <th>
                            <center>#</center>
                        </th>
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
                            <td>
                                <center><?php echo $counter++ ?></center>
                            </td>
                            <td><?php echo $row['bookId'] ?></td>
                            <td><?php echo $row['bookTitle'] ?></td>
                            <td><?php echo $row['author'] ?></td>
                            <td><?php echo $row['publisherName'] ?></td>
                            <td><?php echo $row['catagories'] ?></td>
                            <td><?php echo $row['callNumber'] ?></td>
                            <td>
                                <center><?php echo $row['numOfBook'] ?></center>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>

        
        <br>
        <br>
        <!-- Feedback Form -->
        <div class="container" style=" padding: 2rem; box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background-color: #fff; border-radius: 10px; margin-bottom: 2rem;">
            <h3>Feedback Form</h3>
            <form action="javascript:void(0);" method="post" id="submit-to-google-sheet">
                <div class="mb-3">
                    <label for="email">Your Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="feedback">Your Feedback:</label>
                    <textarea class="form-control" id="feedback" name="feedback" rows="4" required></textarea>
                </div>
                <input type="hidden" id="timestamp" name="timestamp">
                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
            <span id="msg"></span>
        </div>


        <script>
            const scriptURL = 'https://script.google.com/macros/s/AKfycbxg9kv5QJVAibR_HtuFlgo9JGdTzprt_Rqm_u0MP_LqsTF1qNouBpKR5T5NU8S8pPv59g/exec'
            const form = document.forms['submit-to-google-sheet']
            const msg = document.getElementById("msg")

            form.addEventListener('submit', e => {
                e.preventDefault()
                fetch(scriptURL, {
                        method: 'POST',
                        body: new FormData(form)
                    })
                    .then(response => {
                        msg.innerHTML = "Thank you for your feedback!";
                        setTimeout(function() {
                            msg.innerHTML = "";
                        }, 5000);
                        form.reset();

                    })
                    .catch(error => console.error('Error!', error.message))
            })
        </script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>