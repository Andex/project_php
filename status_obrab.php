<?php
//здесь админ обновляет статус брони - из сессии берется id_reservation, а username=admin
//можно придти только с detalied_view и уйти на booking_list_user

session_start();
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

$new_status = $_POST['newstatus'];
$bID = $_SESSION['bookingID'];
echo '$new_status = '.$new_status.'$bID'.$bID;
$for_update_status = mysqli_query($link,"UPDATE booking set status='$new_status' WHERE id = '$bID'");

header("Refresh: 0;  url=booking_list_user.php?select=know_admin");

mysqli_close($link);
?>