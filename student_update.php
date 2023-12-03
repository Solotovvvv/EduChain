<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}
include './includes/config.php';

$pdo = Database::connection();


if (isset($_POST['hiddendata_student'])) {
    // Update student information
    $id = $_POST['hiddendata_student'];
    $name = $_POST['name'];
    $course = $_POST['course'];
    $sy = $_POST['sy'];
    $section = $_POST['section'];
    $year = $_POST['year'];
    $student_no = strtoupper($_POST['student_no']);

    $sql = "UPDATE student SET fullname = :name, course = :course, schooyear = :sy, section = :section, year = :year, studentNumber=:student_no WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':name' => $name,
        ':course' => $course,
        ':sy' => $sy,
        ':section' => $section,
        ':year' => $year,
        ':id' => $id,
        ':student_no' => $student_no
    ])) {
        $data = array(
            'status' => 'success'
        );
    }
    echo json_encode($data);


}