<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}
include 'includes/config.php';

$pdo = Database::connection();

if (isset($_POST['hiddendata'])) {
    // Update for the course table
    $id = $_POST['hiddendata'];
    $status = $_POST['status'];
    $course = $_POST['course'];
    $abbreviation = $_POST['abbre'];

    $sql = "UPDATE course SET course_name = UPPER(:courses), abbreviation = :abbreviation, status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':status' => $status,
        ':id' => $id,
        ':courses' => $course,
        ':abbreviation' => $abbreviation
    ])) {
        $data = array(
            'status' => 'success'
        );
    } else {
        $data = array(
            'status' => 'failed',
            'error' => $stmt->errorInfo()
        );
    }
    echo json_encode($data);
} elseif (isset($_POST['hiddendatas'])) {
    $id = $_POST['hiddendatas'];
    $status = $_POST['status'];
    $section = $_POST['section'];
    $course = $_POST['course'];

    $sql = "UPDATE section SET section = :section, status = :status, course_id = :course WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':status' => $status,
        ':id' => $id,
        ':section' => $section,
        ':course' => $course
    ])) {
        $data = array(
            'status' => 'success'
        );
    } else {
        $data = array(
            'status' => 'failed',
            'error' => $stmt->errorInfo()
        );
    }
    echo json_encode($data);

}elseif (isset($_POST['hiddendata_sy'])) {
    $id = $_POST['hiddendata_sy'];
    $status = $_POST['status'];
    $schoolyear = $_POST['schoolyear'];

    // If updating to 1, reset status for all other school years
    if ($status == 1) {
        $resetSql = "UPDATE schoolyear SET status = '' WHERE status = 1";
        $resetStmt = $pdo->prepare($resetSql);
        $resetStmt->execute();
    }

    $sql = "UPDATE schoolyear SET schoolyear =:schoolyear ,status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':status' => $status,
        ':id' => $id,
        ':schoolyear' => $schoolyear,
    ])) {
        $data = array(
            'status' => 'success'
        );
    } else {
        $data = array(
            'status' => 'failed',
            'error' => $stmt->errorInfo()
        );
    }
    echo json_encode($data);
}
else if (isset($_POST['id'])) {
    $id = $_POST['id'];
  
    // Update the status column in the database
    $sql = "UPDATE student SET status = '1' WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
  
    try {
      $statement->execute();
      echo 'Success';
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
}


?>
