<?php
include 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Activity Log</title>
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
                        <a href="#" class="d-block">Admin</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
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
                                    <a href="account-registrar.php" class="nav-link">
                                        <p>Registrar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="schoolyear.php" class="nav-link active">
                                <i class="nav-icon fas fa-clock mr-3"></i>
                                <p>Schoolyear</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="course.php" class="nav-link ">
                                <i class="nav-icon fas fa-clock mr-3"></i>
                                <p>Course</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="section.php" class="nav-link ">
                                <i class="nav-icon fas fa-clock mr-3"></i>
                                <p>section</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="activity-log.php" class="nav-link ">
                                <i class="nav-icon fas fa-clock mr-3"></i>
                                <p>Activity Log</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-danger">
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
                    <h1 class="m-0">Section</h1>
                </div>
            </div>

            <section class="content">
                <div class="container">
                    <div class="card p-3">
                        <div class="print-button mb-3">
                            <button class="btn btn-primary" id="add-department" data-toggle="modal" data-target="#schoolyear">Add Course</button>
                        </div>
                        <div class="card p-3">
                            <table id="schoolyear_dt" class="table table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Schoolyear</th>
                                        <th>Status</th>
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

    <!-- add course modal -->
    <div class="modal fade" id="schoolyear" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add Courses</h5>
                </div>
                <div class="modal-body">
                    <div class="course">
                        <label>Schoolyear <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="schoolyear_val" placeholder="Enter SchoolYear">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Activate_SY()">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- edit details modal -->
    <div class="modal fade" id="edit_sy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                </div>
                <div class="modal-body">

                    <div class="course">
                        <label>Schoolyear <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_schoolyear" placeholder="Enter SchoolYear">
                    </div>

                    <div class="status">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="" id="edit_status">
                            <option value="" readonly selected disabled>Select Status</option>
                            <option value="1">Open</option>
                            <option value="">Closed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="schoolyear_update()">Update</button>
                    <input type="hidden" id="hiddendata_sy">
                </div>
            </div>
        </div>
    </div>

    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge("uibutton", $.ui.button);
    </script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#schoolyear_dt').DataTable({
                'serverside': true,
                'processing': true,
                'paging': true,
                "columnDefs": [{
                    "className": "dt-center",
                    "targets": "_all"
                }, ],
                'ajax': {
                    'url': 'schoolyear_tbl.php',
                    'type': 'post',

                },
            });

        });

        function Activate_SY() {
            $.ajax({
                url: 'sy_controller.php',
                method: 'POST',
                data: {
                    schoolyear: $('#schoolyear_val').val(),
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status == 'data_exist') {
                        alert('Data already exists.');
                    } else if (data.status == 'success') {
                        var c = $('#schoolyear_dt').DataTable().ajax.reload();
                        alert('Data added successfully.');
                    } else {
                        alert('Failed to add data.');
                    }
                    $('#schoolyear_val').val('');
                  
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        }

        function edit_schoolyear(update) {
            $('#hiddendata_sy').val(update);
            $.post("sy_controller.php", {
                update: update
            }, function(data,
                status) {
                var userids = JSON.parse(data);
                $('#edit_schoolyear').val(userids.schoolyear);
                $('#edit_status option[value="' + userids.status + '"]').prop('selected', true); // Use this line

            });
            $('#edit_sy').modal("show");
        }


        function schoolyear_update() {
            var status = $('#edit_status').val()
            var schoolyear = $('#edit_schoolyear').val();
            var hiddendata = $('#hiddendata_sy').val();

            $.post("update_controller.php", {
                status: status,
                hiddendata_sy: hiddendata,
                schoolyear: schoolyear,
            }, function(data, status) {
                var jsons = JSON.parse(data);
                status = jsons.status;
                if (status == 'success') {
                    var update = $('#schoolyear_dt').DataTable().ajax.reload();
                }
            });
        }
    </script>
</body>

</html>