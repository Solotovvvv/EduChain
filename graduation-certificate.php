<?php
include 'includes/config.php';
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    private $studentData;

    public function setStudentData($data)
    {
        $this->studentData = $data;
    }
    function ChapterTitle()
    {
        $title = 'CERTIFICATE OF GRADUATION';

        $this->Ln(35);
        $this->SetFont('Times', '', 25);
        $this->Cell(0, 5, $title, 0, 1, 'C');
        $this->Ln(15);
    }

    function ChapterBody()
    {
        $txt = 'This is awarded to';

        $this->SetFont('Helvetica', '', 14);
        $this->Cell(0, 5, $txt, 0, 1, 'C');
        $this->Ln(15);

        $studentName = $this->studentData['fullname'];;

        $this->SetFont('Times', 'B', 35);
        $this->Cell(0, 5, $studentName, 0, 1, 'C');
        $this->Ln(15);

        $txt2 = 'for successfully completing the Timpton International High School curriculum.';

        $this->SetFont('Helvetica', '', 14);
        $this->Cell(0, 5, $txt2, 0, 1, 'C');
        $this->Ln(30);

        $this->SetFillColor(0, 0, 0);
        $this->Cell(59, .5, '', 0, 0, 'C');
        $this->Cell(70, .5, '', 0, 0, 'C', true);
        $this->Cell(20, .5, '', 0, 0, 'C');
        $this->Cell(70, .5, '', 0, 0, 'C', true);
        $this->Cell(59, .5, '', 0, 1, 'C');
        $this->Ln(2);

        $schoolDirector = 'Nicollette Loanne F. Porca';
        $associateDirector = 'Nicollette Loanne F. Porca';

        $this->SetFont('Times', 'B', 15);
        $this->Cell(59, 7, '', 0, 0, 'C');
        $this->Cell(70, 7, $schoolDirector, 0, 0, 'C');
        $this->Cell(20, 5, '', 0, 0, 'C');
        $this->Cell(70, 7, $associateDirector, 0, 0, 'C');
        $this->Cell(59, 7, '', 0, 1, 'C');

        $this->SetFont('Helvetica', '', 14);
        $this->Cell(59, 5, '', 0, 0, 'C');
        $this->Cell(70, 5, 'SCHOOL DIRECTOR', 0, 0, 'C');
        $this->Cell(20, 5, '', 0, 0, 'C');
        $this->Cell(70, 5, 'ASSOCIATE DIRECTOR', 0, 0, 'C');
        $this->Cell(59, 5, '', 0, 1, 'C');
    }

    function PrintChapter()
    {
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
