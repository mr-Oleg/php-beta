<?php
    require_once "../db.php";
    ob_start();
    if(!isset($_SESSION['Question'])) header("Location: admin_main.php");
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
    <body>
        <div class="container">
            <div class="row" >
                <div class="col-md-2"></div>
                <div class="col-md-8" style="margin-top: 10%; border: 1px solid gray; border-radius:10px;">
                    <div class="text-center" style="font-size: 150%;">
                        Редактирование вопроса
                        <form method="POST" action="question_editor.php" class="form-horizontal" style="margin: 1%;" enctype="multipart/form-data">
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-3 control-label">Формулировка:</label>
                                <div class="col-sm-9">
                                    <input required type="text" class="form-control input-xs" id="add_ticket_question" placeholder="Введите данные" name="add_ticket_question" value="<?php echo $_SESSION['Question']['text']; ?>">
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-3 control-label">Номер билета:</label>
                                <div class="col-sm-9">
                                    <select class="form-control input-xs" name="tickets" required>
                                        <?php 
                                            $tickets = mysqli_query($connection,"Select * From Tickets Order by ID;");
                                            while($type = mysqli_fetch_assoc($tickets)){
                                                if($type['ID']==$_SESSION['Question']['ticket']) echo "<option selected value ='" . $type['ID'] . "'>" . $type['Title'] . "</option>";
                                                else echo "<option value ='" . $type['ID'] . "'>" . $type['Title'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-3 control-label">Номер вопроса:</label>
                                <div class="col-sm-9">
                                    <select class="form-control input-xs" name="typeofquestion" required>
                                        <?php 
                                            $typeOfQuestion = mysqli_query($connection,"Select * From TypeOfQuestion Order by ID;");
                                            while($type = mysqli_fetch_assoc($typeOfQuestion)){
                                                if($type['ID'] == $_SESSION['Question']['type']) echo "<option selected value ='" . $type['ID'] . "'>" . $type['ID'] . "</option>";
                                                else echo "<option value ='" . $type['ID'] . "'>" . $type['ID'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row text-center has-warning" style="font-size: 50%;">
                                <div class="col-md-4 has-warning">
                                    <input value="r" onclick="document.getElementById('add_ticket_photo').disabled = true;" type="radio" id="customRadio1" name="ticketQuestion" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Удалить прошлую картинку</label>
                                </div>
                                <div class="col-md-4">
                                    <input value="s" checked onclick="document.getElementById('add_ticket_photo').disabled = true;" type="radio" id="customRadio2" name="ticketQuestion" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Не изменять картинку</label>
                                </div>
                                <div class="col-md-4">
                                    <input value="c" onclick="document.getElementById('add_ticket_photo').disabled = false;" type="radio" id="customRadio3" name="ticketQuestion" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Заменить</label>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="inputDate" class="col-sm-2 control-label">Фото:</label>
                                <div class="col-sm-10 text-center">
                                    <input type="file" disabled class="form-control input-xs text-center" style="border: 0px gray solid;" id="add_ticket_photo" name="add_ticket_photo" accept="image/png,image/jpeg,image/bmp,image/gif">
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
                $question = htmlentities($_POST['add_ticket_question']);
                $ticketNumber = htmlentities($_POST['tickets']);
                $questionNumber = htmlentities($_POST['typeofquestion']);
                $check = mysqli_query($connection,"Select * From Question Where Ticket = '$ticketNumber' AND TypeOfQuestion = '$questionNumber';");
                if(mysqli_num_rows($check)<=1){
                    $image = NULL;
                    $name = mysqli_fetch_assoc($check);
                    $name_1 = $name['Image'];
                    $switch = htmlentities($_POST['ticketQuestion']);
                    if($switch == 'r'){ //удалить прошлую картинку
                        $path = "../tests_pic/";
                        unlink($path . $name_1 . ".png");
                        $id = $_SESSION['Question']['id'];
                        $query = mysqli_query($connection,"Update Question Set Text = '$question',Image = '$image',Ticket = '$ticketNumber',TypeOfQuestion = '$questionNumber' Where ID ='$id';");
                        if($query){
                            unset($_SESSION['Question']);
                            $_SESSION['Status'] = 10;
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
                    else if($switch == 's'){ //не изменять картинку
                        $id = $_SESSION['Question']['id'];
                        $query = mysqli_query($connection,"Update Question Set Text = '$question',Ticket = '$ticketNumber',TypeOfQuestion = '$questionNumber' Where ID ='$id';");
                        if($query){
                            unset($_SESSION['Question']);
                            $_SESSION['Status'] = 10;
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
                    else if($switch == 'c'){ //заменить картинку
                        if(isset($_FILES['add_ticket_photo'])){
                            $path = "../tests_pic/";
                            unlink($path . $name_1 . ".png");
                            $id = $_SESSION['Question']['id'];
                            $name = $ticketNumber . "." . $questionNumber;
                            $maxSize = 1048576; //максимальный размер - 10 мб
                            $currentSize = $_FILES['add_ticket_photo']['size'];
                            $tmp = $_FILES['add_ticket_photo']['tmp_name'];
                            if($currentSize < $maxSize){
                                if(@copy($tmp,$path . $name . ".png")){
                                    $image = $name;
                                    $temporary = mysqli_query($connection,"Update Question Set Text = '$question',Image = '$name', Ticket = '$ticketNumber',TypeOfQuestion = '$questionNumber' Where ID ='$id';");
                                    if($temporary) {
                                        unset($_SESSION['Question']);
                                        $_SESSION['Status'] = 10;
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
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Такой вопрос уже есть! Редактирование не произошло!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                        </script>';
                }
            }
        ?>
    </body>
</html>