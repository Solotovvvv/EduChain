<?php
include './includes/config.php';
$pdo = Database::connection();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM `student` WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = array(
            'status' => 'success',
        );
        echo json_encode($data);
    } catch (PDOException $e) {
        $data = array(
            'status' => 'failed',
            'error' => $e->getMessage(),
        );
        echo json_encode($data);
    }
}

 ?>
