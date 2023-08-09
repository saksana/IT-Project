<?php
session_start();

unset($_SESSION['adminid']);
unset($_SESSION['adminname']);
unset($_SESSION['username']);
header("Location: index.php");
?>