<?php
include 'includes/config.php';
require('fpdf/fpdf.php');

class PDF extends FPDF {
    private $studentData;

    public function setStudentData($data)
    {
        $this->studentData = $data;
    }
    function Header() {
        $this->SetFont('Times', 'B', 20);
        $this->Cell(0, 8, 'UNIVERSITY OF CALOOCAN CITY', 0, 1, 'C');
        $this->SetFont('Times', 'I', 12);
        $this->Cell(0, 6, '(Formerly Caloocan City Polytechnic College)', 0, 1, 'C');
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 6, 'Biglang Awa St. 12th Ave. East, Caloocan City', 0, 1, 'C');
        $this->Cell(0, 6, 'E-mail: registrar@ucc-caloocan.edu.ph', 0, 1, 'C');
        $this->Cell(0, 6, 'Tel. no: 310-6855', 0, 1, 'C');
        $this->Ln(5);
        $this->SetFillColor(0, 170, 0);
        $this->Cell(0, 1, '', 0, 1, 'C', true);

        $this->Image('ucc-logo.jpg', 10, 10, 28, 0); //x,y,width,height
        $this->Image('caloocan-logo.jpg', 165, 10, 33, 0); //x,y,width,height
    }

    function ChapterTitle() {
        $this->Ln(20);
        $this->SetFont('Times', '', 25);
        $this->Cell(0, 5, 'C E R T I F I C A T I O N', 0, 1, 'C');
        $this->Ln(20);
    }

    function ChapterBody() {
        $this->SetMargins(20, 0, 20); //left, top, right
        $this->Ln(0);

        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, 5, 'TO WHOM IT MAY CONCERN:', 0, 'J', 0);
        $this->Ln(8);

        $paragraph1 = 'This is to certify that ' . $this->studentData['fullname'] . '  is a student of ' . $this->studentData['course_name'] . '  in this University.';
        $paragraph2 = 'This further certifies that he/she has shown GOOD MORAL CHARACTER and has never been disciplined for any violation of the school rules and regulations during his/her stay in this University.';
        $paragraph3 = 'This certification is being issued upon request of Ms/Mr. ' . $this->studentData['fullname'] . '  whatever legal purpose/s it may serve him/her.';

        $this->SetFont('Times', '', 12);
        $this->MultiCell(0, 5, $paragraph1, 0, 'J', 0);
        $this->Ln(5);
        $this->MultiCell(0, 5, $paragraph2, 0, 'J', 0);
        $this->Ln(5);
        $this->MultiCell(0, 5, $paragraph3, 0, 'J', 0);
        $this->Ln(25);

        $this->SetFont('Times', 'B', 12);
        $this->Cell(85, 5, '', 0, 0);
        $this->Cell(85, 5, 'MARJORIE LOPEZ - TIU, M.A, RGC, RPM', 0, 1, 'C');

        $this->SetFont('Times', 'I', 12);
        $this->Cell(85, 5, '', 0, 0);
        $this->Cell(85, 5, 'Guidance Counselor', 0, 1, 'C');
        $this->Ln(5);

        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, 5, 'Noted:', 0, 1, 'L');
        $this->Ln(15);

        $this->Cell(85, 5, 'PROF. MARIA CECILIA M. SAENZ', 0, 0, 'C');
        $this->Cell(85, 5, '', 0, 1);

        $this->SetFont('Times', 'I', 12);
        $this->Cell(85, 5, 'University Registrar - South Campus', 0, 0, 'C');
        $this->Cell(85, 5, '', 0, 0);
    }

    function PrintChapter() {
        $this->AddPage();
        $this->ChapterTitle();
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
    c.`course_name` AS `course_name`,
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
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->SetTitle('Good Moral');
        $pdf->setStudentData($studentData);
        $pdf->PrintChapter();
        $pdf->Output();
    } else {
        echo 'Student not found.';
    }
} else {
    echo 'Error fetching student data.';
}
