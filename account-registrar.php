<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Account | Registrar</title>
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
  <link rel="stylesheet" href="dist/css/style.css">
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
            <a href="#" class="d-block">Admin</a>
            <a href="#" class="d-block">
              <?php echo strtoupper($_SESSION['fullname']) ?>
            </a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user mr-3"></i>
                <p>Account</p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="account-admin.php" class="nav-link">
                    <p>Admin</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="account-registrar.php" class="nav-link active">
                    <p>Registrar</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="schoolyear.php" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt mr-3"></i>
                <p>School Year</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="course.php" class="nav-link">
                <i class="nav-icon fas fa-graduation-cap mr-3"></i>
                <p>Course</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="section.php" class="nav-link">
                <i class="nav-icon fas fa-list mr-3"></i>
                <p>Section</p>
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
          <h1 class="m-0">Registrar</h1>
        </div>
      </div>

      <section class="content">
        <div class="container">
          <div class="table-responsive card p-3">
            <button class="btn btn-primary mb-3 registrar-btn" data-toggle="modal" data-target="#addRegistrarModal">ADD
              REGISTRAR</button>

            <div class="table-responsive card p-3">
              <table id="registrar_dt" class="table table-striped table-bordered text-center" style="width: 100%">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Fullname</th>
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

  <!-- add registrar modal -->
  <div class="modal fade" id="addRegistrarModal" tabindex="-1" role="dialog" aria-labelledby="addRegistrarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addRegistrarModalLabel">Add Registrar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Fullname <span class="text-danger">*</span></p>
              <input type="email" class="form-control" placeholder="Enter Full Name" id="fullnameR">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Username <span class="text-danger">*</span></p>
              <input type="text" class="form-control" placeholder="Enter username" id="registrar">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Password <span class="text-danger">*</span></p>
              <input type="password" class="form-control" placeholder="Enter password" id="passwordR">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="addregistrar()">SUBMIT</button>
        </div>
      </div>
    </div>
  </div>

  <!-- edit registrar modal -->
  <div class="modal fade" id="editRegistrarModal" tabindex="-1" role="dialog" aria-labelledby="editRegistrarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editRegistrarModalLabel">Edit Registrar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Fullname <span class="text-danger">*</span></p>
              <input type="email" class="form-control" placeholder="Enter Full Name" id="edit_fullnameR">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Username <span class="text-danger">*</span></p>
              <input type="text" class="form-control" placeholder="Enter username" id="edit_registrar">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Password <span class="text-danger">*</span></p>
              <input type="password" class="form-control" placeholder="Enter password" id="edit_passwordR">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="update_registrar()">SAVE CHANGES</button>
          <input type="text" id="hiddendata_registrar">
        </div>
      </div>
    </div>
  </div>


  < <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js">
    </script>
    <script src="https://adminlte.io/themes/v3/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge("uibutton", $.ui.button);
    </script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.js?v=3.2.0"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

    <script>
      $(document).ready(function() {

        $('#registrar_dt').DataTable({
          'serverside': true,
          'processing': true,
          'paging': true,
          "columnDefs": [{
            "className": "dt-center",
            "targets": "_all"
          }, ],
          'ajax': {
            'url': 'adminRegistrar_tbl.php',
            'type': 'post',

          },
        });

      });




      function addregistrar() {
        $.ajax({
          url: 'admin_controller_crud.php',
          method: 'POST',
          data: {
            registrar: $('#registrar').val(),
            passwordR: $('#passwordR').val(),
            fullnameR: $('#fullnameR').val()
          },
          success: function(response) {
            var data = JSON.parse(response);
            if (data.status == 'data_exist') {
              alert('Data already exists.');
            } else if (data.status == 'success') {
              var c = $('#registrar_dt').DataTable().ajax.reload();
              alert('Data added successfully.');
            } else {
              alert('Failed to add data.');
            }
            $('#admin').val('');
            $('#password').val('');
            $('#fullname').val('');

            $('#addRegistrarModal').modal("hide");
          },
          error: function(xhr, status, error) {
            alert('Error: ' + error);
          }
        });
      }


      function edit_registrar_admin(id) {
        $('#hiddendata_registrar').val(id);
        $.post("admin_controller_crud.php", {
          idR: id
        }, function(data,
          status) {
          var userids = JSON.parse(data);
          $('#edit_fullnameR').val(userids.full_name);
          $('#edit_registrar').val(userids.username);
          // $('#edit_password').val(userids.password);
        });
        $('#editRegistrarModal').modal("show");
      }

      function update_registrar() {
        var fullnameR = $('#edit_fullnameR').val()
        var usernameR = $('#edit_registrar').val();
        var passwordR = $('#edit_passwordR').val();
        var hiddendata_registrar = $('#hiddendata_registrar').val();

      
        $.post("admin_controller_crud.php", {
          passwordR: passwordR,
          hiddendata_registrar: hiddendata_registrar,
          usernameR: usernameR,
          fullnameR: fullnameR
        }, function(data, status) {
          var jsons = JSON.parse(data);
          status = jsons.status;
          if (status == 'success') {
            var update = $('#registrar_dt').DataTable().ajax.reload();
          }
          $('#editRegistrarModal').modal("hide");
        });
        
      }


      function delete_registrar_admin(id) {
      $.ajax({

        url: 'admin_controller_crud.php',
        type: 'post',
        data: {
          removeR: id
        },
        success: function (data, status) {

          var json = JSON.parse(data);
          status = json.status;
          if (status == 'success') {

            $('#registrar_dt').DataTable().ajax.reload();


          }
        }
      })
    }
    </script>
</body>

</html>