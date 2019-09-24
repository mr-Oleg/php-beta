<?php
    require_once "../db.php";
    if(!isset($_SESSION['Fines'])) header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fines editor</title>
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
                        Изменить штраф
                        <form method="POST" action="fines_editor.php" class="form-horizontal" style="margin: 1%;">
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">КоАП</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $_SESSION['Fines']['cao']; ?>" required type="text" class="form-control input-xs" id="edit_fines_cao" placeholder="Введите статью" name="edit_fines_cao" >
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Нарушение</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control input-xs" id="edit_fines_offense" placeholder="Введите описание" name="edit_fines_offense" style="min-width: 100%;max-width: 100%;" required><?php echo $_SESSION['Fines']['offense']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Санкции</label>
                                    <div class="col-sm-10">
                                        <input value="<?php echo $_SESSION['Fines']['sanctions']; ?>" required type="text" class="form-control input-xs" id="edit_fines_sanctions" placeholder="Введите описание" name="edit_fines_sanctions">
                                    </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Тип</label>
                                <div class="col-sm-10">
                                    <select class="form-control input-xs" name="typeoffines" required>
                                        <?php 
                                            $typeoffines = mysqli_query($connection,"Select * From TypeOfFines Order by ID;");
                                            while($type = mysqli_fetch_assoc($typeoffines)){
                                                if($type['ID']==$_SESSION['Fines']['type']) echo '<option selected value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                                else echo '<option value =' . $type['ID'] . '>' . $type['Title'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <input type="submit" class="btn btn-warning" value="Изменить" name="edit_fines_submit"/> 
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
            if(isset($_POST['edit_fines_submit'])){
                $cao = htmlentities($_POST['edit_fines_cao']);
                $offense = htmlentities($_POST['edit_fines_offense']);
                $sanctions = htmlentities($_POST['edit_fines_sanctions']);
                $type = htmlentities($_POST['typeoffines']);
                $id = $_SESSION['Fines']['id'];
                $temporary = mysqli_query($connection,"Update Fines Set CAO = '$cao', Offense = '$offense', Sanctions = '$sanctions', TypeOfFines = '$type' Where ID = '$id'; ");
                if($temporary) {
                    unset($_SESSION['Fines']);
                    $_SESSION['Status'] = 4;
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
        ?>

    </body>
</html>