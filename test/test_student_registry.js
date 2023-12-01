// test_student_registry.js
const StudentRegistry = artifacts.require("StudentRegistry");

contract("StudentRegistry", (accounts) => {
  let studentRegistry;

  beforeEach(async () => {
    studentRegistry = await StudentRegistry.new();
  });

  it("should add and retrieve a student", async () => {
    const studentNumber = "12345";
    const name = "John Doe";
    const course = "Computer Science";
    const schoolYear = "2023";
    const university = "Example University";

    await studentRegistry.addStudent(name, course, schoolYear, studentNumber, university);

    const result = await studentRegistry.getStudent(studentNumber);

    assert.equal(result[0], name, "Incorrect name");
    assert.equal(result[1], course, "Incorrect course");
    assert.equal(result[2], schoolYear, "Incorrect school year");
    assert.equal(result[3], studentNumber, "Incorrect student number");
    assert.equal(result[4], university, "Incorrect university");
  });
});
