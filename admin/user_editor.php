<?php
    require_once "../db.php";
    if(!isset($_SESSION['User'])) header("Location: admin_main.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User editor</title>
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
                        Изменить пользователя
                        <form method="POST" action="user_editor.php" class="form-horizontal" style="margin: 1%;">
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Логин</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $_SESSION['User']['login']; ?>" required type="text" class="form-control input-xs" id="edit_users_login" placeholder="Введите логин" name="edit_users_login" >
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Пароль</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $_SESSION['User']['password']; ?>" required type="text" class="form-control input-xs" id="edit_users_password" placeholder="Введите пароль" name="edit_users_password" >
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Имя</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $_SESSION['User']['fname']; ?>" required type="text" class="form-control input-xs" id="edit_users_fname" placeholder="Введите имя" name="edit_users_fname" >
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Фамилия</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $_SESSION['User']['lname']; ?>" required type="text" class="form-control input-xs" id="edit_users_sname" placeholder="Введите фамилию" name="edit_users_sname" >
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Почта</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $_SESSION['User']['email']; ?>" required type="text" class="form-control input-xs" id="edit_users_email" placeholder="Введите почту" name="edit_users_email" >
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="pass" class="col-sm-2 control-label">Админ</label>
                                <div class="col-sm-10 radio">
                                    <select class="form-control input-xs" name="admin" required>
                                        <?php
                                            if(1 == $_SESSION['User']['status']) echo '<option selected value ="1">Да</option> <option value ="0">Нет</option>';
                                            else echo '<option value ="1">Да</option> <option selected value ="0">Нет</option>';
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <input type="submit" class="btn btn-warning" value="Изменить" name="edit_users_submit"/> 
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
            if(isset($_POST['edit_users_submit'])){
                $login = htmlentities($_POST['edit_users_login']);
                $password = htmlentities($_POST['edit_users_password']);
                $fname = htmlentities($_POST['edit_users_fname']);
                $lname = htmlentities($_POST['edit_users_sname']);
                $email = htmlentities($_POST['edit_users_email']);
                $status = htmlentities($_POST['admin']);
                $id = $_SESSION['User']['id'];
                $check = mysqli_query($connection,"Select * From Users Where Login = '$login';");
                $check = mysqli_fetch_assoc($check);
                $check = $check['ID'];
                if($check == NULL){
                    $temporary = mysqli_query($connection,"Update Users Set Login = '$login', Password = '$password', FirstName = '$fname', LastName = '$lname', Status = '$status', Email = '$email' Where ID = '$id';");
                    if($temporary){
                        unset($_SESSION['User']);
                        $_SESSION['Status'] = 7;
                        header("Location: admin_main.php");
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
                                messageBox.innerHTML = "Пользователь с таким логином существует!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                          </script>';
                }
            }
        ?>

    </body>
</html>