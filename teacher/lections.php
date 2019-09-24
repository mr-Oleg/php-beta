<?php
    require_once "../db.php";
    ob_start();
    if ($_SESSION['teacher']['type']!=2) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Teacher Panel</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
            function a(){
                var a = document.getElementById("myModal");
                a.style.display = 'none';
            }
            function b(temp){
                var messageBox = document.getElementById("textmessage");
                messageBox.innerHTML = temp;
                var a = document.getElementById("myModal");
                a.style.display = 'block';
            }
        </script>
        <script>
            $('a[data-toggle="pill"]').on('hidden.bs.tab', function (e) {
                console.log(e.target); // вкладка, которая стала активной
                console.log(e.relatedTarget); // предыдущая активная вкладка
            })
        </script>
        <script type="text/javascript">
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

<?php
	require_once("header.php");
?>


	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-9" style="border: 1px gray solid; border-radius: 10px;">
					<ul class="nav nav-pills" role="tablist">
                        <li class="active"><a href="#lections" role="tab" data-toggle="pill">Лекции</a></li>
                        <li><a href="#questions" role="tab" data-toggle="pill">Вопросы</a></li>
                        <li><a href="#answers" role="tab" data-toggle="pill">Ответы</a></li>
                    </ul>

                    <div class="tab-content" >
                        <div role="tabpanel" class="tab-pane active" id="lections" style="margin:1%;">
                            <div class="1 text-center" style="font-size: 150%;">
                                Добавить лекцию
                                <form method="POST" action="lections.php" style="margin: 1%;" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Заголовок:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_lections_title" placeholder="Введите текст" name="add_lections_title" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Описание:</label>
                                        <div class="col-sm-10">
                                            <textarea required class="form-control input-xs" id="add_lections_description" placeholder="Введите описание" name="add_lections_description" style="min-width: 100%;max-width: 100%;"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Тело:</label>
                                        <div class="col-sm-10">
                                            <textarea required class="form-control input-xs" id="add_lections_body" placeholder="Введите описание" name="add_lections_body" style="min-width: 100%;max-width: 100%;"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row text-center has-success" style="font-size: 50%;">
                                        <div class="col-md-6 has-success">
                                            <input value="r" checked onclick="document.getElementById('add_lections_photo').disabled = true;" type="radio" id="customRadio1" name="lectionSwitch" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1">Без картинки</label>
                                        </div>
                                        <div class="col-md-6 has-success">
                                            <input value="c" onclick="document.getElementById('add_lections_photo').disabled = false;" type="radio" id="customRadio3" name="lectionSwitch" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3">С картинкой</label>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="inputDate" class="col-sm-2 control-label">Фото:</label>
                                        <div class="col-sm-10 text-center">
                                            <input type="file" disabled class="form-control input-xs text-center" style="border: 0px gray solid;" id="add_lections_photo" name="add_lections_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Курс:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="course" required>
                                                <?php 
                                                    $login = $_SESSION['teacher']['login'];
                                                    $getID = mysqli_query($connection,"Select * From Users Where Login ='$login';");
                                                    $id = mysqli_fetch_assoc($getID);
                                                    $id = $id['ID'];
                                                    $courses = mysqli_query($connection,"Select * From Course Where Teacher = '$id' Order by ID;");
                                                    while($type = mysqli_fetch_assoc($courses)){
                                                        echo "<option value ='" . $type['ID'] . "'>" . $type['Title'] . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_lections_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%; margin-top:1%; display: none">
                                Изменить лекцию
                                <form method="POST" action="lections.php" style="margin: 1%;" class="form-horizontal">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Заголовок:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="set_lections_title" placeholder="Введите текст" name="set_lections_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="set_lections_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%; margin-top:1%; display: none">
                                Удалить лекцию
                                <form method="POST" action="lections.php" style="margin: 1%;" class="form-horizontal">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Заголовок:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_lections_title" placeholder="Введите текст" name="remove_lections_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_lections_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="questions" style="margin:2%;">
                            <div class="1 text-center" style="font-size: 150%;">
                                Добавить вопрос
                                <form method="POST" action="lections.php" style="margin: 1%;" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Текст:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_question_title" placeholder="Введите текст" name="add_question_title" >
                                        </div>
                                    </div>
                                    <div class="form-group row text-center has-success" style="font-size: 50%;">
                                        <div class="col-md-6 has-success">
                                            <input value="r" checked onclick="document.getElementById('add_question_photo').disabled = true;" type="radio" id="customRadio1" name="questionSwitch" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1">Без картинки</label>
                                        </div>
                                        <div class="col-md-6 has-success">
                                            <input value="c" onclick="document.getElementById('add_question_photo').disabled = false;" type="radio" id="customRadio3" name="questionSwitch" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3">С картинкой</label>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="inputDate" class="col-sm-2 control-label">Фото:</label>
                                        <div class="col-sm-10 text-center">
                                            <input type="file" disabled class="form-control input-xs text-center" style="border: 0px gray solid;" id="add_question_photo" name="add_question_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Курс:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="course_1" required>
                                                <?php 
                                                    $login = $_SESSION['teacher']['login'];
                                                    $getID = mysqli_query($connection,"Select * From Users Where Login ='$login';");
                                                    $id = mysqli_fetch_assoc($getID);
                                                    $id = $id['ID'];
                                                    $courses = mysqli_query($connection,"Select * From Course Where Teacher = '$id' Order by ID;");
                                                    while($type = mysqli_fetch_assoc($courses)){
                                                        echo "<option value ='" . $type['ID'] . "'>" . $type['Title'] . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Лекция:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_questionOfLection_title" placeholder="Введите текст" name="add_questionOfLection_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_question_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%; margin-top:1%; display: none">
                                Изменить вопрос
                                <form method="POST" action="lections.php" style="margin: 1%;" class="form-horizontal" >
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Текст:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="edit_question_title" placeholder="Введите текст" name="edit_question_title" >
                                        </div>
                                    </div>
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Курс:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="course_2" required>
                                                <?php 
                                                    $login = $_SESSION['teacher']['login'];
                                                    $getID = mysqli_query($connection,"Select * From Users Where Login ='$login';");
                                                    $id = mysqli_fetch_assoc($getID);
                                                    $id = $id['ID'];
                                                    $courses = mysqli_query($connection,"Select * From Course Where Teacher = '$id' Order by ID;");
                                                    while($type = mysqli_fetch_assoc($courses)){
                                                        echo "<option value ='" . $type['ID'] . "'>" . $type['Title'] . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Лекция:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="edit_questionOfLection_title" placeholder="Введите текст" name="edit_questionOfLection_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="edit_question_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%; margin-top:1%; display: none">
                                Удалить вопрос
                                <form method="POST" action="lections.php" style="margin: 1%;" class="form-horizontal" >
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Текст:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_question_title" placeholder="Введите текст" name="remove_question_title" >
                                        </div>
                                    </div>
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Курс:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="course_3" required>
                                                <?php 
                                                    $login = $_SESSION['teacher']['login'];
                                                    $getID = mysqli_query($connection,"Select * From Users Where Login ='$login';");
                                                    $id = mysqli_fetch_assoc($getID);
                                                    $id = $id['ID'];
                                                    $courses = mysqli_query($connection,"Select * From Course Where Teacher = '$id' Order by ID;");
                                                    while($type = mysqli_fetch_assoc($courses)){
                                                        echo "<option value ='" . $type['ID'] . "'>" . $type['Title'] . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Лекция:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_questionOfLection_title" placeholder="Введите текст" name="remove_questionOfLection_title" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_question_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="answers" style="margin:1%;">
                            <div class="1 text-center" style="font-size: 150%;">
                                Добавить ответ
                                <form method="POST" action="lections.php" style="margin: 1%;" class="form-horizontal">
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Текст:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_answer_title" placeholder="Введите текст" name="add_answer_title" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Верный ?</label>
                                        <div class="col-sm-10 radio">
                                            <select class="form-control input-xs" name="isTrue" required>
                                                <option selected value ="1">Да</option>
                                                <option value ="0">Нет</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Курс:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control input-xs" name="course_4" required>
                                                <?php 
                                                    $login = $_SESSION['teacher']['login'];
                                                    $getID = mysqli_query($connection,"Select * From Users Where Login ='$login';");
                                                    $id = mysqli_fetch_assoc($getID);
                                                    $id = $id['ID'];
                                                    $courses = mysqli_query($connection,"Select * From Course Where Teacher = '$id' Order by ID;");
                                                    while($type = mysqli_fetch_assoc($courses)){
                                                        echo "<option value ='" . $type['ID'] . "'>" . $type['Title'] . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Лекция:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_answer_lection" placeholder="Введите текст" name="add_answer_lection" >
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Вопрос:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="add_answer_question" placeholder="Введите текст" name="add_answer_question" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success" value="Добавить" name="add_answer_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="2 text-center" style="font-size: 150%;display:none;">
                                Изменить ответ
                                <form method="POST" action="lections.php" style="margin: 1%;" class="form-horizontal">
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Лекция:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="edit_answer_lection" placeholder="Введите текст" name="edit_answer_lection" >
                                        </div>
                                    </div>
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Вопрос:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="edit_answer_question" placeholder="Введите текст" name="edit_answer_question" >
                                        </div>
                                    </div>
                                    <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Ответ:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="edit_answer_definition" placeholder="Введите текст" name="edit_answer_definition" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-warning" value="Изменить" name="edit_answer_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="3 text-center" style="font-size: 150%;display:none;">
                                Удалить ответ
                                <form method="POST" action="lections.php" style="margin: 1%;" class="form-horizontal">
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Лекция:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_answer_lection" placeholder="Введите текст" name="remove_answer_lection" >
                                        </div>
                                    </div>
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Вопрос:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_answer_question" placeholder="Введите текст" name="remove_answer_question" >
                                        </div>
                                    </div>
                                    <div class="form-group has-danger">
                                        <label for="pass" class="col-sm-2 control-label">Ответ:</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="remove_answer_definition" placeholder="Введите текст" name="remove_answer_definition" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Удалить" name="remove_answer_submit"/> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
				</div>

				<div class="col-md-3">
					<div class="col-md-12" style="border: 0px gray solid; border-radius: 10px;">
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

        if(isset($_SESSION['StatusLection'])){
            if($_SESSION['StatusLection']==1)
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция обновлена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
            else if($_SESSION['StatusLection']==2)
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Вопрос обновлён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
            else if($_SESSION['StatusLection']==3)
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Ответ обновлён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
            unset($_SESSION['StatusLection']);
        }

        if(isset($_POST['add_lections_submit'])){ // добавка лекций
            $name = htmlentities($_POST['add_lections_title']);
            $description = htmlentities($_POST['add_lections_description']);
            $body = htmlentities($_POST['add_lections_body']);
            $switch = htmlentities($_POST['lectionSwitch']);
            $course = htmlentities($_POST['course']);
            $image = NULL;
            if($switch == 'r'){ // без картинки
                $temporary = mysqli_query($connection,"Insert Into Lections (Name,Text,Image,CourseID,Description) Values ('$name','$body','$image','$course','$description');");
                if($temporary){
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция добавлена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Что-то пошло не так! Лекция не добавлена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }
            }
            else if($switch == 'c'){ //с картинкой
                if(isset($_FILES['add_lections_photo'])){
                    $path = "../lections_pic/";
                    $maxSize = 1048576; //максимальный размер - 10 мб
                    $currentSize = $_FILES['add_lections_photo']['size'];
                    $tmp = $_FILES['add_lections_photo']['tmp_name'];
                    $name_1=str_replace(':','',$name);
                    if($currentSize < $maxSize){
                        if(@copy($tmp,$path . $name_1 . ".png")){
                            $image = $name . ".png";
                            $temporary = mysqli_query($connection,"Insert Into Lections (Name,Text,Image,CourseID,Description) Values ('$name','$body','$image','$course','$description');");
                            if($temporary){
                                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Лекция успешно добавлена!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                    </script>';
                            }
                            else{
                                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Что-то пошло не так! Попробуйте ещё разок!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                    </script>';
                            }
                            
                        }
                        else echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Картинка не загружена! Проверьте соединение с интернетом!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                    </script>';
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Слишком большой размер изображения!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                    }
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Загрузите изображение!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }

            }
        }
        else if(isset($_POST['set_lections_submit'])){ // изменение лекций
            $title = htmlentities($_POST['set_lections_title']);
            $setID = mysqli_query($connection,"Select * From Lections Where Name = '$title';");
            if(mysqli_num_rows($setID)>0){
                $setID = mysqli_fetch_assoc($setID);
                $id = $setID['ID'];
                $name = $setID['Name'];
                $text = $setID['Text'];
                $image = $setID['Image'];
                $course = $setID['CourseID'];
                $description = $setID['Description'];
                if($image == ''){
                    $image = NULL;
                }
                $data = [
                    "id" => $id,
                    "name" => $name,
                    "text" => $text,
                    "image" => $image,
                    "course" => $course,
                    "description" => $description
                ];
                $_SESSION['Lection'] = $data;
                header("Location: lections_editor.php");
            }
            else{
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция с таким заголовком не найдена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
            }
        }
        else if(isset($_POST['remove_lections_submit'])){// удаление лекций
            $title = htmlentities($_POST['remove_lections_title']);
            $setID = mysqli_query($connection,"Select * From Lections Where Name = '$title';");
            if(mysqli_num_rows($setID)>0){
                $setID = mysqli_fetch_assoc($setID);
                $setID = $setID['ID'];
                $temporary = mysqli_query($connection,"Select * From Sets Where LectionID = '$setID';");
                while($result = mysqli_fetch_assoc($temporary)){
                    $questionID = $result['QuestionID'];
                    $temporary_1 = mysqli_query($connection,"Delete From Answers Where QuestionID = '$questionID';");
                    $removeImages = mysqli_query($connection,"Select * From Question Where ID = '$questionID';");
                    $img = mysqli_fetch_assoc($removeImages);
                    $img = $img['Image'];
                    if($img != NULL){
                        $path = "../lections_pic/";
                        unlink($path . $img);
                    }
                    $temporary_2 = mysqli_query($connection,"Delete From Question Where ID = '$questionID';");
                }
                $set_delete = mysqli_query($connection,"Delete From Sets Where LectionID = '$setID';");
                $lection_delete = mysqli_query($connection,"Delete From Lections Where ID = '$setID';");
                if($lection_delete){
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция удалена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция не удалена! Что-то пошло не так!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }

            }
            else{
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция с таким заголовком не найдена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
            }
        }
        else if(isset($_POST['add_question_submit'])){ // добавка вопросов
            $title = htmlentities($_POST['add_question_title']);
            $switch = htmlentities($_POST['questionSwitch']);
            $course = htmlentities($_POST['course_1']);
            $lection = htmlentities($_POST['add_questionOfLection_title']);
            $image = NULL;
            $ticket = NULL;
            $typeOfQuestion = NULL;
            $courseCheck = mysqli_query($connection,"Select * From Course Where ID = '$course';");
            if(mysqli_num_rows($courseCheck) >0){
                $lectionCheck = mysqli_query($connection,"Select * From Lections Where Name = '$lection';");
                if(mysqli_num_rows($lectionCheck)>0){
                    if($switch == 'r'){// без картинки
                        $insert = mysqli_query($connection, "Insert Into Question (Text,Image) Values ('$title','$image');");
                        if($insert){
                            $search = mysqli_query($connection,"Select * From Question Where Text = '$title' And Image ='$image';");
                            $questionID = mysqli_fetch_assoc($search);
                            $questionID = $questionID['ID'];
                            $lectionID = mysqli_fetch_assoc($lectionCheck);
                            $lectionID = $lectionID['ID'];
                            $set = mysqli_query($connection,"Insert Into Sets (QuestionID,LectionID) Values ('$questionID','$lectionID');");
                            if($set){
                                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Вопрос добавлен!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                    </script>';
                            }
                            else{
                                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Вопрос не добавлен, что-то пошло не так!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                    </script>';
                            }
                        }
                        else{
                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Вопрос не добавлен!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                        }
                    }
                    else{ // с картинкой
                        if(isset($_FILES['add_question_photo'])){
                            $path = "../tests_pic/";
                            $maxSize = 1048576; //максимальный размер - 10 мб
                            $currentSize = $_FILES['add_question_photo']['size'];
                            $tmp = $_FILES['add_question_photo']['tmp_name'];
                            $name = $lection . $title;
                            $name_1=str_replace(':','',$name);
                            if($currentSize < $maxSize){
                                if(@copy($tmp,$path . $name_1 . ".png")){
                                    $image = $name_1 . ".png";
                                    $insert = mysqli_query($connection, "Insert Into Question (Text,Image) Values ('$title','$image');");
                                    if($insert){
                                        $search = mysqli_query($connection,"Select * From Question Where Text = '$title' And Image ='$image';");
                                        $questionID = mysqli_fetch_assoc($search);
                                        $questionID = $questionID['ID'];
                                        $lectionID = mysqli_fetch_assoc($lectionCheck);
                                        $lectionID = $lectionID['ID'];
                                        $set = mysqli_query($connection,"Insert Into Sets (QuestionID,LectionID) Values ('$questionID','$lectionID');");
                                        if($set){
                                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                    messageBox.innerHTML = "Вопрос добавлен!";
                                                    var a = document.getElementById("myModal");
                                                    a.style.display = "block";
                                                </script>';
                                        }
                                        else{
                                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                    messageBox.innerHTML = "Вопрос не добавлен, что-то пошло не так!";
                                                    var a = document.getElementById("myModal");
                                                    a.style.display = "block";
                                                </script>';
                                        }
                                    }
                                    else{
                                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                messageBox.innerHTML = "Вопрос не добавлен!";
                                                var a = document.getElementById("myModal");
                                                a.style.display = "block";
                                            </script>';
                                    }
                                }
                            }
                            else{
                                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Размер изображения слишком большой!";
                                            var a = document.getElementById("myModal");
                                            a.style.display = "block";
                                    </script>';
                            }
                        }
                        else{
                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Загрузите изображение!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                </script>';
                        }
                    }
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция с таким названием не найдена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }
            }
            else{
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Курс с таким названием не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
            }
        }
        else if(isset($_POST['edit_question_submit'])){ // редактирование вопросов
            $title = htmlentities($_POST['edit_question_title']);
            $course = htmlentities($_POST['course_2']);
            $lection = htmlentities($_POST['edit_questionOfLection_title']);
            $courseCheck = mysqli_query($connection,"Select * From Course Where ID = '$course';");
            if(mysqli_num_rows($courseCheck)>0){
                $lectionCheck = mysqli_query($connection,"Select * From Lections Where Name = '$lection';");
                if(mysqli_num_rows($lectionCheck)>0){
                    $questionSearch = mysqli_query($connection,"Select * From Question Where Text = '$title';");
                    if(mysqli_num_rows($questionSearch)>0){
                        $questionSearch = mysqli_fetch_assoc($questionSearch);
                        $text = $questionSearch['Text'];
                        $image = $questionSearch['Image'];
                        $id = $questionSearch['ID'];
                        if($image = ''){
                            $image = NULL;
                        }
                        $data = [
                            "course" => $course,
                            "lection" => $lection,
                            "id" => $id,
                            "text" => $text,
                            "image" => $image
                        ];
                        $_SESSION['Question'] = $data;
                        header("Location: question_editor.php");
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Вопрос не найден!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                            </script>';
                    }
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Лекция не найдена!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                            </script>';
                }
            }
            else{
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Курс не найден!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                            </script>';
            }
        }
        else if(isset($_POST['remove_question_submit'])){ // удаление вопросов
            $title = htmlentities($_POST['remove_question_title']);
            $course = htmlentities($_POST['course_3']);
            $lection = htmlentities($_POST['remove_questionOfLection_title']);
            $courseCheck = mysqli_query($connection,"Select * From Course Where ID = '$course';");
            if(mysqli_num_rows($courseCheck)>0){
                $lectionCheck = mysqli_query($connection,"Select * From Lections Where Name = '$lection';");
                if(mysqli_num_rows($lectionCheck)>0){
                    $imageRemove = mysqli_query($connection,"Select * From Question Where Text = '$title';");
                    if(mysqli_num_rows($imageRemove)>0){
                        $image = mysqli_fetch_assoc($imageRemove);
                        $id = $image['ID'];
                        $image = $image['Image'];
                        if($image != NULL){
                            $path = "../tests_pic/";
                            unlink($path . $image);
                        }
                        $deleteSet = mysqli_query($connection,"Delete From Sets Where QuestionID = '$id';");
                        $delete = mysqli_query($connection,"Delete From Question Where ID = '$id';");
                        if($delete && $deleteSet){
                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Вопрос успешно удалён!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                            </script>';
                        }
                        else{
                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Что-то пошло не так!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                            </script>';
                        }
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Вопрос не найден!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                            </script>';
                    }
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция с таким названием не найдена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }
            }
            else{
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Курс с таким названием не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
            }
        }
        else if(isset($_POST['add_answer_submit'])){ // добавка ответов
            $lection = htmlentities($_POST['add_answer_lection']);
            $question = htmlentities($_POST['add_answer_question']);
            $title = htmlentities($_POST['add_answer_title']);
            $isTrue = htmlentities($_POST['isTrue']);
            $course = htmlentities($_POST['course_4']);
            $courseCheck = mysqli_query($connection,"Select * From Course Where ID = '$course';");
            if(mysqli_num_rows($courseCheck)>0){
                $lectionCheck = mysqli_query($connection,"Select * From Lections Where Name = '$lection';");
                if(mysqli_num_rows($lectionCheck)>0){
                    $questionCheck = mysqli_query($connection,"Select * From Question Where Text = '$question';");
                    if(mysqli_num_rows($questionCheck)>0){
                        $questionID = mysqli_fetch_assoc($questionCheck);
                        $questionID = $questionID['ID'];
                        $query = mysqli_query($connection, "Insert Into Answers (Text,IsTrue,QuestionID) Values ('$title','$isTrue','$questionID');");
                        if($query){
                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Ответ добавлен!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                        }
                        else{
                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Не удалось добавить ответ!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                            </script>';
                        }
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Вопрос не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                    }
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция не найдена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }
            }
            else{
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Курс не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
            }

        }
        else if(isset($_POST['edit_answer_submit'])){ // редактирование ответов
            $lection = htmlentities($_POST['edit_answer_lection']);
            $question = htmlentities($_POST['edit_answer_question']);
            $answer = htmlentities($_POST['edit_answer_definition']);
            $lectionCheck = mysqli_query($connection,"Select * From Lections Where Name = '$lection';");
            if(mysqli_num_rows($lectionCheck) > 0){
                $questionCheck = mysqli_query($connection,"Select * From Question Where Text = '$question';");
                if(mysqli_num_rows($questionCheck) > 0){
                    $questionCheck = mysqli_fetch_assoc($questionCheck);
                    $questionID = $questionCheck['ID'];
                    $answerCheck = mysqli_query($connection,"Select * From Answers Where QuestionID = '$questionID' And Text = '$answer';");
                    if(mysqli_num_rows($answerCheck) > 0){
                        $answerCheck = mysqli_fetch_assoc($answerCheck);
                        $isTrue = $answerCheck['IsTrue'];
                        $data = [
                            "id" => $answerCheck['ID'],
                            "text" => $answer,
                            "isTrue" => $isTrue,
                            "questionID" => $questionID
                        ];
                        $_SESSION['Answer'] = $data;
                        header("Location: answer_editor.php");
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Такой ответ не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                    }
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Вопрос с такой формулировкой не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }
            }
            else{
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция не найдена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
            }
        }
        else if(isset($_POST['remove_answer_submit'])){ // удаление ответа
            $lection = htmlentities($_POST['remove_answer_lection']);
            $question = htmlentities($_POST['remove_answer_question']);
            $answer = htmlentities($_POST['remove_answer_definition']);
            $lectionCheck = mysqli_query($connection,"Select * From Lections Where Name = '$lection';");
            if(mysqli_num_rows($lectionCheck)>0){
                $questionCheck = mysqli_query($connection,"Select * From Question Where Text = '$question';");
                if(mysqli_num_rows($questionCheck)>0){
                    $id = mysqli_fetch_assoc($questionCheck);
                    $id = $id['ID'];
                    $answerCheck = mysqli_query($connection,"Delete From Answers Where QuestionID = '$id' And Text = '$answer';");
                    if($answerCheck){
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Ответ успешно удалён!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Ответ не удалён! Уточните его формулировку и попробуйте снова!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                    }
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Вопрос с такой формулировкой не найден!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }
            }
            else{
                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Лекция с таким заголовком не найдена!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
            }
        }

        ?>
	</body>
</html>