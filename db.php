<?php
    $db = [
        "servername"=>"localhost",
        "user"=>"id10203735_oleg",
        "password"=>"silumi97",
        "databasename"=>"id10203735_road_rules"
    ];
    $connection = mysqli_connect($db["servername"],$db["user"],$db["password"],$db["databasename"]);
    session_start();
    if(!$connection){
        echo "Не удалось присоединиться к базе данных!";
        mysqli_connect_error();
        exit();
    }
?>