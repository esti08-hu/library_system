<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';

if (isset($_POST['del'])) {
    $id = sanitize(trim($_POST['id']));

    $sql_del = "DELETE FROM admin WHERE adminId = $id";
    $error = false;

    $result = mysqli_query($conn, $sql_del);
    if ($result) {
        $error = true;
    }
}
?>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: radial-gradient(#fff, #AED2FF)">
<div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background: radial-gradient(#FFF, #FFCC70); border-radius: 10px; margin-top: 6rem;">
    <?php include 'includes/nav.php'; ?>

    <div class="alert col-lg-7 col-md-12 col-sm-12 col-12 offset-lg-2" style="text-align: center; margin-top: 70px;">
    <span class="glyphicon glyphicon-book"></span>
            <strong style="font-size: 20px;">Admins</strong>
            </div>
</div>
<div class="container" style=" padding-bottom: 1rem; box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); background-color: #fff; border-radius: 10px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php if (isset($error) === true) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Record Deleted Successfully!</strong>
                </div>
                
            <?php } ?>
            <div class="row" style="margin: 1rem;">
                    <a style="margin-top: 1rem; width: 14rem;" href="adduser.php"><button style="width: 100%; " class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-11" style="margin-left: 15px; margin-bottom:5px">Add Another Admin</button></a>
                </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><center>#</center></th>
                    <th>Admin Id</th>
                    <th>Admin Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th><center>Actions</center></th>
                </tr>
            </thead>
            <?php
                $sql = "SELECT * FROM admin";

                $query = mysqli_query($conn, $sql);
                $counter = 1;
                while ($row = mysqli_fetch_array($query)) {
            ?>
                <tbody>
                    <tr>
                        <td><center><?php echo $counter++ ?></center></td>
                        <td><?php echo $row['adminId'] ?></td>
                        <td><?php echo $row['adminName'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td>
                            <form action="users.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['adminId']; ?>">
                                <center><button name="del" type="submit" style="color: #fff;" value="Delete" onclick="return Delete()" class="btn btn-danger"><span class="fas fa-trash"></button></center>
                            </form>
                        </td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
    </div>
</div>

<script type="text/javascript">
    function Delete() {
        return confirm('Would you like to delete the User?');
    }
</script>
</body>
</html>