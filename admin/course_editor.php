<?php
    require_once "../db.php";
    ob_start();
    if(!isset($_SESSION['Course'])) header("Location: admin_main.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Course editor</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row" >
                <div class="col-md-2"></div>
                <div class="col-md-8" style="margin-top: 10%; border: 1px solid gray; border-radius:10px;">
                    <div class="text-center" style="font-size: 150%;">
                    	Редактирование курса
                    	<form method="POST" action="course_editor.php" style="margin: 1%;" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="edit_course_title" placeholder="Введите текст" name="edit_course_title" value="<?php echo $_SESSION['Course']['title']; ?>" >
                                        </div>
                                </div>
                                <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Описание</label>
                                        <div class="col-sm-10">
                                            <textarea required class="form-control input-xs" id="edit_course_description" placeholder="Введите текст" name="edit_course_description" style="min-width: 100%;max-width: 100%;"><?php echo $_SESSION['Course']['description']; ?></textarea>
                                        </div>
                                </div>
                                <!-- <div class="form-group has-warning">
                                    <label for="inputDate" class="col-sm-2 control-label">Дата</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control input-xs" id="edit_news_date" name="edit_news_date" value="<?php echo date('Y-m-d\TH:i', strtotime($_SESSION['News']['date'])); ?>" required>
                                    </div>
                                </div> -->
                                <div class="form-group has-warning">
                                    <label for="inputDate" class="col-sm-2 control-label">Препод</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-xs" name="people" required>
                                            <?php
                                                $people = mysqli_query($connection,"Select * From Users Where Type = 2 Order by ID;");
                                                while($teacher = mysqli_fetch_assoc($people)){
                                                    if($teacher['ID']==$_SESSION['Course']['teacher']) echo '<option selected value =' . $teacher['ID'] . '>' . $teacher['FirstName'] . " " . $teacher['LastName'] . '</option>';
                                                    else echo '<option value =' . $teacher['ID'] . '>' . $teacher['FirstName'] . " " . $teacher['LastName'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row text-center has-success" style="font-size: 50%;">
                                    <div class="col-md-4 has-success">
                                        <input value="r" onclick="document.getElementById('edit_course_photo').disabled = true;" type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Удалить прошлую картинку</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="s" checked onclick="document.getElementById('edit_course_photo').disabled = true;" type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Не изменять картинку</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="c" onclick="document.getElementById('edit_course_photo').disabled = false;" type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio3">Заменить</label>
                                    </div>
                                </div>
                                <div class="form-group has-warning">
                                    <label for="inputDate" class="col-sm-2 control-label">Фото</label>
                                    <div class="col-sm-10 text-center">
                                        <input type="file" disabled class="form-control input-xs text-center" style="border: 0px gray solid;" id="edit_course_photo" name="edit_course_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn btn-warning" value="Редактировать" name="edit_course_submit"/> 
                                    </div>
                                </div>
                        </form>
                    </div>
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

        <?php
        // 	print_r($_POST);
        //     echo "<br/><br/>";
        //     print_r($_FILES);
            if (isset($_POST['edit_course_submit'])) {
            	$title = htmlentities($_POST['edit_course_title']);
            	$description = htmlentities($_POST['edit_course_description']);
            	$teacher = htmlentities($_POST['people']);
            	$switch = htmlentities($_POST['customRadio']);
            	$id = $_SESSION['Course']['id'];
            	$image = NULL;
            	if($switch == 'r'){ //удалить прошлую картинку
                    $path = "../courses_pic/";
                    $temporary = mysqli_query($connection,"SELECT * FROM Course WHERE ID = '$id';");
                    $temporary = mysqli_fetch_assoc($temporary);
                    if($temporary['Image']!=NULL) unlink($path . $temporary['Image']);
                    $temporary = mysqli_query($connection,"UPDATE Course SET Title = '$title', Description = '$description', Teacher = '$teacher', Image = 'Отсутствует'  WHERE ID = '$id';");
                    if($temporary) {
                        unset($_SESSION['Course']);
                        $_SESSION['Status'] = 9;
                        header("Location: admin_main.php");
                    }
                    else {
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Что-то пошло не так!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                              </script>';
                    }
                } else if($switch == 's'){ //не изменять картинку
                    $temporary = mysqli_query($connection,"SELECT * FROM Course WHERE ID = '$id';");
                    $temporary = mysqli_fetch_assoc($temporary);
                    $image = $temporary['Image'];
                    $temporary = mysqli_query($connection,"UPDATE Course SET Title = '$title', Description = '$description', Teacher = '$teacher', Image = '$image'  Where ID = '$id';");
                    if($temporary) {
                        unset($_SESSION['Course']);
                        $_SESSION['Status'] = 9;
                        header("Location: admin_main.php");
                    }
                    else {
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Что-то пошло не так!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                              </script>';
                    }
                } else if($switch == 'c'){ //заменить картинку
                    if(isset($_FILES['edit_course_photo'])){
                        $path = "../courses_pic/";
                        $name = $title;
                        $maxSize = 1048576; //максимальный размер - 10 мб
                        $currentSize = $_FILES['edit_course_photo']['size'];
	                    $tmp = $_FILES['edit_course_photo']['tmp_name'];
	                    $array = explode('.', $_FILES['edit_course_photo']['name']);
	                    $extension = end($array);
                        if($currentSize < $maxSize){
                            $temporary = mysqli_query($connection,"SELECT * FROM Course WHERE ID = '$id';");
                            $temporary = mysqli_fetch_assoc($temporary);
                            unlink($path . $temporary['Image']);
                            if(copy($tmp, $path . $name . "." . $extension)){
                                $name = $name . "." . $extension;
                                $temporary = mysqli_query($connection,"UPDATE Course SET Title = '$title', Description = '$description', Teacher = '$teacher', Image = '$name'  Where ID = '$id';");
                                if($temporary) {
                                    unset($_SESSION['Course']);
                                    $_SESSION['Status'] = 9;
                                    header("Location: admin_main.php");
                                }
                                else {
                                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                messageBox.innerHTML = "Что-то пошло не так!";
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
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Загрузите изображение!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                              </script>';
                    }
                }
            }


        ?>

    </body>
</html>