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
    function Header()
    {
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 5, 'Republic of the Philippines', 0, 1, 'C');
        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, 5, 'Department of Education', 0, 1, 'C');
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 5, 'REGION VIII', 0, 1, 'C');
        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, 5, 'DIVISION OF SOUTHERN LEYTE', 0, 1, 'C');
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 5, 'District of Malitbog', 0, 1, 'C');
        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, 5, 'CONCEPCION NATIONAL HIGH SCHOOL', 0, 1, 'C');
        $this->Ln(5);
        $this->SetFillColor(0, 170, 0);
        $this->Cell(0, 1, '', 0, 1, 'C', true);
    }

    function ChapterTitle()
    {
        $title = 'CERTIFICATE';

        $this->Ln(20);
        $this->SetFont('Times', '', 25);
        $this->Cell(0, 5, $title, 0, 1, 'C');
        $this->Ln(20);
    }

    function ChapterBody()
    {

        $subTitle = 'TO WHOM IT MAY CONCERN:';

        $this->SetMargins(20, 0, 20); //left, top, right
        $this->Ln(0);

        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, 5, $subTitle, 0, 'J', 0);
        $this->Ln(8);

        $paragraph1 = 'This is to certify that ' . $this->studentData['fullname'] . ' is officially enrolled as ' . $this->studentData['year'] . 'th year student of ' . $this->studentData['course_abbreviation'] . ', during the school year ' . $this->studentData['schooyear'] . '.';
        $paragraph2 = 'This is to certify further that he/she is a student of good moral character and has no property or financial responsibility in this school.';
        $paragraph3 = 'This certification is issued upon request of the student concerned for his/her desire to transfer to another school.';
        $paragraph4 = 'Done this 29th day of September, 2009 at Concepcion National High School, Concepcion, Malitbog, Southern Leyte, Philippines.';

        $this->SetFont('Times', '', 12);
        $this->MultiCell(0, 5, $paragraph1, 0, 'J', 0);
        $this->Ln(5);
        $this->MultiCell(0, 5, $paragraph2, 0, 'J', 0);
        $this->Ln(5);
        $this->MultiCell(0, 5, $paragraph3, 0, 'J', 0);
        $this->Ln(5);
        $this->MultiCell(0, 5, $paragraph4, 0, 'J', 0);
        $this->Ln(30);

        $principal = 'ROSALINA L. AGAPAY';
        $position = 'Principal I';

        $this->SetFont('Times', 'B', 12);
        $this->Cell(100, 5, '', 0, 0);
        $this->Cell(70, 5, $principal, 0, 1, 'C');

        $this->SetFont('Times', '', 12);
        $this->Cell(100, 5, '', 0, 0);
        $this->Cell(70, 5, $position, 0, 0, 'C');
        $this->Ln(1);
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
