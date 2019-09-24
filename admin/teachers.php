<?php
    require_once "../db.php";
    ob_start();
    if(!isset($_SESSION['admin'])) header("Location: index.php");

    if (isset($_POST['accept'])) {
        $_id = $_POST['id'];
        $query = mysqli_query($connection, "UPDATE Users SET Type = 2 WHERE ID = $_id;");
        $query = mysqli_query($connection, "SELECT * FROM Users WHERE ID = $_id;");
        $fetch = mysqli_fetch_assoc($query);
        $message = "Здравствуйте!</br> Поздравляем! Вы подходите нам на роль преподавателя! Мы выдали вам право входить в учительский кабинет по вашим учётным данным.";
        $subject = "Регистрация на сайте ПДД 2019";
        $email = $fetch['Email'];
        $to = $email;
        $from  = 'From: pdd2019@admin.ru'."\r\n";
        mail($to, $subject, $message,$from);
    }

    if (isset($_POST['decline'])) {
        // echo "dec<br/>";
        $_id = $_POST['id'];
        $query = mysqli_query($connection, "SELECT * FROM Users WHERE ID = '$_id';");
        $_query = mysqli_query($connection, "DELETE FROM TeacherProfile WHERE TeacherID = '$_id';");
        $_query = mysqli_query($connection, "DELETE FROM Users WHERE ID = '$_id';");
        $fetch = mysqli_fetch_assoc($query);
        $message = "Здравствуйте!</br> К сожалению Вы не подходите нам на роль преподавателя.";
        $subject = "Регистрация на сайте ПДД 2019";
        $email = $fetch['Email'];
        $to = $email;
        $from  = 'From: pdd2019@admin.ru'."\r\n";
        mail($to, $subject, $message,$from);
    }


    unset($_POST['decline']);
    unset($_POST['accept']);
    unset($_POST['id']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Teacher Positions</title>
        <style>
            .auth{
                display:block;
            }
            .unauth{
                display:none;
            }
        </style>
        <script>
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            require_once "admin_header.php";
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 text-center" style="border:1px gray solid; border-radius:10px; height: 800px; overflow: scroll;">
                    <p style="font-weight:bolder; font-size:150%; font-style:italic;">Преподаватели</p>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4" onclick="show_auth();"><a href="#" ><span class="glyphicon glyphicon-th-list"></span> Авторизованные</a></div>
                        <div class="col-md-4" onclick="show_unauth();"><a href="#" ><span class="glyphicon glyphicon-th-list"></span> Неавторизованные</a></div>
                        <div class="col-md-2"></div>
                    </div>

                    <?php
                        $temporary = mysqli_query($connection,"SELECT * FROM Users u JOIN TeacherProfile tp ON tp.TeacherID = u.ID;");
                        if(mysqli_num_rows($temporary)<1) echo "<p style='font-size:125%;font-weight:bolder;font-style:italic;'>Преподавателей не обнаружено! </p>";
                        else{
                            $counter = 1;
                            $counter_auth = 1;
                            $counter_unauth = 1;
                            $path = "../teacher/documents/"; 
                            while($result = mysqli_fetch_assoc($temporary)){ 
                                // print_r($result);
                                // echo "<br/><br/>";
                                if ($result['Type']==2) {
                                    $type = "auth";
                                    echo "<div class='row text-left ". $type ."' style='margin-left:1%'>
                                        <p style='font-size:125%;font-weight:bolder;font-style:italic;'> Преподаватель № " . $counter_auth . " (" . $result['FirstName'] . " " . $result['LastName'] . ")" .
                                        "<div class='col-md-12' style='margin-top:1%;margin-bottom:1%;font-weight:bolder;font-style:italic;'>
                                            <p>Город: " . $result['City'] . "</p>" .
                                            "<p>Прописка: " . $result['Registration'] . "</p>" .
                                            "<p>Дата Рождения: " . $result['DateOfBirth'] . "</p>" .
                                            "<p>Пол: " . $result['Sex'] . "</p>" .
                                            "<p>Просмотреть документ: <a target='blank' href='" . $path . $result['DocumentPath'] . "'>Ссылка</a>" .
                                            "<div class='row' style='line-height:125%;'>".
                                                "
                                                <div class='col-md-6'><a target='blank' href='letter.php?receiver=" . $result['Login'] . "'><input type='submit' style='width:100%;' class='btn btn-default' name='message_" . $counter . "' value='Написать письмо'/></a></div>" .
                                                "<div class='col-md-4'></div>".
                                                "<div class='col-md-2'><a target='blank' href='strike.php?receiver=" . $result['Login'] . "&id=" . $result['TeacherID'] ."'><input type='submit' style='width:100%;' class='btn btn-danger' name='lost_" . $counter . "' value='Уволить'/></a></div>".
                                            "</div>" .
                                            "<hr/>" .
                                        "</div>" .
                                    "</div>";
                                    $counter_auth++;
                                }
                                if ($result['Type']==3) {
                                    $type = "unauth";
                                    echo "<div class='row text-left ". $type ."' style='margin-left:1%'>
                                        <p style='font-size:125%;font-weight:bolder;font-style:italic;'> Преподаватель № " . $counter_unauth . " (" . $result['FirstName'] . " " . $result['LastName'] . ")" .
                                        "<div class='col-md-12' style='margin-top:1%;margin-bottom:1%;font-weight:bolder;font-style:italic;'>
                                            <p>Город: " . $result['City'] . "</p>" .
                                            "<p>Прописка: " . $result['Registration'] . "</p>" .
                                            "<p>Дата Рождения: " . $result['DateOfBirth'] . "</p>" .
                                            "<p>Пол: " . $result['Sex'] . "</p>" .
                                            "<p>Просмотреть документ: <a target='blank' href='" . $path . $result['DocumentPath'] . "'>Ссылка</a>" .
                                            "<div class='row' style='line-height:125%;'>
                                                <div class='col-md-3'><form action='teachers.php' method='POST'><input type='submit' class='btn btn-success' name='accept' value='Авторизовать'/><input name='id' type='hidden' value='".$result['TeacherID']."'></form></div>
                                                <div class='col-md-3'><form action='teachers.php' method='POST'><input type='submit' class='btn btn-danger' name='decline' value='Отклонить'/><input name='id' type='hidden' value='".$result['TeacherID']."'></form></div>
                                                <div class='col-md-6'><a target='blank' href='letter.php?receiver=" . $result['Login'] . "'><input type='submit' style='width:100%;' class='btn btn-default' name='message_" . $counter . "' value='Написать письмо'/></a></div>" .
                                            "</div>" .
                                            "<hr/>" .
                                        "</div>" .
                                    "</div>";
                                    $counter_unauth++;
                                }
                                
                                $counter++;
                            }
                        }
                    ?>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

        <div id="myModal" class="modal" tabindex="-1" style="display:none;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" onclick="document.getElementById('myModal').style.display = 'none';">х</button>
                        <h4 class="modal-title">Уведомление</h4>
                    </div>
                    <div class="modal-body" id="textmessage">
                        test
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function show_auth(){
                var a = document.getElementsByClassName('auth');
                for(var i = 0; i < a.length; i++) a[i].style.display = 'block';
                var b = document.getElementsByClassName('unauth');
                for(var i = 0; i < b.length; i++) b[i].style.display = 'none';
            }

            function show_unauth(){
                var a = document.getElementsByClassName('auth');
                for(var i = 0; i < a.length; i++) a[i].style.display = 'none';
                var b = document.getElementsByClassName('unauth');
                for(var i = 0; i < b.length; i++) b[i].style.display = 'block';
            }
        </script>
    </body>

    <?php

    ?>
</html>