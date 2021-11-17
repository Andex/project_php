<?php

session_start();

function generateSalt($SaltLength = 3){
    $salt = '';
    for($i = 0; $i < $SaltLength; $i++){
        $salt = $salt.chr(mt_rand(33, 126));
    }
    return $salt;
}

require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

if($_POST['login'] != '') { $new_name=$_POST['login']; } else {     echo '<h3>'.'Данные введены не полностью!'.'</h3>'.'<br>';    exit();}
if(isset($_POST['password'])) { $passw=$_POST['password']; } else {     echo '<h3>'.'Данные введены не полностью!'.'</h3>'.'<br>';    exit();}
if(isset($_POST['verification'])) { $verify=$_POST['verification']; } else {     echo '<h3>'.'Данные введены не полностью!'.'</h3>'.'<br>';    exit();}
if(isset($_POST['phone'])) { $phone=$_POST['phone']; } else {     echo '<h3>'.'Пожалуйста, введите номер телефона'.'</h3>'.'<br>';    exit();}
if(isset($_POST['email'])) { $email=$_POST['email']; } else {     $email = '-';}
$existing_name = mysqli_query($link,"SELECT name FROM users WHERE name = '$new_name'");
if(ctype_digit($phone)!='false' or ctype_alpha(str_split($new_name)[0])!='false'){
    echo '<h3>'.'Неверный формат номера или логина! (Логин должен начинаться с буквы)'.'</h3>'.'<br>';
    exit();
}
if(isset(mysqli_fetch_row($existing_name)[0])){   // если рез-т по name не пустой
    echo '<h3>'.'Пользователь с таким именем уже существует'.'</h3>';
    exit();
}
if ($passw!=$verify){
    echo '<h3>'.'Пароль или его подтверждение'.'<b>'.' не '.'</b>'.'верно, попробуйте еще раз'.'</h3>';
    exit();
}

else{
    $admin_check = mysqli_query($link,"SELECT name FROM users WHERE name = 'admin'");// есть ли вообще админ
    $cmp_admin = stripos(strtolower($new_name), 'admin');
    if ($admin_check == 'true' and $cmp_admin != 'false' or substr_count(strtolower($new_name), 'admin') != 0){
        echo '<h3>'.'Нельзя использовать "admin" в имени пользователя'.'</h3>';
        exit();
    }
    $_SESSION['username'] = $new_name;
    echo '<h3>'.'Поздравляем, Вы успешно зарегестрированы!'.'</h3>';
    
    $required_res1 = mysqli_query($link,"SELECT max(id) FROM users");
    $required_res2 = mysqli_query($link,"SELECT max(id) FROM passwords");
    $required_res3 = mysqli_query($link,"SELECT max(id) FROM hashes");
    
    $max_id_user = mysqli_fetch_row($required_res1);
    $max_id_passw = mysqli_fetch_row($required_res2);
    $max_id_hash = mysqli_fetch_row($required_res3);
    
    $uId = 1 + (int)$max_id_user[0];
    $pId = 1 + (int)$max_id_passw[0];
    $hId = 1 + (int)$max_id_hash[0];
    
    $paswId = $pId;//
    $hashId = $hId;//
    $email = $new_name.'@...';
      
    $salt = generateSalt(3);
    $pHash = md5($passw.$salt);
      
    $result2 = mysqli_query($link,"INSERT INTO hashes (id,pass_hash) VALUES ('$hId','$pHash')");
    $result3 = mysqli_query($link,"INSERT INTO passwords (id,password,verification,salt,hash_id) VALUES ('$pId','$passw','$verify','$salt','$hashId')");
    $result4 = mysqli_query($link,"INSERT INTO users (id,name,passw_id,phone,email) VALUES ('$uId','$new_name','$paswId','$phone','$email')");
    if($result2!='true' or $result3!='true' or $result4!='true'){
        echo '<h3>'.'Информация в базу'.'<b>'.' не '.'</b>'.'добавлена'.'</h3>';
    }
    else{
        echo '<h3>'.'Информация в базу'.'<i>'.' успешно '.'</i>'.'добавлена'.'</h3>';
        header("Refresh: 0;  url=main.php");
    }
}
mysqli_close($link);
?>
    
