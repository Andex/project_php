<?php
//каждый видит детальную инфу по брони - сюда передаётся id_reservation(для admin поможет отобразить пользователя в таблице), username
//можно придти только с booking_list_user и booking_list_admin
//возврат на страницу назад (booking_list_user) и обработка status

session_start();
$username = $_SESSION['username'];

require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

echo '<title>Подробный просмотр</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="main.css">
        <body>
        <form action="status_obrab.php" method="post" name="form"> <!--если не получиться через ifЫ-->
        <img src="images\F1_heading_new.jpg" height="101px" alt="header" class="header"><br><br><br><br><br>>
        <div align="right" class="exit"><a href="exit.php" class="exit">ВЫЙТИ</a></div>            
        <div align="center" class="text">
            <table width=60% border=1 cellspacing=5 cellpadding=7 class="text">
                <tr><th>Имя пользователя</th>
                    <th>Этап сезона</th>
                    <th>Трибуна</th>
                    <th>Даты</th>
                    <th>Количество билетов</th>
                    <th>Цена (в руб.)</th>
                    <th>Статус</th>
                </tr>';

$id_reservation = $_GET['ID'];
$_SESSION['bookingID'] = $id_reservation;
$result = mysqli_query($link,"SELECT * FROM booking WHERE id = '$id_reservation'");
$my_row = mysqli_fetch_array($result);
$uId = $my_row['user_id'];
$find_username = mysqli_query($link,"SELECT name FROM users WHERE id = '$uId' ");
$name = mysqli_fetch_array($find_username)['name'];

echo '<tr><td>'.$name.'</td>
                    <td>Гран-при России</td>
                    <td>'.$my_row['tribune'].'</td>
                    <td>'.$my_row['dates'].'</td>
                    <td>'.$my_row['quantity'].'</td>
                    <td>'.$my_row['total_amount'].'</td>';
                    if ($username == 'admin'){
                        echo '<td>'.'<select name="newstatus">
                                    <option value='.$my_row['status'].'selected>'.$my_row['status'].'</option>';
                                    
                                    if ($my_row['status'] == 'processing'){
                                         echo '<option value="confirmed">confirmed</option>
                                               <option value="denied">denied</option>
                                               </select>'.'</a>'.'</td>                              
      </tr>';
                                    }
                                    if ($my_row['status'] == 'confirmed'){
                                         echo '<option value="denied">denied</option>
                                               <option value="processing">processing</option>
                                               </select>'.'</a>'.'</td>                              
      </tr>';
                                    }
                                    if ($my_row["status"] == 'denied'){
                                         echo '<option value="processing">processing</option>
                                               <option value="confirmed">confirmed</option>
                                               </select>'.'</a>'.'</td>                              
      </tr>';
                                    }
                        echo '</table><br>
                        <button type="submit" class="button">изменить статус</button>
                        <a href="booking_list_user.php?select=know_admin">назад</a>';
      
                    }
                    else{
                        echo '<td>'.$my_row['status'].'</td>
      </tr></table><br>
        <a href="booking_list_user.php?select=know_user">назад</a>';
                    }
                    

echo '</div>
        </form>
    </body>';

mysqli_close($link);
?>