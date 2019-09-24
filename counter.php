<?php require_once "db.php";

// // Указываем кодировку, в которой будет получена информация из базы
// @mysqli_query ($db, 'set character_set_results = "utf8"');

// // Получаем IP-адрес посетителя и сохраняем текущую дату
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d");

// Узнаем, были ли посещения за сегодня
$res = mysqli_query($connection, "SELECT ID FROM Visits WHERE Date='$date';");

// Если сегодня еще не было посещений
if (mysqli_num_rows($res) == 0)
{
    // Очищаем таблицу ips
    mysqli_query($connection, "DELETE FROM IPs;");

    // Заносим в базу IP-адрес текущего посетителя
    mysqli_query($connection, "INSERT INTO IPs (IP_addr) Values ('$visitor_ip');");

    // Заносим в базу дату посещения и устанавливаем кол-во просмотров и уник. посещений в значение 1
    $unique_incr = 1;
    $increment = 1;
    $res_count = mysqli_query($connection, "INSERT INTO Visits (Date,Hosts,Views) Values ('$date','$unique_incr','$increment');");
}

// Если посещения сегодня уже были
else
{
    // Проверяем, есть ли уже в базе IP-адрес, с которого происходит обращение
    $current_ip = mysqli_query($connection, "SELECT ID FROM IPs WHERE IP_addr='$visitor_ip';");

    // Если такой IP-адрес уже сегодня был (т.е. это не уникальный посетитель)
    if (mysqli_num_rows($current_ip) == 1)
    {
        // Добавляем для текущей даты +1 просмотр (хит)
        mysqli_query($connection, "UPDATE Visits SET Views=Views+1 WHERE Date='$date';");
    }

    // Если сегодня такого IP-адреса еще не было (т.е. это уникальный посетитель)
    else
    {
        // Заносим в базу IP-адрес этого посетителя
        mysqli_query($connection, "INSERT INTO IPs SET IP_addr='$visitor_ip';");

        // Добавляем в базу +1 уникального посетителя (хост) и +1 просмотр (хит)
        mysqli_query($connection, "UPDATE Visits SET `Hosts`=`Hosts`+1,`Views`=`Views`+1 WHERE Date='$date';");
    }
}