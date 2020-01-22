<?php

session_start();
//unset($_SESSION['user_id']);
//unset($_SESSION['username']);
//setcookie('username', md5($user_id.$login), time() - 10, '/');
//setcookie('user_id', $user_id, time() - 10, '/');
session_destroy();
header("Location: input.php");
exit();
//?>