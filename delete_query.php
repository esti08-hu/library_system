<?php
require 'includes/snippet.php';
require_once 'includes/db-inc.php';

if (isset($_GET['bookId']) and isset( $_GET['studentId'])) {
    $bookId = $_GET['bookId'];
    $studentId = $_GET['studentId'];

    // Prepare and execute a SELECT query to retrieve the current numOfBook value
    $stmt = $conn->prepare("SELECT numOfBook FROM books WHERE bookId = ?");
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $stmt->bind_result($currentSize);
    $stmt->fetch();
    $stmt->close();

    $newSize = $currentSize + 1;
    $stmt = $conn->prepare("UPDATE books SET numOfBook = ? WHERE bookId = ?");
    $stmt->bind_param("ii", $newSize, $bookId);
    $stmt->execute();
    $stmt->close();

// Delete records from the borrow table
$conn->query("DELETE FROM  `borrow` WHERE `bookId` = $bookId  AND `studentId` = $studentId") or die(mysqli_errno($conn));
header("Location: borrowedbooks.php");
}
?>