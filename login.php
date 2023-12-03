<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" href="dist/img/ucc-logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/style.css">
</head>

<body class="bg-success">
  <div class="card login-card text-center">
    <div>
      <img src="dist/img/ucc-logo.png" alt="UCC Logo" width="100">
    </div>

    <p class="mt-3 mb-4 text-muted">Log in to your account</p>

    <input type="text" id="username" class="form-control mb-2" placeholder="Username">
    <input type="password" id="password" class="form-control mb-3" placeholder="Password">
    <button class="btn btn-primary" onclick="login()">LOGIN</button>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>


<script>
  function login() {
    var username = $('#username').val();
    var password = $('#password').val();

    if (
      !username ||
      !password
    ) {
      Swal.fire({
        title: 'Warning',
        text: 'Please fill out all required fields.',
        icon: 'warning'
      });
      return;
    }

    var payload = {
      username: username,
      password: password
    };

    $.ajax({
      type: "POST",
      url: 'Login_back.php',
      data: {
        payload: JSON.stringify(payload),
        setFunction: 'Login'
      },
      success: function (response) {
        data = JSON.parse(response);
        swal.fire(data.title, data.message, data.icon);
        if (data.user_role === 0) {
          setTimeout(function () {
            window.location.href = "account-admin.php";
          }, 2000);
        } else if (data.user_role === 1) {
          setTimeout(function () {
            window.location.href = "student.php";
          }, 2000);
        }
      }
    });

  }
</script>

</html>