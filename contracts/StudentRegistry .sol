// SPDX-License-Identifier: MIT
pragma solidity >=0.4.25 <0.9.0;

contract StudentRegistry {
    event StudentAdded(string indexed studentNumber, string name, string course, string schoolYear, string university);

    struct Student {
        string name;
        string course;
        string schoolYear;
        string studentNumber;
        string university;
    }

    mapping(string => Student) studentsByNumber; // Mapping using student_number
    mapping(string => Student) studentsByName;   // Mapping using student_name

    function addStudent(
        string memory _name,
        string memory _course,
        string memory _schoolYear,
        string memory _studentNumber,
        string memory _university
    ) external {
        Student memory newStudent = Student(_name, _course, _schoolYear, _studentNumber, _university);
        studentsByNumber[_studentNumber] = newStudent;
        studentsByName[_name] = newStudent;

        // Log the added student information
        emit StudentAdded(_studentNumber, _name, _course, _schoolYear, _university);
    }

    function getStudent(string memory _name) external view returns (string memory, string memory, string memory, string memory, string memory) {
        Student memory student = studentsByName[_name];
        return (student.name, student.course, student.schoolYear, student.studentNumber, student.university);
    }
}
