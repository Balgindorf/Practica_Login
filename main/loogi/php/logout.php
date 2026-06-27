<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: /loogi/login-3.php");
exit;
?>