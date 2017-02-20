<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['pass']);
unset($_SESSION['type']);
header("location: ../index.php");
?>