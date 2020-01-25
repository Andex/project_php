<?php
//главная страница - сюда передаётся username
//придти можно с choose_ticket, booking_list_user и booking_list_admin
//переход на choose_ticket, booking_list_user и booking_list_admin

session_start();
$username = $_SESSION['username'];
?>
<html>
    <head>
        <title>Главная страница</title>
        <link rel="stylesheet" type="text/css" href="main.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--для мобильных устройств-->
    </head>
    <body>
        <form action="">
        <img src="images\F1_heading_new.jpg" height="100px" alt='header' class="header">
        <br><br><br><br><br><div align="right" class="exit"><a href="exit.php" class="exit">ВЫЙТИ</a></div>
        <div align="center" class="text">
        Этап чемпионата мира Формулы 1 пройдет на Сочи Автодроме с 24 по 27 сентября<br>
            и станет самым грандиозным автоспортивным мероприятием года в России.<br><br>
        <img src="images\main2.jpg" width="1200px" alt="Изображение стартовой решетки">
        <?php if($username != 'admin'){?>
        <div align="right"><a href="booking_list_user.php?select=know_user">К моим билетам</a></div>
        <?php }?>
        <?php if($username == 'admin'){?><br><br>
        <a href="booking_list_user.php?select=know_admin">Заявки на брони</a>
        <?php }?>
        <p>Лучшие пилоты мира на технически совершенных болидах в седьмой раз сразятся за победу на трассе в Олимпийском парке.
           Масштабная развлекательная программа и концерты на территории проведения Гран-при России подарят зрителям невероятные эмоции и драйв,
           а доступные билеты позволят не беспокоиться о путешествии и насладиться главным гоночным событием страны!</p>
        <?php if($username != 'admin'){?>
        <a href="choose_ticket.php">выбрать билеты</a></div>
        <?php }?>
        </form>
    </body>
</html>
