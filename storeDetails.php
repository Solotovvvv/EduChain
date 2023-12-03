<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}
include 'includes/config.php';

$pdo = Database::connection();

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql = "SELECT student.*, course.course_name
    FROM student
    INNER JOIN course ON student.course= course.id
    WHERE student.id = :id";
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
}