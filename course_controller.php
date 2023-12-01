<?php

include 'includes/config.php';

$pdo = Database::connection();

if (isset($_POST['course'])) {
    $course = $_POST['course'];
    $abbreviation = $_POST['abbreviation']; // Assuming you get abbreviation from the form

    // Check if course already exists
    $check_course_query = "SELECT * FROM course WHERE course_name = :course AND abbreviation = :abbreviation";
    $stmt = $pdo->prepare($check_course_query);
    $stmt->bindParam(':course', $course, PDO::PARAM_STR);
    $stmt->bindParam(':abbreviation', $abbreviation, PDO::PARAM_STR);
    $stmt->execute();

    // Use rowCount() to check the number of rows returned
    if ($stmt->rowCount() > 0) {
        // Course or abbreviation already exists, so don't insert the new record
        $data = array(
            'status' => 'data_exist',
        );
        echo json_encode($data);
    } else {
        // Course and abbreviation don't exist, so insert the new record
        $insert_course_query = "INSERT INTO `course` (`course_name`, `abbreviation`, `status`)
            VALUES (UPPER(:course), :abbreviation, '')";
        $stmt = $pdo->prepare($insert_course_query);
        $stmt->bindParam(':course', $course, PDO::PARAM_STR);
        $stmt->bindParam(':abbreviation', $abbreviation, PDO::PARAM_STR);
        $insert_course_result = $stmt->execute(); // Store the result of the execution

        if ($insert_course_result) {
            $data = array(
                'status' => 'success',
            );
            echo json_encode($data);
        } else {
            $data = array(
                'status' => 'failed',
            );
            echo json_encode($data);
        }
    }
}
else if(isset($_POST['update'])){
    $id = $_POST['update'];
    $sql = "SELECT * FROM `course` WHERE id = :id";
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


?>
