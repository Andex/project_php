<?php
//выводится весь список заявок на бронь пользователя вместе с новой - сюда передаётся username и (трибуна, кол-во билетов и телефон)
//можно придти с booking, main(_for_user), status_obrab и detalied_view
//переход на main(_for_user) и detalied_view

session_start();
$username = $_SESSION['username'];
if(empty($_GET['select'])){ $select='-'; }  else{   $select = $_GET['select'];}
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

$find_username_id = mysqli_query($link,"SELECT id FROM users WHERE name = '$username'");
$username_id = mysqli_fetch_array($find_username_id)['id'];

if($select == 'know_user'){
    goto know_the_list_user;
}
if($select == 'know_admin'){
    goto know_the_list_admin;
}

if(isset($_POST['tribune'])) { $tribune=$_POST['tribune']; } else {     echo '<h3>'.'Вы не выбрали трибуну'.'</h3>'.'<br>';    exit();}
if($_POST['count_tickets'] != '') { $count_tickets=$_POST['count_tickets']; } else {     echo '<h3>'.'Укажите количество билетов'.'</h3>'.'<br>'; exit();}
if($_POST['phone'] != '') { $phone_number_for_booking=$_POST['phone']; } else {     $phone_number_for_booking = $_SESSION['phone'];}

if(ctype_digit($phone_number_for_booking)!='false' or ctype_digit($count_tickets)!='false'){
    echo '<h3>'.'Некорректно указано количество билетов или номер телефона'.'</h3>'.'<br>';
    exit();
}

$find_price = mysqli_query($link,"SELECT * FROM tribunes WHERE name_tribune = '$tribune'");
$price = mysqli_fetch_row($find_price);
$status = 'processing';
$total_amount = $count_tickets*$price[1];

$required_res1 = mysqli_query($link,"SELECT max(id) FROM booking");
$max_id_booking = mysqli_fetch_row($required_res1);
$bId = 1 + (int)$max_id_booking[0];

$result = $price[0];

$result1 = mysqli_query($link,"INSERT INTO booking (id,user_id,tribune,quantity,total_amount,status) VALUES ('$bId','$username_id','$result','$count_tickets','$total_amount','$status')");
if ($result1!='true'){
        echo '<h3>'.'Бронь'.'<b>'.' не '.'</b>'.'добавлена'.'</h3>';
        exit();
}
else{
        echo '<h3>'.'Бронь'.'<i>'.' успешно '.'</i>'.'добавлена'.'</h3>';
        
        $result3 = mysqli_query($link,"UPDATE users set phone='$phone_number_for_booking' WHERE name = '$username'");
        if(isset($_POST['email'])){
            $email=$_POST['email'].'@...';
            mysqli_query($link,"UPDATE users set email='$email' WHERE name = '$username'");
        }
        
        know_the_list_user:
        $result2 = mysqli_query($link,"SELECT id, tribune, quantity, status FROM booking WHERE user_id = '$username_id'");
        $my_row = mysqli_fetch_array($result2);
        if (!isset($my_row)){
            echo '<title>Мои билеты</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
                    <link rel="stylesheet" type="text/css" href="main.css">
                    <body>
                    <img src="images\F1_heading_new.jpg" height="101px" alt="header" class="header"><br><br><br><br><br>
                    <div align="right" class="exit"><a href="exit.php" class="exit">ВЫЙТИ</a></div>            
                    <div align="center" class="text"><h3>'.'Вы еще ничего не бронировали'.'</h3>
                    <a href="main.php">на главную</a></div></body>';
            mysqli_close($link);
            exit();
        }
        
        echo '<title>Мои билеты</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
                <link rel="stylesheet" type="text/css" href="main.css">
                <body>
                <img src="images\F1_heading_new.jpg" height="101px" alt="header" class="header"><br><br><br><br><br>
                <div align="right" class="exit"><a href="exit.php" class="exit">ВЫЙТИ</a></div>             
                <div align="center" class="text"><strong>Мои билеты</strong><br><br>
                    <table width=60% border=1 cellspacing=1 cellpadding=8 class="text">
                    <caption></caption>
                        <tr><th>Имя пользователя</th>
                            <th>Этап сезона</th>
                            <th>Трибуна</th>
                            <th>Количество билетов</th>
                            <th>Статус</th>
                        </tr>';

        while($my_row){
            echo '<tr><th>'.$username.'</th>
                            <td>Гран-при России</td>
                            <td>'.$my_row['tribune'].'</td>
                            <td>'.$my_row['quantity'].'</td>
                            <td>'.$my_row['status'].'</td>
                            <td>'.'<a href="detailed_view.php?ID='.$my_row['id'].'" id="simple">Подробнее</a>'.'</td>
                  </tr>';
            $my_row = mysqli_fetch_array($result2);
        }
        
        if($select != 'know_admin'){
            goto the_end;
        }
        
        know_the_list_admin:
            echo '<title>Все билеты</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
                <link rel="stylesheet" type="text/css" href="main.css">
                <body>
                <img src="images\F1_heading_new.jpg" height="101px" alt="header" class="header"><br><br><br><br><br>
                <div align="right" class="exit"><a href="exit.php" class="exit">ВЫЙТИ</a></div>             
                <div align="center" class="text"><strong>Все заявки на бронирование</strong>
                    <table width=60% border=1 cellspacing=1 cellpadding=8 class="text">
                    <caption></caption>
                        <tr><th>Бронь</th>
                            <th>Этап сезона</th>
                            <th>Трибуна</th>
                            <th>Количество билетов</th>
                            <th>Статус</th>
                        </tr>';
        
            $result5 = mysqli_query($link,"SELECT * FROM booking");
            while($my_row5 = mysqli_fetch_array($result5)){
                echo '<tr><th>'.$my_row5['id'].'</th>
                                <td>Гран-при России</td>
                                <td>'.$my_row5['tribune'].'</td>
                                <td>'.$my_row5['quantity'].'</td>
                                <td>'.$my_row5['status'].'</td>
                                <td>'.'<a href="detailed_view.php?ID='.$my_row5['id'].'" id="simple">Подробнее</a>'.'</td>
                      </tr>';
            }
    }

the_end:
    
        echo '</table>
                <a href="main.php">на главную</a>
                    </div>
                </form>
            </body>';
mysqli_close($link);
?>