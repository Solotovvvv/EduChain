<?php
include './includes/config.php';

$pdo = Database::connection();


$sql = "SELECT * FROM schoolyear ";
$stmt = $pdo->prepare($sql);

$data = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $status = ($row['status'] == 1) ? 'Open':'Closed';
        $subarray = [
            '<td>' . $row['schoolyear'] . '</td>',
            '<td>' . $status. '</td>',
            '<td><button class="btn btn-primary" onclick="edit_schoolyear(' .$row['id'] . ')"><i class="nav-icon fas fa-edit"></i></button></td>',
        ];
        $data[] = $subarray;
    }
}

$output = [
    'data' => $data,
];

echo json_encode($output);
?>