<?php
include 'includes/config.php';
require('fpdf/fpdf.php');

class PDF extends FPDF {
    private $studentData;

    public function setStudentData($data) {
        $this->studentData = $data;
    }
    function Header() {
        $this->Image('background.jpg', 0, 0, 300, 0); //x,y,width,height
        $this->Image('ucc-logo.jpg', 50, 26, 20, 0); //x,y,width,height
        $this->Image('caloocan-logo.jpg', 225, 27, 23, 0); //x,y,width,height

        $this->Ln(20);
        $this->SetFont('Times', 'B', 25);
        $this->Cell(0, 10, 'UNIVERSITY OF CALOOCAN CITY', 0, 1, 'C');
        $this->SetFont('Times', 'I', 14);
        $this->Cell(0, 5, 'Biglang Awa St. 12th Ave. East, Caloocan City', 0, 1, 'C');
        $this->Ln(20);
        // $title = 'CERTIFICATE OF GRADUATION';

        // $this->Ln(35);
        // $this->SetFont('Times', '', 25);
        // $this->Cell(0, 5, $title, 0, 1, 'C');
        // $this->Ln(15);
    }

    function ChapterBody() {
        $this->SetFont('Times', 'B', 25);
        $this->Cell(0, 5, 'CERTIFICATE OF GRADUATION', 0, 1, 'C');
        $this->Ln(15);
     

        $this->SetFont('Times', '', 14);
        $this->Cell(0, 5, 'This is awarded to', 0, 1, 'C');
        $this->Ln(15);

        $studentName = $this->studentData['fullname'];;
        $this->SetFont('Times', 'B', 40);
        $this->Cell(0, 5, $studentName, 0, 1, 'C');
        $this->Ln(15);

        $this->SetFont('Times', '', 14);
        $this->Cell(0, 5, 'for successfully completing the University Of Caloocan City curriculum.', 0, 1, 'C');
        $this->Ln(25);

        $this->SetFillColor(0, 0, 0);
        $this->Cell(59, .5, '', 0, 0, 'C');
        $this->Cell(70, .5, '', 0, 0, 'C', true);
        $this->Cell(20, .5, '', 0, 0, 'C');
        $this->Cell(70, .5, '', 0, 0, 'C', true);
        $this->Cell(59, .5, '', 0, 1, 'C');
        $this->Ln(1);

        $this->SetFont('Times', 'B', 15);
        $this->Cell(59, 7, '', 0, 0, 'C');
        $this->Cell(70, 7, 'Dr. Marilyn T. De Jesus, DPA', 0, 0, 'C');
        $this->Cell(20, 5, '', 0, 0, 'C');
        $this->Cell(70, 7, 'Prof. Ma. Cecilia M. Saenz', 0, 0, 'C');
        $this->Cell(59, 7, '', 0, 1, 'C');

        $this->SetFont('Times', '', 14);
        $this->Cell(59, 5, '', 0, 0, 'C');
        $this->Cell(70, 5, 'OIC PRESIDENT ', 0, 0, 'C');
        $this->Cell(20, 5, '', 0, 0, 'C');
        $this->Cell(70, 5, 'HEAD, REGISTRAR', 0, 0, 'C');
        $this->Cell(59, 5, '', 0, 1, 'C');

    
    }
    function PrintChapter() {
        $this->AddPage();
        // $this->ChapterTitle();
        $this->ChapterBody();
    }
}

// Fetch the student data based on the provided ID
$studentId = isset($_GET['id']) ? $_GET['id'] : null;

// Use the Database class to establish a database connection
$database = new Database();
$pdo = $database->connection();

// Fetch student data using a prepared statement
// $query = "SELECT `id`, `fullname`, `studentNumber`, `course`, `year`, `section`, `schooyear` FROM `student` WHERE `id` = :id";

$query = "SELECT
    s.`id`,
    s.`fullname`,
    s.`studentNumber`,
    s.`year`,
    s.`section`,
    s.`schooyear`,
    c.`abbreviation` AS `course_abbreviation`
FROM
    `student` s
INNER JOIN
    `course` c ON s.`course` = c.`id`
WHERE
    s.`id` = :id";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $studentId, PDO::PARAM_INT);

if ($stmt->execute()) {
    $studentData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($studentData) {
        $pdf = new PDF('L', 'mm', 'A4');
        $pdf->SetTitle('Certificate of Graduation');
        $pdf->setStudentData($studentData);
        $pdf->PrintChapter();
        $pdf->Output();
    } else {
        echo 'Student not found.';
    }
} else {
    echo 'Error fetching student data.';
}