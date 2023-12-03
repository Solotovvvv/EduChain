<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}
// get_sections.php
include 'includes/config.php';
// Assuming you have a database connection in your Database class
$pdo = Database::connection();

// Get the selected course ID from the URL parameters
$courseId = isset($_GET['course_id']) ? $_GET['course_id'] : null;

// Prepare and execute the SQL query to fetch sections based on the selected course ID
$sql = "SELECT id, section FROM section WHERE course_id = :course_id AND status = '1'";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);

$response = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $response[] = [
            'id' => $row['id'],
            'section' => $row['section'],
        ];
    }
}

// Return the sections as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
