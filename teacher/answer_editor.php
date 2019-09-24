<?php
    require_once "../db.php";
    if ($_SESSION['teacher']['type']!=2) {
        header("Location: index.php");
    }
    ob_start();
    if(!isset($_SESSION['Answer'])) header("Location: lections.php");
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
                    <div class="text-center" style="font-size: 150%;">
                        Редактировать ответ
                        <form method="POST" action="answer_editor.php" style="margin: 1%;" class="form-horizontal">
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Текст:</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $_SESSION['Answer']['text']; ?>" required type="text" class="form-control input-xs" id="add_answer_title" placeholder="Введите текст" name="add_answer_title" >
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Верный ?</label>
                                <div class="col-sm-10 radio">
                                    <select class="form-control input-xs" name="isTrue" required>
                                        <?php
                                            if($_SESSION['Answer']['isTrue'] == 1) echo "<option selected value ='1'>Да</option> <option value ='0'>Нет</option>";
                                            else echo "<option value ='1'>Да</option> <option selected value ='0'>Нет</option>";
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
                $id = $_SESSION['Answer']['id'];
                $title = htmlentities($_POST['add_answer_title']);
                $isTrue = htmlentities($_POST['isTrue']);
                $update = mysqli_query($connection,"Update Answers Set Text = '$title', IsTrue = '$isTrue' Where ID = '$id';");
                if($update){
                    unset($_SESSION['Answer']);
                    $_SESSION['StatusLection'] = 3;
                    header("Location: lections.php");
                }
                else{
                    echo '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Ответ не обновлён! Попробуйте ещё раз!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                </script>';
                }
            }
        ?>
    </body>

</html>