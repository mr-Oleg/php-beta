<?php
    require_once "../db.php";
    ob_start();
    if(!isset($_SESSION['Answer'])) header("Location: admin_main.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Answer editor</title>
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
                        Редактирование ответа
                        <form method="POST" action="answer_editor.php" class="form-horizontal" style="margin: 1%;" >
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-3 control-label">Номер билета:</label>
                                <div class="col-sm-9">
                                    <select class="form-control input-xs" name="tickets_1" required>
                                        <?php 
                                            $tickets = mysqli_query($connection,"Select * From Tickets Order by ID;");
                                            while($type = mysqli_fetch_assoc($tickets)){
                                                if($type['ID'] == $_SESSION['Answer']['id']) echo '<option selected value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                                else echo '<option value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-3 control-label">Номер вопроса:</label>
                                <div class="col-sm-9">
                                    <select class="form-control input-xs" name="typeofquestion_1" required>
                                        <?php 
                                            $typeOfQuestion = mysqli_query($connection,"Select * From TypeOfQuestion Order by ID;");
                                            while($type = mysqli_fetch_assoc($typeOfQuestion)){
                                                if($type['ID'] == $_SESSION['Answer']['questionID']) echo '<option selected value =' . $type['ID'] . '>' . $type['ID'] . '</option>';
                                                else echo '<option value =' . $type['ID'] . '>' . $type['ID'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-3 control-label">Формулировка:</label>
                                <div class="col-sm-9">
                                    <input required type="text" class="form-control input-xs" id="add_ticket_answer" placeholder="Введите данные" name="add_ticket_answer" value="<?php echo $_SESSION['Answer']['text']; ?>" >
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-3 control-label">Правильный ?</label>
                                <div class="col-sm-9 radio">
                                    <select class="form-control input-xs" name="isTrue" required>
                                        <?php
                                            if(1 == $_SESSION['Answer']['isTrue']) echo '<option selected value ="1">Да</option> <option value ="0">Нет</option>';
                                            else echo '<option value ="1">Да</option> <option selected value ="0">Нет</option>';
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <input type="submit" class="btn btn-warning" value="Изменить" name="add_answer_submit"/> 
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
            if(isset($_POST['add_answer_submit'])){
                $ticketNumber = htmlentities($_POST['tickets_1']);
                $questionNumber = htmlentities($_POST['typeofquestion_1']);
                $isTrue = $_POST['isTrue'];
                $text = htmlentities($_POST['add_ticket_answer']);
                $questionSearch = mysqli_query($connection,"Select * From Question Where Ticket = '$ticketNumber' AND TypeOfQuestion = '$questionNumber';");
                if(mysqli_num_rows($questionSearch)==0){
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Вопрос не найден, не удаётся редактировать ответ!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                        </script>';
                }
                else{
                    $questionID = mysqli_fetch_assoc($questionSearch);
                    $questionID = $questionID['ID'];
                    $count = mysqli_query($connection,"Select * From Answers Where QuestionID = '$questionID';");
                    if(mysqli_num_rows($count) <= 4){
                        $id = $_SESSION['Answer']['id'];
                        $temporary = mysqli_query($connection,"Update Answers Set Text = '$text',IsTrue = '$isTrue',QuestionID = '$questionID' Where ID = '$id';");
                        if($temporary){
                            unset($_SESSION['Answer']);
                            $_SESSION['Status'] = 11;
                            header("Location: admin_main.php");
                        }
                        else{
                            echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Что-то пошло не так! Редактирование ответа не произошло!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                        }
                    }
                    else{
                        echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "На этот вопрос уже есть допустимые 4 ответа! Редактирование не произошло!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                    }
                }
            }
        ?>
    </body>
</html>