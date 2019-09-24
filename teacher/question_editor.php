<?php
    require_once "../db.php";
    if ($_SESSION['teacher']['type']!=2) {
        header("Location: index.php");
    }
    ob_start();
    if(!isset($_SESSION['Question'])) header("Location: lections.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Question editor</title>
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
                        Редактировать вопрос
                        <form method="POST" action="question_editor.php" style="margin: 1%;" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Текст:</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $_SESSION['Question']['text']; ?>" required type="text" class="form-control input-xs" id="add_question_title" placeholder="Введите текст" name="add_question_title" >
                                </div>
                            </div>
                            <div class="form-group row text-center has-warning" style="font-size: 50%;">
                                <div class="col-md-4 has-warning">
                                    <input value="r" checked onclick="document.getElementById('add_question_photo').disabled = true;" type="radio" id="customRadio1" name="questionSwitch" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Не изменять</label>
                                </div>
                                <div class="col-md-4 has-warning">
                                    <input value="g" onclick="document.getElementById('add_question_photo').disabled = false;" type="radio" id="customRadio2" name="questionSwitch" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Изменить</label>
                                </div>
                                <div class="col-md-4 has-warning">
                                    <input value="s" onclick="document.getElementById('add_question_photo').disabled = true;" type="radio" id="customRadio3" name="questionSwitch" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Удалить</label>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="inputDate" class="col-sm-2 control-label">Фото:</label>
                                <div class="col-sm-10 text-center">
                                    <input type="file" disabled class="form-control input-xs text-center" style="border: 0px gray solid;" id="add_question_photo" name="add_question_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <input type="submit" class="btn btn-warning" value="Изменить" name="add_question_submit"/> 
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
            if(isset($_POST['add_question_submit'])){
                $title = htmlentities($_POST['add_question_title']);
                $switch = htmlentities($_POST['questionSwitch']);
                $image = NULL;
                $id = $_SESSION['Question']['id'];
                if($switch == 'r'){ // не изменять
                    $update = mysqli_query($connection,"Update Question Set Text = '$title' Where ID = '$id';");
                    if($update){
                        unset($_SESSION['Question']);
                        $_SESSION['StatusLection'] = 2;
                        header("Location: lections.php");
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Вопрос не обновлён! Попробуйте ещё раз!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                </script>';
                    }
                }
                else if($switch == 'g'){ // изменить
                    if(isset($_FILES['add_question_photo'])){
                        $path = "../tests_pic/";
                        $name_1 = $_SESSION['Question']['image'];
                        $maxSize = 1048576; //максимальный размер - 10 мб
                        $currentSize = $_FILES['add_question_photo']['size'];
                        $tmp = $_FILES['add_question_photo']['tmp_name'];
                        $image = str_replace(':','',$title);
                        if($currentSize < $maxSize){
                            if($name_1 != NULL && $name_1 != ''){
                                unlink($path . $name_1);
                            }
                            if(copy($tmp,$path . $image . ".png")){
                                $image = $image . ".png";
                                $update = mysqli_query($connection,"Update Question Set Text = '$title', Image = '$image' Where ID = '$id';");
                                if($update){
                                    echo "q";
                                    unset($_SESSION['Question']);
                                    $_SESSION['StatusLection'] = 2;
                                    header("Location: lections.php");
                                }
                                else{
                                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                    messageBox.innerHTML = "Вопрос не обновлён!";
                                                    var a = document.getElementById("myModal");
                                                    a.style.display = "block";
                                            </script>';
                                }
                            }
                            else{
                                echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                                    messageBox.innerHTML = "Картинка не загружена!";
                                                    var a = document.getElementById("myModal");
                                                    a.style.display = "block";
                                            </script>';
                            }
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
                else if($switch == 's'){ // удалить
                    $path = "../tests_pic/";
                    $deleteImg = mysqli_query($connection,"Select * From Question Where ID = '$id';");
                    $deleteImg = mysqli_fetch_assoc($deleteImg);
                    $delete = $deleteImg['Image'];
                    if($delete != NULL && $delete != ''){
                        unlink($path . $delete);
                    }
                    $temp = NULL;
                    $update = mysqli_query($connection,"Update Question Set Text = '$title', Image = '$temp' Where ID = '$id';");
                    if($update){
                        unset($_SESSION['Question']);
                        $_SESSION['StatusLection'] = 2;
                        header("Location: lections.php");
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Вопрос не обновлён! Попробуйте ещё раз!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                </script>';
                    }
                }
            }
        ?>
    </body>
</html>