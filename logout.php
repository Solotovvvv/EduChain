<?php
session_start();
session_unset();
session_destroy();
echo "<script> setTimeout(() => {
    window.location.href = 'login.php'
},1); </script>";
exit;