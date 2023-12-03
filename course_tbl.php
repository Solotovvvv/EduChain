<?php
include './includes/config.php';

$pdo = Database::connection();


$sql = "SELECT * FROM course ";
$stmt = $pdo->prepare($sql);

$data = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $status = ($row['status'] == 1) ? 'Available' : 'Closed';
        $subarray = [
            '<td>' . $row['course_name'] . '</td>',
            '<td>' . $row['abbreviation'] . '</td>',
            '<td><span class="badge badge-secondary">' . $status . '</span></td>',
            '<td>
            <button class="btn btn-primary" onclick="edit_course(' . $row['id'] . ')"><i class="nav-icon fas fa-edit"></i></button>
           
            </td>',
        ];
        $data[] = $subarray;
    }
}

$output = [
    'data' => $data,
];

echo json_encode($output);
