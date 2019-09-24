<?php
    ob_start();
    require_once "../db.php";
    unset($_SESSION['login']);
	unset($_SESSION['password']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    unset($_SESSION['email']);
    if(isset($_SESSION['teacher'])){
        if($_SESSION['teacher']['type']==3) header("Location: completion.php");
        else header("Location: teacher_main.php");
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
    </head>
    <body >
        <?php
            require_once "header.php";
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <p class="col-md-8 text-center" style="font-size: 200%; color:black; margin-top:2%;">Вход в панель преподавателя</p>
                <div class="col-md-2"></div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="border: 1px gray solid; border-radius: 15px;">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="active"><a href="#home" role="tab" data-toggle="pill">Авторизация</a></li>
                        <li><a href="#profile" role="tab" data-toggle="pill">Регистрация</a></li>
                    </ul>
		            <div class="tab-content" >
			            <div role="tabpanel" class="tab-pane active" id="home" style="margin:2%;">
				            <form method="POST" action="index.php" class="form-horizontal">
                                <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Логин</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-xs" id="pass" placeholder="Введите логин" name="login_auth">
                                        </div>
                                </div>
                                <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Пароль</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control input-xs" id="pass" placeholder="Введите пароль" name="pass_auth">
                                        </div>
                                </div>
					            <div class="col-sm-10"></div>
					            <input type="submit" class="btn btn-success" name="submit_auth" value="Войти"/> 
				            </form>
			            </div>
			            <div role="tabpanel" class="tab-pane " id="profile" style="margin:2%;">
                            <form method="POST" action="index.php" class="form-horizontal">
                                <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Логин*</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-xs" id="pass" placeholder="Введите логин" name="login_sup">
                                        </div>
                                </div>
                                <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Пароль*</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control input-xs" id="pass" placeholder="Введите пароль" name="pass_sup">
                                        </div>
                                </div>
                                <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Имя*</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-xs" id="pass" placeholder="Введите имя" name="fname_sup">
                                        </div>
                                </div>
                                <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Фамилия*</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-xs" id="pass" placeholder="Введите фамилию" name="sname_sup">
                                        </div>
                                </div>
                                <div class="form-group has-success">
                                        <label for="pass" class="col-sm-2 control-label">Email*</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-xs" id="pass" placeholder="Введите почту" name="email_sup">
                                        </div>
                                </div>
                                <div class="col-sm-8">* - Обязательно для заполнения</div>
                                <input type="submit" class="btn btn-success" value="Присоединиться" name="submit_sup" data-toggle="modal" data-target="#myModal"/> 
                            </form>
			            </div>
		            </div>
                </div>
                <div class="col-md-4"></div>
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
            if(isset($_POST['submit_sup'])){
                if(isset($_POST['login_sup'])){
                    $login = htmlentities($_POST['login_sup']);
                    $result = mysqli_query($connection,"Select * From Users Where Login='$login';");
                    if($result){
                        $res = mysqli_fetch_assoc($result);
                        if($res['Login']!= $login){
                            //echo "Такого имени нет!";
                            if(isset($_POST['pass_sup'])&&isset($_POST['fname_sup'])&&isset($_POST['sname_sup'])&&isset($_POST['email_sup'])){
                                $password = htmlentities($_POST['pass_sup']);
                                $fname = htmlentities($_POST['fname_sup']);
                                $sname = htmlentities($_POST['sname_sup']);
                                $email = htmlentities($_POST['email_sup']);
                                $status = 0;
                                $type = 3;
                                $temporary = mysqli_query($connection,"Insert Into Users (Login,Password,FirstName,LastName,Status,Email,Type) Values ('$login','$password','$fname','$sname','$status','$email','$type');");
                                if($temporary){
                                    $data = [
                                        "login" => $login,
                                        "pass" => $password,
                                        "fname" => $fname,
                                        "sname" => $sname,
                                        "email" => $email,
                                        "type" => 3
                                    ];
                                    $_SESSION['teacher'] = $data;
                                    header("Location: completion.php"); 
                                }
                            }
                        }else{
                            echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "Пользователь с таким логином уже существует!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                    </script>';
                        }
                    }
                    else{
                        echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Ошибка сервера :( Попробуйте позже!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                    }
                }
            }
            else if(isset($_POST['submit_auth'])){
                $login = htmlentities($_POST['login_auth']);
                $password = htmlentities($_POST['pass_auth']);
                $check = mysqli_query($connection,"Select * From Users Where Login='$login';");
                if($check){
                    $check = mysqli_fetch_assoc($check);
                    $checkLogin = $check['Login'];
                    $checkPass = $check['Password'];
                    $fname = $check['FirstName'];
                    $sname = $check['LastName'];
                    $email = $check['Email'];
                    $type = $check['Type'];
                    if($checkLogin == $login && $checkPass == $password){
                        $data = [
                            "login" => $login,
                            "pass" => $password,
                            "fname" => $fname,
                            "sname" => $sname,
                            "email" => $email,
                            "type" => $type
                        ];
                        if($type == 3){
                            $_SESSION['teacher'] = $data;
                            header("Location: completion.php"); 
                        } 
                        else if($type == 2){
                            $_SESSION['teacher'] = $data;
                            header("Location: teacher_main.php");
                        }
                        else {
                            echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                        messageBox.innerHTML = "У вас нет прав на просмотр этого раздела!";
                                        var a = document.getElementById("myModal");
                                        a.style.display = "block";
                                    </script>';
                        }
                    }
                    else{
                        echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                    messageBox.innerHTML = "Неправильный логин или пароль!";
                                    var a = document.getElementById("myModal");
                                    a.style.display = "block";
                                </script>';
                    }
                }
                else{
                    echo    '<script type="text/javascript">var messageBox = document.getElementById("textmessage");
                                messageBox.innerHTML = "Неправильный логин или пароль!";
                                var a = document.getElementById("myModal");
                                a.style.display = "block";
                            </script>';
                }
            }
        ?>

    </body>
</html>