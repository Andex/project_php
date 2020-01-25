<?php
session_start();
$_SESSION['username'] = (isset($_SESSION['username'])) ? $_SESSION['username'] : 0;
?>

<html> 
    <title>Регистрация</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="authorization.css">
    <body>
        <?php if (!$_SESSION['username']){?>
        <form action="rega_obrab.php" method="post" name="form">
            <div>
            <h3>РЕГИСТРАЦИЯ</h3> 
            <label for="username">*Введите логин:</label><br> 
            <input name="login" type="varchar" size="20" maxlength="40" required><br> 
            <label for="password">*Придумайте пароль:</label><br> <input name="password" type="password" size="10" maxlength="40" required><br> 
            <label for="password">*Подтвердите пароль:</label><br> <input name="verification" type="password" size="10" maxlength="40" required><br><br><br>
            <label>*Введите телефон:</label><br> <input name="phone" type="integer" size="20" maxlength="40" required><br> 
            <label>Введите email:</label><br> <input name="email" type="varchar" size="20" maxlength="40"><br>
            <div style="margin-top: 40px;"><input name="submit" type="submit" value="зарегистрироваться"></div></div>
        <?php } else{?>
        <div class="check">
            <label for="exit">Вы уже зарегистрированы</label><br>
            <a href="main.php"><strong>назад <span>&#127950;</span></strong></a></div>
        <?php }?>
        </form>
    </body> 
</html>

