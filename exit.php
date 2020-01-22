<?php

session_start();
unset($_SESSION['username']);
unset($_SESSION['bookingID']);
unset($_SESSION['phone']);
session_destroy();
header("Location: input.php");
exit();
?>