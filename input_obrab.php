<?php
session_start();

require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

if(isset($_POST['login'])) { $name=$_POST['login']; } else {     echo '<h3>'.'Данные введены не полностью!'.'</h3>'.'<br>';    exit();}
if(isset($_POST['password'])) { $passw=$_POST['password']; } else {     echo '<h3>'.'Данные введены не полностью!'.'</h3>'.'<br>'; exit();}

$first_check = mysqli_query($link,"SELECT id, name, passw_id FROM users WHERE name = '$name'");
$second_check = mysqli_query($link,"SELECT id, password FROM passwords WHERE password = '$passw'");
$id_for_first_check = mysqli_fetch_array($first_check);
$id_for_second_check = mysqli_fetch_array($second_check);
if(!isset($id_for_first_check)){   // isset возвращает true, если не null и false иначе. в if() - true дб для входа!
    echo '<h3>'.'Пользователя с таким именем не существует'.'</h3>';
    exit();
}
if ($second_check == 'false' or $id_for_first_check[2] != $id_for_second_check[0]){
    echo '<h3>'.'Пароль введен'.'<b>'.' не '.'</b>'.'верно, попробуйте еще раз'.'</h3>';
    exit();
}
else{
    $_SESSION['username'] = $name;
    if ($name == 'admin'){
        echo '<h3>'.'Владыка, '. $name .', здравствуйте!'.'</h3>';
        echo '<h3>'.'Добро пожаловать на страницу администратора!'.'</h3>';;
    }
    else{
        echo '<h3>'.'Добро пожаловать, '. $name .'!'.'</h3>';
    }
    header("Refresh: 0;  url=main.php");
}
mysqli_close($link);
?>