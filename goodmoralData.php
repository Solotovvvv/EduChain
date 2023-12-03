<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}
include 'includes/config.php';
$pdo = Database::connection();

$id = $_POST['id'];
$sql = "SELECT *, c.abbreviation FROM `student` s INNER JOIN course c ON s.course = c.id WHERE s.id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($userData) {
        $data = $userData;
    } else {
        $data = array(
            'status' => 'failed',
            'message' => 'Data not found'
        );

    }
} else {
    $data = array(
        'status' => 'failed',
        'error' => $stmt->errorInfo()
    );

}
echo json_encode($data);

?>