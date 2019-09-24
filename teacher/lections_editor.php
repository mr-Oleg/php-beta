<?php
    require_once "../db.php";
    if ($_SESSION['teacher']['type']!=2) {
        header("Location: index.php");
    }
    ob_start();
    if(!isset($_SESSION['Lection'])) header("Location: lections.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lection editor</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>

<?php
    require_once("header.php");
?>


	<body>
		<div class="container">
			<div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" style="margin-top: 10%; border: 1px solid gray; border-radius:10px;">
                    <div class="text-center" style="font-size: 150%; ">
                        Редактировать лекцию
                        <form method="POST" action="lections_editor.php" style="margin: 1%;" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Заголовок:</label>
                                <div class="col-sm-10">
                                    <input required type="text" class="form-control input-xs" id="edit_add_lections_title" placeholder="Введите текст" name="edit_add_lections_title" value="<?php echo $_SESSION['Lection']['name']; ?>">
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Описание:</label>
                                <div class="col-sm-10">
                                    <textarea required class="form-control input-xs" id="edit_add_lections_description" placeholder="Введите описание" name="edit_add_lections_description" style="min-width: 100%;max-width: 100%;"><?php echo $_SESSION['Lection']['description']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Тело:</label>
                                <div class="col-sm-10">
                                    <textarea required class="form-control input-xs" id="edit_add_lections_body" placeholder="Введите описание" name="edit_add_lections_body" style="min-width: 100%;max-width: 100%;"><?php echo $_SESSION['Lection']['text']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row text-center has-warning" style="font-size: 50%;">
                                <div class="col-md-4 has-warning">
                                    <input value="r" checked onclick="document.getElementById('edit_add_lections_photo').disabled = true;" type="radio" id="customRadio1" name="edit_lectionSwitch" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Удалить картинку</label>
                                </div>
                                <div class="col-md-4 has-warning">
                                    <input value="c" onclick="document.getElementById('edit_add_lections_photo').disabled = false;" type="radio" id="customRadio2" name="edit_lectionSwitch" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Изменить картинкой</label>
                                </div>
                                <div class="col-md-4 has-warning">
                                    <input value="s" onclick="document.getElementById('edit_add_lections_photo').disabled = true;" type="radio" id="customRadio3" name="edit_lectionSwitch" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Не изменять картинку</label>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="inputDate" class="col-sm-2 control-label">Фото:</label>
                                <div class="col-sm-10 text-center">
                                    <input type="file" disabled class="form-control input-xs text-center" style="border: 0px gray solid;" id="edit_add_lections_photo" name="edit_add_lections_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Курс:</label>
                                <div class="col-sm-10">
                                    <select class="form-control input-xs" name="edit_course" required>
                                        <?php 
                                            $login = $_SESSION['teacher']['login'];
                                            $getID = mysqli_query($connection,"Select * From Users Where Login ='$login';");
                                            $id = mysqli_fetch_assoc($getID);
                                            $id = $id['ID'];
                                            $courses = mysqli_query($connection,"Select * From Course Where Teacher = '$id' Order by ID;");
                                            while($type = mysqli_fetch_assoc($courses)){
                                                if($type['ID'] == $_SESSION['Lection']['course']) echo "<option selected value ='" . $type['ID'] . "'>" . $type['Title'] . "</option>";
                                                else echo "<option value ='" . $type['ID'] . "'>" . $type['Title'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <input type="submit" class="btn btn-warning" value="Изменить" name="edit_add_lections_submit"/> 
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
            if(isset($_POST['edit_add_lections_submit'])){
                $name = htmlentities($_POST['edit_add_lections_title']);
                $description = htmlentities($_POST['edit_add_lections_description']);
                $body = htmlentities($_POST['edit_add_lections_body']);
                $switch = htmlentities($_POST['edit_lectionSwitch']);
                $course = htmlentities($_POST['edit_course']);
                $id = $_SESSION['Lection']['id'];
                $image = NULL;
                if($switch == 'r'){// удалить картинку
                    $temporary = mysqli_query($connection,"Select * From Lections Where ID = '$id';");
                    $temporary = mysqli_fetch_assoc($temporary);
                    $path = "../lections_pic/";
                    $oldImage = $temporary['Image'];
                    unlink($path . $oldImage);
                    $update = mysqli_query($connection,"Update Lections Set Name = '$name', Text = '$body', Image = '$image', CourseID = '$course', Description = '$description' Where ID = '$id';");
                    if($update){
                        unset($_SESSION['Lection']);
                        $_SESSION['StatusLection'] = 1;
                        header("Location: lections.php");
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Лекция не обновлена! Попробуйте ещё раз!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                </script>';
                    }
                }
                else if($switch == 'c'){// изменить картинку
                    if(isset($_FILES['edit_add_lections_photo'])){
                        $path = "../lections_pic/";
                        $name_1 = $_SESSION['Lection']['name'] . ".png";
                        $maxSize = 1048576; //максимальный размер - 10 мб
                        $currentSize = $_FILES['edit_add_lections_photo']['size'];
                        $tmp = $_FILES['edit_add_lections_photo']['tmp_name'];
                        $image = str_replace(':','',$name);
                        if($currentSize < $maxSize){
                            unlink($path . $name_1);
                            if(@copy($tmp,$path . $name . ".png")){
                                $image = $image . ".png";
                                $update = mysqli_query($connection,"Update Lections Set Name = '$name', Text = '$body', Image = '$image', CourseID = '$course', Description = '$description' Where ID = '$id';");
                                if($update){
                                    unset($_SESSION['Lection']);
                                    $_SESSION['StatusLection'] = 1;
                                    header("Location: lections.php");
                                }
                                else{
                                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                            messageBox.innerHTML = "Лекция не обновлена! Попробуйте ещё раз!";
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
                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
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
                else if($switch == 's'){// не изменять картинку
                    $update = mysqli_query($connection,"Update Lections Set Name = '$name', Text = '$body', CourseID = '$course', Description = '$description' Where ID = '$id';");
                    if($update){
                        unset($_SESSION['Lection']);
                        $_SESSION['StatusLection'] = 1;
                        header("Location: lections.php");
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Лекция не обновлена! Попробуйте ещё раз!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                </script>';
                    }
                }
            }   
        ?>
    </body>
</html>