<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: /login-3.php");
exit;
?>