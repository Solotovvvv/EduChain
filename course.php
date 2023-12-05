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
    <title>Course</title>
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
                        <a href="#" class="d-block">
                                        <?php echo strtoupper($_SESSION['fullname']) ?>
                                    </a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-closed">
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
                            <a href="schoolyear.php" class="nav-link ">
                                <i class="nav-icon fas fa-calendar-alt mr-3"></i>
                                <p>School Year</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="course.php" class="nav-link active">
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
                    <h1 class="m-0">Course</h1>
                </div>
            </div>

            <section class="content">
                <div class="container">
                    <div class="card p-3">
                        <div class="print-button mb-3">
                            <button class="btn btn-primary" id="add-department" data-toggle="modal" data-target="#add_course">ADD COURSE</button>
                        </div>
                        <div class="card p-3">
                            <table id="course_dt" class="table table-striped table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>COURSE</th>
                                        <th>ABBREVIATION</th>
                                        <th>STATUS</th>
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
    <div class="modal fade" id="add_course" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="course mb-3">
                        <label>Course <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="course" placeholder="Enter course name">
                    </div>
                    <div class="abbreviation">
                        <label>Abbreviation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="Abbreviation" placeholder="Enter abbreviation name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="Add_courses()">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit course modal -->
    <div class="modal fade" id="update_course" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="course mb-3">
                        <label>Course <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="update_coursess" placeholder="Enter course name">
                    </div>
                    <div class="abbreviation mb-3">
                        <label>Abbreviation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="update_abbre" placeholder="Enter abbreviation name">
                    </div>
                    <div class="status">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="" id="update_course_status">
                            <option value="" readonly selected disabled>Select Status</option>
                            <option value="1">Available</option>
                            <option value="">Closed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="course_update()">SAVE
                        CHANGES</button>
                    <input type="hidden" id="hiddendata_course">
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
    <script src="https://adminlte.io/themes/v3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.js?v=3.2.0"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {

            $('#course_dt').DataTable({
                'serverside': true,
                'processing': true,
                'paging': true,
                "columnDefs": [{
                    "className": "dt-center",
                    "targets": "_all"
                }, ],
                'ajax': {
                    'url': 'course_tbl.php',
                    'type': 'post',

                },
            });

        });

        function Add_courses() {
            $.ajax({
                url: 'course_controller.php',
                method: 'POST',
                data: {
                    course: $('#course').val(),
                    abbreviation: $('#Abbreviation').val()
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status == 'data_exist') {
                        Swal.fire({
                            title: 'Record Already Exist!',
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else if (data.status == 'success') {
                        var c = $('#course_dt').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Record Added!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else {
                        alert('Failed to add data.');
                    }
                    $('#course').val('');
                    $('#Abbreviation').val('');
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        }

        function edit_course(update) {
            $('#hiddendata_course').val(update);
            $.post("course_controller.php", {
                update: update
            }, function(data,
                status) {
                var userids = JSON.parse(data);
                $('#update_coursess').val(userids.course_name);
                $('#update_abbre').val(userids.abbreviation);
                $('#update_course_status option[value="' + userids.status + '"]').prop('selected', true); // Use this line

            });
            $('#update_course').modal("show");
        }


        function course_update() {
            var status = $('#update_course_status').val()
            var course = $('#update_coursess').val();
            var abbre = $('#update_abbre').val();
            var hiddendata = $('#hiddendata_course').val();


            $.post("update_controller.php", {
                status: status,
                hiddendata: hiddendata,
                course: course,
                abbre: abbre
            }, function(data, status) {
                var jsons = JSON.parse(data);
                status = jsons.status;
                if (status == 'success') {
                    var update = $('#course_dt').DataTable().ajax.reload();
                    Swal.fire({
                        title: 'Record Updated!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        }
    </script>
</body>

</html>