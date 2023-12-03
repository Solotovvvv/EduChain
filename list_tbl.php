<?php

session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}
include './includes/config.php';

$pdo = Database::connection();


$sql = "SELECT * FROM student ";
$stmt = $pdo->prepare($sql);

$data = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $disabledButtons = $row['status'] != 1 ? 'disabled' : ''; // Add this line

        $subarray = [
            '<td>' . $row['fullname'] . '</td>',
            '<td>
                <button class="btn btn-primary" onclick="store(' . $row['id'] . ')"><i class="nav-icon fas fa-edit"></i></button>
                <button class="btn btn-danger" onclick="goodmoral(' . $row['id'] . ')" ' . $disabledButtons . '><i class="nav-icon fas fa-stamp"></i></button>
                <button class="btn btn-info" onclick="certOfGrad(' . $row['id'] . ')" ' . $disabledButtons . '><i class="nav-icon fas fa-certificate"></i></button>
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
