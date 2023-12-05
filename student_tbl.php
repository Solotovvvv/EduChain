<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}
include './includes/config.php';

$pdo = Database::connection();

// $sql = "SELECT s.id, s.fullname, c.course_name,s.studentNumber ,CONCAT(s.year, '-', s.section) AS yearSec, s.schooyear 
//         FROM student s
//         INNER JOIN course c ON s.course = c.id";

$sql ="SELECT s.id, s.fullname, c.course_name, s.studentNumber, CONCAT(s.year, '-', s.section) AS yearSec, s.schooyear 
FROM student s
INNER JOIN course c ON s.course = c.id
INNER JOIN schoolyear sy ON s.schooyear = sy.schoolyear
WHERE sy.status = 1";
$stmt = $pdo->prepare($sql);

$data = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $subarray = [
            '<td>' . $row['fullname'] . '</td>',
            '<td>' . $row['studentNumber'] . '</td>',
            '<td>' . $row['course_name'] . '</td>',
            '<td>' . $row['yearSec'] . '</td>',
            '<td>' . $row['schooyear'] . '</td>',
            '<td>
                <button class="btn btn-primary" onclick="edit_student(' . $row['id'] . ')"><i class="nav-icon fas fa-edit"></i></button>
                <button class="btn btn-danger" onclick="delete_student(' . $row['id'] . ')"><i class="nav-icon fas fa-trash-alt"></i></button>
            </td>',
        ];
        $data[] = $subarray;
    }
}

$output = [
    'data' => $data,
];

echo json_encode($output);
?>
