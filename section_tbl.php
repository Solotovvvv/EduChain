<?php
include './includes/config.php';

$pdo = Database::connection();

$sql = "SELECT section.*, course.abbreviation AS course_abbreviation
        FROM section
        INNER JOIN course ON section.course_id = course.id";
$stmt = $pdo->prepare($sql);

$data = [];

if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $status = ($row['status'] == 1) ? 'Available' : 'Closed';
        $subarray = [
            '<td>' . $row['course_abbreviation'] . '</td>', // Use the alias for course abbreviation
            '<td>' . $row['section'] . '</td>',
            '<td>' . $status . '</td>',
            '<td><button class="btn btn-primary" onclick="edit_section(' . $row['id'] . ')"><i class="nav-icon fas fa-edit"></i></button></td>',
        ];
        $data[] = $subarray;
    }
}

$output = [
    'data' => $data,
];

echo json_encode($output);
?>
