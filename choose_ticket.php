<?php
//схема автодрома и трибун - сюда передаётся username
//можно придти только с main(_for_user) (ну или добавить "забронировать еще билеты" с detalied_view или booking_list_user)
//переход только на booking и вернуться на main(_for_user)
//session_start();
?>
<html>
    <head>
        <title>Гран-при России.Выбор билетов</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <link rel="stylesheet" type="text/css" href="main.css">
        <body>
        <form action="">
        <div align="center">
        <img src="images\F1_heading_new.jpg" height="100px" alt='header' class="header"><br><br><br><br><br>
        <br><br><strong>Выберете трибуну</strong>
        <table width=60% border=1 cellspacing=1 cellpadding=8 class="text">
            <caption></caption>
                <tr>
                        <th><a href="booking.php?select=T1">Т1</a></th>
			<th><a href="booking.php?select=T2">Т2</a></th>
                	<th><a href="booking.php?select=MainTribune">Главная трибуна</a></th>
			<th><a href="booking.php?select=T3">Т3</a></th>
                        <th><a href="booking.php?select=T4">Т4</a></th>
			<th><a href="booking.php?select=FreeZone">Зона свободного размещения</a></th>
		</tr>
		<tr>
			<td>6990 руб.</td>
                        <td>6990 руб.</td>
                	<td>9990 руб.</td>
                        <td>5490 руб.</td>
                        <td>5490 руб.</td>
                        <td>2790 руб.</td>
		</tr>
        </table><br>
        <img src="images\Track_with_stands.jpg" width="1000px" alt='tribunes'>
        </div>
        </form>
    </body>
</html>
