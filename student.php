<?php
session_start();
if (!isset($_SESSION['fullname'])) {
  header('Location:login.php');
  exit;
}
include 'includes/config.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student</title>
  <link rel="icon" href="dist/img/ucc-logo.png" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/jqvmap/jqvmap.min.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
        <img src="dist/img/ucc-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">EduChain</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block">Registrar</a>
            <a href="#" class="d-block">
              <?php echo strtoupper($_SESSION['fullname']) ?>
            </a>

          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="student.php" class="nav-link active">
                <i class="nav-icon fas fa-user mr-3"></i>
                <p>Student</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="list.php" class="nav-link">
                <i class="nav-icon fas fa-list mr-3"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link text-danger">
                <i class="nav-icon fas fa-power-off mr-3"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container">
          <h1 class="m-0">Student</h1>
        </div>
      </div>

      <section class="content">
        <div class="container">
          <div class="card p-3">
            <div class="input-group">
              <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#addStudentModal">
                ADD STUDENT
              </button>
              <button class="btn btn-success">
                IMPORT
              </button>
            </div>

            <div class="card p-3 mt-3">
              <table id="student_dt" class="table table-striped table-bordered" style="width: 100%">
                <thead>
                  <tr>
                    <th>NAME</th>
                    <th>STUDENT NO.</th>
                    <th>COURSE</th>
                    <th>YEAR & SECTION</th>
                    <th>SCHOOL YEAR</th>
                    <th>ACTIONS</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- add student modal -->
  <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="student-no row mb-3">
            <div class="col-sm-4">
              <p class="font-weight-bold m-0">Student No. <span class="text-danger">*</span></p>
              <input type="text" class="form-control" placeholder="Enter student no." id="student_no">
            </div>
          </div>
          <div class="name mb-3">
            <p class="font-weight-bold m-0">Name <span class="text-danger">*</span></p>
            <input type="text" class="form-control" placeholder="Enter name" id="name">
          </div>
          <div class="course mb-3">
            <p class="font-weight-bold m-0">Course <span class="text-danger">*</span></p>
            <select class="form-control" id="course">
              <option value="" selected disabled>Select Course</option>
              <?php

              $pdo = Database::connection();
              $sql = "SELECT * FROM course WHERE status = '1'";
              $stmt = $pdo->prepare($sql);

              if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . $row['id'] . '">' . $row['course_name'] . '</option>';
                }
              }
              ?>
            </select>
          </div>
          <div class="row">
            <div class="year-level col-sm-4">
              <p class="font-weight-bold m-0">Year Level <span class="text-danger">*</span></p>
              <select class="form-control" id="year">
                <option value="4" Selected readonly>4th Year</option>
              </select>
            </div>
            <div class="section col-sm-4">
              <p class="font-weight-bold m-0">Section <span class="text-danger">*</span></p>
              <select class="form-control" id="section">
                <option value="" selected disabled>Select Section</option>
              </select>
            </div>
            <div class="school-year col-sm-4">
              <p class="font-weight-bold m-0">School Year <span class="text-danger">*</span></p>
              <!-- <input type="text" class="form-control" placeholder="Enter school year" id="sy"> -->
              <?php

              $pdo = Database::connection();
              $sql = "SELECT * FROM schoolyear WHERE status = '1'";
              $stmt = $pdo->prepare($sql);

              if ($stmt->execute()) {
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $selectedSchoolYear = $row['schoolyear'];
                } else {
                  $selectedSchoolYear = ""; // Set a default value if no school year is selected
                }
              }
              ?>
              <input type="text" class="form-control" id="sy" value="<?php echo $selectedSchoolYear; ?>" readonly>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="Add_Student()">SUBMIT</button>
        </div>
      </div>
    </div>
  </div>

  <!-- edit student modal -->
  <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="student-no row mb-3">
            <div class="col-sm-4">
              <p class="font-weight-bold m-0">Student No. <span class="text-danger">*</span></p>
              <input type="text" class="form-control" placeholder="Enter student no." id="edit_student_no">
            </div>
          </div>
          <div class="name mb-3">
            <p class="font-weight-bold m-0">Name <span class="text-danger">*</span></p>
            <input type="text" class="form-control" placeholder="Enter name" id="edit_name">
          </div>
          <div class="course mb-3">
            <p class="font-weight-bold m-0">Course <span class="text-danger">*</span></p>
            <select class="form-control" id="edit_course">
              <option value="" selected disabled>Select Course</option>
              <?php
              $pdo = Database::connection();
              $sql = "SELECT * FROM course WHERE status = '1'";
              $stmt = $pdo->prepare($sql);

              if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . $row['id'] . '">' . $row['abbreviation'] . '</option>';
                }
              }
              ?>
            </select>
          </div>
          <div class="row">
            <div class="year col-sm-4">
              <p class="font-weight-bold m-0">Year <span class="text-danger">*</span></p>
              <select class="form-control" id="edit_year">
                <option value="4" readonly selected>4th Year</option>
              </select>
            </div>
            <div class="section col-sm-4">
              <p class="font-weight-bold m-0">Section <span class="text-danger">*</span></p>
              <select class="form-control" id="edit_section">
                <option value="" selected disabled>Select Section</option>
              </select>
            </div>
            <div class="school-year col-sm-4">
              <p class="font-weight-bold m-0">School Year <span class="text-danger">*</span></p>
              <?php

              $pdo = Database::connection();
              $sql = "SELECT * FROM schoolyear WHERE status = '1'";
              $stmt = $pdo->prepare($sql);

              if ($stmt->execute()) {
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $selectedSchoolYear = $row['schoolyear'];
                } else {
                  $selectedSchoolYear = ""; // Set a default value if no school year is selected
                }
              }
              ?>
              <input type="text" class="form-control" id="edit_sy" value="<?php echo $selectedSchoolYear; ?>" readonly>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="update_student()">SAVE CHANGES</button>
          <input type="hidden" id="hiddendata_student">
        </div>
      </div>
    </div>
  </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="https://adminlte.io/themes/v3/dist/js/adminlte.js?v=3.2.0"></script>

  <script>
    $(document).ready(function() {

      $('#student_dt').DataTable({
        'serverside': true,
        'processing': true,
        'paging': true,
        "columnDefs": [{
          "className": "dt-center",
          "targets": "_all"
        }, ],
        'ajax': {
          'url': 'student_tbl.php',
          'type': 'post',

        },
      });

    });

    function Add_Student() {
      $.ajax({
        url: 'student_controller.php',
        method: 'POST',
        data: {
          course: $('#course').val(),
          year: $('#year').val(),
          section: $('#section').val(),
          name: $('#name').val(),
          schoolyear: $('#sy').val(),
          student_no: $('#student_no').val()
        },

        success: function(response) {
          var data = JSON.parse(response);
          if (data.status == 'data_exist') {
            alert('Data already exists.');
          } else if (data.status == 'success') {
            var c = $('#student_dt').DataTable().ajax.reload();
            alert('Data added successfully.');
          } else {
            alert('Failed to add data.');
          }
          $('#addStudentModal').modal('hide');
          $('#course').val('')

          $('#section').val('')
          $('#name').val('')
          $('#sy').val('')
        },
        error: function(xhr, status, error) {
          alert('Error: ' + error);
        }
      });
    }


    // function edit_student(update) {
    //         $('#hiddendata_student').val(update);
    //         $.post("student_controller.php", {
    //             update: update
    //         }, function(data,
    //             status) {
    //             var userids = JSON.parse(data);
    //             console.log("Response:", userids)
    //             // $('#edit_name').val(userids.fullname);

    //             // $('#edit_course option[value="' + userids.course + '"]').prop('selected', true); // Use this line
    //             // // $('#update_section').val(userids.section);
    //             // $('#edit_section option[value="' + userids.section + '"]').prop('selected', true); // Use this line

    //         });
    //         $('#editStudentModal').modal("show");
    //     }

    function edit_student(update) {
      $('#hiddendata_student').val(update);
      $.post("student_edit.php", {
        update: update
      }, function(data, status) {
        var userids = JSON.parse(data);
        console.log("Response:", userids);

        // Populate modal fields
        $('#edit_name').val(userids.fullname);
        $('#edit_sy').val(userids.schooyear);
        $('#edit_course option[value="' + userids.course + '"]').prop('selected', true);
        $('#edit_student_no').val(userids.studentNumber);

        // Clear existing options in the edit_section select element
        $('#edit_section').empty();

        // Add default disabled option
        $('#edit_section').append('<option value="" selected disabled>Select Section</option>');

        // Populate sections from the response
        userids.sections.forEach(function(section) {
          $('#edit_section').append('<option value="' + section.section + '">' + section.section + '</option>');


        });
        $('#edit_section option[value="' + userids.section + '"]').prop('selected', true); // Use this line



        // Open the modal
        $('#editStudentModal').modal("show");
      });
    }

    function update_student() {
      var hiddendata = $('#hiddendata_student').val();
      var course = $('#edit_course').val();
      var name = $('#edit_name').val();
      var sy = $('#edit_sy').val();
      var section = $('#edit_section').val()
      var year = $('#edit_year').val();
      var student_no = $('#edit_student_no').val();

      $.post("student_update.php", {
        name: name,
        hiddendata_student: hiddendata,
        course: course,
        sy: sy,
        section: section,
        year: year,
        student_no: student_no

      }, function(data, status) {
        var jsons = JSON.parse(data);
        status = jsons.status;
        if (status == 'success') {
          var update = $('#student_dt').DataTable().ajax.reload();
        }
        $('#editStudentModal').modal("hide");
      });



    }


    function delete_student(id) {
      $.ajax({

        url: 'delete_student.php',
        type: 'post',
        data: {
          id: id
        },
        success: function(data, status) {

          var json = JSON.parse(data);
          status = json.status;
          if (status == 'success') {

            $('#student_dt').DataTable().ajax.reload();


          }
        }
      })
    }


    function populateSectionDropdown(courseId, sectionDropdown) {
      $.ajax({
        type: 'GET',
        url: 'get_sections.php',
        data: {
          course_id: courseId
        },
        dataType: 'json',
        success: function(sections) {
          // Clear existing options in the Section dropdown
          sectionDropdown.html('<option value="" selected disabled>Select Section</option>');

          // Populate the Section dropdown with the fetched sections
          $.each(sections, function(index, section) {
            sectionDropdown.append('<option value="' + section.section + '">' + section.section + '</option>');
          });
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', status, error);
        }
      });
    }


    $('#course').change(function() {
      // Get the selected course ID
      var courseId = $(this).val();

      // Call the common function to populate the section dropdown
      populateSectionDropdown(courseId, $('#section'));
    });

    $('#edit_course').change(function() {
      // Get the selected course ID
      var courseId = $(this).val();

      // Call the common function to populate the edit_section dropdown
      populateSectionDropdown(courseId, $('#edit_section'));
    });

    // $('#course').change(function() {
    //   // Get the selected course ID
    //   var courseId = $(this).val();
    //   $.ajax({
    //     type: 'GET',
    //     url: 'get_sections.php',
    //     data: {
    //       course_id: courseId
    //     },
    //     dataType: 'json',
    //     success: function(sections) {
    //       // Clear existing options in the Section dropdown
    //       $('#section').html('<option value="" selected disabled>Select Section</option>');

    //       // Populate the Section dropdown with the fetched sections
    //       $.each(sections, function(index, section) {
    //         $('#section').append('<option value="' + section.section + '">' + section.section + '</option>');
    //       });
    //     },
    //     error: function(xhr, status, error) {
    //       console.error('AJAX Error:', status, error);
    //     }
    //   });
    // });
  </script>
</body>

</html>