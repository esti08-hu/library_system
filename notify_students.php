<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'includes/db-inc.php';
require 'phpmailer/PHPMailerAutoload.php';
require 'phpmailer/class.phpmailer.php';
require 'phpmailer/class.smtp.php';
require 'vendor/autoload.php';

// Fetch requests for books with numOfBook > 0 from request_book table
$query = "SELECT request_book.*, student.email, books.bookTitle
          FROM request_book
          JOIN student ON request_book.studentId = student.studentId
          JOIN books ON request_book.bookId = books.bookId
          WHERE books.numOfBook > 0";

$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $studentEmail = $row['email'];
        $bookTitle = $row['bookTitle'];
        sendNotificationEmail($conn, $row['bookId'], $row['studentId'], $studentEmail, $bookTitle);
    }
}

function sendNotificationEmail($conn, $bookId, $studentId, $studentEmail, $bookTitle)
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'estioame@gmail.com';
    $mail->Password = 'rulqnjuawmbbehtg';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Use prepared statement to avoid SQL injection
    $updateQuery = "UPDATE request_book SET email_sent = 1 WHERE bookId = ? AND studentId = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ss", $bookId, $studentId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $mail->setFrom("estioame@gmail.com", "Library Management System");
    $mail->addAddress($studentEmail);

    $mail->Subject = 'Notification: Requested Book Available';
    $mail->Body = 'Dear Student, The Book you requested "' . $bookTitle . '" is now available. Please pick it up from the library.';
    
    try {
        $mail->send();
        echo "<script>alert('Reminder email sent to " . $studentEmail . "');</script>";
    } catch (Exception $e) {
        echo "Error sending email: " . $mail->ErrorInfo . "\n";
    }
}
