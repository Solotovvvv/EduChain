<?php

include 'includes/config.php';

$pdo = Database::connection();

if (isset($_POST['section'])) {
    $section = $_POST['section'];
    $course = $_POST['course']; // Assuming you get course name from the form

    // Check if section already exists for the given course
    $check_section_query = "SELECT * FROM section WHERE section = :section AND course_id = :course_id";
    $stmt = $pdo->prepare($check_section_query);
    $stmt->bindParam(':section', $section, PDO::PARAM_STR);
    $stmt->bindParam(':course_id', $course, PDO::PARAM_INT);
    $stmt->execute();

    // Use rowCount() to check the number of rows returned
    if ($stmt->rowCount() > 0) {
        // Section already exists for the given course, so don't insert the new record
        $data = array(
            'status' => 'data_exist',
        );
        echo json_encode($data);
    } else {
        // Section doesn't exist for the given course, so insert the new record
        $insert_section_query = "INSERT INTO `section` (`course_id`, `section`, `status`)
            VALUES (:course_id, upper(:section), '')";
        $stmt = $pdo->prepare($insert_section_query);
        $stmt->bindParam(':course_id', $course, PDO::PARAM_INT);
        $stmt->bindParam(':section', $section, PDO::PARAM_STR);
        $insert_section_result = $stmt->execute(); // Store the result of the execution

        if ($insert_section_result) {
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
    $sql = "SELECT * FROM `section` WHERE id = :id";
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
