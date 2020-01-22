<?php
session_start();
$_SESSION['username'] = (isset($_SESSION['username'])) ? $_SESSION['username'] : 0; //true - что-то есть и не null
//echo '$_SESSION[username] = '.$_SESSION['username'];
?>

<html>
    <title>Авторизация</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="authorization.css">
        <?php if ($_SESSION['username']){?>
        <div align="center" class="form-inner">
            <strong>Вы уже вошли</strong>
            <a href="main.php"><strong>назад</strong></a></div>
        <?php }else{?>
        <form action="input_obrab.php" method="post" name="form" class="transparent">
            <div class="form-inner">
            <h3>Вход</h3>
            <label for="username">Введите логин</label>
            <input name="login" type="varchar" required  id="username">
            <label for="password">Введите пароль</label>
            <input name="password" type="password" required id="password">
            <input name="submit" type="submit" value="войти" required>
            <label>Вы ещё не зарегистрированы?</label>
            <a href="registration.php"><strong>зарегистрироваться</strong></a></div>
        </form>
        <?php }?>
    </body> 
</html>

