<?php
    require_once "../db.php";
    ob_start();
    if(!isset($_SESSION['admin'])) header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit menu</title>
        <style type="text/css">
            .1{
                display:block;
            }
            .2{
                display:none;
            }
            .3{
                display:none;
            }
        </style>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
            window.onload = function show_default(){
                var a = document.getElementsByClassName('1');
                for(var i=0; i<a.length; i++){ a[i].style.display = "block"; }
                a = document.getElementsByClassName('2');
                for(var i=0; i<a.length; i++){ a[i].style.display = "none"; }
                a = document.getElementsByClassName('3');
                for(var i=0; i<a.length; i++){ a[i].style.display = "none"; }
            }
            function show_1(){
                var a = document.getElementsByClassName('1');
                for(var i=0; i<a.length; i++){ a[i].style.display = "block"; }
                a = document.getElementsByClassName('2');
                for(var i=0; i<a.length; i++){ a[i].style.display = "none"; }
                a = document.getElementsByClassName('3');
                for(var i=0; i<a.length; i++){ a[i].style.display = "none"; }
            }
            function show_2(){
                var a = document.getElementsByClassName('2');
                for(var i=0; i<a.length; i++){ a[i].style.display = "block"; }
                a = document.getElementsByClassName('1');
                for(var i=0; i<a.length; i++){ a[i].style.display = "none"; }
                a = document.getElementsByClassName('3');
                for(var i=0; i<a.length; i++){ a[i].style.display = "none"; }
            }
            function show_3(){
                var a = document.getElementsByClassName('3');
                for(var i=0; i<a.length; i++){ a[i].style.display = "block"; }
                a = document.getElementsByClassName('2');
                for(var i=0; i<a.length; i++){ a[i].style.display = "none"; }
                a = document.getElementsByClassName('1');
                for(var i=0; i<a.length; i++){ a[i].style.display = "none"; }
            }
        </script>
    </head>
    <body>
        <?php
            require_once "admin_header.php";
        ?>
        <!-- <nav class="navbar navbar-light" style="background-color: gray;">
                <div class="container-fluid">
                    <div class="navbar-header col-md-3"><a href="admin.php" class="navbar-brand" style="color: black;">Панель администрирования</a></div>
                    <div class="col-md-6">
                        <ul class="nav navbar-nav">
                            <li><a href="admin_main.php" style="color: yellow;">CRUD</a></li>
                            <li> <a href="#" style="color: yellow;">Статистика</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <ul class="nav navbar-nav dropdown">
                            <?php
                                    if(isset($_SESSION['admin']['fname'])){
                                        $fname = $_SESSION['admin']['fname'];
                                        $lname = $_SESSION['admin']['sname'];
                                        echo "<li class='dropdown-toggle' data-toggle='dropdown'> <a href='#' style='color: yellow;'>" . $fname . " " . $lname . "<span class='caret'></span></a></li>
                                                <ul class='dropdown-menu'>
                                                    <li><a href='logout_admin.php'>Выйти</a></li>
                                                </ul>";
                                    }else{
                                        echo "<li> <a href='#' style='color: yellow;'>Вы не авторизованы</a></li>";
                                    }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>            -->
        <div class="container">
            <div class="row">
                <div class="col-md-9" style="border: 1px gray solid; border-radius: 10px;">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="active"><a href="#news" role="tab" data-toggle="pill">Новости</a></li>
                        <li><a href="#markup" role="tab" data-toggle="pill">Разметка</a></li>
                        <li><a href="#signs" role="tab" data-toggle="pill">Знаки</a></li>
                        <li><a href="#users" role="tab" data-toggle="pill">Пользователи</a></li>
                        <li><a href="#fines" role="tab" data-toggle="pill">Штрафы</a></li>
                        <li><a href="#tickets" role="tab" data-toggle="pill">Билеты</a></li>
                        <li><a href="#courses" role="tab" data-toggle="pill">Курсы</a></li>
                    </ul>
                    <div class="tab-content" >
                        <div role="tabpanel" class="tab-pane active" id="news" style="margin:2%;">
                            <div class="1 text-center" style="font-size: 150%;">
                                Добавление новости
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;" enctype="multipart/form-data">
                                    <div class="form-group has-success">
                                            <label for="pass" class="col-sm-2 control-label">Заголовок</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control input-xs" id="add_news_title" placeholder="Введите текст" name="add_news_title" >
                                            </div>
                                    </div>
                                    <div class="form-group has-success">
                                            <label for="pass" class="col-sm-2 control-label">Тело</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control input-xs" id="add_news_text" placeholder="Введите текст статьи" name="add_news_text" style="min-width: 100%;max-width: 100%;" required></textarea>
                                            </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="inputDate" class="col-sm-2 control-label">Дата</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control input-xs" id="add_news_date" name="add_news_date" required>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="inputDate" class="col-sm-2 control-label">Автор</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="people" required>
                                                <?php 
                                                    $people = mysqli_query($connection,"Select * From Users Where Status = 1 Order by ID;");
                                                    while($admin = mysqli_fetch_assoc($people)){
                                                        echo '<option value =' . $admin['ID'] . '>' . $admin['FirstName'] . " " . $admin['LastName'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="inputDate" class="col-sm-2 control-label">Фото</label>
                                        <div class="col-sm-10 text-center">
                                            <input type="file" class="form-control input-xs text-center" style="border: 0px gray solid;" id="add_news_photo" name="add_news_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Опубликовать" name="add_news_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%; margin-top:1%;">
                                Изменить новость
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_news_title" placeholder="Введите информацию" name="set_news_title" >
                                        </div>
                                    </div>
                                    <div class="form-group has-warning">
                                        <label for="inputDate" class="col-sm-2 control-label">Дата</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control input-xs" id="set_news_date" name="set_news_date" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="#"><input type="submit" class="btn btn-warning" value="Изменить" name="set_news_submit"/></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%; margin-top:1%;">
                                Удалить новость
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_news_title" placeholder="Введите информацию" name="remove_news_title" >
                                        </div>
                                    </div>
                                    <div class="form-group has-danger">
                                        <label for="inputDate" class="col-sm-2 control-label">Дата</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control input-xs" id="remove_news_date" name="remove_news_date" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_news_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane " id="markup" style="margin:2%;">
                            <div class="1 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Добавить тип разметки
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_typeofmarkup_title" placeholder="Введите название" name="add_typeofmarkup_title" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                            <label for="pass" class="col-sm-2 control-label">Описание</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control input-xs" id="add_typeofmarkup_text" placeholder="Введите описание" name="add_typeofmarkup_text" style="min-width: 100%;max-width: 100%;" required></textarea>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_typeofmarkup_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="1 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Добавить разметку
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_markup_title" placeholder="Введите название" name="add_markup_title" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Описание</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control input-xs" id="add_markup_text" placeholder="Введите описание" name="add_markup_text" style="min-width: 100%;max-width: 100%;" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Номер</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_markup_number" placeholder="Введите номер" name="add_markup_number">
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Тип</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="typeofmarkups" required>
                                                <?php 
                                                    $typeofmarkups = mysqli_query($connection,"Select * From TypeOfMarkup Order by ID;");
                                                    while($type = mysqli_fetch_assoc($typeofmarkups)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Картинка</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_markup_photo" placeholder="Введите ссылку на изображение" name="add_markup_photo">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_markup_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Изменить тип разметки
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_typeofmarkup_title" placeholder="Введите информацию" name="set_typeofmarkup_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="#"><input type="submit" class="btn btn-warning" value="Изменить" name="set_typeofmarkup_submit"/></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%; margin-top:1%; border: 1px gray solid; border-radius:10px;">
                                Изменить разметку
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Номер</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_markup_number" placeholder="Введите данные" name="set_markup_number" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="set_markup_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Удалить тип разметки
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_typeofmarkup_title" placeholder="Введите информацию" name="remove_typeofmarkup_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_typeofmarkup_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%; margin-top:1%; border: 1px gray solid; border-radius:10px;">
                                Удалить разметку
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Номер</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_markup_number" placeholder="Введите данные" name="remove_markup_number" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_markup_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane " id="signs" style="margin:2%;">
                            <div class="1 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Добавить тип знака
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_typeofsign_title" placeholder="Введите название" name="add_typeofsign_title" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                            <label for="pass" class="col-sm-2 control-label">Описание</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control input-xs" id="add_typeofsign_text" placeholder="Введите описание" name="add_typeofsign_text" style="min-width: 100%;max-width: 100%;" required></textarea>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_typeofsign_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="1 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Добавить знак
                                <form method="POST" enctype="multipart/form-data" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_sign_title" placeholder="Введите название" name="add_sign_title" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Описание</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control input-xs" id="add_sign_text" placeholder="Введите описание" name="add_sign_text" style="min-width: 100%;max-width: 100%;" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Номер</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_sign_number" placeholder="Введите номер" name="add_sign_number">
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Тип</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="typeofsigns" required>
                                                <?php 
                                                    $typeofsigns = mysqli_query($connection,"Select * From TypeOfSign Order by ID;");
                                                    while($type = mysqli_fetch_assoc($typeofsigns)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="inputDate" class="col-sm-2 control-label">Картинка</label>
                                        <div class="col-sm-10 text-center">
                                            <input type="file" class="form-control input-xs text-center" style="border: 0px gray solid;" id="add_sign_photo" name="add_sign_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_sign_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Изменить тип знака
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_typeofsigns_title" placeholder="Введите информацию" name="set_typeofsigns_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="set_typeofsigns_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%; margin-top:1%; border: 1px gray solid; border-radius:10px;">
                                Измениь знак
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Номер</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_signs_number" placeholder="Введите данные" name="set_signs_number" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="set_signs_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Удалить тип знака
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_typeofsigns_title" placeholder="Введите информацию" name="remove_typeofsigns_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_typeofsigns_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%; margin-top:1%; border: 1px gray solid; border-radius:10px;">
                                Удалить знак
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Номер</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_signs_number" placeholder="Введите данные" name="remove_signs_number" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_signs_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane " id="users" style="margin:2%;">
                            <div class="1 text-center" style="font-size: 150%;">
                                Добавить пользователя
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Логин</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_users_login" placeholder="Введите логин" name="add_users_login" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Пароль</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_users_password" placeholder="Введите пароль" name="add_users_password" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Имя</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_users_fname" placeholder="Введите имя" name="add_users_fname" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Фамилия</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_users_sname" placeholder="Введите фамилию" name="add_users_sname" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Почта</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_users_email" placeholder="Введите почту" name="add_users_email" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Админ</label>
                                        <div class="col-sm-10 radio">
                                            <select class="form-control input-xs" name="admin" required>
                                                <option value="1">Да</option>
                                                <option value="0">Нет</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_users_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%; margin-top:1%;">
                                Изменить пользователя
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Логин</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_users_login" placeholder="Введите данные" name="set_users_login" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="set_users_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%; margin-top:1%;">
                                Удалить пользователя
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Логин</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_users_login" placeholder="Введите данные" name="remove_users_login" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_users_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane " id="fines" style="margin:2%;">
                            <div class="1 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Добавить тип штрафа
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_typeoffine_title" placeholder="Введите название" name="add_typeoffine_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_typeoffine_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="1 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Добавить штраф
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">КоАП</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_fines_cao" placeholder="Введите статью" name="add_fines_cao" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Нарушение</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control input-xs" id="add_fines_offense" placeholder="Введите описание" name="add_fines_offense" style="min-width: 100%;max-width: 100%;" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Санкции</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_fines_sanctions" placeholder="Введите описание" name="add_fines_sanctions">
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Тип</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="typeoffines" required>
                                                <?php 
                                                    $typeoffines = mysqli_query($connection,"Select * From TypeOfFines Order by ID;");
                                                    while($type = mysqli_fetch_assoc($typeoffines)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_fines_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Изменить тип штрафа
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_fines_title" placeholder="Введите название" name="set_fines_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="set_typeoffines_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%; margin-top:1%; border: 1px gray solid; border-radius:10px;">
                                Изменить штраф
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">КоАП</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_fines_login" placeholder="Введите данные" name="set_fines_login" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="set_fines_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%; border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                Удалить тип штрафа
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_fines_title" placeholder="Введите название" name="remove_fines_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_typeoffines_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%; margin-top:1%; border: 1px gray solid; border-radius:10px;">
                                Удалить штраф
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;" >
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">КоАП</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_fines_cao" placeholder="Введите данные" name="remove_fines_cao" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_fines_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane " id="tickets" style="margin:2%;">
                            <div class="1 text-center" style="border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                <p style="text-align:center;font-size: 150%; font-weight:bolder; font-style:italic;">Добавить билет</p>
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;" >
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Номер:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_ticket_number" placeholder="Введите данные" name="add_ticket_number" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_ticket_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="1 text-center" style="border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                <p style="text-align:center;font-size: 150%; font-weight:bolder; font-style:italic;">Добавить вопрос</p>
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;" enctype="multipart/form-data">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Формулировка:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_ticket_question" placeholder="Введите данные" name="add_ticket_question" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Номер билета:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="tickets" required>
                                                <?php 
                                                    $tickets = mysqli_query($connection,"Select * From Tickets Order by ID;");
                                                    while($type = mysqli_fetch_assoc($tickets)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Номер вопроса:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="typeofquestion" required>
                                                <?php 
                                                    $typeOfQuestion = mysqli_query($connection,"Select * From TypeOfQuestion Order by ID;");
                                                    while($type = mysqli_fetch_assoc($typeOfQuestion)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['ID'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row text-center has-success" style="">
                                        <div class="col-md-6 has-success">
                                            <input value="r" onclick="document.getElementById('add_ticket_photo').disabled = false;" type="radio" id="customRadio1" name="ticketQuestion" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1">Добавить картинку</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input value="s" checked onclick="document.getElementById('add_ticket_photo').disabled = true;" type="radio" id="customRadio2" name="ticketQuestion" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio2">Не добавлять картинку</label>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="inputDate" class="col-sm-2 control-label">Фото:</label>
                                        <div class="col-sm-10 text-center">
                                            <input type="file" disabled class="form-control input-xs text-center" style="border: 0px gray solid;" id="add_ticket_photo" name="add_ticket_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_question_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="1 text-center" style="border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                <p style="text-align:center; font-size:150%; font-weight:bolder; font-style:italic;">Добавить ответ</p>
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;" >
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Номер билета:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="tickets_1" required>
                                                <?php 
                                                    $tickets = mysqli_query($connection,"Select * From Tickets Order by ID;");
                                                    while($type = mysqli_fetch_assoc($tickets)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Номер вопроса:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="typeofquestion_1" required>
                                                <?php 
                                                    $typeOfQuestion = mysqli_query($connection,"Select * From TypeOfQuestion Order by ID;");
                                                    while($type = mysqli_fetch_assoc($typeOfQuestion)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['ID'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Формулировка:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_ticket_answer" placeholder="Введите данные" name="add_ticket_answer" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Правильный ?</label>
                                        <div class="col-sm-10 radio">
                                            <select class="form-control input-xs" name="isTrue" required>
                                                <option selected value ="1">Да</option>
                                                <option value ="0">Нет</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_answer_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                <p style="text-align:center; font-size:150%; font-weight:bolder; font-style:italic;">Изменить вопрос</p>
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Номер билета:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="tickets_2" required>
                                                <?php 
                                                    $tickets = mysqli_query($connection,"Select * From Tickets Order by ID;");
                                                    while($type = mysqli_fetch_assoc($tickets)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Номер вопроса:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="typeofquestion_2" required>
                                                <?php 
                                                    $typeOfQuestion = mysqli_query($connection,"Select * From TypeOfQuestion Order by ID;");
                                                    while($type = mysqli_fetch_assoc($typeOfQuestion)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['ID'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="set_question_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="border: 1px gray solid; border-radius:10px; margin-top:1%;">
                                <p style="text-align:center; font-size:150%; font-weight:bolder; font-style:italic;">Изменить ответ</p>
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Формулировка:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_ticket_answer" placeholder="Введите данные" name="set_ticket_answer" >
                                        </div>
                                    </div>
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Номер билета:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="tickets_3" required>
                                                <?php 
                                                    $tickets = mysqli_query($connection,"Select * From Tickets Order by ID;");
                                                    while($type = mysqli_fetch_assoc($tickets)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Номер вопроса:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="typeofquestion_3" required>
                                                <?php 
                                                    $typeOfQuestion = mysqli_query($connection,"Select * From TypeOfQuestion Order by ID;");
                                                    while($type = mysqli_fetch_assoc($typeOfQuestion)){
                                                        echo '<option value =' . $type['ID'] . '>' . $type['ID'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="set_answer_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3">
                                Удалить билет
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Номер билета</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_ticket_number" placeholder="Введите данные" name="remove_ticket_number" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_ticket_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                        <div role="tabpanel" class="tab-pane" id="courses" style="margin:2%;">
                            <div class="1 text-center" style="font-size: 150%;">
                                Добавление курса
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;" enctype="multipart/form-data">
                                    <div class="form-group has-success">
                                            <label for="pass" class="col-sm-2 control-label">Название</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control input-xs" id="add_news_title" placeholder="Введите текст" name="add_course_title" >
                                            </div>
                                    </div>
                                    <div class="form-group has-success">
                                            <label for="pass" class="col-sm-2 control-label">Описание</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control input-xs" id="add_news_text" placeholder="Введите текст" name="add_course_description" style="min-width: 100%;max-width: 100%;" required></textarea>
                                            </div>
                                    </div>

                                    <div class="form-group has-success">
                                        <label for="inputDate" class="col-sm-2 control-label">Картинка:</label>
                                        <div class="col-sm-10 text-center">
                                            <input type="file" class="form-control input-xs text-center" style="border: 0px gray solid;" id="add_course_photo" name="add_course_photo" accept="application/pdf,image/png,image/jpeg,image/bmp,image/gif">
                                        </div>
                                    </div>

                                    <div class="form-group has-success">
                                        <label for="inputDate" class="col-sm-2 control-label">Препод:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="people" required>
                                                <?php 
                                                    $people = mysqli_query($connection,"Select * From Users Where Type = 2 Order by ID;");
                                                    while($teach = mysqli_fetch_assoc($people)){
                                                        echo '<option value =' . $teach['ID'] . '>' . $teach['FirstName'] . " " . $teach['LastName'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Опубликовать" name="add_course_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="2 text-center" style="font-size: 150%; margin-top:1%;">
                                Изменить курс
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_course_title" placeholder="Введите информацию" name="set_course_title" >
                                        </div>
                                    </div>
                                    <!-- <div class="form-group has-warning">
                                        <label for="inputDate" class="col-sm-2 control-label">Дата</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control input-xs" id="set_news_date" name="set_news_date" required>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="#"><input type="submit" class="btn btn-warning" value="Изменить" name="set_course_submit"/></a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="3 text-center" style="font-size: 150%; margin-top:1%;">
                                Удалить курс
                                <form method="POST" action="admin_main.php" class="form-horizontal" style="margin: 1%;">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_course_title" placeholder="Введите информацию" name="remove_course_title" >
                                        </div>
                                    </div>
                                    <!-- <div class="form-group has-danger">
                                        <label for="inputDate" class="col-sm-2 control-label">Дата</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control input-xs" id="remove_news_date" name="remove_news_date" required>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_course_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-12" style="border: 0px gray solid; border-radius: 10px;" id="sideMenu">
                        <ul class="list-group list-unstyled">
                            <a href="#" class="list-group-item" onclick="show_1();"><li>Добавить</li></a>
                            <a href="#" class="list-group-item" onclick="show_2();"><li>Изменить</li></a>
                            <a href="#" class="list-group-item" onclick="show_3();"><li>Удалить</li></a>
                        </ul>
                    </div>
                </div>
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

        <?php
        
            if(isset($_SESSION['Status'])){
                if($_SESSION['Status']==1)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Тип штрафа обновлён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                else if($_SESSION['Status']==2)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Тип знака обновлён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                else if($_SESSION['Status']==3)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Тип разметки обновлён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                else if($_SESSION['Status']==4)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Штраф обновлён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                else if($_SESSION['Status']==5)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Знак обновлён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                else if($_SESSION['Status']==6)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Разметка обновлена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                else if($_SESSION['Status']==7)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Пользователь обновлён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                else if($_SESSION['Status']==8)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Новость обновлена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                else if($_SESSION['Status']==9)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Курс обновлен!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                else if($_SESSION['Status']==10)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Вопрос обновлен!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                else if($_SESSION['Status']==11)
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Ответ обновлен!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                unset($_SESSION['Status']);
            }
            if( isset($_POST['add_news_submit']) ){//публикация статьи
                $title = htmlentities($_POST['add_news_title']);
                $text = htmlentities($_POST['add_news_text']);
                $date = date("Y-m-d H:i:s",strtotime(htmlentities($_POST['add_news_date'])));
                $image = NULL;
                $views = 0;
                if(isset($_FILES['add_news_photo'])){
                    $path = "../news_pic/";
                    $name = $title . $date;
                    $maxSize = 1048576; //максимальный размер - 10 мб
                    $currentSize = $_FILES['add_news_photo']['size'];
                    $tmp = $_FILES['add_news_photo']['tmp_name'];
                    $name=str_replace(':','',$name);
                    if($currentSize < $maxSize){
                        if(copy($tmp,$path . $name . ".png")) $image = $name;
                        else echo "не загрузилося(";// такого быть не должно
                    }
                    else{
                        echo "файл слишком большой!";//перезагрузка страницы и скрыпт
                        echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Слишком большой размер картинки!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                    }
                }
                $author = htmlentities($_POST['people']);
                $temporary = mysqli_query($connection, "Insert INTO News (Title, Text, Date, Views, AuthorID, ImgSource) Values ('$title','$text','$date','$views','$author','$image');");
                if($temporary) echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Новость успешно добавлена на сайт!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                    </script>';
            }
            else if(isset($_POST['set_news_submit'])){
                $title = htmlentities($_POST['set_news_title']);
                $date = htmlentities($_POST['set_news_date']);
                $check = mysqli_query($connection,"Select * From News Where Title = '$title' AND Date = '$date';");
                $check = mysqli_fetch_assoc($check);
                if($check['ID']!=NULL){
                    $news = [
                        "title" => $check['Title'],
                        "text" => $check['Text'],
                        "date" => $check['Date'],
                        "views" => $check['Views'],
                        "author" => $check['AuthorID'],
                        "image" => $check['ImgSource'],
                        "id" => $check['ID']
                    ];
                    $_SESSION['News'] = $news;
                    header("Location: news_editor.php");
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                            messageBox.innerHTML = "Ваша новость не найдена!";
                            var a = document.getElementById("myModal");
                            a.style.display = "block";
                         </script>';
                }
            }
            else if(isset($_POST['remove_news_submit'])){ //удаление новости
                $title = htmlentities($_POST['remove_news_title']);
                $date = date("Y-m-d H:i:s",strtotime(htmlentities($_POST['remove_news_date'])));
                $temporary = mysqli_query($connection,"Select * From News Where Title = '$title' AND Date = '$date';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];
                $path = "../news_pic/";
                if($temporary_1!=NULL){
                    if($temporary['ImgSource']!=NULL) unlink("../news_pic/" . $temporary['ImgSource']);
                    $temporary = mysqli_query($connection,"Delete From News Where Title = '$title' AND Date = '$date';");
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Новость удалена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
                else{
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Новость не найдена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
            else if(isset($_POST['add_typeofmarkup_submit'])){ //добавить тип разметки
                $title = htmlentities($_POST['add_typeofmarkup_title']);
                $description = htmlentities($_POST['add_typeofmarkup_text']);
                $temporary = mysqli_query($connection,"Insert INTO TypeOfMarkup (Title, Description) Values ('$title','$description');");
                if($temporary) echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Тип добавлен!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                        </script>';
                else echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Что-то пошло не так!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';           
            }
            else if(isset($_POST['add_markup_submit'])){ //добавить разметку
                $title = htmlentities($_POST['add_markup_title']);
                $description = htmlentities($_POST['add_markup_text']);
                $number = htmlentities($_POST['add_markup_number']);
                $imageSrc = htmlentities($_POST['add_markup_photo']);
                $typeOfMarkup = htmlentities($_POST['typeofmarkups']);
                $temporary = mysqli_query($connection,"Insert INTO Markup (Number, Title, ImageSrc, Description, TypeOfMarkup) Values ('$number','$title','$imageSrc','$description','$typeOfMarkup');");
                if($temporary) echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Разметка добавлена!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                        </script>';
                else echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Что-то пошло не так!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';  
            }
            else if(isset($_POST['set_typeofmarkup_submit'])) {
                $title = htmlentities($_POST['set_typeofmarkup_title']);
                $temporary = mysqli_query($connection,"Select * From TypeOfMarkup Where Title = '$title';");
                $temporary = mysqli_fetch_assoc($temporary);
                if($temporary['ID']!= NULL){
                    $typeOfMarkup = [
                        "title" => $temporary['Title'],
                        "description" => $temporary['Description'],
                        "id" => $temporary['ID']
                    ];
                    $_SESSION['TypeOfMarkup'] = $typeOfMarkup;
                    header("Location: typeofmarkup_editor.php");
                }
                else echo  '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Тип разметки не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';  
            }
            else if(isset($_POST['set_markup_submit'])) {
                $number = htmlentities($_POST['set_markup_number']);
                $temporary = mysqli_query($connection,"Select * From Markup Where Number = '$number';");
                $temporary = mysqli_fetch_assoc($temporary);
                if($temporary['ID']!= NULL){
                    $markup = [
                        "number" => $temporary['Number'],
                        "title" => $temporary['Title'],
                        "image" => $temporary['ImageSrc'],
                        "description" => $temporary['Description'],
                        "type" => $temporary['TypeOfMarkup'],
                        "id" => $temporary['ID']
                    ];
                    $_SESSION['Markup'] = $markup;
                    header("Location: markup_editor.php");
                }
                else echo  '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Разметка не найдена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';  
            }
            else if(isset($_POST['remove_typeofmarkup_submit'])){ //удалить тип разметки
                $title = htmlentities($_POST['remove_typeofmarkup_title']);
                $temporary = mysqli_query($connection,"Select * From TypeOfMarkup Where Title = '$title';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];
                if($temporary_1 != NULL) {
                    $temporary = mysqli_query($connection,"Delete From TypeOfMarkup Where ID = '$temporary_1';");
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Тип разметки удалён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
                else{
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Тип разметки не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
            else if(isset($_POST['remove_markup_submit'])){ // удалить разметку
                $number = htmlentities($_POST['remove_markup_number']);
                $temporary = mysqli_query($connection,"Select * From Markup Where Number = '$number';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];
                if($temporary_1 != NULL) {
                    $temporary = mysqli_query($connection,"Delete From Markup Where ID = '$temporary_1';");
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Разметка удалена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
                else{
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Разметка не найдена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
            else if(isset($_POST['add_typeofsign_submit'])){ //добавить тип знака
                $title = htmlentities($_POST['add_typeofsign_title']);
                $description = htmlentities($_POST['add_typeofsign_text']);
                $temporary = mysqli_query($connection,"Insert INTO TypeOfSign (Title, Description) Values ('$title','$description');");
                if($temporary) echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Тип добавлен!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                        </script>';
                else echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Что-то пошло не так!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';      
            }
            else if(isset($_POST['add_sign_submit'])){
                $title = htmlentities($_POST['add_sign_title']);
                $description = htmlentities($_POST['add_sign_text']);
                $number = htmlentities($_POST['add_sign_number']);
                $type = "кастыль,который нада удалить,ыы";
                $typeOfSign = htmlentities($_POST['typeofsigns']);
                $image = NULL;
                if(isset($_FILES['add_sign_photo'])){
                    $path = "../signs_pic/";
                    $name = $number;
                    $maxSize = 1048576; //максимальный размер - 10 мб
                    $currentSize = $_FILES['add_sign_photo']['size'];
                    $tmp = $_FILES['add_sign_photo']['tmp_name'];
                    if($currentSize < $maxSize){
                        if(copy($tmp,$path . $name)) $image = $path . $name;
                        else echo "не загрузилося(";// такого быть не должно
                    }
                    else{
                        echo "файл слишком большой!";//перезагрузка страницы и скрыпт
                        echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Слишком большой размер картинки!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                    }
                }
                $temporary = mysqli_query($connection,"Insert INTO signs (Title, Description, Number, type, TypeOfSign) Values ('$title','$description', '$number', '$type', '$typeOfSign');");
                if($temporary)  echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Знак добавлен!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                        </script>';
                else echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Что-то пошло не так!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                           </script>'; 
            }
            else if(isset($_POST['set_typeofsigns_submit'])){
                $title = htmlentities($_POST['set_typeofsigns_title']);
                $temporary = mysqli_query($connection,"Select * From TypeOfSign Where Title = '$title';");
                $temporary = mysqli_fetch_assoc($temporary);
                if($temporary['ID']!= NULL){
                    $typeOfSign = [
                        "title" => $temporary['Title'],
                        "description" => $temporary['Description'],
                        "id" => $temporary['ID']
                    ];
                    $_SESSION['TypeOfSign'] = $typeOfSign;
                    header("Location: typeofsign_editor.php");
                }
                else echo  '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Тип знака не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>'; 
            }
            else if(isset($_POST['set_signs_submit'])){
                $number = htmlentities($_POST['set_signs_number']);
                $temporary = mysqli_query($connection,"Select * From signs Where Number = '$number';");
                $temporary = mysqli_fetch_assoc($temporary);
                if($temporary['ID']!= NULL){
                    $sign = [
                        "id" => $temporary['ID'],
                        "title" => $temporary['Title'],
                        "description" => $temporary['Description'],
                        "number" => $temporary['Number'],
                        "type" => $temporary['TypeOfSign']
                    ];
                    $_SESSION['Sign'] = $sign;
                    header("Location: signs_editor.php");
                }
                else echo  '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Знак не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>'; 
            }
            else if(isset($_POST['remove_typeofsigns_submit'])){ // удалить тип знака
                $title = htmlentities($_POST['remove_typeofsigns_title']);
                $temporary = mysqli_query($connection,"Select * From TypeOfSign Where Title = '$title';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];
                if($temporary_1!=NULL){
                    $temporary = mysqli_query($connection,"Delete From TypeOfSign Where ID = '$temporary_1';");
                    if($temporary){
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Раздел удалён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>'; 
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Не удалось удалить раздел, возможно в нём есть знаки,удалите сначала их!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                           </script>'; 
                    }
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Раздел не обнаружен!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                           </script>'; 
                }
            }
            else if(isset($_POST['remove_signs_submit'])){
                $number = htmlentities($_POST['remove_signs_number']);
                $temporary = mysqli_query($connection,"Select * From signs Where Number = '$number';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];
                $path = "../signs_pic/";
                if($temporary_1 != NULL){
                    $temporary = mysqli_query($connection,"Delete From signs Where ID = '$temporary_1';");
                    unlink(($path . $number));
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Знак удалён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>'; 
                }
                else{
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Знак не обнаружен!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>'; 
                }
            }
            else if(isset($_POST['add_users_submit'])){
                $login = htmlentities($_POST['add_users_login']);
                $password = htmlentities($_POST['add_users_password']);
                $fname = htmlentities($_POST['add_users_fname']);
                $lname = htmlentities($_POST['add_users_sname']);
                $email = htmlentities($_POST['add_users_email']);
                $status = htmlentities($_POST['add_users_admin']);
                $temporary = mysqli_query($connection,"Select * From Users Where Login = '$login';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];
                if($temporary_1 == NULL){
                    $temporary = mysqli_query($connection,"Insert INTO Users (Login, Password, FirstName, LastName, Status, Email) Values ('$login','$password', '$fname', '$lname', '$status', '$email');");
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Пользователь добавлен!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
                else{
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Пользователь уже существует!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>'; 
                }
            }
            else if(isset($_POST['set_users_submit'])){
                $login = htmlentities($_POST['set_users_login']);
                $temporary = mysqli_query($connection,"Select * From Users Where Login = '$login';");
                $temporary = mysqli_fetch_assoc($temporary);
                if($temporary['ID']!= NULL){
                    $user = [
                        "login" => $temporary['Login'],
                        "password" => $temporary['Password'],
                        "fname" => $temporary['FirstName'],
                        "lname" => $temporary['LastName'],
                        "status" => $temporary['Status'],
                        "email" => $temporary['Email'],
                        "id" => $temporary['ID']
                    ];
                    $_SESSION['User'] = $user;
                    header("Location: user_editor.php");
                }
                else echo  '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Пользователь не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>'; 
            }
            else if(isset($_POST['remove_users_submit'])){
                $login = htmlentities($_POST['remove_users_login']);
                $temporary = mysqli_query($connection,"Select * From Users Where Login = '$login';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];
                if($temporary_1 != NULL){
                    $temporary = mysqli_query($connection,"Delete From Users Where ID = '$temporary_1';");
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Пользователь удалён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>'; 
                }
                else{
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Пользователь не обнаружен!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>'; 
                }
            }
            else if(isset($_POST['add_typeoffine_submit'])){//добавить тип штрафа
                $title = htmlentities($_POST['add_typeoffine_title']);
                $temporary = mysqli_query($connection,"Insert INTO TypeOfFines (Title) Values ('$title');");
                if($temporary) echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Тип добавлен!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                        </script>';
                else echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Что-то пошло не так!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';      
            }
            else if(isset($_POST['add_fines_submit'])){// добавить штраф
                $cao = htmlentities($_POST['add_fines_cao']);
                $offense = htmlentities($_POST['add_fines_offense']);
                $sanctions = htmlentities($_POST['add_fines_sanctions']);
                $type  = htmlentities($_POST['typeoffines']);
                $temporary = mysqli_query($connection,"Insert INTO Fines (CAO, Offense, Sanctions, TypeOfFines) Values ('$cao','$offense','$sanctions','$type');");
                if($temporary) echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Штраф добавлена!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                        </script>';
                else echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Что-то пошло не так!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
            }
            else if(isset($_POST['set_fines_submit'])){
                $cao = htmlentities($_POST['set_fines_login']);
                $temporary = mysqli_query($connection,"Select * From Fines Where CAO = '$cao';");
                $temporary = mysqli_fetch_assoc($temporary);
                if($temporary['ID']!= NULL){
                    $Fines = [
                        "cao" => $temporary['CAO'],
                        "offense" => $temporary['Offense'],
                        "sanctions" => $temporary['Sanctions'],
                        "type" => $temporary['TypeOfFines'],
                        "id" => $temporary['ID']
                    ];
                    $_SESSION['Fines'] = $Fines;
                    header("Location: fines_editor.php");
                }
                else echo  '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Штраф не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
            }
            else if(isset($_POST['set_typeoffines_submit'])){
                $title = htmlentities($_POST['set_fines_title']);
                $temporary = mysqli_query($connection,"Select * From TypeOfFines Where Title = '$title';");
                $temporary = mysqli_fetch_assoc($temporary);
                if($temporary['ID']!= NULL){
                    $typeOfFines = [
                        "title" => $temporary['Title'],
                        "id" => $temporary['ID']
                    ];
                    $_SESSION['TypeOfFines'] = $typeOfFines;
                    header("Location: typeoffine_editor.php");
                }
                else echo  '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Тип штрафа не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
            }
            else if(isset($_POST['remove_typeoffines_submit'])){ //удаление типа штрафа
                $title = htmlentities($_POST['remove_fines_title']);
                $temporary = mysqli_query($connection,"Select * From TypeOfFines Where Title = '$title';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];
                if($temporary_1 != NULL) {
                    $temporary = mysqli_query($connection,"Delete From TypeOfFines Where ID = '$temporary_1';");
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Тип штрафа удалён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
                else{
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Тип штрафа не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
            else if(isset($_POST['remove_fines_submit'])){ //удаление штрафа
                $cao = htmlentities($_POST['remove_fines_cao']);
                $temporary = mysqli_query($connection,"Select * From Fines Where CAO = '$cao';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];
                if($temporary_1 != NULL) {
                    $temporary = mysqli_query($connection,"Delete From Fines Where ID = '$temporary_1';");
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Штраф удалён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
                else{
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Штраф не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
            else if(isset($_POST['add_ticket_submit'])){//добавление билета
                $prefix = "Экзаменационный билет №";
                $number = htmlentities($_POST['add_ticket_number']);
                $title = $prefix . $number;
                $temporary = mysqli_query($connection,"Select * From Tickets Where Title = '$title';");
                if(mysqli_num_rows($temporary)==0){
                    $temporary_1 = mysqli_query($connection,"Insert Into Tickets (Title) Values ('$title');");
                    if($temporary_1){
                        echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Билет добавлен!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>'; 
                    }
                    else{
                        echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Что-то пошло не так! Билет не добавлен!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>'; 
                    }
                }
                else{
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Уже есть такой билет!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>'; 
                }
            }
            else if(isset($_POST['add_question_submit'])){// вставить вопрос
                $question = htmlentities($_POST['add_ticket_question']);
                $ticketNumber = htmlentities($_POST['tickets']);
                $questionNumber = htmlentities($_POST['typeofquestion']);
                $check = mysqli_query($connection,"Select * From Question Where Ticket = '$ticketNumber' AND TypeOfQuestion = '$questionNumber';");
                if(mysqli_num_rows($check)==0){
                    $image = NULL;
                    $switch = htmlentities($_POST['ticketQuestion']);
                    if($switch == 'r'){// добавить картинку
                        if(isset($_FILES['add_ticket_photo'])){
                            $path = "../tests_pic/";
                            $name = $ticketNumber . "." . $questionNumber;
                            $maxSize = 1048576; //максимальный размер - 10 мб
                            $currentSize = $_FILES['add_ticket_photo']['size'];
                            $tmp = $_FILES['add_ticket_photo']['tmp_name'];
                            if($currentSize < $maxSize){
                                if(copy($tmp, $path . $name . ".png")){
                                    $temporary = mysqli_query($connection,"Insert Into Question (Text,Image,Ticket,TypeOfQuestion) Values ('$question','$name','$ticketNumber','$questionNumber');");
                                    if($temporary){
                                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                    messageBox.innerHTML = "Вопрос добавлен!";
                                                    var a = document.getElementById("myModal");
                                                    a.style.display = "block";
                                            </script>';
                                    }
                                    else{
                                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                    messageBox.innerHTML = "Что-то пошло не так! Вопрос не добавлен!";
                                                    var a = document.getElementById("myModal");
                                                    a.style.display = "block";
                                            </script>';
                                    }
                                }
                                else echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                    messageBox.innerHTML = "Картинка не загружена!";
                                                    var a = document.getElementById("myModal");
                                                    a.style.display = "block";
                                            </script>';
                            }
                            else{
                                echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Слишком большой размер картинки!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                        </script>';
                            }
                        }
                    }
                    else{// не добавлять картинку
                        $temporary = mysqli_query($connection,"Insert Into Question (Text,Image,Ticket,TypeOfQuestion) Values ('$question','$image','$ticketNumber','$questionNumber');");
                            if($temporary){
                                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Вопрос добавлен!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                    </script>';
                            }
                            else{
                                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Что-то пошло не так! Вопрос не добавлен!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                    </script>';
                            }
                    }
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "такой вопрос уже есть! Вы можете редактировать его в другой вкладке!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                        </script>';
                }
            }
            else if(isset($_POST['add_answer_submit'])){// добавление ответа
                $ticketNumber = htmlentities($_POST['tickets_1']);
                $questionNumber = htmlentities($_POST['typeofquestion_1']);
                $isTrue = $_POST['isTrue'];
                $text = htmlentities($_POST['add_ticket_answer']);
                $questionSearch = mysqli_query($connection,"Select * From Question Where Ticket = '$ticketNumber' AND TypeOfQuestion = '$questionNumber';");
                if(mysqli_num_rows($questionSearch)==0){
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Вопрос не найден, не удаётся добавить ответ!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                        </script>';
                }
                else{
                    $questionID = mysqli_fetch_assoc($questionSearch);
                    $questionID = $questionID['ID'];
                    $count = mysqli_query($connection,"Select * From Answers Where QuestionID = '$questionID';");
                    if(mysqli_num_rows($count) < 4){
                        $temporary = mysqli_query($connection,"Insert Into Answers (Text,IsTrue,QuestionID) Values ('$text','$isTrue','$questionID');");
                        if($temporary){
                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Ответ добавлен!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                        }
                        else{
                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Что-то пошло не так! Добавление ответа не произошло!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                        }
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "На этот вопрос уже есть допустимые 4 ответа! Добавление не произошло!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                    }
                }
            }
            else if(isset($_POST['set_question_submit'])){//изменение вопроса
                $ticketNumber = htmlentities($_POST['tickets_2']);
                $questionNumber = htmlentities($_POST['typeofquestion_2']);
                $temporary_1 = mysqli_query($connection,"Select * From Question Where Ticket = '$ticketNumber' And TypeOfQuestion = '$questionNumber';");
                $check = mysqli_fetch_assoc($temporary_1);
                if($check['ID'] != NULL){
                    $data = [
                        "id" => $check['ID'],
                        "text" => $check['Text'],
                        "image" => $check['Image'],
                        "ticket" => $check['Ticket'],
                        "type" => $check['TypeOfQuestion']
                    ];
                    $_SESSION['Question'] = $data;
                    header("Location: question_editor.php");
                }
                else{
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Вопрос не найден, либо ещё не создан!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
            else if(isset($_POST['set_answer_submit'])){//изменение ответа
                $questionNumber = htmlentities($_POST['typeofquestion_3']);
                $ticketNumber = htmlentities($_POST['tickets_3']);
                $definition = htmlentities($_POST['set_ticket_answer']);
                $temporary_1 = mysqli_query($connection,"Select * From Question Where Ticket = '$ticketNumber' And TypeOfQuestion = '$questionNumber';");
                $check = mysqli_fetch_assoc($temporary_1);
                if($check['ID'] != NULL){
                    $questionID = $check['ID'];
                    $query = mysqli_query($connection,"Select * From Answers Where QuestionID = '$questionID' AND Text = '$definition';");
                    $temporary = mysqli_fetch_assoc($query);
                    if($temporary['ID'] != NULL){
                        $data = [
                            "id" => $temporary['ID'],
                            "text" => $temporary['Text'],
                            "isTrue" => $temporary['IsTrue'],
                            "questionID" => $temporary['QuestionID']
                        ];
                        $_SESSION['Answer'] = $data;
                        header("Location: answer_editor.php");
                    }
                    else{
                        echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Ответ не найден!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                    }
                }
                else{
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Вопрос не найден, либо ещё не создан!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
            else if(isset($_POST['remove_ticket_submit'])){//удаление билета
                $number = htmlentities($_POST['remove_ticket_number']);
                $prefix = "Экзаменационный билет №";
                $number = $number . $prefix;
                $temporary = mysqli_query($connection,"Select * From Tickets Where Title = '$number';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];//ID билета
                if($temporary_1 != NULL) {
                    $question = mysqli_query($connection,"Select * From Question Where Ticket = '$temporary_1';");
                    while($result = mysqli_fetch_assoc($question)){
                        $numberOfQuestion = $result['ID'];//ID вопроса
                        $answer = mysqli_query($connection,"Delete From Answers Where QuestionID = '$numberOfQuestion';");
                    }
                    $removeQuestion = mysqli_query($connection,"Delete From Question Where Ticket = '$temporary_1';");
                    $temporary = mysqli_query($connection,"Delete From Tickets Where Title = '$number';");  
                    if($temporary) {   
                        echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Билет удалён!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                    }
                    else{
                        echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Что-то пошло не так! Билет не удалён!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                    }
                }
                else{
                    echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Билет не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
            else if(isset($_POST['add_course_submit'])){ //добавление курса
                // print_r($_POST);
                // echo "<br/><br/>";
                // print_r($_FILES);
                $image = NULL;
                $title = htmlentities($_POST['add_course_title']);
                $description = htmlentities($_POST['add_course_description']);
                $teacher = htmlentities($_POST['people']);
                if ($_FILES['add_course_photo']['size']>0) { //с картинкой
                    $path = "../courses_pic/";
                    $name = $title;
                    $maxSize = 1048576; //максимальный размер - 10 мб
                    $currentSize = $_FILES['add_course_photo']['size'];
                    $tmp = $_FILES['add_course_photo']['tmp_name'];
                    $array = explode('.', $_FILES['add_course_photo']['name']);
                    $extension = end($array);
                    if ($currentSize < $maxSize) {
                        if(copy($tmp,$path . $name . "." . $extension)) {
                            $name = $name . "." . $extension;
                            $temporary = mysqli_query($connection, "INSERT INTO Course (`Image`, `Title`, `Description`, `Teacher`) VALUES ('$name', '$title', '$description', $teacher)");
                            if ($temporary) {
                                echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Курс добавлен!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                        </script>';
                            } else {
                                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Что-то пошло не так!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                    </script>';
                            }
                        }
                    } else {
                        echo   '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Слишком большой размер файла!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                    }
                } else { //без картинки
                    $temporary = mysqli_query($connection, "INSERT INTO Course (`Image`, `Title`, `Description`, `Teacher`) VALUES ('Отсутствует', '$title', '$description', $teacher)");
                    if ($temporary) {
                        echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Курс добавлен!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                    } else {
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Что-то пошло не так!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                    }
                }
            } else if(isset($_POST['set_course_submit'])){ //редактирование курса
                // print_r($_POST);
                $title = htmlentities($_POST['set_course_title']);
                $check = mysqli_query($connection,"SELECT * FROM Course WHERE Title = '$title';");
                $check = mysqli_fetch_assoc($check);
                if($check['ID']!=NULL){
                    $course = [
                        "title" => $check['Title'],
                        "description" => $check['Description'],
                        "teacher" => $check['Teacher'],
                        "image" => $check['Image'],
                        "id" => $check['ID']
                    ];
                    $_SESSION['Course'] = $course;
                    header("Location: course_editor.php");
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                            messageBox.innerHTML = "Курс не найден!";
                            var a = document.getElementById("myModal");
                            a.style.display = "block";
                         </script>';
                }
            } else if(isset($_POST['remove_course_submit'])){ //удаление курса
                $title = htmlentities($_POST['remove_course_title']);
                $temporary = mysqli_query($connection,"SELECT * FROM Course WHERE Title = '$title';");
                $temporary = mysqli_fetch_assoc($temporary);
                $temporary_1 = $temporary['ID'];
                $path = "../courses_pic/";
                if($temporary_1!=NULL){
                    if($temporary['Image']!=NULL) unlink("../courses_pic/" . $temporary['Image']);
                    $temporary = mysqli_query($connection,"DELETE FROM Course WHERE Title = '$title';");
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Курс удален!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
                else{
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Курс не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
            // if(isset($_POST)){
            //     print_r($_POST);
            //     echo '
            //         <script type="text/javascript">
            //         location.reload();
            //         </script>';
            //     print_r($_POST);
            // }
            // print_r($_POST);
        ?>

    </body>
</html>