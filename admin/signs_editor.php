<?php
    require_once "../db.php";
    ob_start();
    if(!isset($_SESSION['Sign'])) header("Location: admin_main.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign editor</title>
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
                    	Редактирование знака
                        <form method="POST" action="signs_editor.php" style="margin: 1%;" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Название</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="edit_sign_title" placeholder="Введите текст" name="edit_sign_title" value="<?php echo $_SESSION['Sign']['title']; ?>" >
                                        </div>
                                </div>
                                <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Описание</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control input-xs" id="edit_sign_description" placeholder="Введите текст" name="edit_sign_description" style="min-width: 100%;max-width: 100%;"><?php echo $_SESSION['Sign']['description']; ?></textarea>
                                        </div>
                                </div>
                                <div class="form-group has-warning">
                                        <label for="pass" class="col-sm-2 control-label">Номер</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control input-xs" id="edit_sign_number" placeholder="Введите текст" name="edit_sign_number" value="<?php echo $_SESSION['Sign']['number']; ?>" >
                                        </div>
                                </div>
                                <div class="form-group has-warning">
                                    <label for="inputDate" class="col-sm-2 control-label">Тип</label>
                                    <div class="col-sm-10">
                                        <select class="form-control input-xs" name="typeofsigns" required>
                                            <?php
                                                $typeofsigns = mysqli_query($connection,"Select * From TypeOfSign Order by ID;");
                                                while($result = mysqli_fetch_assoc($typeofsigns)){
                                                    if($result['ID']==$_SESSION['Sign']['type']) echo "<option selected value ='" . $result['ID'] . "'>" . $result['Title'] .  "</option>";
                                                    else echo "<option value ='" . $result['ID'] . "'>" . $result['Title'] .  "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row text-center has-success" style="font-size: 50%;">
                                    <!-- <div class="col-md-4 has-success">
                                        <input value="r" onclick="document.getElementById('edit_course_photo').disabled = true;" type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Удалить прошлую картинку</label>
                                    </div> -->
                                    <div class="col-md-6">
                                        <input value="s" checked onclick="document.getElementById('edit_sign_photo').disabled = true;" type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Не изменять картинку</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input value="c" onclick="document.getElementById('edit_sign_photo').disabled = false;" type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio3">Заменить</label>
                                    </div>
                                </div>
                                <div class="form-group has-warning">
                                    <label for="inputDate" class="col-sm-2 control-label">Фото</label>
                                    <div class="col-sm-10 text-center">
                                        <input type="file" disabled class="form-control input-xs text-center" style="border: 0px gray solid;" id="edit_sign_photo" name="edit_sign_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn btn-warning" value="Редактировать" name="edit_sign_submit"/> 
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
            if (isset($_POST['edit_sign_submit'])) {
            	$title = htmlentities($_POST['edit_sign_title']);
                $description = htmlentities($_POST['edit_sign_description']);
                $number = htmlentities($_POST['edit_sign_number']);
            	$typeofsigns = htmlentities($_POST['typeofsigns']);
            	$switch = htmlentities($_POST['customRadio']);
            	$id = $_SESSION['Sign']['id'];
            	$image = NULL;
            	if($switch == 's'){ //не изменять картинку
                    $temporary = mysqli_query($connection,"UPDATE signs SET Title = '$title', Description = '$description', Number = '$number', TypeOfSign = '$typeofsigns'  Where ID = '$id';");
                    if($temporary) {
                        unset($_SESSION['Sign']);
                        $_SESSION['Status'] = 5;
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
                    if(isset($_FILES['edit_sign_photo'])){
                        $path = "../signs_pic/";
                        $name = $number;
                        $maxSize = 1048576; //максимальный размер - 10 мб
                        $currentSize = $_FILES['edit_sign_photo']['size'];
	                    $tmp = $_FILES['edit_sign_photo']['tmp_name'];
	                    // $array = explode('.', $_FILES['edit_sign_photo']['name']);
	                    // $extension = end($array);
                        if($currentSize < $maxSize){
                            // $temporary = mysqli_query($connection,"SELECT * FROM signs WHERE ID = '$id';");
                            // $temporary = mysqli_fetch_assoc($temporary);
                            unlink($path . $number . ".png");
                            if(copy($tmp, $path . $name . "." . "png")){
                                $temporary = mysqli_query($connection,"UPDATE signs SET Title = '$title', Description = '$description', Number = '$number', TypeOfSign = '$typeofsigns'  Where ID = '$id';");
                                if($temporary) {
                                    unset($_SESSION['Sign']);
                                    $_SESSION['Status'] = 5;
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