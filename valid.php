<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Valid</title>
    <link rel="icon" href="dist/img/ucc-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="dist/css/style.css">
</head>

<body>
    <div class="container">
        <div class="card text-center valid-card border-0">
            <div class="text-success mb-2">
                <i class="fas fa-check-circle valid-icon mb-2"></i>
                <p class="h1">Student Valid!</p>
            </div>

            <p class="valid-text">
                <?php
                $updateData = json_decode(file_get_contents('php://input'), true);

                // Check if the keys exist before accessing them
                $name = isset($updateData['name']) ? $updateData['name'] : '';
                $studentNumber = isset($updateData['studentnumber']) ? $updateData['studentnumber'] : '';
                $course = isset($updateData['course']) ? $updateData['course'] : '';
                $schoolYear = isset($updateData['schoolyear']) ? $updateData['schoolyear'] : '';
                $university = isset($updateData['univ']) ? $updateData['univ'] : '';

                // Display the data
                echo "Name: $name <br>";
                echo "Student Number: $studentNumber <br>";
                echo "Course: $course <br>";
                echo "School Year: $schoolYear <br>";
                echo "University: $university <br>";
                ?>
            </p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>

</html>