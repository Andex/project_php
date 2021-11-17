<?php
$select = $_GET['select'];
session_start();
$username = $_SESSION['username'];

require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

$for_phone_number = mysqli_query($link,"SELECT phone FROM users WHERE name = '$username'");
$phone_number = mysqli_fetch_row($for_phone_number)[0];
$_SESSION['phone'] = $phone_number;
?>
<html>
    <head>
        <title>Подтверждениe бронирования</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="for_booking.css">
        
    </head>
    <body>
        <form action="booking_list_user.php" method="post" name="form">            
            <img src="images\F1_heading_new.jpg" height="100px" alt='header' class="header"><br><br><br><br><br>>
            <div align="center">
                <fieldset>
                    <legend>Трибуна</legend>
                        <input type="radio" name="tribune" value="T1" <?php if($select == 'T1'){?> checked <?php } ?>  >Т1   (6990 руб.)<br>
                        <input type="radio" name="tribune" value="T2" <?php if($select == 'T2'){?> checked <?php } ?>  >Т2   (6990 руб.)<br>
                        <input type="radio" name="tribune" value="Main tribune"<?php if($select == 'MainTribune'){?> checked <?php } ?>  >Главная трибуна   (9990 руб.)<br>
                        <input type="radio" name="tribune" value="T3"<?php if($select == 'T3'){?> checked <?php } ?>  >Т3   (5490 руб.)<br>
                        <input type="radio" name="tribune" value="T4"<?php if($select == 'T4'){?> checked <?php } ?>  >Т4   (5490 руб.)<br>
                        <input type="radio" name="tribune" value="Free zone"<?php if($select == 'FreeZone'){?> checked <?php } ?>  >Зона свободного размещения   (2790 руб.)<br>
                </fieldset>
                <fieldset>
                    <legend>Укажите количество билетов</legend>
                    <input type="text" name="count_tickets"><br>
                </fieldset>
                <fieldset>
                    <legend>Даты</legend>
                    24.09.20 - 27.09.20<br>
                </fieldset>
                <fieldset>
                    <legend>Имя пользователя</legend>
                    <?php echo $_SESSION['username']?><br>
                </fieldset>
                <fieldset>
                    <legend>На Ваш телефон будет приходить информация о статусе Вашей брони</legend>
                    <legend>Изменить номер?  <?php echo '<i>'.$_SESSION['phone'].'</i>'?></legend>
                    <input type="text" name="phone" placeholder="можете ввести другой номер телефона" size="37">
                </fieldset>
                <fieldset>
                    <legend>Можете указать почту для оповещения об изменении статуса брони</legend>
                    <input type="text" name="email" size="32"><br>
                </fieldset>
                <button type="submit" class="button">ЗАБРОНИРОВАТЬ</button><a href="choose_ticket.php" class="button">К схеме трибун</a></div>        
        </form>
    </body>
</html>
