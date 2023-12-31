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
  <title>Account | Admin</title>
  <link rel="icon" href="dist/img/ucc-logo.png" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet"
    href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
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
        <img src="dist/img/ucc-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: 0.8" />
        <span class="brand-text font-weight-light">EduChain</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="text-center">Admin</a>
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
                  <a href="account-admin.php" class="nav-link active">
                    <p>Admin</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="account-registrar.php" class="nav-link">
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
          <h1 class="m-0">Admin</h1>
        </div>
      </div>

      <section class="content">
        <div class="container">
          <div class="card p-3">
            <button class="btn btn-primary mb-3 admin-btn" data-toggle="modal" data-target="#addAdminModal">ADD
              ADMIN</button>

            <div class="table-responsive card p-3">
              <table id="admin_dt" class="table table-striped table-bordered text-center" style="width: 100%">
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

  <!-- add admin modal -->
  <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Fullname <span class="text-danger">*</span></p>
              <input type="email" class="form-control" placeholder="Enter Full Name" id="fullname">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Username <span class="text-danger">*</span></p>
              <input type="text" class="form-control" placeholder="Enter username" id="admin">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Password <span class="text-danger">*</span></p>
              <input type="password" class="form-control" placeholder="Enter password" id="password">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="addAdmin()">SUBMIT</button>
        </div>
      </div>
    </div>
  </div>

  <!-- edit admin modal -->
  <div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Fullname <span class="text-danger">*</span></p>
              <input type="email" class="form-control" placeholder="Enter Full Name" id="edit_fullname">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Username <span class="text-danger">*</span></p>
              <input type="text" class="form-control" placeholder="Enter username" id="edit_admin">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <p class="m-0 font-weight-bold">Password <span class="text-danger">*</span></p>
              <input type="password" class="form-control" placeholder="Enter password" id="edit_password">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="update_admin()">SAVE CHANGES</button>
          <input type="text" id="hiddendata_id">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
      $(document).ready(function () {

        $('#admin_dt').DataTable({
          'serverside': true,
          'processing': true,
          'paging': true,
          "columnDefs": [{
            "className": "dt-center",
            "targets": "_all"
          },],
          'ajax': {
            'url': 'admin_tbl.php',
            'type': 'post',

          },
        });

      });

      function addAdmin() {
        $.ajax({
          url: 'admin_controller_crud.php',
          method: 'POST',
          data: {
            admin: $('#admin').val(),
            password: $('#password').val(),
            fullname: $('#fullname').val()
          },
          success: function (response) {
            var data = JSON.parse(response);
            if (data.status == 'data_exist') {
             
              Swal.fire({
                title: 'Record Already Exist!',
                icon: 'warning',
                showConfirmButton: false,
                timer: 1000
              });
            } else if (data.status == 'success') {
              var c = $('#admin_dt').DataTable().ajax.reload();
              Swal.fire({
                title: 'Record Added!',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000
              });
            } else {
              alert('Failed to add data.');
            }
            $('#admin').val('');
            $('#password').val('');
            $('#fullname').val('');

            $('#addAdminModal').modal("hide");
          },
          error: function (xhr, status, error) {
            alert('Error: ' + error);
          }
        });
      }


      function edit_admin(id) {
        $('#hiddendata_id').val(id);
        $.post("admin_controller_crud.php", {
          id: id
        }, function (data,
          status) {
          var userids = JSON.parse(data);
          $('#edit_fullname').val(userids.full_name);
          $('#edit_admin').val(userids.username);
          // $('#edit_password').val(userids.password);
        });
        $('#editAdminModal').modal("show");
      }

      function update_admin() {
        var fullname = $('#edit_fullname').val()
        var username = $('#edit_admin').val();
        var password = $('#edit_password').val();
        var hiddendata_update = $('#hiddendata_id').val();


        $.post("admin_controller_crud.php", {
          password: password,
          hiddendata_update: hiddendata_update,
          username: username,
          fullname: fullname
        }, function (data, status) {
          var jsons = JSON.parse(data);
          status = jsons.status;
          if (status == 'success') {
            Swal.fire({
              title: 'Record Updated!',
              icon: 'success',
              showConfirmButton: false,
              timer: 1000
            });
            var update = $('#admin_dt').DataTable().ajax.reload();
          }
          $('#editAdminModal').modal("hide");
        });
      }



      function delete_admin(id) {
        Swal.fire({
          title: 'Are you sure?',
          text: 'You are about to delete this record.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            // User confirmed deletion
            $.ajax({
              url: 'admin_controller_crud.php',
              type: 'post',
              data: {
                remove: id
              },
              success: function (data, status) {
                var json = JSON.parse(data);
                status = json.status;
                if (status == 'success') {
                  Swal.fire({
                    title: 'Record Deleted!',
                    text: 'The admin record has been successfully deleted.',
                    icon: 'success',
                  });
                  $('#admin_dt').DataTable().ajax.reload();
                }
              }
            });
          }
        });
      }

    </script>
</body>

</html>