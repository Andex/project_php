<?php
session_start();
$_SESSION['username'] = (isset($_SESSION['username'])) ? $_SESSION['username'] : 0; //true - что-то есть и не null
?>

<html>
    <title>Авторизация</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="authorization.css">
        <?php if ($_SESSION['username']){?>
            <div class="check"><label for="exit">Вы уже вошли</label><br>
            <a href="main.php"><strong>назад <span>&#127950;</span></strong></a></div>
        <?php }else{?>
        <form action="input_obrab.php" method="post" name="form" class="transparent">
        <div>
            <h3>Вход</h3>
            <label for="username">Введите логин</label><br>
            <input name="login" type="varchar" required><br>
            <label for="password">Введите пароль</label><br>
            <input name="password" type="password" required><br><br>
            <input name="submit" type="submit" value="войти" required><br><br><br><br>
            <label>Вы ещё не зарегистрированы?</label><br>
            <a href="registration.php"><strong>зарегистрироваться</strong></a></div>
        </form>
        <?php }?>
    </body> 
</html>

