<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailerAutoload.php';
require 'phpmailer/class.phpmailer.php';
require 'phpmailer/class.smtp.php';
require 'vendor/autoload.php';
require('includes/db-inc.php');

if (isset($_GET['bookTitle']) and isset($_GET['studentId'])) {

    $bookTitle = $_GET['bookTitle'];
    $studentId = $_GET['studentId'];
    $getEmailQuery = "SELECT email FROM student WHERE studentId = ?";
    $getEmailStmt = $conn->prepare($getEmailQuery);
    $getEmailStmt->bind_param("i", $studentId);
    $getEmailStmt->execute();
    $emailResult = $getEmailStmt->get_result();

    if ($emailResult->num_rows > 0) {
        $studentEmail = $emailResult->fetch_assoc()['email'];
    } else {
        $studentEmail = '';
    }

    $getEmailStmt->close();
    function sendReminderEmail($studentEmail, $bookTitle)
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'estioame@gmail.com';
        $mail->Password = 'rulqnjuawmbbehtg';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom("estioame@gmail.com", "Library Management System");
        $mail->addAddress($studentEmail);

        $mail->Subject = 'Reminder: Overdue Book Return';
        $mail->Body = 'Dear Student, This is a reminder that the book titled "' . $bookTitle . '" is overdue. Please return it to the library as soon as possible. Thank you.';

        $mail->send();
        echo "<script>alert('Reminder email sent to " . $studentEmail . "');</script>";
        echo "<script>window.location.href = 'overDue.php';</script>";
    }
    if (!empty($studentEmail)) {
        sendReminderEmail($studentEmail, $bookTitle);
    }
}
