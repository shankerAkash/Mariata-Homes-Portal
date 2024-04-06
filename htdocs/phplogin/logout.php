<?php
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();
session_unset();
session_destroy();
setcookie("username", "", time() - 3600);
header("Location: ../phplogin/login.php");
?>