<?php
session_start();
$_SESSION['username'] = (isset($_SESSION['username'])) ? $_SESSION['username'] : 0;

?>

<html> 
    <title>Регистрация</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="input.css">
    <body bgcolor="#FFF8DC">
        <?php if (!$_SESSION['username']){?>
        <form action="rega_obrab.php" method="post" name="form">
            <font size="6" face="fantasy" color="#CD5555">
            <div align="center" style="margin-top: 40px;">
            <marquee style="color: #CD5555; font-family: sans-serif;">РЕГИСТРАЦИЯ</marquee> 
                <p>*Введите логин: <br> 
            <input name="login" type="varchar" size="20" maxlength="40" required></p>
            <p>*Придумайте пароль:<br> <input name="password" type="password" size="10" maxlength="40" required></p>
            <i>*Подтверждение пароля:</i><br> <input name="verification" type="password" size="10" maxlength="40" required>
            <p>*Введите телефон:<br> <input name="phone" type="integer" size="20" maxlength="40" required></p>
            <p>Введите email:</b><br> <input name="email" type="varchar" size="20" maxlength="40"></p>
            <input name="submit" type="submit" value="зарегистрироваться" color="#CD5555"> </div>
        </form>
        <?php } else{?>
        <div align="center" style="margin-top: 40px;">
            <strong>Вы уже зарегистрировались</strong>
            <a href="main.php">назад</a></div>
        <?php }?>
    </body> 
</html>

