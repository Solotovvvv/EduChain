<?php
include './includes/config.php';

$pdo = Database::connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $id = $_POST['update'];
        $sql = "SELECT * FROM student WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                $courseId = $userData['course'];

                // Fetch sections for the selected course with status 1
                $sectionSql = "SELECT id, section, status FROM section WHERE status = '1' AND course_id = :course_id";
                $sectionStmt = $pdo->prepare($sectionSql);
                $sectionStmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);

                if ($sectionStmt->execute()) {
                    $sections = $sectionStmt->fetchAll(PDO::FETCH_ASSOC);
                    $userData['sections'] = $sections;
                    $data = $userData;
                } else {
                    $data = array(
                        'status' => 'failed',
                        'error' => $sectionStmt->errorInfo()
                    );
                }
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
    } else {
        $data = array(
            'status' => 'failed',
            'message' => 'Invalid request'
        );
        echo json_encode($data);
    }

}
?>
