<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}
include './includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = Database::connection();

    // Assuming you have input validation and sanitation
    $course = $_POST['course'];
    $year = $_POST['year'];
    $section = $_POST['section'];
    $name = $_POST['name'];
    $schoolYear = $_POST['schoolyear'];
    $student_no = strtoupper($_POST['student_no']);


    // Check if the data already exists (you might want to use a unique constraint or other validation)
    $checkIfExists = $pdo->prepare("SELECT COUNT(*) as count FROM student WHERE course = ? AND year = ? AND section = ? AND fullname = ? AND schooyear = ? AND studentNumber = ?");
    $checkIfExists->execute([$course, $year, $section, $name, $schoolYear,$student_no]);
    $result = $checkIfExists->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        $data = ['status' => 'data_exist'];
    } else {
        // Insert the student data
        $insertStudent = $pdo->prepare("INSERT INTO student (course,studentNumber, year, section, fullname, schooyear) VALUES (?, ?, ?, ?, ?, ?)");
        $success = $insertStudent->execute([$course,$student_no, $year, $section, $name, $schoolYear]);

        if ($success) {
            $data = ['status' => 'success'];
        } else {
            $data = ['status' => 'failed'];
        }
    }
    echo json_encode($data);
} 
?>
