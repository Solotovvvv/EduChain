<?php
session_start();

if (!isset($_SESSION['fullname'])) {
    header('Location: login.php');
    exit;
}

include './includes/config.php';
$pdo = Database::connection();

// Remove duplicates based on studentNumber and fullname
$sql = "DELETE s1 FROM student s1
        INNER JOIN student s2
        WHERE s1.id > s2.id
        AND s1.studentNumber = s2.studentNumber
        AND s1.fullname = s2.fullname";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo "Duplicates removed successfully";
} catch (PDOException $e) {
    // Handle the error appropriately, you might want to log it
    echo "Error: " . $e->getMessage();
}

$pdo = null;  // Close the database connection
?>
