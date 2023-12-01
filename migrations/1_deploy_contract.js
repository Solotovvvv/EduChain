// 3_update_student_registry.js
const StudentRegistry = artifacts.require("StudentRegistry");

module.exports = function (deployer) {
  deployer.deploy(StudentRegistry);
};
