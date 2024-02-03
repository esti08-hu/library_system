<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
require 'includes/header.php';
$msg = "";
if (isset($_POST['submit'])) {
    $name = sanitize(trim($_POST['name']));
    $studentId = sanitize(trim($_POST['studentId']));
    $email = sanitize(trim($_POST['email']));
    $dept = sanitize(trim($_POST['dept']));
    $phone = sanitize(trim($_POST['phone']));
    
    $IdSql = "SELECT COUNT(*) FROM student WHERE studentId=?";
    $IdStmt = $conn->prepare($IdSql);
    $IdStmt->bind_param("s", $studentId);
    $IdStmt->execute();
    $IdStmt->bind_result($IdCount);
    $IdStmt->fetch();
    $IdStmt->close();

    // Check if email already exists
    $EmailSql = "SELECT COUNT(*) FROM student WHERE email=?";
    $EmailStmt = $conn->prepare($EmailSql);
    $EmailStmt->bind_param("s", $email);
    $EmailStmt->execute();
    $EmailStmt->bind_result($emailCount);
    $EmailStmt->fetch();
    $EmailStmt->close();
  

    if ($IdCount > 0) {
        $msg = "Student ID already exists!";
    } elseif ($emailCount > 0) {
        $msg = "Email already exists!";
    } 
    else {

    $sql = "INSERT INTO student(studentId, email, department, phoneNumber, name) VALUES('$studentId', '$email', '$dept', '$phone', '$name')";

    $query = mysqli_query($conn, $sql);
    $error = false;
    if ($query) {
        $error = true;
    } else {
        echo "<script>alert('Registration failed! Try again.');</script>";
    }
}

}
?>

<body style="height:100vh; display: flex; align-items:center; justify-content:center;">
    <div class="container">
        <?php include "includes/nav.php"; ?>
        <div class="container col-lg-9 col-md-11 col-12" style="margin-top: 20px;">
            <div class="jumbotron bg-light col-lg-10 col-md-11 col-12">
                <?php if (isset($error) && $error === true) { ?>
                    <div class="alert alert-success alert-dismissible">
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Record added Successfully!</strong>
                    </div>
                <?php } ?>

                <div class="container" style="box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.3); padding: 0 .5rem; border-radius: 5px;">
                <p class="page-header" style="text-align:center; font-size: 20px; font-weight: bold; color: steelblue;  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);">ADD STUDENT</p>
                <div style="height: 1.2rem;"><strong style="color: red;"><?php echo $msg;?></strong></div>
                <hr>
                    <form action="addstudent.php" method="post" role="form" enctype="multipart/form-data" class="row g-3">

                        <div class="col-2">
                            <label for="Username" class="form-label">FULL NAME</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" name="name" placeholder="Full Name" id="name" required>
                        </div>

                        <div class="col-2">
                            <label for="password" class="form-label">ID NO.</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" name="studentId" placeholder="Id Number" id="id_no" required>
                        </div>

                        <div class="col-2">
                            <label for="Password" class="form-label">DEPT</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" name="dept" placeholder="Department" id="Address" required>
                        </div>

                        <div class="col-2">
                            <label for="Password" class="form-label">EMAIL</label>
                        </div>
                        <div class="col-10">
                            <input type="email" class="form-control" name="email" placeholder="Email" id="password" required>
                        </div>

                        <div class="col-2">
                            <label for="Password" class="form-label">PHONE NUMBER</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" name="phone" placeholder="phone" id="password" required>
                        </div>
                        <center>
                            <div class="col-12">
                                <button style="width: 30%; color: #fff; margin-bottom: 1rem; " class="btn btn-info col-12" data-toggle="modal" data-target="#info" name="submit">ADD MEMBER</button>
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