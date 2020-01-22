<?php
session_start();

require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

if(isset($_POST['login'])) { $name=$_POST['login']; } else {     echo '<h3>'.'Данные введены не полностью!'.'</h3>'.'<br>';    exit();}
if(isset($_POST['password'])) { $passw=$_POST['password']; } else {     echo '<h3>'.'Данные введены не полностью!'.'</h3>'.'<br>'; exit();}
//echo '<h3>'.''.'</h3>';

$first_check = mysqli_query($link,"SELECT id, name, passw_id FROM users WHERE name = '$name'");// там лежит не фолс но и не тру
$second_check = mysqli_query($link,"SELECT id, password FROM passwords WHERE password = '$passw'");
$id_for_first_check = mysqli_fetch_array($first_check);
$id_for_second_check = mysqli_fetch_array($second_check);
//echo $id_for_first_check[1] .'!'. $id_for_second_check[0];
//var_dump($id_for_first_check);
if(!isset($id_for_first_check)){   // isset возвращает тру, если не null и фолс иначе. в if() - тру дб для входа    УРА! ТОЛЬКО ВОТ ТАК!!!!
    echo '<h3>'.'Пользователя с таким именем не существует'.'</h3>';
    exit();
}
if ($second_check == 'false' or $id_for_first_check[2] != $id_for_second_check[0]){
    echo '<h3>'.'Пароль введен'.'<b>'.' не '.'</b>'.'верно, попробуйте еще раз'.'</h3>';
    exit();
}
else{
    $_SESSION['username'] = $name;
    //echo 'SESSION["username"] = '.$_SESSION['username'];
    if ($name == 'admin'){
        echo '<h3>'.'Владыка, '. $name .', здравствуйте!'.'</h3>';
        echo '<h3>'.'Добро пожаловать на страницу администратора!'.'</h3>';;
    }
    else{
        echo '<h3>'.'Добро пожаловать, '. $name .'!'.'</h3>';
    }
//    echo "<a href='input.php'>ВЫЙТИ</a>";
    header("Refresh: 0;  url=main.php");
//    $num = (isset($_SESSION['num'])) ? $_SESSION['num'] : 0;
//    $_SESSION['num'] = $num + 1;
//    echo '$num = '.$num;
}
mysqli_close($link);
?>