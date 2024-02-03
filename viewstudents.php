<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';

if (isset($_POST['submit'])) {
    $id = trim($_POST['del_btn']);
    $sql = "DELETE FROM student WHERE studentId = '$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>alert('Student Deleted!')</script>";
    }
}
?>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body  style="background: radial-gradient(#fff, #AED2FF)">
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
                    <a style="margin-top: 1rem; width: 13rem;" href="addstudent.php"><button style="width: 100%; " class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-11" style="margin-left: 15px; margin-bottom:5px"><i class="fa-solid fa-plus"></i>  Add Student</button></a>
                </div>
            </div>
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
            <?php
            $sql = "SELECT * FROM student";
            $query = mysqli_query($conn, $sql);
            $counter = 1;
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo $row['studentId'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['department'] ?></td>
                        <td><?php echo $row['phoneNumber'] ?></td>
                        <td>
                            <form action="viewstudents.php" method="post">
                                <input type="hidden" value="<?php echo $row['studentId']; ?>" name="del_btn">
                                <center><button type="submit" name="submit" style="color: #fff;" class="btn btn-danger"><span class="fas fa-trash"></button></center>
                            </form>
                        </td>
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