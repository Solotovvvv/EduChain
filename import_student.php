<?php
require_once './includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the AJAX request
    $excelData = json_decode($_POST['excelData'], true);

    // Assuming your columns in the Excel file match the table columns for student
    $columns = ['fullname', 'studentNumber', 'course', 'year', 'section', 'schooyear'];

    // Prepare the SQL statement for insertion
    $sql = "INSERT INTO student (" . implode(',', $columns) . ") VALUES ";

    // Prepare values for insertion
    $values = [];
    foreach ($excelData as $row) {
        // Escape and quote each value
        $escapedValues = array_map(function ($value) {
            global $conn; // Assuming you have a database connection variable named $conn
            return "'" . mysqli_real_escape_string($conn, $value) . "'";
        }, $row);

        $values[] = "(" . implode(',', $escapedValues) . ")";
    }

    // Combine SQL statement and values
    $sql .= implode(',', $values);

    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        echo "Data imported successfully to student table!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
?>
