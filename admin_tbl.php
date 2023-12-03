<?php

session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}
include './includes/config.php';

$pdo = Database::connection();


$sql = "SELECT * FROM login WHERE role = 0 ";
$stmt = $pdo->prepare($sql);

$data = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  
        $subarray = [
            '<td>' . $row['username'] . '</td>',
            '<td>' . $row['full_name'] . '</td>',
            '<td>
            <button class="btn btn-primary" onclick="edit_admin(' . $row['id'] . ')"><i class="nav-icon fas fa-edit"></i></button>
            <button class="btn btn-danger" onclick="delete_admin(' . $row['id'] . ')"><i class="nav-icon fas fa-trash"></i></button>
            </td>',
        ];
        $data[] = $subarray;
    }
}

$output = [
    'data' => $data,
];

echo json_encode($output);
